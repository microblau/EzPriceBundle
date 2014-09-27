<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 15:26
 */

namespace Efl\DiscountsBundle\eZ\Publish\Core\Persistence\Legacy\Discounts\Gateway;

use Doctrine\ORM\EntityManager;
use Efl\DiscountsBundle\Entity\Ezdiscountrule;
use Efl\DiscountsBundle\eZ\Publish\Core\Persistence\Legacy\Discounts\Gateway;
use eZ\Publish\API\Repository\UserService;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\Core\Repository\Values\User\User;
use eZ\Publish\API\Repository\Repository;

class Doctrine extends Gateway
{
    /**
     * Database h&&ler
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Construct from database h&&ler
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(
        EntityManager $em,
        UserService $userService,
        Repository $repository
    )
    {
        $this->em = $em;
        $this->userService = $userService;
        $this->repository = $repository;
    }

    public function getDiscountPercent( User $user, Content $content )
    {
        $bestMatch = 0.0;

        $params = array(
            'contentobject_id' => $content->id,
            'contentclass_id' => $content->contentInfo->contentTypeId,
            'section_id' => $content->contentInfo->sectionId
        );

        $userId = $user->id;
        $repository = $this->repository;

        $groups = $repository->sudo(
            function ( $repository ) use ( $user )
            {
                return $this->userService->loadUserGroupsOfUser( $user );
            }
        );

        $groupsIds = array();
        foreach ( $groups as $group )
        {
            $groupsIds[] = $group->id;
        }

        $idArray = array_merge( $groupsIds, array( $userId ) );

        $rules = $this->fetchRulesIdsByIdArray( $idArray );

        if ( count ( $rules ) )
        {
            $subRules = $this->getSubRulesByRules( $rules );

            foreach ( $subRules as $subRule ) {
                /** @var \Efl\DiscountsBundle\Entity\Ezdiscountsubrule $subrule */
                if ( $subRule->getDiscountPercent() > $bestMatch )
                {
                    if ( $subRule->getLimitation() == '*' )
                        $bestMatch = $subRule->getDiscountPercent();
                    else
                    {
                        $limitationArray = $this->getLimitationArray( $subRule->getId() );
                        $bestMatch = $this->getBestMatch( $subRule, $limitationArray, $params );
                    }
                }
            }
        }

        return $bestMatch > 0 ? $bestMatch : false;
    }

    private function fetchRulesIdsByIdArray( array $idArray = array() )
    {
        $query = $this->em->createQueryBuilder();
        $query->addSelect( 'ezdiscountrule.id' )
            ->from( 'EflDiscountsBundle:Ezdiscountrule', 'ezdiscountrule' )
            ->innerJoin( 'EflDiscountsBundle:EzuserDiscountrule', 'u', 'WITH', 'u.discountruleId = ezdiscountrule.id' )
            ->where( $query->expr()->in( 'u.contentobjectId', ':idArray' ) )
            ->setParameter( 'idArray', $idArray );

        $rulesIds = array();
        foreach ( $query->getQuery()->getResult() as $result )
        {
            $rulesIds[] = $result['id'];
        }

        return $rulesIds;
    }

    private function getSubRulesByRules( array $rules = array() )
    {
        $query = $this->em->createQueryBuilder();
        $query->select( 'ezdiscountsubrule' )
            ->from( 'EflDiscountsBundle:Ezdiscountsubrule', 'ezdiscountsubrule' )
            ->where( $query->expr()->in( 'ezdiscountsubrule.discountruleId', $rules ) )
            ->orderBy( 'ezdiscountsubrule.discountPercent', 'DESC' );

        return $query->getQuery()->getResult();
    }

    private function getLimitationArray( $subRuleId )
    {
        $query = $this->em->createQueryBuilder();
        $query->select( 'ezdiscountsubrule_value' )
            ->from( 'EflDiscountsBundle:EzdiscountsubruleValue', 'ezdiscountsubrule_value' )
            ->where( $query->expr()->eq( 'ezdiscountsubrule_value.discountsubruleId', $subRuleId ) );

        return $query->getQuery()->getResult();
    }

    private function getBestMatch( $subRule, $limitationArray, $params )
    {
        $hasSectionLimitation = false;
        $hasClassLimitation = false;
        $hasObjectLimitation = false;
        $objectMatch = false;
        $sectionMatch = false;
        $classMatch = false;
        foreach ( $limitationArray as $limitation )
        {
            if ( $limitation->getIssection() == '1' )
            {
                $hasSectionLimitation = true;

                if ( isset( $params['section_id'] ) && $params['section_id'] == $limitation->getValue() )
                    $sectionMatch = true;
            }
            elseif ( $limitation->getIssection() == '2' )
            {
                $hasObjectLimitation = true;

                if ( isset( $params['contentobject_id'] ) && $params['contentobject_id'] == $limitation->getValue() )
                    $objectMatch = true;
            }
            else
            {
                $hasClassLimitation = true;
                if ( isset( $params['contentclass_id'] ) && $params['contentclass_id'] == $limitation->getValue() )
                    $classMatch = true;
            }
        }

        $match = true;
        if ( ( $hasClassLimitation == true ) && ( $classMatch == false ) )
            $match = false;

        if ( ( $hasSectionLimitation == true ) && ( $sectionMatch == false ) )
            $match = false;

        if ( ( $hasObjectLimitation == true ) && ( $objectMatch == false ) )
            $match = false;

        if ( $match == true  )
            return $subRule->getDiscountPercent();
    }
}
