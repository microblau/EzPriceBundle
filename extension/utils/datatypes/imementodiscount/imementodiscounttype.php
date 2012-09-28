<?php
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Flow
// SOFTWARE RELEASE: 1.1-0
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

class imementoDiscountType extends eZMatrixType
{
    const DATA_TYPE_STRING = 'imementodiscount';

    /**
     * Constructor
     *
     */
    function __construct()
    {
        eZDataType::__construct( self::DATA_TYPE_STRING, "Tabla de descuentos Imemento" );
    } 
    
    function deleteStoredObjectAttribute( $objectAttribute, $version = null )
    {
       eflMementixDiscountRule::removeData( $objectAttribute->attribute( 'id' ), $version );
    }

    function onPublish( $contentObjectAttribute, $contentObject, $publishedNodes )
    {
        eflImementoDiscountRule::removeData( $contentObjectAttribute->attribute( 'id' ), $contentObjectAttribute->attribute( 'version' ) );
        
        $content = $contentObjectAttribute->attribute( 'data_text' );      
        $dom = simplexml_load_string( $content );
        $valores = $dom->xpath( '//c' );
        $rows = count ( $valores ) / 2;
        for( $i = 0; $i < $rows; $i++ )
        {
            $discount = new eflImementoDiscountRule( 
                                    array( 
                                           'qte_mem' => (int)$valores[ ($i*2)],
                                           'discount' => (int)$valores[ ($i*2) + 1],
                                           'contentobjectattribute_id' => $contentObjectAttribute->attribute( 'id' ),
                                           'contentobjectattribute_version' => $contentObjectAttribute->attribute( 'version' ) )  
                                );      
            $discount->store();
        }
    }
}

eZDataType::register( imementoDiscountType::DATA_TYPE_STRING, "imementodiscounttype" );
?>
