<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Handler as BasketHandler;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;

class BasketService
{
    /**
     * @var BasketHandler
     */
    protected $basketHandler;

    private $basket = null;

    public function __construct(
        BasketHandler $basketHandler
    )
    {
        $this->basketHandler = $basketHandler;
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
        if ( $this->basket != null )
        {
            return $this->basket;
        }

        $data = $this->basketHandler->currentBasket( $byOrderId );
        $productCollectionId = $data->getProductcollectionId();
        $basketItems = $this->basketHandler->getItemsByProductCollectionId( $productCollectionId );

        $items = array();

        foreach( $basketItems as $basketItem )
        {
            $items[] = new BasketItem( $basketItem );
        }

        return new Basket(
            array(
                'id' => $data->getId(),
                'productCollectionId' => $productCollectionId,
                'sessionId' => $data->getSessionId(),
                'orderId' => $data->getOrderId(),
                'items' => $items
            )
        );
    }

    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $this->basketHandler->addProductToBasket( $contentId, $optionList, $quantity );
    }
}

