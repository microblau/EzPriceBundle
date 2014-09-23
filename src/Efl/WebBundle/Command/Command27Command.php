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
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;


/**
 * Class Command27Command
 * @package Efl\WebBundle\Command
 *
 * Crea las clases para los formatos de producto
 */
class Command27Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command27' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->createGroup( $input, $output );
    }

    private function createGroup( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

        $contentTypeService = $repository->getContentTypeService();
        $contentTypeGroupStruct = new CreateGroupStruct(
            array(
                'identifier' => 'Formatos de producto'
            )
        );

        try
        {
            $contentTypeGroupService = $contentTypeService->createContentTypeGroup( $contentTypeGroupStruct );
        }
        catch ( InvalidArgumentException $e )
        {
            $output->writeln( $e->getMessage() );
        }
        catch ( Exception $e )
        {
            $output->writeln( $e->getMessage() );
        }
    }
}
