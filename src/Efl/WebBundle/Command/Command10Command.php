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

/**
 * Class Command10Command
 * @package Efl\WebBundle\Command
 *
 * Creará una carpeta llamada Nosotros en el primer nivel
 * y moverá a ella la carpeta por qué lefebvre
 *
 */
class Command10Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command10' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->contentService = $this->repository->getContentService();
        $this->locationService = $this->repository->getLocationService();
        $this->contentTypeService = $this->repository->getContentTypeService();
        $this->searchService = $this->repository->getSearchService();
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );

        $contentType = $this->contentTypeService->loadContentTypeByIdentifier( 'folder' );
        $contentCreateStruct = $this->contentService->newContentCreateStruct( $contentType, 'esl-ES' );
        $contentCreateStruct->setField( 'name', 'Nosotros' );

        $locationCreateStruct = $this->locationService->newLocationCreateStruct( 2 );
        // create a draft using the content and location create struct and publish it
        $draft = $this->contentService->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
        $content = $this->contentService->publishVersion( $draft->versionInfo );

        $nosotrosLocation = $this->locationService->loadLocation ( $content->contentInfo->mainLocationId );

        $porQueLocation = $this->locationService->loadLocation ( 63 );
        $this->locationService->moveSubtree( $porQueLocation, $nosotrosLocation );


    }
}
