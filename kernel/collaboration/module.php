<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = array( 'name' => 'eZCollaboration' );

$ViewList = array();
$ViewList['action'] = array(
    'script' => 'action.php',
    "default_navigation_part" => 'ezmynavigationpart',
    'default_action' => array( array( 'name' => 'Custom',
                                      'type' => 'post',
                                      'parameters' => array( 'CollaborationActionCustom',
                                                             'CollaborationTypeIdentifier',
                                                             'CollaborationItemID' ) ) ),
    'post_action_parameters' => array( 'Custom' => array( 'TypeIdentifer' => 'CollaborationTypeIdentifier',
                                                          'ItemID' => 'CollaborationItemID' ) ),
    'params' => array() );
$ViewList['view'] = array(
    'script' => 'view.php',
    "default_navigation_part" => 'ezmynavigationpart',
    'params' => array( 'ViewMode' ),
    "unordered_params" => array( "language" => "Language",
                                 "offset" => "Offset" ) );
$ViewList['item'] = array(
    'script' => 'item.php',
    "default_navigation_part" => 'ezmynavigationpart',
    'params' => array( 'ViewMode', 'ItemID' ),
    "unordered_params" => array( "language" => "Language",
                                 "offset" => "Offset" ) );
$ViewList['group'] = array(
    'script' => 'group.php',
    "default_navigation_part" => 'ezmynavigationpart',
    'params' => array( 'ViewMode', 'GroupID' ),
    "unordered_params" => array( "language" => "Language",
                                 "offset" => "Offset" ) );

?>
