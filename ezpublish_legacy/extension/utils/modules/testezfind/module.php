<?php

$Module = array( "name" => "testezfind",
                 "variable_params" => true );

$ViewList = array();
$ViewList['test'] = array(
    'functions' => array( 'buscador' ),
    'script' => 'test.php',
    'default_navigation_part' => 'ezmynavigationpart' );


$FunctionList = array();
$FunctionList['buscador'] = array( );
?>
