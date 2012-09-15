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

$Module = array( "name" => "colectivos",
                 "variable_params" => true );

$ViewList = array();


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

$ViewList["alta-colectivo"] = array(
    "functions" => array( 'buy' ),
    "script" => "altacolectivo.php",
    "default_navigation_part" => 'ezmynavigationpart',
    'unordered_params' => array( 'error' => 'Error' ),
    "params" => array(  ) );   


$FunctionList = array();
$FunctionList['buy'] = array( );
$FunctionList['checkout'] = array( );
?>
