<?php
/**
 * File containing the eZClusterEventLogger class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 */

/**
 * Interface for eZClusterEvent loggers.
 *
 * Cluster events can be used either inside eZ Publish (cache read/write, file handling...), but also
 * through index_cluster.php in order to serve binary files.
 * In the last case, the process should be as fast as possible and consume less resources as possible.
 * Thus we should not include heavy dependencies on eZ Publish utility classes like eZDebug in order to log errors.
 * This interface is to be implemented by classes dedicated to error logging, depending on context.
 */
interface eZClusterEventLogger
{
    /**
     * Logs $errMsg.
     *
     * @param string $errMsg Error message to be logged
     * @param string $context Context where the error occurred
     * @return void
     */
    public function logError( $errMsg, $context = null );
}
