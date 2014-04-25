<?php
/**
 * File containing the eZClusterFileFailure class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
 \class eZClusterFileHandler ezclusterfilefailure.php
 Special failure object which can be used by some of the cluster functions
 to inform about failures or special exceptions.

 Currently used by the *processCache* function to report that the retrieve callback
 failed to retrieve data because of expiration.
 */
class eZClusterFileFailure
{
    // Error codes:
    // 1 - file expired
    // 2 - file contents must be manually generated
    function eZClusterFileFailure( $errno, $message = false )
    {
        $this->Errno = $errno;
        $this->Message = $message;
    }

    /*!
     Returns the error number.
     */
    function errno()
    {
        return $this->Errno;
    }

    /*!
     Returns the error message if there is one.
     */
    function message()
    {
        return $this->Message;
    }
}
?>
