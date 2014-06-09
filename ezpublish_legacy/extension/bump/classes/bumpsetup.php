<?php
class bumpSetup
{
    protected $classes = array(
        'formato_ipad' => array(
            'nombre' => 'Formato IPAD',
            'vat_id' => 4
        ),
        'formato_papel' =>  array(
            'nombre' => 'Formato Papel',
            'vat_id' => 1
        ),
        'formato_internet' => array(
            'nombre' => 'Formato Internet',
            'vat_id' => 4
        ),
    );

    function __construct( $cli, $script )
    {
        $ini = eZINI::instance();
        $userCreatorID = 3370;
        $this->User = eZUser::fetch( $userCreatorID );
        eZUser::setCurrentlyLoggedInUser( $this->User, $userCreatorID );

        $language = eZContentLanguage::topPriorityLanguage();
        if ( $language )
        {
            $EditLanguage = $language->attribute( 'locale' );
        }

        $this->Language = $EditLanguage;
        $this->CLI = $cli;
        $this->Script = $script;
    }

    /**
     * Busca si ya tenemos el grupo 'Formatos de producto' creado. Si no, lo crea. En
     * ambos casos, devuelve el id del grupo.
     *
     * @return identificador del grupo de clases Formatos de Producto
     */
    function checkGroupClass()
    {
        $existsGroup = eZContentClassGroup::fetchByName( 'Formatos de Producto' );
        if( !$existsGroup )
        {
            $classgroup = eZContentClassGroup::create( $this->User->attribute('id') );
            $classgroup->setAttribute( "name", 'Formatos de Producto' );
            $classgroup->store();
            $GroupID = $classgroup->attribute( "id" );
            return $GroupID;
        }
        return $existsGroup->ID;
    }

    /**
     * Detecta si ya tenemos una clase llamada prensa_escrita. En caso contrario la crea.
     * En ambos casos devuelve el id de la clase creada.
     *
     * @param $idGroup Object, id del grupo donde queremos guardarlo (Formatos de producto)
     * @return void
     */
    function createClasses( $idGroup )
    {

        foreach ( array_keys( $this->classes ) as $class_identifier )
        {
            $this->CLI->output( 'Procesando ' . $class_identifier );
            $checkClass = eZContentClass::fetchByIdentifier( $class_identifier );
            if( !$checkClass )
            {
                $class = eZContentClass::create( $this->User->attribute('id'), array(), $this->Language );
                $class->setName( ezpI18n::tr( 'kernel/class/edit', 'New Class' ), $this->Language );
                $class->setAttribute( "is_container", 0 );
                $class->setAttribute( "always_available", 1 );
                $class->setName( $this->classes[$class_identifier]['nombre'], $this->Language );
                $class->setAttribute( 'version', 0 );
                $class->setAttribute( 'identifier', $class_identifier );
                $class->setAttribute( 'modified', time() );
                $class->setAttribute( 'contentobject_name', '<producto>' );
                $class->store();
                $editLanguageID = eZContentLanguage::idByLocale( $this->Language );
                $class->setAlwaysAvailableLanguageID( $editLanguageID );
                $ClassID = $class->attribute( 'id' );
                $ClassVersion = $class->attribute( 'version' );
                $this->addAttributesForClass( $class, $this->classes[$class_identifier]['vat_id'] );
                $ingroup = eZContentClassClassGroup::create( $ClassID, $ClassVersion, $idGroup, 'Formatos de Producto' );
                $ingroup->store();
            }
        }
    }

    /**
     * Añade los atributos a la clases. Recibirá el tipo de ipa por defecto
     * para asignárselo al segundo atributo.
     *
     * @param eZContentClass $class la clase con la que trabajamos
     * @param int $vat_id el tipo de iva a aplicar
     *
     * @return true
     */
    function addAttributesForClass( $class, $vat_id )
    {
        $attributes = $class->fetchAttributes();

        $wsproduct = eZContentClassAttribute::create( $class->ID, "wsproduct", array(), $this->Language );
        $attrcnt = count( $attributes ) + 1;
        $wsproduct->setName( "Producto de Webservice",  $this->Language );
        $dataType = $wsproduct->dataType();
        $dataType->initializeClassAttribute( $wsproduct );
        $wsproduct->setAttribute( "version", 0 );
        $wsproduct->setAttribute( "identifier", "producto" );
        $wsproduct->setAttribute( "is_required", true );
        $wsproduct->setAttribute( "placement", $attrcnt );
        $wsproduct->store();

        $customezprice = eZContentClassAttribute::create( $class->ID, "customezprice", array(), $this->Language );
        $attrcnt = count( $attributes ) + 1;
        $customezprice->setName( 'Precio', $this->Language );
        $dataType = $customezprice->dataType();
        $dataType->initializeClassAttribute( $customezprice );
        $customezprice->setAttribute( 'version', 0 );
        $customezprice->setAttribute( 'identifier', 'precio' );
        $customezprice->setAttribute( 'is_required', true );
        $customezprice->setAttribute( 'placement', $attrcnt );
        $customezprice->setAttribute( 'data_int1', 2 );
        $customezprice->setAttribute( 'data_float1', $vat_id );
        $customezprice->store();

    }

    /**
     * Script execution
     */
    function run()
    {
        $idGroup = $this->checkGroupClass();
        $this->createClasses( $idGroup );
    }

    var $User;
    var $CLI;
    var $Language;
    var $Script;
    var $INI;
}