<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 8:58
 */

namespace Efl\BasketBundle\Command;

use Efl\WebBundle\eZ\Publish\Core\FieldType\WsProduct\Value as WsProductValue;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value as CategoryValue;
use EzSystems\EzPriceBundle\eZ\Publish\Core\FieldType\Price\Value as PriceValue;
use eZ\Publish\API\Repository\Repository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:basket:test' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var \eZ\Publish\API\Repository\Repository $repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $ws_manager = $this->getContainer()->get( 'efl_auth.ws_manager' );
        $data = $ws_manager->recuperarProductosPrecio( 'MCF' );
    }

}
