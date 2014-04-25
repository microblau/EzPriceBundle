<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( "name" => "Settings management",
                 "variable_params" => true );

$ViewList = array();
$ViewList["view"] = array(
    "script" => "view.php",
    "default_navigation_part" => "ezsetupnavigationpart",
    "params" => array( 'SiteAccess' , 'INIFile' ) );
$ViewList["edit"] = array(
    "script" => "edit.php",
    'ui_context' => 'edit',
    "default_navigation_part" => "ezsetupnavigationpart",
    "params" => array( 'SiteAccess', 'INIFile', 'Block', 'Setting', 'Placement' ) );

?>
