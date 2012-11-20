<?php
/**
 * File containing the ezpContentException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This is the base exception for the eZ Publish content API
 *
 * @package ezp_api
 */
abstract class ezpContentException extends ezcBaseException
{
    public function __construct( $message )
    {
        parent::__construct( $message );
    }
}
?>
