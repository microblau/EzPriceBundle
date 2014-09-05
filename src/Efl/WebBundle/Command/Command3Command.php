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
 * Class Command2Command
 * @package Efl\WebBundle\Command
 *
 * Creará los contenidos "info_modules" (Módulos informativos)
 * Los meterá en una carpeta q también creará
 * Son los que aparecen en el pie
 */
class Command3Command extends ContainerAwareCommand
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
        $this->setName( 'efl:web:command3' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->contentService = $this->repository->getContentService();
        $this->locationService = $this->repository->getLocationService();
        $this->contentTypeService = $this->repository->getContentTypeService();
        $this->searchService = $this->repository->getSearchService();
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );

        $data = array(
            array(
                'title' => 'Atención al cliente',
                'icon' => 'info',
                'body' => 'Si tiene dudas póngase en contacto con nosotros a través de <link href="mailto:clientes@efl.es">clientes@efl.es</link> o mediante la <link href="#">página de contacto</link>.'
            ),
            array(
                'title' => 'Por teléfono',
                'icon' => 'phone',
                'body' => 'Lo más rápido es llamarnos al <strong>912 108 000</strong> le atenderemos de 9:00h a 20:00h de Lunes a Viernes.'
            ),

            array(
                'title' => 'Envío gratis',
                'icon' => 'box',
                'body' => 'Para pedidos de más de <strong>30€</strong> enviamos gratis tu compra a cualquier lugar de la península.'
            ),

            array(
                'title' => 'Devoluciones',
                'icon' => 'calendar',
                'body' => 'Hasta <strong>dos meses</strong> desde que recibe el pedido para devolver la compra si no ha quedado satisfecho.'
            ),


        );

        try
        {
            $findFolder = $this->findFolder();
            if ( count( $findFolder ) === 0 )
            {
                $contentType = $this->contentTypeService->loadContentTypeByIdentifier( 'folder' );
                $contentCreateStruct = $this->contentService->newContentCreateStruct( $contentType, 'esl-ES' );
                $contentCreateStruct->setField( 'name', 'Módulos informativos del Pie' );

                $locationCreateStruct = $this->locationService->newLocationCreateStruct( 142 );
                // create a draft using the content and location create struct and publish it
                $draft = $this->contentService->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
                $content = $this->contentService->publishVersion( $draft->versionInfo );

                // guardar el location de la carpeta creada
                $carpetaLocationId = $content->contentInfo->mainLocationId;
            }
            else
            {
                $carpetaLocationId = $findFolder[0]->valueObject->id;
            }
        }
// Content type or location not found
        catch ( \eZ\Publish\API\Repository\Exceptions\NotFoundException $e )
        {
            $output->writeln( $e->getMessage() );
        }
// Invalid field value
        catch ( \eZ\Publish\API\Repository\Exceptions\ContentFieldValidationException $e )
        {
            $output->writeln( $e->getMessage() );
        }
// Required field missing or empty
        catch ( \eZ\Publish\API\Repository\Exceptions\ContentValidationException $e )
        {
            $output->writeln( $e->getMessage() );
        }

        try
        {

            foreach ( $data as $item )
            {
                $contentType = $this->contentTypeService->loadContentTypeByIdentifier( 'info_modules' );
                $contentCreateStruct = $this->contentService->newContentCreateStruct( $contentType, 'esl-ES' );
                $contentCreateStruct->setField( 'title', $item['title'] );
                $contentCreateStruct->setField( 'icon', $item['icon'] );
                $xmlText = "<?xml version='1.0' encoding='utf-8'?><section><paragraph>{$item['body']}</paragraph></section>";

                $contentCreateStruct->setField( 'body', $xmlText );

                $locationCreateStruct = $this->locationService->newLocationCreateStruct( $carpetaLocationId );
                    // create a draft using the content and location create struct and publish it
                $draft = $this->contentService->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
                $this->contentService->publishVersion( $draft->versionInfo );
            }
        }
        catch ( Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }


    }

    private function findFolder()
    {
        $location = $this->locationService->loadLocation( 142 );
        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\Field( 'name', Criterion\Operator::EQ, 'Módulos informativos del Pie' )
            )
        );

        return $this->searchService->findLocations( $query )->searchHits;
    }
}
