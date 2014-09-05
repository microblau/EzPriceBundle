<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 15:22
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:test' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $locationService = $repository->getLocationService();
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 14 ) );

        $rootLocation = $locationService->loadLocation( 2 );
        $locationUpdateStruct = $locationService->newLocationUpdateStruct();
        $locationUpdateStruct->priority = 100;
        // first will be ok
        $output->writeln( 'First attempt should be ok...');
        $locationService->updateLocation( $rootLocation, $locationUpdateStruct );

        $output->writeln( 'Second attempt will fail...' );
        $locationService->updateLocation( $rootLocation, $locationUpdateStruct );
    }
}
