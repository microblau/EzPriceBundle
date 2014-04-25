<?php
/**
 * File containing the notification.php cronjob
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$event = eZNotificationEvent::create( 'ezcurrenttime', array() );

$event->store();
$cli->output( "Starting notification event processing" );
eZNotificationEventFilter::process();

$cli->output( "Done" );

?>
