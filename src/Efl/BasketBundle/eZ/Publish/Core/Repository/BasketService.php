<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Handler as BasketHandler;

class BasketService
{
    /**
     * @var BasketHandler
     */
    protected $basketHandler;

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
}

