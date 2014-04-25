<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( "name" => "eZTrigger" );

$ViewList = array();
$ViewList["list"] = array(
    "script" => "list.php",
    'ui_context' => 'administration',
    "default_navigation_part" => 'ezsetupnavigationpart',
    "params" => array( ) );

?>
