<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\Event\AddItemToBasketEvent;
use Efl\BasketBundle\Event\RemoveItemFromBasketEvent;
use Efl\BasketBundle\Event\UpdateQuantityItemInBasket;
use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Handler as BasketHandler;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\Product;
use eZ\Publish\API\Repository\ContentService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BasketService
{
    /**
     * @var BasketHandler
     */
    protected $basketHandler;

    /**
     * @var ContentService
     */
    protected $contentService;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var ShippingService
     */
    protected $shippingService;

    private $basket = null;

    public function __construct(
        BasketHandler $basketHandler,
        ContentService $contentService,
        EventDispatcherInterface $eventDispatcher,
        ShippingService $shippingService
    )
    {
        $this->basketHandler = $basketHandler;
        $this->contentService = $contentService;
        $this->eventDispatcher = $eventDispatcher;
        $this->shippingService = $shippingService;
    }

    public function getRelatedPurchasedListForContentIds( $contentIds, $limit )
    {
        return $this->basketHandler->getRelatedPurchasedListForContentIds( $contentIds, $limit );
    }

    /**
     * Obtiene la cesta actual.
     *
     * @param $byOrderId
     *
     * @return \Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket
     */
    public function getCurrentBasket( $byOrderId = -1 )
    {
        if ( $this->basket === null )
        {
            $basket = new Basket(
                $this->basketHandler->currentBasket($byOrderId)
            );

            $basketItems = $this->basketHandler->getItemsByProductCollectionId($basket->productCollectionId);

            $items = array();

            foreach ($basketItems as $basketItem) {
                $items[] = new BasketItem($basketItem);
            }

            $basket->setItems($items);

            $basket->setShippingCost(
                $this->shippingService->getShippingCostForBasket( $basket )
            );

            $this->basket = $basket;
        }

        return $this->basket;

    }

    /**
     * Añadir producto a la cesta
     *
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return void
     */
    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $item = $this->basketHandler->addProductToBasket(
            $this->getCurrentBasket(),
            $contentId,
            $optionList,
            $quantity
        );

        $event = new AddItemToBasketEvent( $item );
        $this->eventDispatcher->dispatch('eflweb.event.basket.additem', $event);
    }

    /**
     * Determinar si el producto ya está o no en la cesta
     *
     * @param $contentId
     *
     * @return bool
     */
    public function isProductInBasket( $contentId )
    {
        $items = $this->getCurrentBasket()->getItems();

        foreach ( $items as $item )
        {
            if ( $item->getContent()->id == $contentId )
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Quita el producto de la cesta
     *
     * @param $contentId
     *
     * @return void
     */
    public function removeProductFromBasket( $contentId )
    {
        $item = $this->basketHandler->removeProductFromBasket(
            $this->getCurrentBasket(),
            $contentId
        );

        $event = new RemoveItemFromBasketEvent( $item );
        $this->eventDispatcher->dispatch('eflweb.event.basket.removeitem', $event);
    }

    /**
     * Actualizar número de unidades de producto en cesta
     *
     * @param $productCollectionItemId
     * @param $quantity
     */
    public function updateBasketItemQuantity( $productCollectionItemId, $quantity )
    {
        $item = $this->basketHandler->updateBasketItemQuantity(
            $productCollectionItemId,
            $quantity
        );

        $event = new UpdateQuantityItemInBasket( $item, $quantity );
        $this->eventDispatcher->dispatch('eflweb.event.basket.updateitem', $event);
    }

    public function setDiscountCoupon( $couponCode )
    {
        $this->basketHandler->setDiscountCoupon(
            $this->getCurrentBasket(),
            $couponCode
        );
    }

    /**
     * @param BasketItem $basketItem
     * @param Product $discount
     * @return \Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem
     */
    public function applyDiscountToItem( BasketItem $basketItem, Product $discount )
    {
        return $this->basketHandler->applyDiscountToItem( $basketItem, $discount );
    }

    /**
     * Actualizar el id de sesión de la cesta
     *
     * @param $sessionId
     *
     * @return void
     */
    public function resetBasketSessionId( $oldSessionId, $newSessionId )
    {
        $this->basketHandler->resetBasketSessionId(
            $oldSessionId,
            $newSessionId
        );
    }
}

