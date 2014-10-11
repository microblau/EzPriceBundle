<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\BasketBundle\Helper;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\Values\Content\Content;

class CartHelper
{
    private $contentTypeService;

    public function __construct(
        ContentTypeService $contentTypeService
    )
    {
        $this->contentTypeService = $contentTypeService;
    }

    /**
     * Datos para presentar en la cesta
     *
     * @param BasketItem $basketItem
     * @return array
     */
    public function getDataForBasketItem( BasketItem $basketItem )
    {
        if ( $basketItem->isA( 'formato_papel' ) )
        {
            $literal = 'En Papel';
            $icon = 'paper';
        }
        elseif ( $basketItem->isA( 'formato_ipad' ) )
        {
            $literal = 'Para Ipad';
            $icon = 'tablet';
        }
        else
        {
            $literal = 'En Internet';
            $icon = 'pc';
        }

        return array(
            'canModifyUnits' => $basketItem->isA( 'formato_papel' ),
            'literal' => $literal,
            'icon' => $icon
        );
    }
}
