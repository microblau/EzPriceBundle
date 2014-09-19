<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 16/09/14
 * Time: 17:37
 */

namespace Efl\WebServiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('efl_auth');

        $rootNode
            ->children()
            ->arrayNode('client')
            ->children()
            ->scalarNode('host')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('wsdl')->isRequired()->cannotBeEmpty()->end()
            ->end()
            ->end();


        $this->addServiceSection($rootNode);

        return $treeBuilder;
    }

    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode('service')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('user_manager')->defaultValue('efl_auth.security.user_provider')->end()
            ->scalarNode('ws_manager')->defaultValue('efl_auth.ws_manager.default')->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }
} 