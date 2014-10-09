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

    /**
     * Contenido asociado
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
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
} 