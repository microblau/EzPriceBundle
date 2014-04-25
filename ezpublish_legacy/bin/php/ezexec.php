#!/usr/bin/env php
<?php
/**
 * File containing the ezexec.php script.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

require 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish Script Executor\n\n" .
                                                        "Allows execution of simple PHP scripts which uses eZ Publish functionality,\n" .
                                                        "when the script is called all necessary initialization is done\n" .
                                                        "\n" .
                                                        "ezexec.php myscript.php" ),
                                     'use-session' => false,
                                     'use-modules' => true,
                                     'use-extensions' => true ) );

$script->startup();

$options = $script->getOptions( "",
                                "[scriptfile]",
                                array() );
$script->initialize();

if ( count( $options['arguments'] ) < 1 )
{
    $script->shutdown( 1, "Missing script file" );
}

$scriptFile = $options['arguments'][0];

if ( !file_exists( $scriptFile ) )
    $script->shutdown( 1, "Could execute the script '$scriptFile', file was not found" );

$retCode = include( $scriptFile );

if ( $retCode != 1 )
    $script->setExitCode( 1 );

$script->shutdown();

?>
