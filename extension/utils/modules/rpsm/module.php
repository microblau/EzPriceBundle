<?php 

$Module = array( "name" => "basket",
                 "variable_params" => true );
				 
$ViewList = array();
$ViewList['login'] = array(
    'functions' => array( 'login' ),
    'script' => 'login.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( 'Key' ) );
				 
?>