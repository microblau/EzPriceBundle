<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 14:19
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct;
use eZ\Publish\Core\REST\Client\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;

/**
 * Class Command1Command
 * @package Efl\WebBundle\Command
 *
 * Crear grupo de clases ofertas
 */
class Command38Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command38' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

        $contentTypeService = $repository->getContentTypeService();
        $contentTypeGroupStruct = new CreateGroupStruct(
            array(
                'identifier' => 'Tipos de Oferta'
            )
        );

        try
        {
            $contentTypeGroup = $contentTypeService->createContentTypeGroup($contentTypeGroupStruct);
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }

            $titleField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'title',
                    'names' => array( 'esl-ES' => 'title' ),
                    'position' => 1,
                    'isRequired' => true,
                    'isSearchable' => false,
                )
            );


            $description = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'description',
                    'names' => array( 'esl-ES' => 'Descripción' ),
                    'position' => 2,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $descuento = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezfloat',
                    'identifier' => 'discount',
                    'names' => array( 'esl-ES' => 'Descuento' ),
                    'position' => 3,
                    'isRequired' => true,
                    'isSearchable' => false,
                )
            );

            $productos = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelationlist',
                    'identifier' => 'products',
                    'names' => array( 'esl-ES' => 'Productos a los que aplica' ),
                    'position' => 4,
                    'isRequired' => false,
                    'isSearchable' => true,
                )
            );

            $fechaInicio = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezdatetime',
                    'identifier' => 'fecha_inicio',
                    'names' => array( 'esl-ES' => 'Fecha inicio' ),
                    'position' => 5,
                    'isRequired' => false,
                    'isSearchable' => true,
                )
            );

            $fechaFin = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezdatetime',
                    'identifier' => 'fecha_fin',
                    'names' => array( 'esl-ES' => 'Fecha Fin' ),
                    'position' => 6,
                    'isRequired' => false,
                    'isSearchable' => true,
                )
            );

            $contentTypeStruct = new ContentTypeCreateStruct(
                array(
                    'identifier' => 'oferta_comb_2_soportes',
                    'mainLanguageCode' => 'esl-ES',
                    'nameSchema' => '<title>',
                    'names' => array( 'esl-ES' => 'Combinado de dos soportes' ),
                    'fieldDefinitions' => array(
                        $titleField,
                        $description,
                        $descuento,
                        $productos,
                        $fechaInicio,
                        $fechaFin
                    )
                )
            );
        try
        {
            $contentTypeGroup = $repository->getContentTypeService()->loadContentTypeGroupByIdentifier('Tipos de Oferta');

            $contentType = $repository->getContentTypeService()->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );

            $repository->getContentTypeService()->publishContentTypeDraft( $contentType );

        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }
    }
}
