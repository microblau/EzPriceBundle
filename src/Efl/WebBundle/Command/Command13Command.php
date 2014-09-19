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


/**
 * Class Command13Command
 * @package Efl\WebBundle\Command
 *
 * Crea una nueva clase llamada "módulos menú compra" para gestionarlos. además, les añade textos.
 * Lo hace en la carpeta  auxiliar (142)
 *
 */
class Command13Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command13' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        try
        {
            $this->createModulesMenuCompra();
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }
        try
        {
            $this->createModules();
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }
    }

    private function createModulesMenuCompra()
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $contentTypeService = $repository->getContentTypeService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

        $titleField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezstring',
                'identifier' => 'title',
                'names' => array( 'esl-ES' => 'titulo' ),
                'position' => 1,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        $bodyField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezxmltext',
                'identifier' => 'body',
                'names' => array( 'esl-ES' => 'Texto' ),
                'position' => 2,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        // necesitamos el grupo clases 2014
        $contentTypeGroup = $contentTypeService->loadContentTypeGroupByIdentifier( 'Clases 2014' );

        $contentTypeStruct = new CreateTypeStruct(
            array(
                'identifier' => 'modules_menu_compra',
                'mainLanguageCode' => 'esl-ES',
                'nameSchema' => '<title>',
                'names' => array( 'esl-ES' => 'Módulos menú compra' ),
                'fieldDefinitions' => array( $titleField, $bodyField )
            )
        );

        // hay que crear el tipo ahora y asignarlo a este group
        try
        {
            $contentType = $contentTypeService->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );

            $contentTypeService->publishContentTypeDraft( $contentType );
        }
        catch ( InvalidArgumentException $e )
        {
            throw $e;
        }
    }

    private function createModules( )
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $contentTypeService = $repository->getContentTypeService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );
        $data = array(
            array(
                'title' => 'Metodos de envío',
                'body' => '<paragraph><strong>Una vez procesado su pedido, en el caso de obras ya editadas, le será entregado por la mensajería entre 27 y 72 horas.</strong></paragraph>
                           <paragraph>Los costes de envío son gratuitos para pedidos de más de 30€ dentro de la Península y Baleares. Para pedidos inferiores, 3€.</paragraph>',
            ),
            array(
                'title' => 'Formas de Pago',
                'body' => '<paragraph>Disponemos de una certificación SSL que garantiza que sus datos y transacciones siempre estarán seguros.</paragraph>
                           <paragraph><link href="#">Más detalles sobre formas de pago</link></paragraph>'
            ),
            array(
                'title' => 'Contactar',
                'body' => '<paragraph><strong>Elija la forma que prefiera y póngase en contacto con nosotros y le atenderá alguno de nuestros profesionales de respuesta inmediata sobre cualquier producto Francis Lefebvre.</strong></paragraph>
                            <paragraph>Llamar al 912 108 000, o si lo prefiere, <link href="#">le llamamos nosotros</link> cuando usted quiera.</paragraph>
                            <paragraph>Escriba a nuestro Centro de Atención al Cliente, <link href="mailto:clientes@efl.es">clientes@efl.es</link> y le responderemos en 24 horas.</paragraph>
                            <paragraph>Solicite la ayuda online mediante nuestro <link href="#">chat de soporte</link>.</paragraph>'
            ),
        );

        try
        {

            foreach ( $data as $item )
            {
                $contentType = $contentTypeService->loadContentTypeByIdentifier( 'modules_menu_compra' );
                $contentCreateStruct = $repository->getContentService()->newContentCreateStruct( $contentType, 'esl-ES' );
                $contentCreateStruct->setField( 'title', $item['title'] );
                $xmlText = "<?xml version='1.0' encoding='utf-8'?><section>{$item['body']}</section>";

                $contentCreateStruct->setField( 'body', $xmlText );

                $locationCreateStruct = $repository->getLocationService()->newLocationCreateStruct( 142 );
                // create a draft using the content and location create struct and publish it
                $draft = $repository->getContentService()->createContent( $contentCreateStruct, array( $locationCreateStruct ) );
                $repository->getContentService()->publishVersion( $draft->versionInfo );
            }
        }
        catch ( Exception $e )
        {
            throw $e;
        }

    }
}
