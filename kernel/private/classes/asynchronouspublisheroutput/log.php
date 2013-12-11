<?php
/**
 * File containing the ezpAsynchronousPublisherLogOutput class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Handles asynchronous publishing output to var/log/async.log
 * @package kernel
 */
class ezpAsynchronousPublisherLogOutput implements ezpAsynchronousPublisherOutput
{
    private $logFile = 'async.log';
    private $logDir = 'var/log';

    public function write( $message )
    {
        eZLog::write( $message, $this->logFile, $this->logDir );
    }
}
?>
