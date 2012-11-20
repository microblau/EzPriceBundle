<?php
/**
 * File containing the ezpAsynchronousPublisherCliOutput class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Handles asynchronous publishing output to CLI
 * @package kernel
 */
class ezpAsynchronousPublisherCliOutput implements ezpAsynchronousPublisherOutput
{
    public function __construct()
    {
        $this->cli = eZCLI::instance();
    }

    public function write( $message )
    {
        $this->cli->output( $message );
    }

    private $cli;
}
?>
