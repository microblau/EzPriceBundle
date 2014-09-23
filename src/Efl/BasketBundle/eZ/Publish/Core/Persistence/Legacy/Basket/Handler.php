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

    public function __construct( Gateway $basketGateway )
    {
        $this->basketGateway = $basketGateway;
    }

    public function getRelatedPurchasedListForContentIds( $contentIds, $limit )
    {
        return $this->basketGateway->relatedPurchasedListForContentIds( $contentIds, $limit );
    }
}
