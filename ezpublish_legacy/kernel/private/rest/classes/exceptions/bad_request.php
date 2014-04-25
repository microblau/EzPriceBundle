<?php
/**
 * File containing the ezpOauthBadRequestException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This is the base exception for triggering BAD REQUEST response.
 *
 * @package oauth
 */
abstract class ezpOauthBadRequestException extends ezpOauthException
{
    public function __construct( $message )
    {
        parent::__construct( $message );
    }
}
?>
