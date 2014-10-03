<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\FieldType\Relation\Value;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use eZ\Publish\SPI\Persistence\Content\Relation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;
use eZ\Publish\API\Repository\Exceptions\InvalidArgumentException;
use Exception;


/**
 * Class Command29Command
 * @package Efl\WebBundle\Command
 *
 * Actualiza la clase producto_qmementix
 */
class Command33Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command33' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        // crear primera imagen
        $parentLocationId = 117;

        $contentTypeService = $repository->getContentTypeService();
        $contentService = $repository->getContentService();
        $locationService = $repository->getLocationService();

        try
        {
            $contentType = $contentTypeService->loadContentTypeByIdentifier( "image" );
            $contentCreateStruct = $contentService->newContentCreateStruct( $contentType, 'eng-GB' );
            $contentCreateStruct->setField( 'name', 'Preview Video QMementix' ); // set name field

            $file = __DIR__ . '/../Resources/public/images/dummy-images/dummy-preview-video.jpg';

            // set image file field
            $value = new \eZ\Publish\Core\FieldType\Image\Value(
                array(
                    'path' => $file,
                    'fileSize' => filesize( $file ),
                    'fileName' => basename( $file ),
                    'alternativeText' => 'Preview Video QMementix'
                )
            );
            $contentCreateStruct->setField( 'image', $value );

            // Create and publish the image as a child of the provided parent location
            $draft = $contentService->createContent(
                $contentCreateStruct,
                array(
                    $locationService->newLocationCreateStruct( $parentLocationId )
                )
            );
            $content = $contentService->publishVersion( $draft->versionInfo );
            $img1 = $content->id;
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }

        try
        {
            $contentType = $contentTypeService->loadContentTypeByIdentifier( "image" );
            $contentCreateStruct = $contentService->newContentCreateStruct( $contentType, 'eng-GB' );
            $contentCreateStruct->setField( 'name', 'Botón Player Video QMementix' ); // set name field

            $file = __DIR__ . '/../Resources/public/images/preview.png';

            // set image file field
            $value = new \eZ\Publish\Core\FieldType\Image\Value(
                array(
                    'path' => $file,
                    'fileSize' => filesize( $file ),
                    'fileName' => basename( $file ),
                    'alternativeText' => 'Botón Player Vídeo QMementix'
                )
            );
            $contentCreateStruct->setField( 'image', $value );

            // Create and publish the image as a child of the provided parent location
            $draft = $contentService->createContent(
                $contentCreateStruct,
                array(
                    $locationService->newLocationCreateStruct( $parentLocationId )
                )
            );
            $content = $contentService->publishVersion( $draft->versionInfo );
            $img2 = $content->id;
        }
        catch ( \Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }

        $contentCreateStruct = $contentService->newContentCreateStruct(
            $repository->getContentTypeService()->loadContentTypeByIdentifier( 'qmemento' ),
            'esl-ES'
        );

        $contentCreateStruct->setField( 'title', 'Domine la información jurídica con facilidad' );
        $contentCreateStruct->setField( 'text1', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>El mejor motor de búsqueda de soluciones jurídicas del mercado, los Mementos Francis Lefebvre, y el sistema documentario más completo en la actualidad, Quantor.</paragraph></section>");
        $contentCreateStruct->setField( 'text2', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Con el objetivo de dar un gran paso adelante en los actuales sistemas de consulta, Nautis 4 ha evolucionado QMemento Essencial, aportando una forma aún más fácil y directa de acceder a la información.</paragraph></section>");
        $contentCreateStruct->setField( 'ventajas', '<?xml version="1.0" encoding="utf-8"?><section xmlns:image="http://ez.no/namespaces/ezpublish3/image/" xmlns:xhtml="http://ez.no/namespaces/ezpublish3/xhtml/" xmlns:custom="http://ez.no/namespaces/ezpublish3/custom/"><paragraph xmlns:tmp="http://ez.no/namespaces/ezpublish3/temporary/"><ul><li><paragraph xmlns:tmp="http://ez.no/namespaces/ezpublish3/temporary/">Actualización diaria de todos los contenidos.</paragraph></li></ul></paragraph></section>');
        $contentCreateStruct->setField( 'contenidos', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
        $contentCreateStruct->setField( 'funcionalidades', '<section xmlns:image="http://ez.no/namespaces/ezpublish3/image/" xmlns:xhtml="http://ez.no/namespaces/ezpublish3/xhtml/" xmlns:custom="http://ez.no/namespaces/ezpublish3/custom/"><paragraph xmlns:tmp="http://ez.no/namespaces/ezpublish3/temporary/"><ul><li><paragraph xmlns:tmp="http://ez.no/namespaces/ezpublish3/temporary/">Actualización diaria de todos los contenidos.</paragraph></li></ul></paragraph></section>');
        $contentCreateStruct->setField( 'url_youtube', "http://www.youtube.com/embed/zOwWqWusi64?rel=0&amp;amp;autoplay=1");
        $contentCreateStruct->setField( 'img_preview_video', new Value( $img1 ) );
        $contentCreateStruct->setField( 'img_preview_video_2', new Value( $img2 ) );

        $parentLocationId = 70;

        $draft = $contentService->createContent(
            $contentCreateStruct,
            array(
                $locationService->newLocationCreateStruct( $parentLocationId )
            )
        );
        $content = $contentService->publishVersion( $draft->versionInfo );


    }
}
