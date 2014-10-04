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


    abstract public function currentBasket( $byOder = -1 );

    /**
     * @param $productCollectionId
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem[]
     */
    abstract public function getItemsByProductCollectionId( $productCollectionId );

    abstract public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 );
} 