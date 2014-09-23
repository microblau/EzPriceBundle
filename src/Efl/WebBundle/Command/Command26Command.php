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
 * Class Command26Command
 * @package Efl\WebBundle\Command
 *
 * Añade el campo imagen_2014 a la clase producto. será un campo  ezobjectrelation
 * Será el campo en el que metamos las nuevas imágenes. se hace así para no machacar las que
 * ya teníamos y mostrarlas en el caso de que las nuevas no estén metidas todavía.
 *
 */
class Command26Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command26' )->setDefinition(array());
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

            $img2014 = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'image_2014',
                    'names' => array( 'esl-ES' => 'Imagen del producto para rediseño' ),
                    'position' => 36,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $img2014 );
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
