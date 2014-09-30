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
class Command31Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command31' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        // crear primera imagen
        $parentLocationId = 11154;

        $contentTypeService = $repository->getContentTypeService();
        $contentService = $repository->getContentService();
        $locationService = $repository->getLocationService();

        try
        {
            $contentType = $contentTypeService->loadContentTypeByIdentifier( "image" );
            $contentCreateStruct = $contentService->newContentCreateStruct( $contentType, 'esl-ES' );
            $contentCreateStruct->setField( 'name', 'Imagen Imemento' ); // set name field

            $file = __DIR__ . '/../Resources/public/images/iMemento_iPad.png';

            // set image file field
            $value = new \eZ\Publish\Core\FieldType\Image\Value(
                array(
                    'path' => $file,
                    'fileSize' => filesize( $file ),
                    'fileName' => basename( $file ),
                    'alternativeText' => 'Imagen Imemento'
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
            $contentInfo = $contentService->loadContentInfo( 18383 );
            $contentDraft = $contentService->createContentDraft( $contentInfo );

            $contentUpdateStruct = $contentService->newContentUpdateStruct();
            $contentUpdateStruct->initialLanguageCode = 'esl-ES'; // set language for new version
            $contentUpdateStruct->setField( 'title', 'Todos sus mementos en Internet' );
            $contentUpdateStruct->setField( 'text1', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Olvídese del papel... disponga ya de todos los mementos en soporte Internet, siempre actualizados y conectados entre sí.</paragraph></section>");
            $contentUpdateStruct->setField( 'text2', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Saque el máximo partido a la información de sus mementos imprimiendo, copiando, pegando en sus documentos y añadiendo notas y creando dossiers con los recortes de sus mementos.</paragraph></section>");
            $contentUpdateStruct->setField( 'ventaja1', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'ventaja2', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'ventaja3', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'ventaja4', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización <strong>diaria</strong> de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'contenidos1', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'contenidos2', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'contenidos3', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización diaria de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'funcionalidad1', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización <strong>diaria</strong> de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'funcionalidad2', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización <strong>diaria</strong> de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'funcionalidad3', "<?xml version='1.0' encoding='utf-8'?><section><paragraph>Actualización <strong>diaria</strong> de todos los contenidos.</paragraph><paragraph>Actualización <strong>diaria</strong> de todos los contenidos.</paragraph></section>");
            $contentUpdateStruct->setField( 'url_appstore', "https://itunes.apple.com/es/app/imemento/id509177093?mt=8");
            $contentUpdateStruct->setField( 'big_image', new Value( $img1 ) );

            // update and publish draft
            $contentDraft = $contentService->updateContent( $contentDraft->versionInfo, $contentUpdateStruct );
            $content = $contentService->publishVersion( $contentDraft->versionInfo );


        }
        catch ( Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }

    }
}
