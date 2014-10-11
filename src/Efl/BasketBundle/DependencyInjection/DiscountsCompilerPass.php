<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 13:28
 */

namespace Efl\BasketBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class DiscountsCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(
            'efl.basket.discounts.basketitem.manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'efl.discounts.basketitem'
        );

        foreach ($taggedServices as $id => $attributes)
        {
            $definition->addMethodCall(
                'addDiscountType',
                array(new Reference($id))
            );
        }
    }
}