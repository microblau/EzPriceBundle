<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 16:05
 */

namespace Efl\DiscountsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class EflDiscountsExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $config    An array of configuration values
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator( __DIR__ . '/../Resources/config' )
        );

        // Base services override
        $loader->load( 'services.yml' );
    }
}
