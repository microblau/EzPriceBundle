<?php

//
// SOFTWARE NAME: Utils
// SOFTWARE RELEASE: 0.1
// COPYRIGHT NOTICE: Copyright (C) 2011 Tanta Comunicación

$Module = array( 'name' => 'producto',
                 'variable_params' => true );

$ViewList = array();
	
$ViewList['vervideo'] = array(
    'script' => 'ver.php',
	'functions' => array( 'ver' )
	);	
$ViewList['opinion'] = array(
    'script' => 'opinion.php',
	'functions' => array( 'opinion' )
	);	
$ViewList['formularioopinion'] = array(
    'script' => 'formularioopinion.php',
	'functions' => array( 'formularioopinion' )
	);			

$ViewList['login'] = array(
    'functions' => array( 'login' ),
    'script' => 'login.php',
    'ui_context' => 'authentication',
    'default_action' => array( array( 'name' => 'Login',
                                      'type' => 'post',
                                      'parameters' => array( 'Login',
                                                             'Password' ) ) ),
    'single_post_actions' => array( 'LoginButton' => 'Login' ),
    'post_action_parameters' => array( 'Login' => array( 'UserLogin' => 'Login',
                                                         'UserPassword' => 'Password',
                                                         'UserRedirectURI' => 'RedirectURI' ) ),
    'params' => array( ) );


$ViewList['forgotpassword'] = array(
    'functions' => array( 'password' ),
    'script' => 'forgotpassword.php',
    'params' => array( ),
    'ui_context' => 'administration',
    'single_post_actions' => array( 'GenerateButton' => 'Generate' ),
    'post_action_parameters' => array( 'Generate' => array( 'Login' => 'UserLogin',
                                                            'Email' => 'UserEmail' ) ),
    'params' => array( 'HashKey' ) );

$ViewList["xmlproducts"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "xmlproducts.php" );
	
$FunctionList['ver'] = array();
$FunctionList['opinion'] = array();
$FunctionList['formularioopinion'] = array();

?>
