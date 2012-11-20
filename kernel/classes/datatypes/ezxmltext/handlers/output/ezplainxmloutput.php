<?php
/**
 * File containing the eZPlainXMLOutput class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class eZPlainXMLOutput extends eZXMLOutputHandler
{
    function eZPlainXMLOutput( &$xmlData, $aliasedType )
    {
        $this->eZXMLOutputHandler( $xmlData, $aliasedType );
    }

    function &outputText()
    {
        $retText = "<pre>" . htmlspecialchars( $this->xmlData() ) . "</pre>";
        return $retText;
    }
}

?>
