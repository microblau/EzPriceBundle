<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:29
 */

namespace Efl\ShippingBundle\Listeners;

use Efl\BasketBundle\Event\BasketPreShowEvent;
use Efl\BasketBundle\eZ\Publish\Core\Repository\ShippingService;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;

class Shipping extends Event
{
    private $shippingService;

    public function __construct(
        ShippingService $shippingService
    )
    {
        $this->shippingService = $shippingService;
    }

    public function getShippingCost( BasketPreShowEvent $event )
    {
        $basket = $event->getBasket();

        if ( count( $basket->getItems() ) == 0 )
        {
            return;
        }

        $cost = $this->shippingService->findBestMethod( $basket );

        print_r( $cost );
    }
}
