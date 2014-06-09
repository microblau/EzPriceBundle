<?php

/**
 * Scripts que nos permitirá la creación de nuevas clases así como la modificación
 * de las existentes para adaptarlo al nuevo modelo de datos.
 *
 */

require 'autoload.php';
$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => 'Creación de nuevas clases',
    'use-session' => false,
    'use-modules' => true,
    'use-extensions' => true ) );


$script->startup();

$options = $script->getOptions();

$script->initialize();

$setup = new bumpSetup( $cli, $script );
$setup->run();

$script->shutdown();