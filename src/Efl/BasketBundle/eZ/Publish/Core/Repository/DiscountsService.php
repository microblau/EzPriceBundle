<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 12:48
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;

class DiscountsService
{
    /**
     * @var \Efl\BasketBundle\Discounts\BasketItemDiscountInterface[]
     */
    private $discountTypes;

    public function __construct()
    {
        $this->discountTypes = array();
    }

    /**
     * Añade un tipo de descuento
     *
     * @param BasketItemDiscountInterface $basketItemDiscountType
     */
    public function addDiscountType( BasketItemDiscountInterface $basketItemDiscountType )
    {
        $this->discountTypes[] = $basketItemDiscountType;
    }

    /**
     * Aplica el descuento al producto
     *
     * @param BasketItem $basketItem
     * @return BasketItem|void
     */
    public function findBestDiscount( BasketItem $basketItem )
    {
        $applicableDiscounts = array();

        foreach ( $this->discountTypes as $discountType )
        {
            $discount = $discountType->isApplicableTo( $basketItem );
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
     * @param \Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\BasketItem[]
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