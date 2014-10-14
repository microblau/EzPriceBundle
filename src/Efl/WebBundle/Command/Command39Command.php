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
use eZ\Publish\API\Repository\Repository;

/**
 * Class Command39Command
 * @package Efl\WebBundle\Command
 *
 * Oferta combinado dos productos
 */
class Command39Command extends ContainerAwareCommand
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
        $this->setName( 'efl:web:command39' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var Repository $repository */
        $repository =  $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

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
            $findFolder = $this->findFolder( $repository );
            if ( count( $findFolder ) === 0 )
            {
                $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier( 'folder' );
                $contentCreateStruct = $repository->getContentService()->newContentCreateStruct( $contentType, 'esl-ES' );
                $contentCreateStruct->setField( 'name', 'Ofertas' );

                $locationCreateStruct = $repository->getLocationService()->newLocationCreateStruct( 295 );
                // create a draft using the content and location create struct and publish it
                $draft = $repository->getContentService()->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
                $content = $repository->getContentService()->publishVersion( $draft->versionInfo );

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

            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier( 'oferta_comb_2_soportes' );
                $contentCreateStruct = $repository->getContentService()->newContentCreateStruct( $contentType, 'esl-ES' );
                $contentCreateStruct->setField( 'title', 'Combinado dos soportes' );
                $contentCreateStruct->setField( 'description', 'El usuario selecciona en la ficha el papel y un producto eléctronico' );
                $contentCreateStruct->setField( 'discount', 50.0 );

                $locationCreateStruct = $repository->getLocationService()->newLocationCreateStruct( $carpetaLocationId );
                    // create a draft using the content and location create struct and publish it
                $draft = $repository->getContentService()->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
                $repository->getContentService()->publishVersion( $draft->versionInfo );

        }
        catch ( Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }


    }

    private function findFolder( Repository $repository )
    {
        $location = $repository->getLocationService()->loadLocation( 295 );
        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\Field( 'name', Criterion\Operator::EQ, 'Ofertas' )
            )
        );

        return $repository->getSearchService()->findLocations( $query )->searchHits;
    }
}
