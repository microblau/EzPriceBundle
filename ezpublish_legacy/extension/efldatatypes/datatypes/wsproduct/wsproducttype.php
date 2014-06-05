<?php

class wsProductType extends eZDataType
{
    const DATA_TYPE_STRING = 'wsproduct';

    /**
     * Initializes the datatype
     */
    function __construct()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr( 'kernel/classes/datatypes', 'Producto de Webservice', 'Datatype name' ),
            array( 'serialize_supported' => true,
                'object_serialize_map' => array( 'data_text' => 'text' ) ) );
    }

    /**
     * Sets the default value.
     *
     * En el datatext tendremos en el nombre del producto según esté escrito en el ws
     *
     * En el dataint, el identificador de ese producto en el ws
     */
    function initializeObjectAttribute( $contentObjectAttribute, $currentVersion, $originalContentObjectAttribute )
    {
        if ( $currentVersion != false )
        {
            $dataText = $originalContentObjectAttribute->attribute( "data_text" );
            $dataInt = $originalContentObjectAttribute->attribute( "data_int" );
            $contentObjectAttribute->setAttribute( "data_text", $dataText );
            $contentObjectAttribute->setAttribute( "data_int", $dataInt );
        }
    }

    /**
     * Validates $data with the constraints defined on the class attribute
     *
     * @param $data
     * @param eZContentObjectAttribute $contentObjectAttribute
     * @param eZContentClassAttribute $classAttribute
     *
     * @return int
     * @todo perform real validation
     */
    function validateStringHTTPInput( $data, $contentObjectAttribute, $classAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /**
     * @todo perform validation
     */
    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /**
     * Seguramente no la necesitemos. devolvemos aceptado por defecto
     * En caso de necesitar hay que programar aquí l validacióntra webservice
     *
     * @param $http
     * @param $base
     * @param $contentObjectAttribute
     * @return int
     */
    function validateCollectionAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /**
     * Recoge los valores del formulario y los isnerta en el atributo
     *
     * @param $http
     * @param $base
     * @param $contentObjectAttribute
     * @return bool|void
     */
    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        if ( $http->hasPostVariable( $base . '_ezstring_data_text_' . $contentObjectAttribute->attribute( 'id' ) ) )
        {
            $data = $http->postVariable( $base . '_ezstring_data_text_' . $contentObjectAttribute->attribute( 'id' ) );
            $data_int = $http->postVariable( $base . '_ezstring_data_int_' . $contentObjectAttribute->attribute( 'id' ) );
            $contentObjectAttribute->setAttribute( 'data_int', $data_int );
            return true;
        }
        return false;
    }

    /**
     * Como no la necesitamos decimos que true por defecto
     *
     * @param $collection
     * @param $collectionAttribute
     * @param $http
     * @param $base
     * @param $contentObjectAttribute
     * @return bool|void
     */
    function fetchCollectionAttributeHTTPInput( $collection, $collectionAttribute, $http, $base, $contentObjectAttribute )
    {
        return true;
    }

    /**
     * Does nothing since it uses the data_text and data_int field in the content object attribute.
     * See fetchObjectAttributeHTTPInput for the actual storing.
     *
     * @param eZContentObjectAttribute $attribute
     */
    function storeObjectAttribute( $attribute )
    {
    }

    /**
     * Simple insertion is not supported
     *
     * @return bool
     */
    function isSimpleStringInsertionSupported()
    {
        return false;
    }

    function storeClassAttribute( $attribute, $version )
    {
    }

    function storeDefinedClassAttribute( $attribute )
    {
    }

    /**
     * @param $http
     * @param $base
     * @param $classAttribute
     * @return int
     */
    function validateClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        return true;
    }

    /**
     * Devuelve el contenido. Un array con el nombre y el id
     *
     * @param $contentObjectAttribute
     * @return array
     */
    function objectAttributeContent( $contentObjectAttribute )
    {
        return array(
            'name' => $contentObjectAttribute->attribute( 'data_text' ),
            'id' => $contentObjectAttribute->attribute( 'data_int' )
        );
    }

    /**
     * Metadata for indexes
     *
     * @param $contentObjectAttribute
     * @return string
     */
    function metaData( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }

    /**
     * Devuelve el nombre y el id separados por '|'
     *
     * @param $contentObjectAttribute
     * @return string
     */
    function toString( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' ) . '|' . $contentObjectAttribute->attribute( 'data_int' );
    }

    /**
     * Puede recibir un valor en el formato nombreenws|idenws
     *
     * @param $contentObjectAttribute
     * @param $string
     *
     * @return bool
     */
    function fromString( $contentObjectAttribute, $string )
    {
        $data = explode('|', $string );
        $contentObjectAttribute->setAttribute( 'data_text', $data[0] );
        $contentObjectAttribute->setAttribute( 'data_int', $data[1] );
        return true;
    }

    /**
     * Devuelve el nombre del producto
     *
     * @param $contentObjectAttribute
     * @param null $name
     * @return string
     */
    function title( $contentObjectAttribute, $name = null )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }

    /**
     * Determina si el atributo tiene contenido o no
     *
     * @param $contentObjectAttribute
     * @return bool
     */
    function hasObjectAttributeContent( $contentObjectAttribute )
    {
        return trim( $contentObjectAttribute->attribute( 'data_text' ) ) != '';
    }

    function isIndexable()
    {
        return true;
    }

    function isInformationCollector()
    {
        return false;
    }

    function sortKey( $contentObjectAttribute )
    {
        $trans = eZCharTransform::instance();
        return $trans->transformByGroup( $contentObjectAttribute->attribute( 'data_text' ), 'lowercase' );
    }

    function sortKeyType()
    {
        return 'string';
    }

    function serializeContentClassAttribute( $classAttribute, $attributeNode, $attributeParametersNode )
    {
        $maxLength = $classAttribute->attribute( self::MAX_LEN_FIELD );
        $defaultString = $classAttribute->attribute( self::DEFAULT_STRING_FIELD );
        $dom = $attributeParametersNode->ownerDocument;
        $maxLengthNode = $dom->createElement( 'max-length' );
        $maxLengthNode->appendChild( $dom->createTextNode( $maxLength ) );
        $attributeParametersNode->appendChild( $maxLengthNode );
        $defaultStringNode = $dom->createElement( 'default-string' );
        if ( $defaultString )
        {
            $defaultStringNode->appendChild( $dom->createTextNode( $defaultString ) );
        }
        $attributeParametersNode->appendChild( $defaultStringNode );
    }

    function unserializeContentClassAttribute( $classAttribute, $attributeNode, $attributeParametersNode )
    {
        $maxLength = $attributeParametersNode->getElementsByTagName( 'max-length' )->item( 0 )->textContent;
        $defaultString = $attributeParametersNode->getElementsByTagName( 'default-string' )->item( 0 )->textContent;
        $classAttribute->setAttribute( self::MAX_LEN_FIELD, $maxLength );
        $classAttribute->setAttribute( self::DEFAULT_STRING_FIELD, $defaultString );
    }

    function diff( $old, $new, $options = false )
    {
        $diff = new eZDiff();
        $diff->setDiffEngineType( $diff->engineType( 'text' ) );
        $diff->initDiffEngine();
        $oldData = $old->content();
        $newData = $new->content();
        $diffObject = $diff->diff( $oldData['name'], $newData['name'] );
        return $diffObject;
    }
}

eZDataType::register( wsProductType::DATA_TYPE_STRING, 'wsProductType' );