<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 21:16
 */

namespace Efl\WebBundle\eZ\Publish\Core\FieldType\CustomEzPrice;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * The price, that includes or not VAT, depending on {@link $isVatIncluded}
     * @var float
     */
    public $price;

    /**
     * If VAT is, or not, included in $price {@link $isVatincluded}
     * @var bool
     */
    public $isVatIncluded = true;

    /**
     * @param float|array $price Either the price as a float, or an array of properties (price, isVatIncluded)
     * @param bool $isVatIncluded
     */
    public function __construct( $price = null, $isVatIncluded = true )
    {
        if ( is_array( $price ) )
        {
            parent::__construct( $price );
        }
        else
        {
            $this->price = $price;
            $this->isVatIncluded = $isVatIncluded;
        }
    }

    public function __toString()
    {
        return (string)$this->price;
    }
}

