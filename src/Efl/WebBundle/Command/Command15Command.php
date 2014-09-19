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
 * Class Command15Command
 * @package Efl\WebBundle\Command
 *
 * Añadirá dos nuevos campos, mas_info y claim, a la clase producto.
 * El primero será ezxml, el segundo una línea de texto
 *
 */
class Command15Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command15' )->setDefinition(array());
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

            $masInfo = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'mas_info',
                    'names' => array( 'esl-ES' => 'Más información' ),
                    'position' => 17,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $claim = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezstring',
                    'identifier' => 'claim',
                    'names' => array( 'esl-ES' => 'Destacado' ),
                    'position' => 18,
                    'isRequired' => false,
                    'isSearchable' => false,
                )
            );

            $contentTypeDraft = $contentTypeService->createContentTypeDraft( $contentType );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $masInfo );
            $contentTypeService->addFieldDefinition( $contentTypeDraft, $claim );
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
