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
 * Class Command18Command
 * @package Efl\WebBundle\Command
 *
 * Añade el campo previsualización a la clase producto. será un campo  ezxmltext
 *
 */
class Command17Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command17' )->setDefinition(array());
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

            $preview = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'preview',
                    'names' => array( 'esl-ES' => 'Previsualización' ),
                    'position' => 26,
                    'isRequired' => false,
                    'isSearchable' => true,
                )
            );

            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $preview );
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
