<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;
use eZ\Publish\API\Repository\Exceptions\InvalidArgumentException;
use Exception;


/**
 * Class Command27Command
 * @package Efl\WebBundle\Command
 *
 * Crea las clases para los formatos de producto
 */
class Command27Command extends ContainerAwareCommand
{
    private $classes = array(
        'formato_ipad' => array(
            'nombre' => 'Formato IPAD',
            'vat_id' => 4
        ),
        'formato_papel' =>  array(
            'nombre' => 'Formato Papel',
            'vat_id' => 1
        ),
        'formato_internet' => array(
            'nombre' => 'Formato Internet',
            'vat_id' => 4
        ),
    );

    protected function configure()
    {
        $this->setName( 'efl:web:command27' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $group = $this->getGroup( $input, $output );

        foreach ( $this->classes as $index => $data )
        {
            $this->createClass( $index, $group, $data );
        }

    }

    private function getGroup( $input, $output )
    {
        try
        {
            return $this->getContainer()->get( 'ezpublish.api.repository')->getContentTypeService()->loadContentTypeGroupByIdentifier( 'Formatos de producto' );
        }
        catch ( \Exception $e )
        {
            return $this->createGroup( $input, $output );
        }
    }

    private function createGroup( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        $contentTypeService = $repository->getContentTypeService();
        $contentTypeGroupStruct = new CreateGroupStruct(
            array(
                'identifier' => 'Formatos de producto'
            )
        );

        try
        {
            $group = $contentTypeService->createContentTypeGroup( $contentTypeGroupStruct );
            return $group;
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
        catch ( Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }
    }

    private function createClass( $class, $group, $data )
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        $wsProductField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'wsproduct',
                'identifier' => 'producto',
                'names' => array( 'esl-ES' => 'Producto WebService' ),
                'position' => 1,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        $wsPriceField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezprice',
                'identifier' => 'precio',
                'names' => array( 'esl-ES' => 'Precio' ),
                'position' => 2,
                'isRequired' => true,
                'isSearchable' => false,
                'fieldSettings' => array(
                    'is_vat_included' => false,
                    'vat_id' => -1
                )
            )
        );

        $wsPriceFieldOferta = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezprice',
                'identifier' => 'precio_oferta',
                'names' => array( 'esl-ES' => 'Precio Oferta' ),
                'position' => 3,
                'isRequired' => false,
                'isSearchable' => false,
                'fieldSettings' => array(
                    'is_vat_included' => false,
                    'vat_id' => -1
                )
            )
        );

        $categoria = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezproductcategory',
                'identifier' => 'categoria',
                'names' => array( 'esl-ES' => 'Categoría' ),
                'position' => 4,
                'isRequired' => false,
                'isSearchable' => false
            )
        );

        $fechaInicioOferta = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezdate',
                'identifier' => 'fecha_inicio_oferta',
                'names' => array( 'esl-ES' => 'Fecha Inicio Oferta' ),
                'position' => 7,
                'isRequired' => false,
                'isSearchable' => true
            )
        );

        $fechaFinOferta = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezdate',
                'identifier' => 'fecha_fin_oferta',
                'names' => array( 'esl-ES' => 'Fecha Fin Oferta' ),
                'position' => 8,
                'isRequired' => false,
                'isSearchable' => true
            )
        );

        $contentTypeStruct = new CreateTypeStruct(
            array(
                'identifier' => $class,
                'mainLanguageCode' => 'esl-ES',
                'nameSchema' => '<producto> - ' . $data['nombre'],
                'names' => array( 'esl-ES' => $data['nombre'] ),
                'fieldDefinitions' => array(
                    $wsProductField, $wsPriceField, $wsPriceFieldOferta, $categoria,
                    $fechaInicioOferta,
                    $fechaFinOferta,
                )
            )
        );

        try
        {
            $contentTypeService = $this->getContainer()->get( 'ezpublish.api.repository')->getContentTypeService();
            $contentType = $contentTypeService->createContentType(
                $contentTypeStruct,
                array( $group )
            );

            $contentTypeService->publishContentTypeDraft( $contentType );
        }
        catch ( \Exception $e )
        {
            throw $e;
        }
    }
}
