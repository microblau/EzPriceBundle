<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 12:48
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use Efl\BasketBundle\Discounts\ProductDiscountInterface;
use eZ\Publish\Core\Repository\Values\Content\Content;

class DiscountsService
{
    /**
     * @var \Efl\BasketBundle\Discounts\ProductDiscountInterface[]
     */
    private $productDiscountTypes;

    public function __construct()
    {
        $this->productDiscountTypes = array();
    }

    /**
     * Añade un tipo de descuento
     *
     * @param ProductDiscountInterface $productDiscountType
     */
    public function addDiscountType( ProductDiscountInterface $productDiscountType )
    {
        $this->productDiscountTypes[] = $productDiscountType;
    }

    /**
     * Devuelve el mejor descuento para el producto
     *
     * @param Content $content
     * @return BasketItem|void
     */
    public function findBestDiscount( Content $content )
    {
        $applicableDiscounts = array();

        foreach ( $this->productDiscountTypes as $discountType )
        {
            $discount = $discountType->isApplicableTo( $content );
            if ( $discount )
            {
                $applicableDiscounts[] = $discount;
            }
        }

        if ( empty( $applicableDiscounts ) )
            return;

        $bestMatch = $this->findBestMatch( $applicableDiscounts );

        return $bestMatch;
    }

    /**
     * Devuelve el mejor descuento aplicable
     *
     * @param \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\Product[]
     * @return \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\Product
     */
    private function findBestMatch( array $discounts = array() )
    {
        $bestPercentage =  0.0;
        $bestDiscount = null;

        foreach ( $discounts as $discount )
        {
            if ( $discount->percentage > $bestPercentage )
            {
                $bestDiscount = $discount;
                $bestPercentage = $discount->percentage;
            }
        }

        return $bestDiscount;
    }
}
