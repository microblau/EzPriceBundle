<?php
/**
 * File containing the ezpOauthTokenNotFoundException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This exception is thrown when the accept token has expired, but can be
 * renewed.
 *
 * @package oauth
 */
class ezpOauthExpiredTokenException extends ezpOauthRequiredException
{
    public function __construct( $message )
    {
        $this->errorType = ezpOauthErrorType::EXPIRED_TOKEN;
        parent::__construct( $message );
    }
}
?>
