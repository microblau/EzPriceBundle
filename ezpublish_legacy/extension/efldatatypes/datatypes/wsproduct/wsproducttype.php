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
            array( 'serialize_supported' => false,
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
            $data = $originalContentObjectAttribute->attribute( "data_text" );
            $contentObjectAttribute->setAttribute( "data_text", $data );
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
            $contentObjectAttribute->setAttribute( 'data_text', $data_int . '|'  . $data );
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
     * los valores los obtiene de un explode del data_text
     *
     * @param $contentObjectAttribute
     * @return array
     */
    function objectAttributeContent( $contentObjectAttribute )
    {
        $data = explode( '|', $contentObjectAttribute->attribute( 'data_text' ) );
        return array(
            'name' => $data[1],
            'id' => $$data[0]
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
        $data = explode( '|', $contentObjectAttribute->attribute( 'data_text' ) );
        return $data[1];
    }

    /**
     * Devuelve el nombre y el id separados por '|'
     *
     * @param $contentObjectAttribute
     * @return string
     */
    function toString( $contentObjectAttribute )
    {
        return $contentObjectAttribute->attribute( 'data_text' );
    }

    /**
     * Puede recibir un valor en el formato idenws|nombre
     *
     * @param $contentObjectAttribute
     * @param $string
     *
     * @return bool
     */
    function fromString( $contentObjectAttribute, $string )
    {
        $contentObjectAttribute->setAttribute( 'data_text', $string );
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
        $data = explode( '|', $contentObjectAttribute->attribute( 'data_text' ) );
        return $data[1];
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

    function diff( $old, $new, $options = false )
    {
        $diff = new eZDiff();
        $diff->setDiffEngineType( $diff->engineType( 'text' ) );
        $diff->initDiffEngine();
        $oldData = explode('|', $old->content() );
        $newData = explode('|', $old->content() );
        $diffObject = $diff->diff( $oldData[1], $newData[1] );
        return $diffObject;
    }
}

eZDataType::register( wsProductType::DATA_TYPE_STRING, 'wsProductType' );