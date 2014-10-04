<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket;

class Handler
{
    /**
     * @var Gateway
     */
    protected $basketGateway;

    private $contentService;

    public function __construct(
        Gateway $basketGateway
    )
    {
        $this->basketGateway = $basketGateway;
    }

    public function getRelatedPurchasedListForContentIds( $contentIds, $limit )
    {
        return $this->basketGateway->relatedPurchasedListForContentIds( $contentIds, $limit );
    }

    /**
     * @param int $byOrderId
     * @return \Efl\BasketBundle\Entity\Ezbasket
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
     * return array;
     */
    public function getItemsByProductCollectionId( $productCollectionId )
    {
        return $this->basketGateway->getItemsByProductCollectionId( $productCollectionId );
    }

    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $this->basketGateway->addProductToBasket( $contentId, $optionList, $quantity );
    }
}
