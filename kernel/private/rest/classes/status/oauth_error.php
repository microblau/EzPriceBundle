<?php
/**
 * File containing the ezpRestOauthErrorStatus class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class ezpRestOauthErrorStatus implements ezcMvcResultStatusObject
{
    public $errorType;
    public $message;

    public function __construct( $errorType = null, $message = null )
    {
        $this->errorType = $errorType;
        $this->message = $message;
    }

    public function process( ezcMvcResponseWriter $writer )
    {
        if ( $writer instanceof ezcMvcHttpResponseWriter )
        {
            $writer->headers["HTTP/1.1 " . ezpOauthErrorType::httpCodeForError( $this->errorType )] = "";
        }

        if ( $this->message !== null )
        {
            $writer->response->body = $this->message;
        }
    }
}
?>
