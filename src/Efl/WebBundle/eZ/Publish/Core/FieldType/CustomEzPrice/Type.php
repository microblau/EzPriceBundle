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
}
