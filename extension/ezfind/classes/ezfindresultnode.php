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

/*! \file ezfindresultnode.php
*/

/*!
  \class eZFindResultNode ezfindresultnode.php
  \brief The class eZFindResultNode does

*/

class eZFindResultNode extends eZContentObjectTreeNode
{
    /*!
     \reimp
    */
    function eZFindResultNode( $rows = array() )
    {
        $this->eZContentObjectTreeNode( $rows );
        $this->LocalAttributeValueList = array();
        $this->LocalAttributeNameList = array( 'is_local_installation',
                                               'name',
                                               'global_url_alias',
                                               'published',
                                               'language_code',
                                               'highlight',
                                               'score_percent' );
    }

    /*!
     \reimp
    */
    function attribute( $attr, $noFunction = false )
    {
        $retVal = null;

        switch ( $attr )
        {
            case 'object':
            {
                if ( $this->attribute( 'is_local_installation' ) )
                {
                    $retVal = eZContentObjectTreeNode::attribute( $attr, $noFunction );
                }
                else
                {
                    if ( empty( $this->ResultObject ) )
                    {
                        $this->ResultObject = new eZFindResultObject( array( 'published' => $this->attribute( 'published' ) ) );
                    }
                    $retVal = $this->ResultObject;
                }
            } break;

            case 'language_code':
            {
                $retVal = $this->CurrentLanguage;
            } break;

            default:
            {
                if ( in_array( $attr, $this->LocalAttributeNameList ) )
                {
                    $retVal = isset( $this->LocalAttributeValueList[$attr] ) ? $this->LocalAttributeValueList[$attr] : null;
                    // Timestamps are stored as strings for remote objects, so it must be converted.
                    if ( $attr == 'published' )
                    {
                        $retVal = strtotime( $retVal );
                    }
                }
                else if ( $this->attribute( 'is_local_installation' ) )
                {
                    $retVal = eZContentObjectTreeNode::attribute( $attr, $noFunction );
                }
            } break;
        }

        return $retVal;
    }

    /*!
     \reimp
    */
    function attributes()
    {
        return array_merge( $this->LocalAttributeNameList,
                            eZContentObjectTreeNode::attributes() );
    }

    /*!
     \reimp
    */
    function hasAttribute( $attr )
    {
        return ( in_array( $attr, $this->LocalAttributeNameList ) ||
                 eZContentObjectTreeNode::hasAttribute( $attr ) );
    }

    /*!
     \reimp
    */
    function setAttribute( $attr, $value )
    {
        switch( $attr )
        {
            case 'language_code':
            {
                $this->CurrentLanguage = $value;
            } break;

            default:
            {
                if ( in_array( $attr, $this->LocalAttributeNameList ) )
                {
                    $this->LocalAttributeValueList[$attr] = $value;
                }
                else
                {
                    eZContentObjectTreeNode::setAttribute( $attr, $value );
                }
            }
        }
    }

    /// Member vars
    var $CurrentLanguage;
    var $LocalAttributeValueList;
    var $LocalAttributeNameList;
    var $ResultObject;
}

?>
