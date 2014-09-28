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
 * Actualiza la clase producto_qmementix
 */
class Command28Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command28' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        $contentTypeService = $repository->getContentTypeService();

        try
        {
            $repository->beginTransaction();
            $contentType = $contentTypeService->loadContentTypeByIdentifier( 'producto_qmementix' );

            $titleField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'title',
                    'names' => array( 'esl-ES' => 'Titulo principal' ),
                    'position' => 26,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );

            $texto1Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'text1',
                    'names' => array( 'esl-ES' => 'Texto 1' ),
                    'position' => 27,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );

            $texto2Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'text2',
                    'names' => array( 'esl-ES' => 'Texto 2' ),
                    'position' => 28,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );

            $imagenPreviewVideo = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'img_preview_video',
                    'names' => array( 'esl-ES' => 'Imagen preview video' ),
                    'position' => 29,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );


            $imagenPreviewVideo2 = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'img_preview_video_2',
                    'names' => array( 'esl-ES' => 'Imagen preview video 2' ),
                    'position' => 31,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );


            $videoYouTube = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'url_youtube',
                    'names' => array( 'esl-ES' => 'Vídeo' ),
                    'position' => 29,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );

            $ventaja1Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'ventaja1',
                    'names' => array( 'esl-ES' => 'Ventaja 1' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $ventaja2Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'ventaja2',
                    'names' => array( 'esl-ES' => 'Ventaja 2' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );
            $ventaja3Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'ventaja3',
                    'names' => array( 'esl-ES' => 'Ventaja 3' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );
            $ventaja4Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'ventaja4',
                    'names' => array( 'esl-ES' => 'Ventaja 4' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $contenidos1Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos1',
                    'names' => array( 'esl-ES' => 'Contenidos 1' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $contenidos2Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos2',
                    'names' => array( 'esl-ES' => 'Contenidos 2' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $contenidos3Field = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos3',
                    'names' => array( 'esl-ES' => 'Contenidos 3' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidad1 = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidad1',
                    'names' => array( 'esl-ES' => 'Funcionalidad 1' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidad2 = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidad2',
                    'names' => array( 'esl-ES' => 'Funcionalidad 2' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidad3 = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidad3',
                    'names' => array( 'esl-ES' => 'Funcionalidad 3' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $fieldIdentifiers = array();
            foreach ( $contentType->getFieldDefinitions() as $fieldIdentifier )
            {
                $fieldIdentifiers[] = $fieldIdentifier->identifier;
            }
            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            if ( !in_array( 'title', $fieldIdentifiers ) )
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $titleField );

            if ( !in_array( 'text1', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $texto1Field );

            if ( !in_array( 'text2', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $texto2Field );

            if ( !in_array( 'img_preview_video', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $imagenPreviewVideo );

            if ( !in_array( 'url_youtube', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $videoYouTube );

            if ( !in_array( 'img_preview_video_2', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $imagenPreviewVideo2 );

            if ( !in_array( 'ventaja1', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $ventaja1Field );

            if ( !in_array( 'ventaja2', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $ventaja2Field );

            if ( !in_array( 'ventaja3', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $ventaja3Field );

            if ( !in_array( 'ventaja4', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $ventaja4Field );

            if ( !in_array( 'contenidos1', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $contenidos1Field );

            if ( !in_array( 'contenidos2', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $contenidos2Field );

            if ( !in_array( 'contenidos3', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $contenidos3Field );

            if ( !in_array( 'funcionalidad1', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $funcionalidad1 );

            if ( !in_array( 'funcionalidad2', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $funcionalidad2 );

            if ( !in_array( 'funcionalidad3', $fieldIdentifiers ))
                $contentTypeService->addFieldDefinition( $contentTypeDraft, $funcionalidad3 );

            $contentTypeService->publishContentTypeDraft( $contentTypeDraft );

            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

    }
}
