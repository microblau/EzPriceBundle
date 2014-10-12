<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:29
 */

namespace Efl\BasketBundle\Shipping;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;

/**
 * Interface ShippingInterface
 * @package Efl\BasketBundle\Shipping
 */
interface ShippingInterface
{
    /**
     * Cada clase que implemente este interface definirá este método
     * y devolverá la información asociada a ese tipo de envío.
     * Puede devolver false en el caso de que el método no sea aplicable a la cesta
     *
     * @param Basket $basket
     * @return float
     */
    public function getShippingCost( Basket $basket );
}
