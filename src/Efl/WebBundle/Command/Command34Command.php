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
 * Class Command33Command
 * @package Efl\WebBundle\Command
 *
 * Quita el campo ebook de la clase producto y se lo añade a los formatos
 */
class Command34Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command34' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        // crear primera imagen
        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier(
                'producto'
            );
            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft(
                $contentType
            );
            $field = $contentTypeDraft->getFieldDefinition( 'ebook_gratis' );
            $repository->getContentTypeService()->removeFieldDefinition(
                $contentTypeDraft,
                $field
            );
            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();
        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }


        $ebookGratisField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezobjectrelation',
                'identifier' => 'ebook_gratis',
                'names' => array( 'esl-ES' => 'Ebook Gratis' ),
                'position' => 10,
                'isRequired' => false,
                'isSearchable' => false,
            )
        );

        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier( 'formato_papel' );
            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft( $contentType );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $ebookGratisField );
            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier( 'formato_internet' );
            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft( $contentType );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $ebookGratisField );
            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier( 'formato_ipad' );
            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft( $contentType );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $ebookGratisField );
            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();

        }
        catch ( Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

    }
}
