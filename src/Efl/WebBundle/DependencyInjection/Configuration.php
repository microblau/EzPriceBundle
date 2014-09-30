<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 17:37
 */

namespace Efl\WebBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root( 'eflweb' );

        $rootNode
            ->children()
            ->arrayNode( 'leads_client' )
            ->children()
            ->scalarNode('host')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('wsdl')->isRequired()->cannotBeEmpty()->end()
            ->end()
            ->end();

        return $treeBuilder;
    }

} 