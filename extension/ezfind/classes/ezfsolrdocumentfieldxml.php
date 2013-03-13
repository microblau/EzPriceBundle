<?php
//
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Find
// SOFTWARE RELEASE: 2.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//  This source file is part of the eZ Publish CMS and is
//  licensed under the terms and conditions of the eZ Business Use
//  License v2.1 (eZ BUL).
//
//  A copy of the eZ BUL was included with the software. If the
//  license is missing, request a copy of the license via email
//  at license@ez.no or via postal mail at
// 	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
//
//  IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//  SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//  READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file ezfsolrdocumentfieldxml.php
*/

/*!
  \class ezfSolrDocumentFieldXML ezfsolrdocumentfieldobjectrelation.php
  \brief The class ezfSolrDocumentFieldObjectRelation does

*/

class ezfSolrDocumentFieldXML extends ezfSolrDocumentFieldBase
{
    /**
     *
     * @param text $text
     * @return text
     *
     * instead of walking thorugh the dom tree, strip all xml/html like
     * this is more brute force, but helps in the case of html literal blocks
     * which are returned verbatim by ezxml attribute meta data function
     */
    public function strip_html_tags( $text )
    {
        $text = preg_replace(
            array(
            // Replace ezmatrix specific cell and column tags by a space
            '@<c[^>]*?>(.*?)</c>@siu',
            '@<column[^>]*?>(.*?)</column>@siu',
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
            // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
            '@</?(br)@iu'
            ),
            array(
            ' $0 ', ' $0 ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0", "\n"
            ),
            $text );
        return strip_tags( $text );
    }


    /**
     * @see ezfSolrDocumentFieldBase::getData()
     */
    public function getData()
    {
        $contentClassAttribute = $this->ContentObjectAttribute->attribute( 'contentclass_attribute' );
        $fieldName = self::getFieldName( $contentClassAttribute );

        switch ( $contentClassAttribute->attribute( 'data_type_string' ) )
        {
            case 'ezxmltext' :
            {
            // $xmlData = $this->ContentObjectAttribute->attribute( 'content' )->attribute( 'xml_data' );
            $xmlData = $this->ContentObjectAttribute->attribute( 'content' )->attribute( 'output' )->attribute( 'output_text' );
            } break;

            case 'ezmatrix' :
            {
                $xmlData = $this->ContentObjectAttribute->attribute( 'content' )->xmlString();
            } break;

            case 'eztext' :
            {
                $xmlData = $this->ContentObjectAttribute->attribute( 'data_text' );
            } break;

            default:
            {
                    return array( $fieldName => '' );
            } break;
        }
        $cleanedXML = $this->strip_html_tags( $xmlData );
        return array( $fieldName => $cleanedXML );
    }
}

?>
