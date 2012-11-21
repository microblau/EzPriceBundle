<?php
/**
 * File containing the eZContentClassAttributeNameList class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * @deprecated since 4.3, use eZSerializedObjectNameList directly instead!
 */

class eZContentClassAttributeNameList extends eZSerializedObjectNameList
{
    function eZContentClassAttributeNameList( $serializedNameList = false )
    {
        eZSerializedObjectNameList::eZSerializedObjectNameList( $serializedNameList );
    }

    function create( $serializedNamesString = false )
    {
        $object = new eZContentClassAttributeNameList( $serializedNamesString );
        return $object;
    }
}

?>
