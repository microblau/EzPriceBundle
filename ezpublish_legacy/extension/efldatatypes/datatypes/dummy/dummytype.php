<?php

class dummyType extends eZDataType
{
    const DATA_TYPE_STRING = 'dummy';

    /**
     * Initializes the datatype
     */
    function __construct()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr( 'kernel/classes/datatypes', 'Dummy', 'Datatype name' ),
            array( 'serialize_supported' => false,
                'object_serialize_map' => array( 'data_text' => 'text' ) ) );
    }
}

eZDataType::register( dummyType::DATA_TYPE_STRING, 'dummyType' );