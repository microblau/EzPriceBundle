<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\Product;

class Handler
{
    /**
     * @var Gateway
     */
    protected $basketGateway;

    public function __construct(
        Gateway $basketGateway
    )
    {
        $this->basketGateway = $basketGateway;
    }

    /**
     * @param $contentIds
     * @param $limit
     * @return \eZ\Publish\API\Repository\Values\Content\Content[]
     */
    public function getRelatedPurchasedListForContentIds( $contentIds, $limit )
    {
        return $this->basketGateway->relatedPurchasedListForContentIds( $contentIds, $limit );
    }

    /**
     * @param int $byOrderId
     * @return array
     */
    public function currentBasket( $byOrderId = -1 )
    {
        return $this->basketGateway->currentBasket( $byOrderId );
    }

    /**
     * Obtiene la colección de productos en la cesta
     *
     * @param $productCollectionId
     *
     * @return array;
     */
    public function getItemsByProductCollectionId( $productCollectionId )
    {
        return $this->basketGateway->getItemsByProductCollectionId( $productCollectionId );
    }

    /**
     * Añadir un producto a la cesta
     *
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem
     */
    public function addProductToBasket( Basket $basket, $contentId, array $optionList = array(), $quantity = 1 )
    {
        return new BasketItem(
            $this->basketGateway->addProductToProductCollection(
                $basket->productCollectionId,
                $contentId,
                $optionList,
                $quantity
            )
        );
    }

    /**
     * @param Basket $basket
     * @param $contentId
     *
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem
     */
    public function removeProductFromBasket( Basket $basket, $contentId )
    {
        return new BasketItem(
            $this->basketGateway->removeProductFromBasket(
                $basket->productCollectionId,
                $contentId
            )
        );
    }

    /**
     * Actualizar el número de unidades de un item de la cesta
     *
     * @param $productCollectionItemId
     * @param $quantity
     * @return BasketItem
     */
    public function updateBasketItemQuantity( $productCollectionItemId, $quantity )
    {
        return new BasketItem(
            $this->basketGateway->updateBasketItemQuantity(
                $productCollectionItemId,
                $quantity
            )
        );
    }

    /**
     * Setear el código de descuento en la tienda
     *
     * @param Basket $basket
     * @param $couponCode
     */
    public function setDiscountCoupon( Basket $basket, $couponCode )
    {
        $this->basketGateway->setDiscountCoupon(
            $basket->id,
            $couponCode
        );
    }

    /**
     * Aplicar descuento a producto
     *
     * @param BasketItem $basketItem
     * @param Product $discount
     * @return BasketItem
     */
    public function applyDiscountToItem( BasketItem $basketItem, Product $discount )
    {
        $basketItem = new BasketItem(
            $this->basketGateway->applyDiscountToItem(
                $basketItem->id,
                $discount->percentage
            )
        );

        $basketItem->setDiscount( $discount );
        return $basketItem;
    }

    /**
     * @param string $oldSessionId     *
     * @param string $newSessionId
     *
     * @return void
     */
    public function resetBasketSessionId( $oldSessionId, $newSessionId )
    {
        $this->basketGateway->resetBasketSessionId(
            $oldSessionId,
            $newSessionId
        );
    }
}
