<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 14:19
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;

/**
 * Class Command1Command
 * @package Efl\WebBundle\Command
 *
 * Este comando creará un nuevo grupo de clases para organizar mejor este tema.
 */
class Command1Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command1' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var $repository \eZ\Publish\API\Repository\Repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

        $contentTypeService = $repository->getContentTypeService();
        $contentTypeGroupStruct = new CreateGroupStruct(
            array(
                'identifier' => 'Clases 2014'
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
