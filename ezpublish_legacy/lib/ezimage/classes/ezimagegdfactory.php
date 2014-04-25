<?php
/**
 * File containing the eZImageGDFactory class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

class eZImageGDFactory extends eZImageFactory
{
    /*!
     Initializes the factory with the name \c 'shell'
    */
    function eZImageGDFactory()
    {
        $this->eZImageFactory( 'gd' );
    }

    /*!
     Creates eZImageGDHandler objects and returns them.
    */
    static function produceFromINI( $iniGroup, $iniFilename = false )
    {
        $convertHandler = eZImageGDHandler::createFromINI( $iniGroup, $iniFilename );
        return $convertHandler;
    }
}

?>
