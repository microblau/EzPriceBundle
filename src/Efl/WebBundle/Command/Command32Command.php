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
 * Class Command32Command
 * @package Efl\WebBundle\Command
 *
 * Crea la clase memento
 */
class Command32Command extends ContainerAwareCommand
{
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
            $repository->beginTransaction();
            $contentTypeGroup = $repository->getContentTypeService()->loadContentTypeGroupByIdentifier( 'Clases 2014' );

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

            $imagenPreviewVideo = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'img_preview_video',
                    'names' => array( 'esl-ES' => 'Imagen preview video' ),
                    'position' => 4,
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
                    'position' => 5,
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
                    'position' => 6,
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
                    'position' => 7,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño Cabecera'
                )
            );


            $ventajas = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'ventajas',
                    'names' => array( 'esl-ES' => 'Ventajas' ),
                    'position' => 8,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $contenidosField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos',
                    'names' => array( 'esl-ES' => 'Contenidos' ),
                    'position' => 9,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidades = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidades',
                    'names' => array( 'esl-ES' => 'Funcionalidades' ),
                    'position' => 10,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );


            $contentTypeStruct = new CreateTypeStruct(
                array(
                    'identifier' => 'qmemento',
                    'mainLanguageCode' => 'esl-ES',
                    'nameSchema' => '<title>',
                    'names' => array( 'esl-ES' => 'Qmemento' ),
                    'fieldDefinitions' => array(
                        $titleField,
                        $texto1Field,
                        $texto2Field,
                        $imagenPreviewVideo,
                        $imagenPreviewVideo2,
                        $imagen,
                        $videoYouTube,
                        $ventajas,
                        $contenidosField,
                        $funcionalidades
                    )
                )
            );

            $contentType = $repository->getContentTypeService()->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );
            $repository->getContentTypeService()->publishContentTypeDraft( $contentType );
            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

    }
}
