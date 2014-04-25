<?php
/**
 * File containing the eZClusterEventNotifier class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 */

/**
 * Interface that must be implemented by cluster backends supporting events notification.
 * Can be useful if one wants to add some cache server such as Memcached or Redis in place in order to save DB load.
 */
interface eZClusterEventNotifier
{
    /**
     * Registers $listener as the cluster event listener.
     *
     * @param eZClusterEventListener $listener
     * @return void
     */
    public function registerListener( eZClusterEventListener $listener );
}
