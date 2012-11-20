<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( "name" => "eZSearch",
                 "variable_params" => true );

$ViewList = array();

$ViewList["stats"] = array(
    "script" => "stats.php",
    "default_navigation_part" => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'ResetSearchStatsButton' => 'ResetSearchStats' ),
    "params" => array( ),
    "unordered_params" => array( "offset" => "Offset" ) );

?>
