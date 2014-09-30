<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 15:22
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\Core\Base\Exceptions\ContentTypeFieldDefinitionValidationException;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;

/**
 * Class Command2Command
 * @package Efl\WebBundle\Command
 *
 * Creará la clase "info_modules" (Módulos informativos)
 * Son los que aparecen en el pie
 */
class Command32Command extends ContainerAwareCommand
{
    /** @var \eZ\Publish\API\Repository\Repository */
    protected $repository;

    protected $contentTypeService;

    protected function configure()
    {
        $this->setName( 'efl:web:command32' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );
        $contentTypeService = $repository->getContentTypeService();

        try
        {
            $titleField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'title',
                    'names' => array( 'esl-ES' => 'Titulo principal' ),
                    'position' => 1,
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
                    'position' => 2,
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
                    'position' => 3,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );

            $imagen = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'big_image',
                    'names' => array( 'esl-ES' => 'Imagen' ),
                    'position' => 4,
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
                    'position' => 5,
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
                    'position' => 6,
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
                    'position' => 7,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );


            $urlAppStore = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'url_appstore',
                    'names' => array( 'esl-ES' => 'AppStore' ),
                    'position' => 8,
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
                    'position' => 9,
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
                    'position' => 10,
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
                    'position' => 11,
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
                    'position' => 12,
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
                    'position' => 13,
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
                    'position' => 14,
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
                    'position' => 15,
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
                    'position' => 16,
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
                    'position' => 17,
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
                    'position' => 18,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $contentTypeGroup = $contentTypeService->loadContentTypeGroupByIdentifier( 'Clases 2014' );

            $contentTypeStruct = new CreateTypeStruct(
                array(
                    'identifier' => 'qmemento',
                    'mainLanguageCode' => 'esl-ES',
                    'nameSchema' => 'QMemento',
                    'names' => array( 'esl-ES' => 'QMemento' ),
                    'fieldDefinitions' => array(
                        $titleField,
                        $texto1Field,
                        $texto2Field,
                        $imagen,
                        $imagenPreviewVideo,
                        $videoYouTube,
                        $imagenPreviewVideo2,
                        $ventaja1Field,
                        $ventaja2Field,
                        $ventaja3Field,
                        $ventaja4Field,
                        $contenidos1Field,
                        $contenidos2Field,
                        $contenidos3Field,
                        $funcionalidad1,
                        $funcionalidad2,
                        $funcionalidad3
                    )
                )
            );

            $contentType = $contentTypeService->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );

            $contentTypeService->publishContentTypeDraft( $contentType );
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
    }
}
