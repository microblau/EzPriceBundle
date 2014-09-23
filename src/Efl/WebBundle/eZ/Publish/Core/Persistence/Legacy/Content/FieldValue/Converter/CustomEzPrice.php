<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 21:18
 */

namespace Efl\WebBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;

use eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;

class CustomEzPrice implements Converter
{
    /**
     * Factory for current class
     *
     * @note Class should instead be configured as service if it gains dependencies.
     *
     * @return \EzSystems\EzPriceBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\Price
     */
    public static function create()
    {
        return new static;
    }

    public function toStorageValue( FieldValue $value, StorageFieldValue $storageFieldValue )
    {
        $storageFieldValue->dataFloat = $value->data['price'];
        $storageFieldValue->dataText = (int)$value->data['isVatIncluded'] . ',1';
        $storageFieldValue->sortKeyInt = $value->sortKey;
    }

    public function toFieldValue( StorageFieldValue $value, FieldValue $fieldValue )
    {
        $fieldValue->data = array( 'price' => $value->dataFloat );

        if ( strstr( $value->dataText, ',' ) !== false )
        {
            list( $vatRateId, $isVatIncluded ) = explode( ',', $value->dataText );
            $fieldValue->data['isVatIncluded'] = ( $isVatIncluded == 1 ) ? true : false;
        }
        $fieldValue->sortKey = $value->sortKeyInt;
    }

    public function toStorageFieldDefinition( FieldDefinition $fieldDef, StorageFieldDefinition $storageDef )
    {
        $storageDef->dataFloat1 = $fieldDef->fieldTypeConstraints->fieldSettings['vat_id'];
        $storageDef->dataInt1 = $fieldDef->fieldTypeConstraints->fieldSettings['is_vat_included'] ? 1 : 2;
    }

    public function toFieldDefinition( StorageFieldDefinition $storageDef, FieldDefinition $fieldDef )
    {
        $fieldDef->fieldTypeConstraints->fieldSettings['vat_id'] = $storageDef->dataFloat1;
        $fieldDef->fieldTypeConstraints->fieldSettings['is_vat_included'] = $storageDef->dataInt1 == 1 ? true : false;
    }

    public function getIndexColumn()
    {
        return 'sort_key_int';
    }

}
