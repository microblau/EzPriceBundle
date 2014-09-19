<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/05/14
 * Time: 14:02
 */

namespace Efl\WebServiceBundle;

use Efl\WebServiceBundle\Security\Factory\WsFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EflWebServiceBundle extends Bundle
{
    protected $name = 'EflWebServiceBundle';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new WsFactory());
    }
}