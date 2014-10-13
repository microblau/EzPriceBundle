<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 14:01
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository\Values;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\Basket as APIBasket;

class Basket extends APIBasket
{
    /**
     * @var \Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem[]
     */
    protected $items;

    /**
     * @var float
     */
    protected $totalExVat = 0.0;

    /**
     * @var float
     */
    protected $totalIncVat = 0.0;

    /**
     * @var string
     */
    protected $discountCode;

    /**
     * @var float
     */
    protected $shippingCost;

    /**
     * @return BasketItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $items
     */
    public function setItems( $items )
    {
        $this->items = $items;
    }

    /**
     * Total en cesta impuestos no incluidos
     *
     * @return float
     */
    public function getTotalExVat()
    {
        if ( $this->totalExVat == null )
        {
            $total = 0.0;
            foreach ( $this->items as $item )
            {
                $total += $item->getTotalExVat();
            }

            $this->totalExVat = $total;
        }

        return $this->totalExVat;
    }

    /**
     * Total en cesta impuestos incluidos
     *
     * @return float
     */
    public function getTotalIncVat()
    {
        if ( $this->totalIncVat == null )
        {
            $total = 0.0;
            foreach ( $this->items as $item )
            {
                $total += $item->getTotalIncVat();
            }

            $this->totalIncVat = $total;
        }

        return $this->totalIncVat;
    }

    /**
     * Total de impuestos aplicados
     *
     * @return mixed
     */
    public function getTotalTaxAmount()
    {
        return $this->totalIncVat - $this->totalExVat;
    }

    /**
     * @return mixed
     */
    public function getDiscountCode()
    {
        return $this->discountCode;
    }

    /**
     * @param $discountCode
     */
    public function setDiscountCode( $discountCode )
    {
        $this->discountCode = $discountCode;
    }

    /**
     * Setter for shipping cost
     *
     * @param float $shippingCost
     */
    public function setShippingCost( $shippingCost )
    {
        $this->shippingCost = $shippingCost;
    }

    /**
     * Getter for shipping cost
     *
     * @return float
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

}
