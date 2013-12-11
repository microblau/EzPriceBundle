<?php
/**
 * File containing the eZClusterEventLoggerEzdebug class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 */

/**
 * Logger using eZDebugSetting.
 * Condition is 'kernel-clustering'
 */
class eZClusterEventLoggerEzdebug implements eZClusterEventLogger
{
    /**
     * Logs $errMsg.
     *
     * @param string $errMsg Error message to be logged
     * @param string $context Context where the error occurred
     * @return void
     */
    public function logError( $errMsg, $context = null )
    {
        eZDebugSetting::writeError( 'kernel-clustering', $errMsg, $context );
    }
}
