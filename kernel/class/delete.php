<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$ClassID = null;
if ( isset( $Params["ClassID"] ) )
    $ClassID = $Params["ClassID"];

$GroupID = null;
if ( isset( $Params["GroupID"] ) )
    $GroupID = $Params["GroupID"];

$class = eZContentClass::fetch( $ClassID );
$ClassName = $class->attribute( 'name' );
$classObjects = eZContentObject::fetchSameClassList( $ClassID );
$ClassObjectsCount = count( $classObjects );
if ( $ClassObjectsCount == 0 )
    $ClassObjectsCount .= " object";
else
    $ClassObjectsCount .= " objects";
$http = eZHTTPTool::instance();
if ( $http->hasPostVariable( "ConfirmButton" ) )
{
    $class->remove( true );
    eZContentClassClassGroup::removeClassMembers( $ClassID, 0 );
    $Module->redirectTo( '/class/classlist/' . $GroupID );
}
if ( $http->hasPostVariable( "CancelButton" ) )
{
    $Module->redirectTo( '/class/classlist/' . $GroupID );
}
$Module->setTitle( "Deletion of class " .$ClassID );
$tpl = eZTemplate::factory();


$tpl->setVariable( "module", $Module );
$tpl->setVariable( "GroupID", $GroupID );
$tpl->setVariable( "ClassID", $ClassID );
$tpl->setVariable( "ClassName", $ClassName );
$tpl->setVariable( "ClassObjectsCount", $ClassObjectsCount );
$Result = array();
$Result['content'] = $tpl->fetch( "design:class/delete.tpl" );
$Result['path'] = array( array( 'url' => '/class/delete/',
                                'text' => ezpI18n::tr( 'kernel/class', 'Remove class' ) ) );
?>
