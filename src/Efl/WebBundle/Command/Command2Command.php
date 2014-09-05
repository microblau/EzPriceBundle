<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 15:22
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\Core\Base\Exceptions\ContentTypeFieldDefinitionValidationException;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;

/**
 * Class Command2Command
 * @package Efl\WebBundle\Command
 *
 * Creará la clase "info_modules" (Módulos informativos)
 * Son los que aparecen en el pie
 */
class Command2Command extends ContainerAwareCommand
{
    /** @var \eZ\Publish\API\Repository\Repository */
    protected $repository;

    protected $contentTypeService;

    protected function configure()
    {
        $this->setName( 'efl:web:command2' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );
        $this->contentTypeService = $this->repository->getContentTypeService();

        try
        {
            $this->createInfoModulesClass();
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }

        try
        {
            $this->createMatrixLinksClass();
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
        catch ( ContentTypeFieldDefinitionValidationException $e )
        {
            foreach( $e->getFieldErrors() as $error )
            {
                print_r ($error);
            }
        }

    }

    private function createInfoModulesClass()
    {
        $titleField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezstring',
                'identifier' => 'title',
                'names' => array( 'esl-ES' => 'titulo' ),
                'position' => 1,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        $bodyField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezxmltext',
                'identifier' => 'body',
                'names' => array( 'esl-ES' => 'Texto' ),
                'position' => 2,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        $iconField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezstring',
                'identifier' => 'icon',
                'names' => array( 'esl-ES' => 'Clase del icono' ),
                'position' => 3,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        // necesitamos el grupo clases 2014
        $contentTypeGroup = $this->contentTypeService->loadContentTypeGroupByIdentifier( 'Clases 2014' );

        $contentTypeStruct = new CreateTypeStruct(
            array(
                'identifier' => 'info_modules',
                'mainLanguageCode' => 'esl-ES',
                'nameSchema' => '<title>',
                'names' => array( 'esl-ES' => 'Módulo de información en pie de página' ),
                'fieldDefinitions' => array( $titleField, $bodyField, $iconField )
            )
        );

        // hay que crear el tipo ahora y asignarlo a este group
        try
        {
            $contentType = $this->contentTypeService->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );

            $this->contentTypeService->publishContentTypeDraft( $contentType );
        }
        catch ( InvalidArgumentException $e )
        {
            throw $e;
        }
    }

    private function createMatrixLinksClass()
    {
        $titleField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezstring',
                'identifier' => 'title',
                'names' => array( 'esl-ES' => 'Nombre' ),
                'position' => 1,
                'isRequired' => true,
                'isSearchable' => false,
            )
        );

        $matrixField = new FieldDefinitionCreateStruct(
            array(
                'fieldTypeIdentifier' => 'ezmatrix',
                'identifier' => 'matrix',
                'names' => array( 'esl-ES' => 'Matriz de Enlaces' ),
                'position' => 2,
                'isRequired' => true,
                'isSearchable' => false,
                'fieldSettings' => array(
                    'columns' => array(
                        array(
                            'id' => 'text',
                            'label' => 'Texto'
                        ),
                        array(
                            'id' => 'url',
                            'label' => 'Url'
                        ),
                    ),
                    'defaultNRows' => 10
                )
            )
        );

        // necesitamos el grupo clases 2014
        $contentTypeGroup = $this->contentTypeService->loadContentTypeGroupByIdentifier( 'Clases 2014' );

        $contentTypeStruct = new CreateTypeStruct(
            array(
                'identifier' => 'link_matrix',
                'mainLanguageCode' => 'esl-ES',
                'nameSchema' => '<title>',
                'names' => array( 'esl-ES' => 'Módulo de enlaces en pie de página' ),
                'fieldDefinitions' => array( $titleField, $matrixField )
            )
        );

        // hay que crear el tipo ahora y asignarlo a este group
        try
        {
            $contentType = $this->contentTypeService->createContentType(
                $contentTypeStruct,
                array( $contentTypeGroup )
            );

            $this->contentTypeService->publishContentTypeDraft( $contentType );
        }
        catch ( InvalidArgumentException $e )
        {
            throw $e;
        }
        catch ( ContentTypeFieldDefinitionValidationException $e )
        {
            throw $e;
        }
    }
}
