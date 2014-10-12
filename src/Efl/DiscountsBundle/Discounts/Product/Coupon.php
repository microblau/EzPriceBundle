<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 19:11
 */

namespace Efl\DiscountsBundle\Discounts\Product;

use Efl\BasketBundle\Discounts\ProductDiscountInterface;
use Efl\BasketBundle\eZ\Publish\Core\Repository\BasketService;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\Product as DiscountProduct;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\SearchService;

class Coupon implements ProductDiscountInterface
{
    private $basketService;

    private $locationService;

    private $contentService;

    private $searchService;

    private $repository;

    public function __construct(
        BasketService $basketService,
        LocationService $locationService,
        ContentService $contentService,
        SearchService $searchService,
        Repository $repository
    )
    {
        $this->basketService = $basketService;
        $this->locationService = $locationService;
        $this->contentService = $contentService;
        $this->searchService = $searchService;
        $this->repository = $repository;
    }

    /**
     * Este descuento será aplicable si hay algún cupón válido para el producto pasado.
     * En caso de haber varios válidos se tomará el de mayor descuento.
     * Como la ordenación por float no está soportada habrá que hacer un loop
     *
     * @param Content $content
     * @return bool|\Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\Product
     */
    public function isApplicableTo( Content $content )
    {
        // miramos en primer lugar si la cesta tiene código de descuento
        $couponCode = $this->basketService->getCurrentBasket()->getDiscountCode();

        if ( !empty( $couponCode ) )
        {
            $repository = $this->repository;
            $locationService = $this->locationService;
            $searchService = $this->searchService;
            $contentService = $this->contentService;

            $results = $this->repository->sudo(
                function ( $respository ) use (
                    $locationService,
                    $searchService,
                    $couponCode,
                    $contentService,
                    $content
                )
                {
                    $location = $locationService->loadLocation( 1194 );

                    $query = new LocationQuery();

                    $query->query = new Criterion\LogicalAnd(
                        array(
                            new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                            new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                            new Criterion\Subtree( $location->pathString ),
                            new Criterion\ContentTypeIdentifier( array( 'codigo_descuento' ) ),
                            new Criterion\Field( 'codigo', Criterion\Operator::EQ, $couponCode ),
                            new Criterion\FieldRelation( 'productos_bono', Criterion\Operator::CONTAINS, $content->id ),
                            new Criterion\LogicalOr(
                                array(
                                    new Criterion\Field( 'fecha_inicio', Criterion\Operator::LT, time() ),
                                    new Criterion\Field( 'fecha_inicio', Criterion\Operator::EQ, 0 )
                                )
                            ),
                            new Criterion\LogicalOr(
                                array(
                                    new Criterion\Field( 'fecha_fin', Criterion\Operator::GT, time() ),
                                    new Criterion\Field( 'fecha_fin', Criterion\Operator::EQ, 0 )
                                )
                            )

                        )
                    );

                    $contents = array();
                    foreach( $searchService->findLocations( $query )->searchHits as $result )
                    {
                        $contents[] =  $contentService->loadContent( $result->valueObject->contentInfo->id );
                    }

                    return $contents;
                }
            );

            $bestMatch = 0;
            foreach ( $results as $result )
            {
                 $descuento = $result->getFieldValue( 'descuento' )->value;
                 if ( $descuento > $bestMatch )
                 {
                    $bestMatch = $descuento;
                 }
            }

            return new DiscountProduct(
                array(
                    'percentage' => $bestMatch,
                    'message' => "Descuento aplicado por cupón $couponCode"
                )
            );

        }

        return false;
    }
}
