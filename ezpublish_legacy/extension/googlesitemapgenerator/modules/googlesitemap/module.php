<?php

$Module = array( "name" => "googlesitemap" );

$ViewList = array();
$ViewList['generate'] = array(
						    'functions' => array( 'generate' ),
						    'script' => 'generate.php',
						    'params' => array( 'NodeID' ) );

$FunctionList['generate'] = array( );
?>