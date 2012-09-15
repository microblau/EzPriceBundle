<?php
class customEZPriceType extends eZPriceType
{
    
    const DATA_TYPE_STRING = 'customezprice';

    function __construct()
    {
        eZDataType::__construct( self::DATA_TYPE_STRING, 'Precio Indexables',
                           array( 'serialize_supported' => true,
                                  'object_serialize_map' => array( 'data_float' => 'price' ) ) );
    }
    function isIndexable()
    {
        return true;
    }
}
eZDataType::register( customEZPriceType::DATA_TYPE_STRING, "customezpricetype" );
?>
