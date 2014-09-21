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
 * Class Command16Command
 * @package Efl\WebBundle\Command
 *
 * Añadirá la clase "Sistema Memento" que servirá para una de las pestañas
 * de la ficha producto
 *
 */
class Command16Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command16' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $contentTypeService = $repository->getContentTypeService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        try
        {
            $repository->beginTransaction();
            $contentType = $contentTypeService->loadContentTypeByIdentifier( 'producto' );

            $fieldDefinitions = $contentType->getFieldDefinitions();

            $titulo = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'titulo',
                    'names' => array( 'esl-ES' => 'Título' ),
                    'position' => 1,
                    'isRequired' => true,
                    'isSearchable' => true,
                )
            );

            $img = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'image',
                    'names' => array( 'esl-ES' => 'Imagen' ),
                    'position' => 2,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $text = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'texto',
                    'names' => array( 'esl-ES' => 'Texto' ),
                    'position' => 18,
                    'isRequired' => false,
                    'isSearchable' => true,
                )
            );

            $contentTypeGroup = $contentTypeService->loadContentTypeGroupByIdentifier( 'Clases 2014' );

            $contentTypeStruct = new CreateTypeStruct(
                array(
                    'identifier' => 'sistema_memento',
                    'mainLanguageCode' => 'esl-ES',
                    'nameSchema' => '<titulo>',
                    'names' => array( 'esl-ES' => 'Sistema Memento' ),
                    'fieldDefinitions' => array( $titulo, $img, $text )
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
            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }
    }
}
