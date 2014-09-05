<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 15:22
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

/**
 * Class Command6Command
 * @package Efl\WebBundle\Command
 *
 * Creará la zona de contenidos 'Atención al cliente'
 *
 * Además moverá algunas localizaciones a esa zona para así
 * poder formar el menú de Atención al Cliente
 *
 */
class Command6Command extends ContainerAwareCommand
{
    /** @var \eZ\Publish\API\Repository\Repository */
    protected $repository;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    protected $locationService;

    protected $contentService;

    protected $contentTypeService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    protected $searchService;


    protected function configure()
    {
        $this->setName( 'efl:web:command6' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->contentService = $this->repository->getContentService();
        $this->locationService = $this->repository->getLocationService();
        $this->contentTypeService = $this->repository->getContentTypeService();
        $this->searchService = $this->repository->getSearchService();
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );

        try
        {
            $contentType = $this->contentTypeService->loadContentTypeByIdentifier( 'folder' );
            $contentCreateStruct = $this->contentService->newContentCreateStruct( $contentType, 'esl-ES' );
            $contentCreateStruct->setField( 'name', 'Atención al cliente' );

            $locationCreateStruct = $this->locationService->newLocationCreateStruct( 2 );
            $draft = $this->contentService->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
            $content = $this->contentService->publishVersion( $draft->versionInfo );
            $createdLocationId = $content->contentInfo->mainLocationId;
            $createdLocation = $this->locationService->loadLocation( $createdLocationId );

            $faqLocation = $this->locationService->loadLocation( 80 );
            $this->locationService->moveSubtree( $faqLocation, $createdLocation );

            $contactoLocation = $this->locationService->loadLocation( 1073 );
            $this->locationService->moveSubtree( $contactoLocation, $createdLocation );
        }
        catch ( Exception $e )
        {
            print_r( $e );
            $output->writeln( $e->getMessage() );
        }


    }

}
