<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:35
 */

namespace Efl\BasketBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;

class BasketPreShowEvent extends Event
{
    protected $basket;

    public function __construct( Basket $basket )
    {
        $this->basket = $basket;
    }

    public function getBasket()
    {
        return $this->basket;
    }
}
