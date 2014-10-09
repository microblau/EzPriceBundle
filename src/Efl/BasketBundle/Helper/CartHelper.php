<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\BasketBundle\Helper;

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

    public function getDataForBasketItem( Content $content )
    {
        $contentTypeIdentifer = $this->contentTypeService->loadContentType(
            $content->contentInfo->contentTypeId
        )->identifier;

        switch( $contentTypeIdentifer )
        {
            case 'formato_papel':
                $literal = 'En Papel';
                $icon = 'paper';
                break;

            case 'formato_ipad':
                $literal = 'Para Ipad';
                $icon = 'tablet';
                break;

            case 'formato_internet':
                $literal = 'En Internet';
                $icon = 'pc';
                break;
        }

        return array(
            'canModifyUnits' => $contentTypeIdentifer == 'formato_papel',
            'literal' => $literal,
            'icon' => $icon
        );
    }
}
