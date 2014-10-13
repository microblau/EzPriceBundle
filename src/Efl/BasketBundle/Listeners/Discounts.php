<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:29
 */

namespace Efl\BasketBundle\Listeners;

use Efl\BasketBundle\Event\BasketPreShowEvent;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
use Efl\BasketBundle\eZ\Publish\Core\Repository\DiscountsService;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;

class Discounts extends Event
{
    /**
     * @var DiscountsService
     */
    private $discountsService;

    /**
     * @var BasketService
     */
    private $basketService;

    public function __construct(
        DiscountsService $discountsService,
        BasketService $basketService
    )
    {
        $this->discountsService = $discountsService;
        $this->basketService = $basketService;
    }

    public function applyDiscountsToBasket( BasketPreShowEvent $event )
    {
        $items = $event->getBasket()->getItems();

        foreach( $items as $i => $item )
        {
            $discount = $this->discountsService->findBestDiscount( $item->getContent() );
            $item = $this->basketService->applyDiscountToItem( $item, $discount );
            $items[$i] = $item;
        }
        $event->getBasket()->setItems( $items );
    }
}
