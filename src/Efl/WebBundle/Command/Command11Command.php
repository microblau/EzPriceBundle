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
 * Class Command11Command
 * @package Efl\WebBundle\Command
 *
 * Coge todos los hijos de por qué lefebvre y los pone al mismo nivel que él
 *
 */
class Command11Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command11' )->setDefinition(array());
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
                new Criterion\Location\Depth( Criterion\Operator::EQ, $porQueLocation->depth + 1 ),
                new Criterion\Subtree( $porQueLocation->pathString )
            )
        );

        $result = $this->searchService->findLocations( $query )->searchHits;

        foreach ( $result as $location )
        {
            $this->locationService->moveSubtree( $location->valueObject, $nosotrosLocation );
        }


    }
}
