<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 9/10/14
 * Time: 15:17
 */

namespace Efl\BasketBundle\Event;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\BasketItem;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Symfony\Component\EventDispatcher\Event;

class AddItemToBasketEvent extends Event
{
    private $basket = null;

    private $item = null;

    public function __construct(
        Basket $basket,
        BasketItem $item
    )
    {
        $this->basket = $basket;
        print_r ($item );
        die('xxx');
        $this->item = $item;
    }
}

