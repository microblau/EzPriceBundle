<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$ViewMode = $Params['ViewMode'];

$Offset = $Params['Offset'];
if ( !is_numeric( $Offset ) )
    $Offset = 0;

if ( !eZCollaborationViewHandler::exists( $ViewMode ) )
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );

$view = eZCollaborationViewHandler::instance( $ViewMode );

$template = $view->template();

// $collaborationHandlers =& eZCollaborationItemHandler::fetchList();

$viewParameters = array( 'offset' => $Offset );

$tpl = eZTemplate::factory();
$tpl->setVariable( 'view_parameters', $viewParameters );

$Result = array();
$Result['content'] = $tpl->fetch( $template );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/collaboration', 'Collaboration' ) ) );

?>
