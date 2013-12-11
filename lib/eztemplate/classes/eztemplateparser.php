<?php
/**
 * File containing the eZTemplateParser class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZTemplateParser eztemplateparser.php
  \brief The class eZTemplateParser does

*/

class eZTemplateParser
{
    /*!
     Constructor
    */
    function eZTemplateParser()
    {
    }

    /*!
     Parses the template file $txt. The actual parsing implementation is done by inheriting classes.
    */
    function parse( $tpl, $sourceText, &$rootElement, $rootNamespace, &$relation )
    {
    }

}

?>
