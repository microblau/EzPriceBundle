<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 18/09/14
 * Time: 10:45
 */

namespace Efl\WebServiceBundle\Driver;

use eZ\Publish\API\Repository\Repository;
use eZ\Publish\API\Repository\UserService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\Core\Repository\Values\User\User;

class UserCreatorService
{
    /**
     * @var \eZ\Publish\API\Repository\UserService
     */
    private $userService;

    private $repository;

    private $locationService;

    private $contentTypeService;

    private $contentService;

    public function __construct(
        Repository $repository,
        UserService $userService,
        LocationService $locationService,
        ContentTypeService $contentTypeService,
        ContentService $contentService
    )
    {
        $this->userService = $userService;
        $this->repository = $repository;
        $this->locationService = $locationService;
        $this->contentTypeService = $contentTypeService;
        $this->contentService = $contentService;
    }

    /**
     * Crea nuevo usuario en el eZ en función del username
     *
     * @param $username
     * @param $colective identificador del colectivo
     */
    public function createNewUser( $username, $colective )
    {
        $repository = $this->repository;
        $contentTypeService = $this->contentTypeService;
        $userService = $this->userService;

        $userGroup = $this->getColectiveBySiglas( $colective );


        return $repository->sudo(
            function( $repository ) use( $contentTypeService, $userService, $username, $userGroup )
            {
                $userType = $contentTypeService->loadContentTypeByIdentifier( 'user' );
                $userCreateStruct = $userService->newUserCreateStruct(
                    $username,
                    $username,
                    "password",
                    'esl-ES',
                    $userType
                );
                $parts = explode( '@', $username );
                $userCreateStruct->setField( 'first_name', $parts[0] );
                $userCreateStruct->setField( 'last_name', $parts[1] );
                return $userService->createUser( $userCreateStruct, array( $userGroup ) );
            }
        );
    }

    /**
     * Mueve al usuario de grupo en el caso de que lo que nos diga el ws
     * no coincida con lo que tenemos nosotros
     *
     * @param User $user
     * @param $colective
     */
    public function placeUserInGroup( User $user, $colective )
    {
        $repository = $this->repository;
        $destinationGroup = $this->getColectiveBySiglas( $colective );
        $repository->sudo(
            function( $repository ) use ( $user, $destinationGroup )
            {
                $userGroups = $repository->getUserService()->loadUserGroupsOfUser( $user );

                if( $destinationGroup->id != $userGroups[0]->id )
                {
                    $repository->getUserService()->assignUserToUserGroup( $user, $destinationGroup );
                    // quitamos del grupo actual
                    $repository->getUserService()->unAssignUserFromUserGroup( $user, $userGroups[0] );

                }
            }
        );
    }

    private function getColectiveBySiglas( $colective )
    {
        $repository = $this->repository;
        $locationService = $this->locationService;

        return $repository->sudo(
            function( $repository ) use( $locationService, $colective )
            {
                $rootLocation = $locationService->loadLocation( 411 );
                $searchService = $repository->getSearchService();
                $query = new LocationQuery();

                $query->query = new Criterion\LogicalAnd(
                    array(
                        new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                        new Criterion\Location\Depth( Criterion\Operator::EQ, $rootLocation->depth + 1 ),
                        new Criterion\Subtree( $rootLocation->pathString ),
                        new Criterion\ContentTypeIdentifier( 'user_group' ),
                        new Criterion\Field( 'siglas', Criterion\Operator::EQ, $colective ),
                        new Criterion\LogicalNot(
                            new Criterion\Field( 'siglas', Criterion\Operator::EQ, '' )
                        )
                    )
                );

                $results = $searchService->findLocations( $query )->searchHits;

                if ( count ( $results ) )
                {
                    return $repository->getUserService()->loadUserGroup( $results[0]->valueObject->contentInfo->id );
                }

                return $repository->getUserService()->loadUserGroup( '11' );
            }
        );
    }
}

