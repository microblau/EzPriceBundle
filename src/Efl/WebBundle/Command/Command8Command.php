<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeUpdateStruct;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use Exception;

/**
 * Class Command8Command
 * @package Efl\WebBundle\Command
 *
 * Modificará la clase ebooks de regalo para añadir una imagen
 * y una descripción al mismo.
 *
 */
class Command8Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command8' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $contentService = $repository->getContentService();
        $contentTypeService = $repository->getContentTypeService();
        $locationService = $repository->getLocationService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        try
        {
            $repository->beginTransaction();
            $contentType = $contentTypeService->loadContentTypeByIdentifier( 'ebook' );

            $fieldDefinitions = $contentType->getFieldDefinitions();

            $imageField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezimage',
                    'identifier' => 'imagen',
                    'names' => array( 'esl-ES' => 'Imagen' ),
                    'position' => 3,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $descriptionField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'description',
                    'names' => array( 'esl-ES' => 'Descripición' ),
                    'position' => 4,
                    'isRequired' => false,
                    'isSearchable' => false
                )
            );

            $contentType = $contentTypeService->loadContentTypeByIdentifier( 'ebook' );
            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $imageField );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $descriptionField );
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
