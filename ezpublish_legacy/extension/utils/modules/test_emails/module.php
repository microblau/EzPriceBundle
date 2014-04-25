<?php
$Module = array( "name" => "test_emails",
                 "variable_params" => true );

$ViewList = array();
$ViewList['test'] = array(
    'functions' => array( 'test' ),
    'script' => 'test.php',
    'default_navigation_part' => 'ezmynavigationpart' );


$FunctionList = array();
$FunctionList['test'] = array( );
?>
