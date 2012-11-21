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
 * This exception is thrown when a request is invalid.
 *
 * An invalid request is the case when a required parameter is missing, when
 * multiple methods of transferring the token is used, or when parameters are
 * repeated.
 *
 * @package oauth
 */
class ezpOauthInvalidRequestException extends ezpOauthBadRequestException
{
    public function __construct( $message )
    {
        $this->errorType = ezpOauthErrorType::INVALID_REQUEST;
        parent::__construct( $message );
    }
}
?>
