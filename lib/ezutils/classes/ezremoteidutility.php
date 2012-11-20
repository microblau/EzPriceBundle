<?php
/**
 * File containing the eZRemoteIdUtility class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/**
 * This class provides tools around remote ids
 * @package lib
 */
class eZRemoteIdUtility
{
    /**
     * Generates a remote ID
     * @param string $type A type string, that will ensure more unicity: object, node, class...
     */
    public static function generate( $type = '' )
    {
        return md5( uniqid( $type, true ) );
    }
}
?>
