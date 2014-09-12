<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeUpdateStruct;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use Exception;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;

/**
 * Class Command12Command
 * @package Efl\WebBundle\Command
 *
 * Asigna el location nosotros y sus hijos a la sección quiénes somos
 *
 */
class Command12Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command12' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->contentService = $this->repository->getContentService();
        $this->locationService = $this->repository->getLocationService();
        $this->contentTypeService = $this->repository->getContentTypeService();
        $this->searchService = $this->repository->getSearchService();
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );

        $porQueLocation = $this->locationService->loadLocation ( 63 );
        $nosotrosLocation = $this->locationService->loadLocation( $porQueLocation->parentLocationId );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $nosotrosLocation->depth + 1 ),
                new Criterion\Subtree( $nosotrosLocation->pathString )
            )
        );

        $result = $this->searchService->findLocations( $query )->searchHits;
        $section = $this->repository->getSectionService()->loadSection( 10 );
        $this->repository->getSectionService()->assignSection( $nosotrosLocation->contentInfo, $section );
        foreach ( $result as $location )
        {
            $this->repository->getSectionService()->assignSection( $location->valueObject->contentInfo, $section );
        }
    }
}
