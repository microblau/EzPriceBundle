<?php
/**
 * File containing the eZTemplateTextElement class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZTemplateTextElement eztemplatetextelement.php
  \ingroup eZTemplateElements
  \brief Represents a text element in the template tree.

 This class containst the text of a text element.
*/

class eZTemplateTextElement
{
    /*!
     Initializes the object with the text.
    */
    function eZTemplateTextElement( $text )
    {
        $this->Text = $text;
    }

    /*!
     Returns #text.
    */
    function name()
    {
        return "#text";
    }

    function serializeData()
    {
        return array( 'class_name' => 'eZTemplateTextElement',
                      'parameters' => array( 'text' ),
                      'variables' => array( 'text' => 'Text' ) );
    }

    /*!
     Appends the element text to $text.
    */
    function process( $tpl, &$text )
    {
        $text .= $this->Text;
    }

    /*!
     Returns a reference to the element text.
    */
    function &text()
    {
        return $this->Text;
    }

    /// The element text
    public $Text;
}

?>
