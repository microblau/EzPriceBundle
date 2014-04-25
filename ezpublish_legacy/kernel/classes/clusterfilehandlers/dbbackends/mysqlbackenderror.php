<?php
/**
 * File containing the eZDMySQLBackendError class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
 \class eZMySQLBackendError mysqlbackenderror.php
 \brief Error class for the MySQL backend (cluster code).
 */

class eZMySQLBackendError
{
    function eZMySQLBackendError( $value, $text )
    {
        $this->errorValue = $value;
        $this->errorText  = $text;
    }
}

?>
