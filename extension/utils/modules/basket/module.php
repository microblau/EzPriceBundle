<?php
//
// Created on: <16-Feb-2010 11:08:15 carlos.revillo@tantacom.com>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

$Module = array( "name" => "basket",
                 "variable_params" => true );

$ViewList = array();
$ViewList['add'] = array(
    'functions' => array( 'buy' ),
    'script' => 'add.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( 'ObjectID', 'Quantity' ) );

$ViewList['login'] = array(
    'functions' => array( 'buy' ),
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
    

$ViewList['register'] = array(
    'functions' => array( 'buy' ),
    'script' => 'register.php',
    'params' => array( 'redirect_number' ),
    'ui_context' => 'edit',
    'default_navigation_part' => 'ezmynavigationpart',
    'single_post_actions' => array( 'PublishButton' => 'Publish',
                                    'CancelButton' => 'Cancel',
                                    'CustomActionButton' => 'CustomAction' ) );

$ViewList["basket"] = array(
    "functions" => array( 'buy' ),
    "script" => "basket.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$ViewList["payment"] = array(
    "functions" => array( 'buy' ),
    "script" => "payment.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array( 'key' ) );

$ViewList["checkout"] = array(
    "functions" => array( 'buy' ),
    "script" => "checkout.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$ViewList["confirmorder"] = array(
    "functions" => array( 'buy' ),
    "script" => "confirmorder.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$ViewList["userdata"] = array(
    "functions" => array( 'checkout' ),
    "script" => "userdata.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$ViewList["forgotpassword"] = array(
    "functions" => array( 'buy' ),
    "script" => "forgotpassword.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$ViewList["resetpassword"] = array(
    "functions" => array( 'buy' ),
    "script" => "resetpassword.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array( 'Key'  ) );

$ViewList['updatebasket'] = array(
    'functions' => array( 'buy' ),
    'script' => 'updatebasket.php',
    'default_navigation_part' => 'ezshopnavigationpart',
    'params' => array(  ) );

$ViewList['outside'] = array(
    'functions' => array( 'buy' ),
    'script' => 'outside.php',
    'default_navigation_part' => 'ezshopnavigationpart',
    'params' => array(  ) );

$ViewList['ajaxadd'] = array(
    'functions' => array( 'buy' ),
    'script' => 'ajaxadd.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( 'ObjectID', 'Quantity' ) );

$ViewList['ajaxremove'] = array(
    'functions' => array( 'buy' ),
    'script' => 'ajaxremove.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( 'ObjectID', 'Quantity' ) );		
	
/*$ViewList['mementix'] = array(
    'functions' => array( 'buy' ),
    'script' => 'mementix.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );
*/
$ViewList['mementixcheckprice'] = array(
    'functions' => array( 'buy' ),
    'script' => 'mementixcheckprice.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList['imementoramacheckprice'] = array(
    'functions' => array( 'buy' ),
    'script' => 'imementoramacheckprice.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );		
	
$ViewList['qmementixcheckprice'] = array(
    'functions' => array( 'buy' ),
    'script' => 'qmementixcheckprice.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );	
		
$ViewList['addmementix'] = array(
    'functions' => array( 'buy' ),
    'script' => 'addmementix.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList['addqmementix'] = array(
    'functions' => array( 'buy' ),
    'script' => 'addqmementix.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );	
	
$ViewList['addnautis4'] = array(
    'functions' => array( 'buy' ),
    'script' => 'addnautis4.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList['que-es-un-acceso-nautis4'] = array(
    'functions' => array( 'buy' ),
    'script' => 'accesonautis4.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList["imemento"] = array(
    'functions' => array( 'imemento' ),
    "script" => "imemento.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["qmementix"] = array(
    'functions' => array( 'qmementix' ),
    "script" => "qmementix.php",
    "default_navigation_part" => 'ezshopnavigationpart' );	
	
$ViewList["imementorama"] = array(
    'functions' => array( 'imemento' ),
    "script" => "imementorama.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["imementocheckprice"] = array(
    'functions' => array( 'imemento' ),
    "script" => "imementocheckprice.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["addimemento"] = array(
    'functions' => array( 'imemento' ),
    "script" => "addimemento.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList['que-es-un-codigo-promocional'] = array(
    'functions' => array( 'buy' ),
    'script' => 'codigopromocional.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList['que-es-un-acceso-mementix'] = array(
    'functions' => array( 'buy' ),
    'script' => 'accesomementix.php',
    'default_navigation_part' => 'ezmynavigationpart',
    'params' => array( ) );

$ViewList["discountgroup"] = array(
    "functions" => array( 'setup' ),
    "script" => "discountgroup.php",
    "default_navigation_part" => 'ezshopnavigationpart',
    "params" => array(  ) );

$ViewList["discountgroupedit"] = array(
    "functions" => array( 'setup' ),
    "script" => "discountgroupedit.php",
    'ui_context' => 'edit',
    "default_navigation_part" => 'ezshopnavigationpart',
    "params" => array( 'DiscountGroupID' ) );

$ViewList["discountgroupview"] = array(
    'functions' => array( 'setup' ),
    "script" => "discountgroupmembershipview.php",
    "default_navigation_part" => 'ezshopnavigationpart',
    'post_actions' => array( 'BrowseActionName' ),
    "params" => array( 'DiscountGroupID' ) );

$ViewList["discountruleedit"] = array(
    "functions" => array( 'setup' ),
    "script" => "discountruleedit.php",
    'ui_context' => 'edit',
    "default_navigation_part" => 'ezshopnavigationpart',
    'post_actions' => array( 'BrowseActionName' ),
    "params" => array( 'DiscountGroupID', 'DiscountRuleID'  ) );

$ViewList["discountgroupview"] = array(
    'functions' => array( 'setup' ),
    "script" => "discountgroupmembershipview.php",
    "default_navigation_part" => 'ezshopnavigationpart',
    'post_actions' => array( 'BrowseActionName' ),
    "params" => array( 'DiscountGroupID' ) );

$ViewList["kelkoo"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "kelkoo.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["ciao"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "ciao.php",
    "default_navigation_part" => 'ezshopnavigationpart' );


$ViewList["orders"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "orders.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["encuesta"] = array(
    'functions' => array( 'encuesta' ),
    "script" => "encuesta.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["csvproducts"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "csvproducts.php",
    "default_navigation_part" => 'ezshopnavigationpart' );
$ViewList["xmlproducts"] = array(
    'functions' => array( 'kelkoo' ),
    "script" => "xmlproducts.php",
    "default_navigation_part" => 'ezshopnavigationpart' );

$ViewList["csv-encuestas"] = array(
    'functions' => array( 'csvencuestas' ),
    "script" => "csv-encuestas.php",
    "default_navigation_part" => 'ezshopnavigationpart' );


$ViewList["gastosenvio"] = array(
    "script" => "gastosenvio.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );

$FunctionList = array();
$FunctionList['buy'] = array( );
$FunctionList['checkout'] = array( );
$FunctionList['setup'] = array( );
$FunctionList['kelkoo'] = array( );
$FunctionList['encuesta'] = array( );
$FunctionList['csvencuestas'] = array( );
$FunctionList['imemento'] = array( );
$FunctionList['qmementix'] = array( );
$FunctionList['envios'] = array( );
?>
