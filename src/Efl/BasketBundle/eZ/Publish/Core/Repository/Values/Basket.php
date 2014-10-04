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

    public function getItems()
    {
        return $this->items;
    }

    public function setItems( $items )
    {
        $this->items = $items;
    }

    public function getTotalExVat()
    {
        $total = 0.0;
        foreach ( $this->items as $item )
        {
            return $item->getTotalExVat();
        }
    }
}
