<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 14:56
 */

namespace Efl\BasketBundle;

use Efl\BasketBundle\DependencyInjection\DiscountsCompilerPass;
use Efl\BasketBundle\DependencyInjection\ShippingCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class EflBasketBundle
 *
 * Bundle para manejar la cesta
 *
 * @package Efl\BasketBundle
 */
class EflBasketBundle extends Bundle
{
    protected $name = 'EflBasketBundle';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DiscountsCompilerPass() );

        $container->addCompilerPass( new ShippingCompilerPass() );
    }
}
