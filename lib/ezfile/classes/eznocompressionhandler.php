<?php
/**
 * File containing the eZNoCompressionHandler class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZNoCompressionHandler eznocompressionhandler.php
  \brief Does no compression at all

*/

class eZNoCompressionHandler extends eZCompressionHandler
{
    /*!
     See eZCompressionHandler::eZCompressionHandler
    */
    function eZNoCompressionHandler()
    {
        $this->eZCompressionHandler( 'No compression', 'no' );
    }
}

?>
