<?php
// Created on: <28-Jun-2009 22:00 bm>
//
// SOFTWARE NAME: DB Attribute Converter
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 2009 DB Team, http://db-team.eu
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

include_once( 'kernel/common/template.php' );
// include_once( 'lib/ezutils/classes/ezini.php' );
// include_once( 'lib/ezutils/classes/ezwizardbase.php' );

$Module = $Params['Module'];

$tpl = templateInit();
$http = eZHTTPTool::instance();

$stepArray = array();

$stepArray[] = array(
    'file' => 'selectclass.php',
    'class' => 'selectClass'
);

$stepArray[] = array(
    'file' => 'selectattribute.php',
    'class' => 'selectAttribute'
);

// TODO: this step should be splited into two parts: 
//  - simple target datatype selection
//  - warnings / options + other info of selected datatype only ...
$stepArray[] = array(
    'file' => 'selecttarget.php',
    'class' => 'selectTarget'
);

$stepArray[] = array(
    'file' => 'result.php',
    'class' => 'result'
);


if ( $http->hasPostVariable( 'RestartButton' ) )
{
    $step = false;
}
else
{
	$step = eZWizardBaseClassLoader::createClass( $tpl, $Module, $stepArray, 'extension/dbattributeconverter/classes/wizard/', 'dbattributeconverter' );
}

if ( $step )
{
    $result = $step->run();
    return $result;
}
else
{
    // step was wrong, go back to first step
    $step = eZWizardBaseClassLoader::createClass( $tpl, $Module, $stepArray, 'extension/dbattributeconverter/classes/wizard/', 'dbattributeconverter', array( 'current_step' => 0 ) );

	$step->cleanUp();
    $result = $step->run();
    return $result;
}

?>