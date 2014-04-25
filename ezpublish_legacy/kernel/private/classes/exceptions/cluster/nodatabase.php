<?php
/**
 * File containing the eZClusterHandlerDBNoDatabaseException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Class representing a no database exception
 *
 * @version 4.7.0
 * @package kernel
 */

class eZClusterHandlerDBNoDatabaseException extends eZDBException
{
    /**
     * Constructs a new eZClusterHandlerDBNoDatabaseException
     *
     * @param string $dbname The database
     * @return void
     */
    function __construct( $dbname )
    {
        parent::__construct( "Unable to select the cluster database {$dbname}" );
    }
}
?>
