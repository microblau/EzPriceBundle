<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:29
 */

namespace Efl\BasketBundle\Listeners;

use Efl\BasketBundle\Discounts\BasketItemDiscountManager;
use Efl\BasketBundle\Event\BasketPreShowEvent;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart extends Event
{
    /**
     * @var BasketItemDiscountManager
     */
    private $basketItemDiscountManager;

    /**
     * @var BasketService
     */
    private $basketService;

    public function __construct(
        BasketItemDiscountManager $basketItemDiscountManager,
        BasketService $basketService
    )
    {
        $this->basketItemDiscountManager = $basketItemDiscountManager;
        $this->basketService = $basketService;
    }

    public function applyDiscountsToBasket( BasketPreShowEvent $event )
    {
        $items = $event->getBasket()->getItems();

        foreach( $items as $i => $item )
        {
            $discount = $this->basketItemDiscountManager->findBestDiscount( $item );
            $this->basketService->applyDiscountToItem( $item, $discount );
            $items[$i]->setDiscount( $discount );
        }

        $event->getBasket()->setItems( $items );
    }
}
