<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 21:18
 */
namespace Efl\WebBundle\eZ\Publish\Core\FieldType\CustomEzPrice;

use EzSystems\EzPriceBundle\eZ\Publish\Core\FieldType\Price\Type as PriceType;

class Type extends PriceType
{
    /**
     * Returns the field type identifier for this field type
     *
     * @return string
     */
    public function getFieldTypeIdentifier()
    {
        return 'customezprice';
    }

    protected function createValueFromInput( $inputValue )
    {
        if ( is_int( $inputValue ) )
        {
            $inputValue = (float)$inputValue;
        }

        if ( is_float( $inputValue ) )
        {
            $inputValue = new Value( $inputValue );
        }

        return $inputValue;
    }

    public function fromHash( $hash )
    {
        if ( $hash === null )
        {
            return $this->getEmptyValue();
        }
        return new Value( $hash );
    }
}
