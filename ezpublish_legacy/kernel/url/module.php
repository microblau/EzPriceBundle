<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( 'name' => 'eZURL' );

$ViewList = array();
$ViewList['list'] = array(
    'script' => 'list.php',
    'default_navigation_part' => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'SetValid' => 'SetValid',
                                    'SetInvalid' => 'SetInvalid' ),
    'post_action_parameters' => array( 'SetValid' => array( 'URLSelection' => 'URLSelection' ),
                                       'SetInvalid' => array( 'URLSelection' => 'URLSelection' ) ),
    'params' => array( 'ViewMode' ),
    "unordered_params" => array( "offset" => "Offset" ) );
$ViewList['view'] = array(
    'script' => 'view.php',
    'default_navigation_part' => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'EditObject' => 'EditObject' ),
    'params' => array( 'ID' ),
    'unordered_params'=> array( 'offset' => 'Offset' ) );
$ViewList['edit'] = array(
    'script' => 'edit.php',
    'ui_context' => 'edit',
    'default_navigation_part' => 'ezsetupnavigationpart',
    'single_post_actions' => array( 'Cancel' => 'Cancel',
                                    'Store' => 'Store' ),
    'params' => array( 'ID' ) );
?>
