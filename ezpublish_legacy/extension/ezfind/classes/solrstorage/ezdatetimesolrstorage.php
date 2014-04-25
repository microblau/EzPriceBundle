<?php

/**
 * File containing the ezdatetimeSolrStorage class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 2.7.0
 * @package ezfind
 */

class ezdatetimeSolrStorage extends ezdatatypeSolrStorage
{
    /**
     * @param eZContentObjectAttribute $contentObjectAttribute the attribute to serialize
     * @param eZContentClassAttribute $contentClassAttribute the content class of the attribute to serialize
     * @return array
     */
    public static function getAttributeContent( eZContentObjectAttribute $contentObjectAttribute, eZContentClassAttribute $contentClassAttribute )
    {
        $dateTime = new DateTime( '@' . $contentObjectAttribute->attribute( 'data_int' ) );
        return array(
            'content' => $dateTime->format( 'c' ),
            'has_rendered_content' => false,
            'rendered' => null,
        );
    }
}

?>
