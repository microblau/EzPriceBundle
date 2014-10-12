<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:37
 */

namespace Efl\BasketBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ShippingCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(
            'efl.basket.shipping'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'efl.shipping'
        );

        foreach ($taggedServices as $id => $attributes)
        {
            $definition->addMethodCall(
                'addShippingMethod',
                array(new Reference($id))
            );
        }
    }
}