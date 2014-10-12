<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:27
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\Basket;
use Efl\BasketBundle\Shipping\ShippingInterface;

/**
 * Servicio para definir los tipos de gastos de envío en tienda
 * Funciona similar a los descuentos
 *
 * Class ShippingService
 * @package Efl\BasketBundle\eZ\Publish\Core\Repository
 */

class ShippingService
{
    private $shippingMethods;

    public function __construct()
    {
        $this->shippingMethods = array();
    }

    /**
     * Añade un método de envío
     *
     * @param ShippingInterface $productDiscountType
     */
    public function addShippingMethod( ShippingInterface $shippingMethod )
    {
        $this->shippingMethods[] = $shippingMethod;
    }

    /**
     * Busca el mejor gasto de envío asociado con la cesta
     *
     * @param Basket $basket
     * @return \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Shipping\ShippingMethod|void
     */
    public function findBestMethod( Basket $basket )
    {
        $applicableMethods = array();

        foreach ( $this->shippingMethods as $shippingMethod )
        {
            $method = $shippingMethod->getShippingCost( $basket );
            if ( $method )
            {
                $applicableMethods[] = $method;
            }
        }

        if ( empty( $applicableMethods ) )
            return;

        $bestMatch = $this->findBestMatch( $applicableMethods );

        return $bestMatch;
    }

    /**
     * Devuelve el mejor coste de envío aplicable
     *
     * @param \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Shipping\ShippingMethod[]
     * @return \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Shipping\ShippingMethod
     */
    private function findBestMatch( array $methods = array() )
    {
        $bestCost =  1000000.0;
        $bestMethod = null;

        foreach ( $methods as $method )
        {
            if ( $method->cost < $bestCost )
            {
                $bestMethod = $method;
                $bestCost = $method->cost;
            }
        }

        return $bestMethod;
    }
} 