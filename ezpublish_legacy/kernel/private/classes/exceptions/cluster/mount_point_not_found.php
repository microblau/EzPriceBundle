<?php
/**
 * File containing the eZDFSFileHandlerNFSMountPointNotFoundException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Class representing a cluster mount point not found exception
 *
 * @version 4.7.0
 * @package kernel
 */

class eZDFSFileHandlerNFSMountPointNotFoundException extends ezcBaseException
{
    /**
     * Constructs a new eZDFSFileHandlerNFSMountPointNotFoundException
     *
     * @param string $host The hostname
     * @param string $user The username
     * @param string $pass The password (will be displayed as *)
     * @return void
     */
    function __construct( $path )
    {
        parent::__construct( "Local DFS mount point '{$path}' does not exist" );
    }
}
?>
