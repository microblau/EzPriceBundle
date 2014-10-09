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
     * @return array
     */
    public function currentBasket( $byOrderId = -1 )
    {
        $data = $this->basketGateway->currentBasket( $byOrderId );
        return array(
            'id' => $data->getId(),
            'sessionId' => $data->getSessionId(),
            'productCollectionId' => $data->getProductCollectionId(),
            'orderId' => $data->getOrderId()
        );
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

    /**
     * Añadir un producto a la cesta
     *
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return \Efl\BasketBundle\Entity\EzproductcollectionItem
     */
    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $data = $this->basketGateway->addProductToBasket( $contentId, $optionList, $quantity );
        return $this->basketGateway->addProductToBasket( $contentId, $optionList, $quantity );
    }

    public function removeProductFromBasket( $contentId )
    {
        $this->basketGateway->removeProductFromBasket( $contentId );
    }
}
