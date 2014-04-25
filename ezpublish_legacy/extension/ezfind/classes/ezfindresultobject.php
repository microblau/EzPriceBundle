<?php
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Find
// SOFTWARE RELEASE: 2.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//  This source file is part of the eZ Publish CMS and is
//  licensed under the terms and conditions of the eZ Business Use
//  License v2.1 (eZ BUL).
//
//  A copy of the eZ BUL was included with the software. If the
//  license is missing, request a copy of the license via email
//  at license@ez.no or via postal mail at
// 	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
//
//  IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//  SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//  READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file ezfindresultobject.php
*/

/*!
  \class eZFindResultObject ezfindresultobject.php
  \brief The class eZFindResultObject does

*/

class eZFindResultObject extends eZContentObject
{
    /*!
     \reimp
    */
    function eZFindResultObject( $rows = array() )
    {
        $this->LocalAttributeValueList = array();
        $this->LocalAttributeNameList = array( 'published' );

        foreach ( $rows as $name => $value )
        {
            $this->setAttribute( $name, $value );
        }
    }

    /*!
     \reimp
    */
    function attribute( $attr, $noFunction = false )
    {
        $retVal = null;
        switch ( $attr )
        {
            default:
            {
                if ( in_array( $attr, $this->LocalAttributeNameList ) )
                {
                    $retVal = isset( $this->LocalAttributeValueList[$attr] ) ?
                        $this->LocalAttributeValueList[$attr] : null;
                }
            } break;
        }
        return $retVal;
    }

    /*!
     \reimp
    */
    function setAttribute( $attr, $value )
    {
        if ( in_array( $attr, $this->LocalAttributeNameList ) )
        {
            $this->LocalAttributeValueList[$attr] = $value;
        }
    }

    /*!
     \reimp
    */
    function attributes()
    {
        return array_merge( $this->LocalAttributeNameList,
                            eZContentObject::attributes() );
    }

    /*!
     \reimp
    */
    function hasAttribute( $attr )
    {
        return ( in_array( $attr, $this->LocalAttributeNameList ) ||
                 eZContentObject::hasAttribute( $attr ) );
    }


    /// Object variables
    var $LocalAttributeValueList;
    var $LocalAttributeNameList;
}

?>
