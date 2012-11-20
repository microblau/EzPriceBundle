<?php
/**
 * File containing the ezpDatabaseBasedClusterFileHandler interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 * @subpackage clustering
 */

/**
 * This interface describes a database based cluster file handler
 *
 * @package kernel
 *
 * @subpackage clustering
 */
interface ezpDatabaseBasedClusterFileHandler
{
    /**
     * Disconnects the cluster file handler from the database it is connected to
     * @since 4.6
     */
    public function disconnect();
}
?>
