<?php

/**
 * File containing the ezproductcategorySolrStorage class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 2.7.0
 * @package ezfind
 */

class ezproductcategorySolrStorage extends ezdatatypeSolrStorage
{
    /**
     * @param eZContentObjectAttribute $contentObjectAttribute the attribute to serialize
     * @param eZContentClassAttribute $contentClassAttribute the content class of the attribute to serialize
     * @return array
     */
    public static function getAttributeContent( eZContentObjectAttribute $contentObjectAttribute, eZContentClassAttribute $contentClassAttribute )
    {
        $category =  $contentObjectAttribute->attribute( 'content' );

        return array(
            'content' => array(
                'name' => $category ? $category->attribute( 'name' ) : null,
                'id' => $category ? $category->attribute( 'id' ) : null,
            ),
            'has_rendered_content' => false,
            'rendered' => null,
        );
    }
}

?>
