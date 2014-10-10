<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 9/10/14
 * Time: 15:17
 */

namespace Efl\BasketBundle\Event;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\BasketItem;
use Symfony\Component\EventDispatcher\Event;

class RemoveItemFromBasketEvent extends Event
{
    private $item = null;

    public function __construct(
        BasketItem $item
    )
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }
}

