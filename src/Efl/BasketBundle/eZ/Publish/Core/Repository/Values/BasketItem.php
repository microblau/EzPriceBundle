<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 16:03
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository\Values;

use Efl\BasketBundle\eZ\Publish\API\Repository\Values\BasketItem as APIBasketItem;

class BasketItem extends APIBasketItem
{
    protected $content;

    public function getContent()
    {
        return $this->content;
    }

    public function getTotalExVat()
    {
        return $this->totalPriceExVat;
    }
} 