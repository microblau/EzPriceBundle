<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:05
 */

namespace Efl\BasketBundle\Discounts;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;

/**
 * Interface BasketItemDiscountInterface
 * @package Efl\DiscountsBundle\eZ\Publish\API\Repository\Values
 */
interface BasketItemDiscountInterface
{
    /**
     * Determina si el descuento se puede aplicar al producto
     * Debe devolver falso en caso negativo.
     * En caso positivo, un objeto que tiene el porcentaje y el mensaje asociado
     * al descuento
     *
     * @param BasketItem $basketItem
     * @return \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\BasketItem|bool
     */
    public function isApplicableTo( BasketItem $basketItem );
}
