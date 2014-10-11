<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/10/14
 * Time: 17:33
 */

namespace Efl\BasketBundle\Event;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\BasketItem;
use Symfony\Component\EventDispatcher\Event;

class UpdateQuantityItemInBasket extends Event
{
    private $item = null;

    private $quantity;

    public function __construct(
        BasketItem $item,
        $quantity
    )
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
