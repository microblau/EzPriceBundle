<?php
/**
 * File containing the eZNotificationFunctionCollection class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZNotificationFunctionCollection eznotificationfunctioncollection.php
  \brief The class eZNotificationFunctionCollection does

*/

class eZNotificationFunctionCollection
{
    /*!
     Constructor
    */
    function eZNotificationFunctionCollection()
    {
    }

    function handlerList()
    {
        $availableHandlers = eZNotificationEventFilter::availableHandlers();
        return array( 'result' => $availableHandlers );
    }

    function digestHandlerList( $time, $address )
    {
        $handlers = eZGeneralDigestHandler::fetchHandlersForUser( $time, $address );
        return array( 'result' => $handlers );
    }

    function digestItems( $time, $address, $handler )
    {
        $items = eZGeneralDigestHandler::fetchItemsForUser( $time, $address, $handler );
        return array( 'result' => $items );
    }

    function eventContent( $eventID )
    {
        $event = eZNotificationEvent::fetch( $eventID );
        return array( 'result' => $event->content() );
    }

    function subscribedNodesCount()
    {
        $count = eZSubTreeHandler::rulesCount();
        return array( 'result' => $count );
    }

    function subscribedNodes( $offset = false, $limit = false )
    {
        $nodes = eZSubTreeHandler::rules( false, $offset, $limit );
        return array( 'result' => $nodes );
    }
}

?>
