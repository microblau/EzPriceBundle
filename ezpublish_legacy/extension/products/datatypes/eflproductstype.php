<?php

class eflProductsType extends eZDataType
{
    /**
     * Constructor
     *
     */
    function __construct()
    {
        parent::__construct( self::DATA_TYPE_STRING, "Formatos de producto" );
    }

    /**
     * Returns the value as it will be shown if this attribute is used in the object name pattern.
     *
     * @param eZContentObjectAttribute $contentObjectAttribute
     * @param string $name
     * @return string
     */
    function title( $contentObjectAttribute, $name = null  )
    {
        return '';
    }

    function toString( $contentObjectAttribute )
    {
        $objectAttributeContent = $contentObjectAttribute->attribute( 'content' );
        $objectIDList = array();
        foreach( $objectAttributeContent['relation_browse'] as $objectInfo )
        {
            $objectIDList[] = $objectInfo['contentobject_id'];
        }
        return implode( '-', $objectIDList );
    }

    function fromString( $contentObjectAttribute, $string )
    {
        $objectIDList = explode( '-', $string );

        $content = eZObjectRelationBrowseType::defaultObjectAttributeContent();
        $priority = 0;
        foreach( $objectIDList as $objectID )
        {
            $object = eZContentObject::fetch( $objectID );
            if ( $object )
            {
                ++$priority;
                $content['relation_browse'][] = $this->appendObject( $objectID, $priority, $contentObjectAttribute );
            }
            else
            {
                eZDebug::writeWarning( $objectID, "Can not create relation because object is missing" );
            }
        }
        $contentObjectAttribute->setContent( $content );
        return true;
    }

}

eZDataType::register( eflProductsType::DATA_TYPE_STRING, "eflproductstype" );