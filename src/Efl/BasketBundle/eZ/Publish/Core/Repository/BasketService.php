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
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\BasketItem as DiscountBasketItem;
use eZ\Publish\API\Repository\ContentService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BasketService
{
    /**
     * @var BasketHandler
     */
    protected $basketHandler;

    protected $contentService;

    protected $eventDispatcher;

    private $basket = null;

    public function __construct(
        BasketHandler $basketHandler,
        ContentService $contentService,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->basketHandler = $basketHandler;
        $this->contentService = $contentService;
        $this->eventDispatcher = $eventDispatcher;
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
        $basket = new Basket(
            $this->basketHandler->currentBasket( $byOrderId )
        );

        $basketItems = $this->basketHandler->getItemsByProductCollectionId( $basket->productCollectionId );

        $items = array();

        foreach( $basketItems as $basketItem )
        {
            $items[] = new BasketItem( $basketItem );
        }

        $basket->setItems( $items );

        $this->basket = $basket;

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

    /**
     * Aplica el código de descuento pasado
     *
     * @param $discountCode
     */
    public function setDiscountCode( $discountCode )
    {
        $this->getCurrentBasket()->setDiscountCode( $discountCode );
    }

    /**
     * @param BasketItem $basketItem
     * @param DiscountBasketItem $discount
     */
    public function applyDiscountToItem( BasketItem $basketItem, DiscountBasketItem $discount )
    {
        $this->basketHandler->applyDiscountToItem( $basketItem, $discount );
    }
}

