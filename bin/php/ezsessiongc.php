#!/usr/bin/env php
<?php
/**
 * File containing the ezsessiongc.php script.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

set_time_limit( 0 );

require 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish Session Garbage Collector\n\n" .
                                                        "Allows manual cleaning up expired sessions as defined by site.ini[Session]SessionTimeout\n" .
                                                        "\n" .
                                                        "./bin/php/ezsessiongc.php" ),
                                     'use-session' => false,
                                     'use-modules' => false,
                                     'use-extensions' => true ) );

$script->startup();

$options = $script->getOptions( "",
                                "[]",
                                array() );
$script->initialize();

$cli->output( "Cleaning up expired sessions." );

// Functions for session to make sure baskets are cleaned up
function eZSessionBasketGarbageCollector( $db, $time )
{
    eZBasket::cleanupExpired( $time );
}

// Fill in hooks
eZSession::addCallback( 'gc_pre', 'eZSessionBasketGarbageCollector');

eZSession::garbageCollector();

$script->shutdown();

?>
