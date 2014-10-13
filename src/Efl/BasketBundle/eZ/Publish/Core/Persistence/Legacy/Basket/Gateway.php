<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:36
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket;

abstract class Gateway
{
    /**
     * Productos que han sido comprados en compras en las que también se ha comprado este producto
     *
     * @param array $contentIds
     * @param int $limit
     * @return \eZ\Publish\API\Repository\Values\Content\Content[]
     */
    abstract public function relatedPurchasedListForContentIds( array $contentIds, $limit );

    /**
     * Cesta actual
     *
     * @param int $byOder
     *
     * @return mixed
     */
    abstract public function currentBasket( $byOder = -1 );

    /**
     * @param $productCollectionId
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem[]
     */
    abstract public function getItemsByProductCollectionId( $productCollectionId );

    /**
     * Añadir producto a la cesta
     *
     * @param int $productCollectionId
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return mixed
     */
    abstract public function addProductToProductCollection( $productCollectionId, $contentId, array $optionList = array(), $quantity = 1 );

    /**
     * Quitar producto de la cesta
     *
     * @param $productCollectionId
     * @param $contentId
     *
     * @return mixed
     */
    abstract public function removeProductFromBasket( $productCollectionId, $contentId );

    /**
     * Actualizar el número de unidades de un producto en la cesta
     *
     * @param $productCollectionItemId
     * @param $quantity
     * @return mixed
     */
    abstract public function updateBasketItemQuantity( $productCollectionItemId, $quantity );

    /**
     * Actualiza el porcentaje aplicado a un item de la cesta
     *
     * @param $productCollectionItemId
     * @param $discountPercent
     * @return mixed
     */
    abstract public function applyDiscountToItem( $productCollectionItemId, $discountPercent );

    /**
     * Actualiza el tax asociado al item
     *
     * @param $productCollectionItemId
     * @param $discountPercent
     * @return mixed
     */
    abstract public function applyTaxToItem( $productCollectionItemId, $discountPercent );

    /**
     * Setear el código de descuento introducido por el usuario
     *
     * @param $basketId
     * @param $couponCode
     * @return mixed
     */
    abstract public function setDiscountCoupon( $basketId, $couponCode );

    /**
     * Actualizar el id de session de la cesta tras login
     * para no perder productos
     *
     * @param $oldSessionId
     * @param $newSessionId
     *
     * @return mixed
     */
    abstract public function resetBasketSessionId( $oldSessionId, $newSessionId );
}
