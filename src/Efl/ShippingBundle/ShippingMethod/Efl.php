<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:57
 */

namespace Efl\ShippingBundle\ShippingMethod;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Shipping\ShippingMethod;
use Efl\BasketBundle\Shipping\ShippingInterface;

class Efl implements ShippingInterface
{
    const FREE_SHIPPING_IF_TOTAL_GREATER_THAN = 150;

    public function getShippingCost( Basket $basket )
    {
        if ( $basket->getTotalExVat() > self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN )
        {
            return new ShippingMethod(
                array(
                    'cost' => 0,
                    'info' => 'Envío gratuito por total de cesta mayor de ' . self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN . ' €'
                )
            );
        }

        return new ShippingMethod(
            array(
                'cost' => 30,
                'info' => 'Gastos por envío a península'
            )
        );
    }
}
