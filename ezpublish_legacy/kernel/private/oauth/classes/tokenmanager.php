<?php
/**
 * File containing the ezpRestTokenManager class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package oAuth
 */

/**
 * This class handles application tokens
 * @package oAuth
 */

class ezpRestTokenManager
{
    /**
     * Generates a token
     *
     * @todo See if this should maybe return a token object with token + expiry
     *
     * @param string $scope
     *
     * @return string $token
     */
    public static function generateToken( $scope )
    {
        return md5( 'uniqid' );
    }
}
?>
