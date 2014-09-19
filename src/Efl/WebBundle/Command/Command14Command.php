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
 * Class Command14Command
 * @package Efl\WebBundle\Command
 *
 * Añadirá un nuevo campo, ebook_gratis, a la clase producto.
 * Será un campo relacionado.
 *
 */
class Command14Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command14' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $contentService = $repository->getContentService();
        $contentTypeService = $repository->getContentTypeService();
        $locationService = $repository->getLocationService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        try
        {
            $repository->beginTransaction();
            $contentType = $contentTypeService->loadContentTypeByIdentifier( 'producto' );

            $fieldDefinitions = $contentType->getFieldDefinitions();

            $ebookGratisField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezobjectrelation',
                    'identifier' => 'ebook_gratis',
                    'names' => array( 'esl-ES' => 'Ebook Gratis' ),
                    'position' => 56,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );


            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $ebookGratisField );
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
