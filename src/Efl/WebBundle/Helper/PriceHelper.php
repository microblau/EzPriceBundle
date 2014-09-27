<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 9:45
 */

namespace Efl\WebBundle\Helper;

use eZ\Bundle\EzPublishLegacyBundle\LegacyMapper\Security;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\ContentService;
use Efl\WebBundle\Helper\ProductHelper;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\Core\Repository\LocationService;
use Efl\DiscountsBundle\eZ\Publish\Core\Repository\DiscountsService;
use eZ\Publish\API\Repository\Repository;

/**
 * Class PriceHelper
 *
 * Helper para precios en función de hijos y demás
 *
 * @package Efl\WebBundle\Helper
 */
class PriceHelper
{
    /**
     * @var ContentTypeService
     */
    private $contentTypeService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var ProductHelper
     */
    private $productHelper;

    /**
     * @var LocationService
     */
    private $locationService;


    private $discountsService;

    private $repository;


    public function __construct(
        ContentTypeService $contentTypeService,
        ContentService $contentService,
        ProductHelper $productHelper,
        LocationService $locationService,
        DiscountsService $discountsService,
        Repository $repository
    )
    {
        $this->contentTypeService = $contentTypeService;
        $this->contentService = $contentService;
        $this->productHelper = $productHelper;
        $this->locationService = $locationService;
        $this->discountsService = $discountsService;
        $this->repository = $repository;
    }

    /**
     * Devuelve un array con el precio base y el de oferta
     * tras hacer las comprobaciones necesarias;
     *
     * @return array
     */
    public function getPrices( $contentId )
    {
        $format = $this->getFormatForContent( $contentId );

        if ( $format != null )
        {
            $offer = $this->offerPrice( $format );
            $base = $this->basePrice( $format );

            $prices = array('base' => $base);

            if ( $offer )
            {
                $prices['offer'] = $offer;
            }

            return $prices;
        }

        return null;
    }

    private function getFormatForContent( $contentId )
    {
        $content =  $this->contentService->loadContent( $contentId );

        $productClass = $this->contentTypeService->loadContentType(
            $content->contentInfo->contentTypeId
        )->identifier;

        $formats = $this->productHelper->getFormatosForLocation(
            $this->locationService->loadLocation(
                $content->contentInfo->mainLocationId
            )
        );

        if ( $productClass == 'producto' && isset( $formats['formato_papel'] ) )
        {
            return $formats['formato_papel']['content'];
        }

        if ( strpos( $productClass, 'formato' ) !== false )
        {
            return $content;
        }

        return null;
    }

    private function offerPrice( Content $content )
    {
        if ( $discountPercent = $this->discountsService->getDiscountPercent(
                $this->repository->getCurrentUser(),
                $content
            )
        )
        {
            $basePrice = $this->basePrice( $content );
            return $basePrice - ( $basePrice * $discountPercent / 100 );
        }
        return false;

    }

    private function basePrice( Content $content )
    {
        return $content->getFieldValue( 'precio' )->price;
    }
}
