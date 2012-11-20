<?php
/**
 * File containing the ezpRestHttpResponseWriter class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class ezpRestHttpResponseWriter extends ezcMvcHttpResponseWriter
{
    /**
     * The response struct object.
     *
     * In the ezp rest version this variable is public, so that error messages
     * can be injected into the response body.
     *
     * @var ezcMvcResponse
     */
    public $response;

}
