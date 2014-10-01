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
 * Quita los campos de producto qmemento añadidos anteriormente
 */
class Command36Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command36' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );

        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier(
                'producto_qmementix'
            );
            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft(
                $contentType
            );

            $contenidosField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos',
                    'names' => array( 'esl-ES' => 'Contenidos' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidadesField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidades',
                    'names' => array( 'esl-ES' => 'Funcionalidades' ),
                    'position' => 33,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $contenidosField );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $funcionalidadesField );

            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();
        }
        catch ( \Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }

        try
        {
            $repository->beginTransaction();
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier(
                'producto_imemento'
            );


            $contentTypeDraft = $repository->getContentTypeService()->createContentTypeDraft(
                $contentType
            );

            $contenidosField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'contenidos',
                    'names' => array( 'esl-ES' => 'Contenidos' ),
                    'position' => 32,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );

            $funcionalidadesField = new FieldDefinitionCreateStruct(
                array(
                    'fieldTypeIdentifier' => 'ezxmltext',
                    'identifier' => 'funcionalidades',
                    'names' => array( 'esl-ES' => 'Funcionalidades' ),
                    'position' => 33,
                    'isRequired' => false,
                    'isSearchable' => true,
                    'fieldGroup' => 'Rediseño'
                )
            );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $contenidosField );
            $repository->getContentTypeService()->addFieldDefinition( $contentTypeDraft, $funcionalidadesField );

            $repository->getContentTypeService()->publishContentTypeDraft( $contentTypeDraft );
            $repository->commit();
        }
        catch ( \Exception $e )
        {
            $repository->rollback();
            $output->writeln( $e->getMessage() );
        }
    }
}
