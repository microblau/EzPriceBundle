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
     * @var LocationService
     */
    private $locationService;

    /**
     * @var DiscountsService
     */
    private $discountsService;

    /**
     * @var Repository
     */
    private $repository;

    public function __construct(
        ContentTypeService $contentTypeService,
        ContentService $contentService,
        LocationService $locationService,
        DiscountsService $discountsService,
        Repository $repository
    )
    {
        $this->contentTypeService = $contentTypeService;
        $this->contentService = $contentService;
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
        $format = $this->contentService->loadContent( $contentId );

        if ( $format != null )
        {
            $offer = $this->offerPrice( $format );
            $base = $this->basePrice( $format );

            $prices = array(
                'base' => $base
            );

            if ( $offer )
            {
                $prices['offer'] = $offer;
            }

            return $prices;
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
