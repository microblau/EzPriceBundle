<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 9/10/14
 * Time: 15:22
 */

namespace Efl\BasketBundle\Services;

use Efl\BasketBundle\Event\AddItemToBasketEvent;

class BasketManagement
{
    public function onAddItemToBasket( AddItemToBasketEvent $event)
    {
        die ('evento');
    }
}