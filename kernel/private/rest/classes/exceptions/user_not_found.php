<?php
/**
 * File containing ezpUserNotFoundException class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */
class ezpUserNotFoundException extends ezpRestException
{
    public function __construct( $userID )
    {
        eZLog::write( __METHOD__ . " : Provided user #$userID was not found and could not be logged in", 'error.log' );
        parent::__construct( 'Provided user was not found' );
    }
}
?>
