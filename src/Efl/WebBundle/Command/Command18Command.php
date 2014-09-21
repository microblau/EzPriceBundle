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
 * Añade el campo vídeo a la clase producto. será un campo  ezstring
 *
 */
class Command18Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command18' )->setDefinition(array());
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

            $video = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'youtube',
                    'names' => array( 'esl-ES' => 'Vídeo Youtube' ),
                    'position' => 28,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $video );
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
