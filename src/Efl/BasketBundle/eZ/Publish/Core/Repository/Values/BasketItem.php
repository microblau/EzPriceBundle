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

    protected $contentTypeIdentifier;

    protected $discount = null;

    /**
     * Contenido asociado
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Nos dice si el producto es del tipo presentado
     *
     * @param $contentTypeIdentifier
     * @return bool
     */
    public function isA( $contentTypeIdentifier )
    {
        return $this->contentTypeIdentifier == $contentTypeIdentifier;
    }

    /**
     * Total sin impuestos
     *
     * @return float
     */
    public function getTotalExVat()
    {
        return $this->totalPriceExVat;
    }

    /**
     * Total con impuestos
     *
     * @return float
     */
    public function getTotalIncVat()
    {
        return $this->totalPriceIncVat;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param Discount $discount
     */
    public function setDiscount( $discount )
    {
        $this->discount = $discount;
    }
} 