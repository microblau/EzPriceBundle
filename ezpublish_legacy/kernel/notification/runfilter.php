<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$http = eZHTTPTool::instance();
$Module = $Params['Module'];

$tpl = eZTemplate::factory();

$tpl->setVariable( 'filter_proccessed', false );
$tpl->setVariable( 'time_event_created', false );

if ( $http->hasPostVariable( 'RunFilterButton' ) )
{
    eZNotificationEventFilter::process();
    $tpl->setVariable( 'filter_proccessed', true );

}
else if ( $http->hasPostVariable( 'SpawnTimeEventButton' ) )
{
    $event = eZNotificationEvent::create( 'ezcurrenttime', array() );
    $event->store();
    $tpl->setVariable( 'time_event_created', true );

}

$Result = array();
$Result['content'] = $tpl->fetch( 'design:notification/runfilter.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/notification', 'Notification settings' ) ) );

?>
