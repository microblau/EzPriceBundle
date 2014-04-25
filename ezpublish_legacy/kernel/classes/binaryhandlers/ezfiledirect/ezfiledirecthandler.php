<?php
/**
 * File containing the eZFileDirectHandler class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZFileDirectHandler ezfiledirecthandler.php
  \ingroup eZBinaryHandlers
  \brief Handles file downloading by passing an URL directly to the file.

*/
class eZFileDirectHandler extends eZBinaryFileHandler
{
    const HANDLER_ID = 'ezfiledirect';

    function eZFileDirectHandler()
    {
        $this->eZBinaryFileHandler( self::HANDLER_ID, "direct download", eZBinaryFileHandler::HANDLE_DOWNLOAD );
    }

    function handleFileDownload( $contentObject, $contentObjectAttribute, $type, $fileInfo )
    {
        return eZBinaryFileHandler::RESULT_OK;
    }

    /*!
     \return the direct download template suffix
    */
    function viewTemplate( $contentobjectAttribute )
    {
        $retValue = 'direct';
        return $retValue;
    }

}

?>
