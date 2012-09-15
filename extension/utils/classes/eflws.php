<?php 
/**
 * Clase para llamar a los métodos del WebService
 * 
 * En cada función se genera un xml. Para ello se utiliza DOMDOCUMENT
 * 
 * Las llamadas al webservice se hacen mediante la función simplexml_load_file, también nativa de PHP
 * 
 * Todos las llamadas han de llevar un parametro p_sParam, cuyo valor debe ser un xml
 * 
 * @author carlos.revillo@tantacom.com
 * @version 0.1
 * @package efl
 *
 */
class eflWS
{
	/**
	 * Constructor. Lee la configuración del webservice de un archivo ini.
	 * @return void
	 */
	function __construct()
	{
	   $eflwebservice_ini = eZINI::instance( 'eflwebservice.ini' );
       $this->Host = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Host' );
       $this->Port = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Port' );
       $this->Path = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Path' );
       $this->UrlWS = 'http://' . $this->Host . ":" . $this->Port . $this->Path;
       $this->BadCharacters = array( '\&', '\%' );
       $this->GoodCharacters = array( '%26',  '%23' );
	}
	
	/**
	 * Comprueba la validez del usuario según email y password
	 * 
	 * @param string $login
	 * @param string $password
	 * @return int Si es 1, el usuario será automáticamente logado en el eZ Publish
	 *   
	 */
	function validaUsuario( $login, $password )
	{
		// inicializamos xml
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //login
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $login ) );
       
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $password ) );  
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $doc->appendChild( $root );       
       
       // leemos los settings del webservice
       $ini = eZINI::instance();
       $eflwebservice_ini = eZINI::instance( 'eflwebservice.ini' );
       $host = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Host' );
       $port = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Port' );
       $path = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Path' );
	   $params = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Params' );
	   
	   $respuesta = 0;
	   //construimos url
	   $urltocheck = 'http://' . $host . ":" . $port . $path .  'validaUsuario?p_sParam=' . $doc->saveXML();	 
        //die( $urltocheck );
	   $response =  simplexml_load_file( $urltocheck );

	   if( is_object( $response ) )
	   {
	   		$element = $response->xpath( '//ns:return' );	   
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$respuesta = (int) $result;
	   }   
	   
	   return $respuesta;
	}
	
	/**
	 * Comprueba la validez del usuario según email y password y devuelve el producto sugerido
	 * 
	 * @param inf $id_usuario
	 * @return string cd_prod sugerido
	 *   
	 */
	function validaUsuarioProdSugerido( $id_usuario )
	{
		// inicializamos xml
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //id_usuario
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $id_usuario ) );
       
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );       
       
       // leemos los settings del webservice
       $ini = eZINI::instance();
       $eflwebservice_ini = eZINI::instance( 'eflwebservice.ini' );
       $host = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Host' );
       $port = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Port' );
       $path = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Path' );
	   $params = $eflwebservice_ini->variable( 'EFLWebServiceSettings', 'Params' );
	   
	   $respuesta = 'NFCP';
	   //construimos url
	   $urltocheck = 'http://' . $host . ":" . $port . $path .  'validaUsuarioProdSugerido?p_sParam=' . $doc->saveXML();	 
        //die( $urltocheck );
	   $response =  simplexml_load_file( $urltocheck );

	   if( is_object( $response ) )
	   {
	   		$element = $response->xpath( '//ns:return' );	   
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$respuesta = (string) $result;
	   }   

	   return $respuesta;
	}
	
	/**
	 * LLamada al webservice para creación de un nuevo usuario.
	 * 
	 * @param string $p_email
	 * @param string $p_pass
	 * @param string $p_nombre
	 * @param string $p_apellido1
	 * @param string $p_apellido2
	 * @param string $p_tlf
	 * @param string $p_fax
	 * @param string $p_dir_tipo
	 * @param string $p_dir_nombre
	 * @param string $p_dir_numero
	 * @param string $p_dir_resto
	 * @param string $p_dir_cpostal
	 * @param string $p_dir_localidad
	 * @param string $p_dir_provincia
	 * @param string $p_dir_id_pais
	 * @param string $p_idempresa
	 * @return mixed
	 * 
	 * Devolverá un entero con el id del usuario creado si hay exito. 
	 * En caso contrario devuelve false
	 */
	function nuevoUsuario( $p_email, $p_pass, $p_nombre, $p_apellido1, $p_apellido2, $p_tlf, $p_fax, $p_dir_tipo,
						   $p_dir_nombre, $p_dir_numero, $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, $p_dir_provincia,
						   $p_dir_id_pais, $p_idempresa )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_email ) );
       
       //pass
	   $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_pass ) );
       
       //$p_nombre
	   $param3 = $doc->createElement( 'param' );
       $param3->appendChild( $doc->createCDATASection( $p_nombre ) );
       
       //$p_apellido1
	   $param4 = $doc->createElement( 'param' );
       $param4->appendChild( $doc->createCDATASection( $p_apellido1 ) );
       
       //$p_apellido2
	   $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_apellido2 ) );
       
       //$p_tlf
	   $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_tlf ) );
       
       //$p_fax
	   $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_fax ) );
       
        //$p_dir_tipo
	   $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_tipo ) );
       
       //$p_dir_nombre
	   $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
       //$p_dir_numero
	   $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection( $p_dir_numero ) );
       
       //$p_dir_resto
	   $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection( $p_dir_resto ) );
       
       //$p_dir_cpostal
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection( $p_dir_cpostal ) );
       
       //$p_dir_localidad
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createTextNode( $p_dir_localidad ) );
       
       //$p_dir_provincia
       $param14 = $doc->createElement( 'param' );
       $param14->appendChild( $doc->createTextNode( $p_dir_provincia ) );
       
       //$p_dir_id_pais
       $param15 = $doc->createElement( 'param' );
       $param15->appendChild( $doc->createCDATASection( $p_dir_id_pais ) );
       
       //$p_idempresa
       $param16 = $doc->createElement( 'param' );
       $param16->appendChild( $doc->createCDATASection( $p_idempresa ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $root->appendChild( $param3 );
       $root->appendChild( $param4 );
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $root->appendChild( $param14 );
       $root->appendChild( $param15 );
       $root->appendChild( $param16 );
       $doc->appendChild( $root );       

       $dom = simplexml_load_file( $this->UrlWS . 'nuevoUsuario?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (int) $result; // en este caso, el id del usuario creado
	   		return $respuesta;
	   }
	   else return false;
	}
	
	/**
	 * Crea un nuevo usuario y le indica al WS en qué paso lo está haciendo
	 * 
	 * @param string $p_email
	 * @param string $p_pass
	 * @param string $p_nombre
	 * @param string $p_apellido1
	 * @param string $p_apellido2
	 * @param int $p_confianza_pago
	 * @param int $p_tipo_usuario 1 si particular, 2 si empresa
	 * @param int $p_estado
	 * @param int $p_origen
	 * @return mixed id del usuario en caso de éxito; falso en caso contrario
	 */
	function nuevoUsuarioPaso1( $p_email, $p_pass, $p_nombre, $p_apellido1, $p_apellido2, $p_confianza_pago, $p_tipo_usuario, $p_estado, $p_origen )	
	{
		$doc = new DOMDocument( '1.0', 'utf-8' );
	    $root = $doc->createElement( 'swEFLU_parametros' );
	    
	    //email
	    $param1 = $doc->createElement( 'param' );
        $param1->appendChild( $doc->createCDATASection( $p_email ) );
       
        //pass
	    $param2 = $doc->createElement( 'param' );
        $param2->appendChild( $doc->createCDATASection( $p_pass ) );
       
        //$p_nombre
  	    $param3 = $doc->createElement( 'param' );
        $param3->appendChild( $doc->createCDATASection( $p_nombre ) );
       
        //$p_apellido1
	    $param4 = $doc->createElement( 'param' );
        $param4->appendChild( $doc->createCDATASection( $p_apellido1 ) );
       
        //$p_apellido2
	    $param5 = $doc->createElement( 'param' );
        $param5->appendChild( $doc->createCDATASection( $p_apellido2 ) );
        
        // $p_confianza_pago
        // debe ser 0 siempre
	    $param6 = $doc->createElement( 'param' );
        $param6->appendChild( $doc->createCDATASection( $p_confianza_pago ) );
        
        // $p_estado
        // paso en el registro
	    $param7 = $doc->createElement( 'param' );
        $param7->appendChild( $doc->createCDATASection( $p_estado ) );
        
        // $p_origen
        // debe ser uno cuando el usuario se crea desde la tienda
	    $param8 = $doc->createElement( 'param' );
        $param8->appendChild( $doc->createCDATASection( $p_origen ) );
        
        // $_p_tipo_usuario
        $param10 = $doc->createElement( 'param' );
        $param10->appendChild( $doc->createCDATASection( $p_tipo_usuario ) );
        
        
        $root->appendChild( $param1 );
        $root->appendChild( $param2 );
        $root->appendChild( $param3 );
        $root->appendChild( $param4 );
        $root->appendChild( $param5 );
        $root->appendChild( $param6 );
        $root->appendChild( $param10 );
        $root->appendChild( $param7 );
        $root->appendChild( $param8 );
        $doc->appendChild( $root );        
        //die( $this->UrlWS . 'nuevoUsuarioPaso1?p_sParam=' . $doc->saveXML()  );
        $dom = simplexml_load_file( $this->UrlWS . 'nuevoUsuarioPaso1?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
		
        if( is_object( $dom ) )
	    {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}

	   		$respuesta = (int) $result; // en este caso, el id del usuario creado
	   		return $respuesta;
	    }
	    else return false;        
	}
	
	
	/**
	 * Crea un nuevo usuario de tipo COLECTIVO (estado=9).
	 * 
	 * @param string $p_email
	 * @param string $p_pass
	 * @param string $p_nombre
	 * @param string $p_apellido1
	 * @param string $p_apellido2
	 * @param int $p_confianza_pago
	 * @param int $p_tipo_usuario 1 si particular, 2 si empresa
	 * @param int $p_estado (será siempre 9)
	 * @param int $p_origen
	 * @param string $p_colectivo
	 * @param string $p_no_colegiado
	 * @return mixed id del usuario en caso de éxito; falso en caso contrario
	 */
	function nuevoUsuarioColectivo( $p_email, $p_pass, $p_nombre, $p_apellido1, $p_apellido2, $p_confianza_pago, $p_tipo_usuario, $p_estado, $p_origen, $p_colectivo, $p_no_colegiado )	
	{
		$doc = new DOMDocument( '1.0', 'utf-8' );
	    $root = $doc->createElement( 'swEFLU_parametros' );
	    
	    //email
	    $param1 = $doc->createElement( 'param' );
        $param1->appendChild( $doc->createCDATASection( $p_email ) );
       
        //pass
	    $param2 = $doc->createElement( 'param' );
        $param2->appendChild( $doc->createCDATASection( $p_pass ) );
       
        //$p_nombre
  	    $param3 = $doc->createElement( 'param' );
        $param3->appendChild( $doc->createCDATASection( $p_nombre ) );
       
        //$p_apellido1
	    $param4 = $doc->createElement( 'param' );
        $param4->appendChild( $doc->createCDATASection( $p_apellido1 ) );
       
        //$p_apellido2
	    $param5 = $doc->createElement( 'param' );
        $param5->appendChild( $doc->createCDATASection( $p_apellido2 ) );
        
        // $p_confianza_pago
        // debe ser 0 siempre
	    $param6 = $doc->createElement( 'param' );
        $param6->appendChild( $doc->createCDATASection( $p_confianza_pago ) );
        
        // $p_estado
        // paso en el registro
	    $param7 = $doc->createElement( 'param' );
        $param7->appendChild( $doc->createCDATASection( $p_estado ) );
        
        // $p_origen
        // debe ser uno cuando el usuario se crea desde la tienda
	    $param8 = $doc->createElement( 'param' );
        $param8->appendChild( $doc->createCDATASection( $p_origen ) );
        
        // $p_tipo_usuario
        $param10 = $doc->createElement( 'param' );
        $param10->appendChild( $doc->createCDATASection( $p_tipo_usuario ) );
		
		// $p_colectivo
        $param9 = $doc->createElement( 'param' );
        $param9->appendChild( $doc->createCDATASection( $p_colectivo ) );
        
		// $p_no_colegiado
        $param11 = $doc->createElement( 'param' );
        $param11->appendChild( $doc->createCDATASection( $p_no_colegiado ) );
        
        $root->appendChild( $param1 );
        $root->appendChild( $param2 );
        $root->appendChild( $param3 );
        $root->appendChild( $param4 );
        $root->appendChild( $param5 );
        $root->appendChild( $param6 );
        $root->appendChild( $param10 );
        $root->appendChild( $param7 );
        $root->appendChild( $param8 );
		$root->appendChild( $param9 );
		$root->appendChild( $param11 );
        $doc->appendChild( $root );        
        
        $dom = simplexml_load_file( $this->UrlWS . 'nuevoUsuarioColectivo?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
		
        if( is_object( $dom ) )
	    {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}

	   		$respuesta = (int) $result; // en este caso, el id del usuario creado
	   		return $respuesta;
	    }
	    else return false;        
	}
	
	
	/**
	 * Llamada al WS para actualización de datos de usaurio
	 * @param int $p_idusuario
	 * @param string $p_nombre
	 * @param string $p_apellido1
	 * @param string $p_apellido2
	 * @param string $p_tlf
	 * @param string $p_fax
	 * @param string $p_dir_tipo
	 * @param string $p_dir_nombre
	 * @param string $p_dir_numero
	 * @param string $p_dir_resto
	 * @param string $p_dir_cpostal
	 * @param string $p_dir_localidad
	 * @param string $p_dir_provincia
	 * @param string $p_dir_id_pais
	 * @return mixed 
	 */
	function setUsuarioDatos( $p_idusuario, $p_nombre, $p_apellido1, $p_apellido2, $p_tlf, $p_fax, $p_dir_tipo,
						   $p_dir_nombre, $p_dir_numero, $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, $p_dir_provincia,
						   $p_dir_id_pais )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //idusuario
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_idusuario ) );       
       
       //$p_nombre
	   $param3 = $doc->createElement( 'param' );
       $param3->appendChild( $doc->createCDATASection( $p_nombre ) );
       
       //$p_apellido1
	   $param4 = $doc->createElement( 'param' );
       $param4->appendChild( $doc->createCDATASection( $p_apellido1 ) );
       
       //$p_apellido2
	   $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_apellido2 ) );
       
       //$p_tlf
	   $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_tlf ) );
       
       //$p_fax
	   $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_fax ) );
       
        //$p_dir_tipo
	   $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_tipo ) );
       
       //$p_dir_nombre
	   $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
       //$p_dir_numero
	   $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection( $p_dir_numero ) );
       
       //$p_dir_resto
	   $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection( $p_dir_resto ) );
       
       //$p_dir_cpostal
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection( $p_dir_cpostal ) );
       
       //$p_dir_localidad
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createCDATASection( $p_dir_localidad ) );
       
       //$p_dir_provincia
       $param14 = $doc->createElement( 'param' );
       $param14->appendChild( $doc->createCDATASection( $p_dir_provincia ) );
       
       //$p_dir_id_pais
       $param15 = $doc->createElement( 'param' );
       $param15->appendChild( $doc->createCDATASection( $p_dir_id_pais ) );      
      
       
       $root->appendChild( $param1 );       
       $root->appendChild( $param3 );
       $root->appendChild( $param4 );
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $root->appendChild( $param14 );
       $root->appendChild( $param15 );      
       $doc->appendChild( $root );       
       die( $this->UrlWS . 'setUsuarioDatos?p_sParam=' . str_replace( $this->BadCharacters, $this->GoodCharacters, $doc->saveXML() )  );
       $dom = simplexml_load_file( $this->UrlWS . 'setUsuarioDatos?p_sParam=' . str_replace( $this->BadCharacters, $this->GoodCharacters, $doc->saveXML() ) );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (int) $result; // en este caso, si es válido o no
	   		return $respuesta;
	   }
	   else return false;
	}
	
	/**
	 * Actualiza los datos del usuario en el segundo paso registro. 
	 * Cuando el usuario se registra como particular los datos de empresa serán los mismos
	 * 
	 * @param int $p_idusuario	 
	 * @param string $p_tlf
	 * @param string $p_tlf_movil
	 * @param string $p_fax
	 * @param string $p_dir_tipo
	 * @param string $p_dir_nombre
	 * @param string $p_dir_numero
	 * @param string $p_dir_resto
	 * @param string $p_dir_cpostal
	 * @param string $p_dir_localidad
	 * @param string $p_dir_provincia
	 * @param string $p_dir_id_pais
	 * @param int $p_estado
	 * @param string $p_esa_cif
	 * @param string $p_esa_nombre
	 * @param string $p_esa_razon_social
	 * @param string $p_esa_dir_tipo
	 * @param string $p_esa_dir_nombre
	 * @param string $p_esa_dir_numero
	 * @param string $p_esa_dir_resto
	 * @param string $p_esa_dir_cpostal
	 * @param string $p_esa_dir_localidad
	 * @param string $p_esa_dir_provincia
	 * @param string $p_esa_dir_id_pais
	 * @param int $p_estado
	 * @param string $p_esa_cif
	 * @param string $p_esa_tlf
	 * @param string $p_esa_tlfmovil
	 * @param string $p_esa_fax
	 * @param string $p_esa_dirnombre
	 * @param string $p_esa_dirnumero
	 * @param string $p_esa_dir_resto
	 * @param string $p_esa_dir_localidad
	 * @param string $p_esa_dir_provincia
	 * @param string $p_esa_dir_id_pais
	 * @return mixed 1 en caso de éxito. falso en caso contrario.
	 */
	
	function setUsuarioDatosPaso2( $p_idusuario, 
								   $p_tlf, $p_tlfmovil,
                                   $p_observaciones, 
                                   $p_direnvio_nombre_pers,
                                   $p_direnvio_apellido1,
                                   $p_direnvio_apellido2,
                                   $p_direnvio_empresa,  
                                   $p_direnvio_email, 
                                   $p_direnvio_tlf,
                                   $p_direnvio_tlfmovil,    
                                   $p_dir_tipo, 
								   $p_dir_nombre, $p_dir_numero, $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, 
								   $p_dir_provincia, $p_dir_id_pais, $p_estado, $p_esa_cif, $p_esa_nombre, $p_esa_razon_social,
								   $p_esa_tlf,
                                   $p_esa_tlfmovil,
								   $p_esa_fax, 
								   $p_esa_dir_tipo, 
								   $p_esa_dir_nombre, $p_esa_dir_numero, $p_esa_dir_resto, $p_esa_dir_cpostal, $p_esa_dir_localidad,
								   $p_esa_dir_provincia, $p_esa_dir_id_pais,
                                   $p_dir_fact_igual_envio
								)		
	{
	   
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //idusuario
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createTextNode( $p_idusuario ) );      
       
       //$p_tlf
	   $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection(  $p_tlf  ) );
       
       //$p_tlfmovil
       $param60 = $doc->createElement( 'param' );
       $param60->appendChild( $doc->createCDATASection(  $p_tlfmovil  ) );
        
       /*//$p_fax
	   $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createTextNode( $p_fax ) );       
        */
       //$p_observaciones
	   $param700 = $doc->createElement( 'param' );
      $param700->appendChild( $doc->createCDATASection(  $p_observaciones  ) );
       
       //$p_direnvio_nombre_pers
	   $param701 = $doc->createElement( 'param' );
       $param701->appendChild( $doc->createCDATASection( $p_direnvio_nombre_pers  ) );

       //$p_direnvio_apellido1
	   $param702 = $doc->createElement( 'param' );
       $param702->appendChild( $doc->createCDATASection( $p_direnvio_apellido1  ) );

       //$p_direnvio_apellido2
	   $param703 = $doc->createElement( 'param' );
       $param703->appendChild( $doc->createCDATASection($p_direnvio_apellido2  ) );

       //$p_direnvio_empresa
	   $param704 = $doc->createElement( 'param' );
       $param704->appendChild( $doc->createCDATASection(  $p_direnvio_empresa  ) );
       
       //$p_direnvio_email

       $param705 = $doc->createElement( 'param' );
       $param705->appendChild( $doc->createCDATASection( $p_direnvio_email  ) );  
       
       //$p_direnvio_tlf
       $param7040 = $doc->createElement( 'param' );
       $param7040->appendChild( $doc->createCDATASection($p_direnvio_tlf )   );
       
       //$p_direnvio_tlfmovil
       $param7041 = $doc->createElement( 'param' );
       $param7041->appendChild( $doc->createCDATASection( $p_direnvio_tlfmovil  ) );
       
       
        
        
       
        //$p_dir_tipo
	   $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_tipo  ) );
       
       //$p_dir_nombre
	   $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
       //$p_dir_numero
	   $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection(  $p_dir_numero ) );
       
       //$p_dir_resto
	   $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection(  $p_dir_resto ) );
       
       //$p_dir_cpostal
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection(  $p_dir_cpostal ) );
       
       //$p_dir_localidad
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createCDATASection(  $p_dir_localidad ) );
       
       //$p_dir_provincia
       $param14 = $doc->createElement( 'param' );
       $param14->appendChild( $doc->createCDATASection(  $p_dir_provincia ) );
       
       //$p_dir_id_pais
       $param15 = $doc->createElement( 'param' );
       $param15->appendChild( $doc->createCDATASection(  $p_dir_id_pais ) );

        //$p_estado
       $param16 = $doc->createElement( 'param' );
       $param16->appendChild( $doc->createCDATASection(  $p_estado ) );
       
       //$p_esa_cif
       //cuando es particular será el nif
       $param17 = $doc->createElement( 'param' );
       $param17->appendChild( $doc->createTextNode(  $p_esa_cif ) );
       
       //$p_esa_nombre
       //cuando es particular será el nif

       $param18 = $doc->createElement( 'param' );
       $param18->appendChild( $doc->createTextNode(  $p_esa_razon_social ) );
       
       //$p_esa_razon_social
       $param19 = $doc->createElement( 'param' );
       $param19->appendChild( $doc->createCDATASection(  $p_esa_razon_social ) );
       
       //$p_esa_tlf
       $param28 = $doc->createElement( 'param' );
       $param28->appendChild( $doc->createCDATASection(  $p_esa_tlf ) );
       
       //$p_esa_tlfmovil
       $param280 = $doc->createElement( 'param' );
       $param280->appendChild( $doc->createCDATASection(  $p_esa_tlfmovil ) );
       
       //$p_esa_fax
       $param29 = $doc->createElement( 'param' );
       $param29->appendChild( $doc->createCDATASection(  $p_esa_fax ) );
       
       //$p_esa_dir_tipo
       $param20 = $doc->createElement( 'param' );
       $param20->appendChild( $doc->createCDATASection(  $p_esa_dir_tipo ) );       
       
       //$p_esa_dir_nombre
       $param21 = $doc->createElement( 'param' );
       $param21->appendChild( $doc->createCDATASection(  $p_esa_dir_nombre ) );
       
       //$p_esa_dir_numero
       $param22 = $doc->createElement( 'param' );
       $param22->appendChild( $doc->createTextNode(  $p_esa_dir_numero ) );
       
       //$p_esa_dir_resto
       $param23 = $doc->createElement( 'param' );
       $param23->appendChild( $doc->createCDATASection(  $p_esa_dir_resto ) );
       
       //$p_esa_dir_cpostal
       $param24 = $doc->createElement( 'param' );
       $param24->appendChild( $doc->createCDATASection(  $p_esa_dir_cpostal )   );
       
       //$p_esa_dir_localidad
       $param25 = $doc->createElement( 'param' );
       $param25->appendChild( $doc->createCDATASection(  $p_esa_dir_localidad )  );
       
       //$p_esa_dir_provincia
       $param26 = $doc->createElement( 'param' );
       $param26->appendChild( $doc->createCDATASection(  $p_esa_dir_provincia )  );
       
       //$p_esa_dir_id_pais
       $param27 = $doc->createElement( 'param' );

       $param27->appendChild( $doc->createCDATASection(  $p_esa_dir_id_pais )  );

       //$p_esa_dir_id_pais
       $param30 = $doc->createElement( 'param' );

       $param30->appendChild( $doc->createCDATASection(  $p_dir_fact_igual_envio )  ); 
               
       $root->appendChild( $param1 );     
       $root->appendChild( $param6 );
       $root->appendChild( $param60 );
       //$root->appendChild( $param7 );
       $root->appendChild( $param700 );
       $root->appendChild( $param701 );
       $root->appendChild( $param702 );
       $root->appendChild( $param703 );
       $root->appendChild( $param704 );
       $root->appendChild( $param705 );
       $root->appendChild( $param7040 );
       $root->appendChild( $param7041 );
       
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $root->appendChild( $param14 );
       $root->appendChild( $param15 );
       $root->appendChild( $param16 );
       $root->appendChild( $param17 );
       $root->appendChild( $param18 );
       $root->appendChild( $param19 );       
       $root->appendChild( $param28 );
       $root->appendChild( $param280 );
       $root->appendChild( $param29 );
       $root->appendChild( $param20 );
       $root->appendChild( $param21 );
       $root->appendChild( $param22 );
       $root->appendChild( $param23 );
       $root->appendChild( $param24 );
       $root->appendChild( $param25 );      
       $root->appendChild( $param26 );             
       $root->appendChild( $param27 );
       $root->appendChild( $param30 );
       $doc->appendChild( $root );  
       eZDebug::writeError( $this->UrlWS . 'setUsuarioDatosPaso2?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
       $dom = simplexml_load_file( $this->UrlWS . 'setUsuarioDatosPaso2?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
 

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
            eZDebug::writeError( (string)$element[0] );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (int) $result; // en este caso, si es válido o no
	   		return $respuesta;
	   }
	   else return false;
	}
	
	/**
	 * Relaciona el usuario $p_iduario con la empresa $p_idempresa
	 * 
	 * @param int $p_idusuario
	 * @param int $p_idempresa
	 * @return bool verdadero en caso de éxito, falso en caso contrario.
	 */
	function setUsuarioEmpresa( $p_idusuario, $p_idempresa )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //$p_idusuario
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_idusuario ) );       
       
       //$p_idempresa
	   $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_idempresa ) );
       
       $root->appendChild( $param1 );       
       $root->appendChild( $param2 );       
       
       $dom = simplexml_load_file( $this->UrlWS . 'setUsuarioEmpresa?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}	   		
	   		return true;
	   }
	   else return false;
	}
	
	/**
	 * Obtiene la infromación del usuario con e-mail $p_sEmail
	 * 
	 * @param string $p_sEmail
	 * @return mixed falso si no existe ningún usuario con ese mail. xml con la información del usuario
	 * 							 en caso de éxito.  
	 */
	function getUsuario( $p_sEmail )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sEmail ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );	  
       $dom = simplexml_load_file( $this->UrlWS . 'getUsuario?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;
	}
	
	/**
	 * Devulve usuario completo junto con los datos de la empresa. 
	 * 
	 * MUY IMPORTANTE: los datos de la empresa son los insertados por el usuario en el proceso de registro
	 * y no los validados por el sistema de gestión de EFL.
	 * 
	 * @param int $p_nIdUsuario
	 * @return mixed falso si no existe ningún usuario con ese id. xml con la información del usuario
	 * 							 en caso de éxito.  
	 */	
	function getUsuarioCompleto( $p_nIdUsuario )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );	
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_nIdUsuario ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );	       
       eZDebug::writeError(  $this->UrlWS . 'getUsuarioCompleto?p_sParam=' . $doc->saveXML() );
       $dom = simplexml_load_file( $this->UrlWS . 'getUsuarioCompleto?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
            eZDebug::writeError( (string)$element[0] ); 
	   		$result = simplexml_load_string( (string)$element[0] );	   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;
	}
	
	/**
	 * Devuelve los datos completos del usuario $p_nIdUsuario
	 * 
	 * @param int $p_nIdUsuario
	 * @return mixed falso si no existe ningún usuario con ese id. xml con la información del usuario
	 * 							 en caso de éxito.  
	 */
	
	function getUsuarioPorId( $p_nIdUsuario )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );	
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_nIdUsuario ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );	  
       $dom = simplexml_load_file( $this->UrlWS . 'getUsuarioPorId?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;
	}
	
	/**
	 * Devuelve usario completo junto con los datos de la empresa.
	 * 
	 * MUY IMPORTANTE: Los datos de la rempsa serán los que se han validado por parte de EFL y 
	 * no los insertados en el formulario de registro 
	 * 
	 * @param int $p_nIdUsuario
	 * @return mixed falso si no existe ningún usuario con ese id. xml con la información del usuario
	 * 							 en caso de éxito.
	 */
	function getUsuarioEmpresa( $p_nIdUsuario )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_nIdUsuario ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );	

       $dom = simplexml_load_file( $this->UrlWS . 'getUsuarioEmpresa?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;
	}
	
	/**
	 * Cambia el password del usuario. Para ello, se debe indicar el email, 
	 * la antigua password y la nueva password.
	 * 
	 * @param string $p_sEmail
	 * @param string $p_sOldpass
	 * @param string $p_sNewPass
	 * @return bool verdadero si la operación se completa correctamente
	 */
	function cambiaPassword( $p_sEmail, $p_sOldpass, $p_sNewPass )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sEmail ) );
       
       //old pass
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_sOldpass ) );
       
        //new pass
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_sNewPass ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $doc->appendChild( $root );	  
       
       $dom = simplexml_load_file( $this->UrlWS . 'cambiaPasswordDirecto?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}	   		
	   		$respuesta = (int) $result; // en este caso, la valided de la operacion	   		
	   		return true;
	   }
	   else return false;
	}
	
	/**
	 * Cambia la password sin necesitad de enviar la antigua password.
	 * Util para el proceso de recuperación de contraseña olvidada
	 *
	 * IMPORTANTE: esta función es la última fase del proceso de recuperación de 
	 * contraseña. El proceso en sí debe ser implementado fuera de esta clase. 
	 * La aplicación que llame al webservice tendrá que enviarle al usuario
	 * la nueva password y finalmente, informar al WS del cambio usando esta función. 
	 * 
	 * @param string $p_sEmail
	 * @param string $p_sNewPass
	 * @return bool verdadero si la operación se completa correctamente
	 */
	function cambiaPasswordDirecto( $p_sEmail, $p_sNewPass )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	    //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sEmail ) );
       
       //pass
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_sNewPass ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $doc->appendChild( $root );	  
       
       $dom = simplexml_load_file( $this->UrlWS . 'cambiaPasswordDirecto?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		
	   		$respuesta = (int) $result; // en este caso, la valided
	   		
	   		return true;
	   }
	   else return false;
	}
	
	/**
	 * Comprueba la existencia del usuario $email
	 * 
	 * @param string $email
	 * @return mixed id de usuario en caso de validez. falso si el usuario no existe.
	 */
	function existeUsuario( $email = '' )
	{	  
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //email
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $email ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );       
       
       $dom = simplexml_load_file( $this->UrlWS . 'existeUsuario?p_sParam=' . $doc->saveXML() );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (int) $result;
	   		
	   		return $respuesta;
	   }
	   else return false;	
	}
	
	/**
	 * Comprueba la existencia de la empresa con cif $p_sCIF
	 * 
	 * @param string $p_sCIF
	 * @return bool verdadero si la empresa existe
	 */
	function existeEmpresa( $p_sCIF )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //cif
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sCIF ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );  
       $dom = simplexml_load_file( $this->UrlWS . 'existeEmpresa?p_sParam=' . $doc->saveXML() );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$respuesta = (int) $result; // id de usuario
	   		return true;
	   }
	   else return false;	
	}
	
	/**
	 * Crea una nueva empresa y devuelve su id
	 * 
	 * @param string $p_cif
	 * @param string $p_nombre
	 * @param string $p_razon_social
	 * @param string $p_tlf
	 * @param string $p_fax
	 * @param string $p_dir_tipo
	 * @param string $p_dir_nombre
	 * @param string $p_dir_numero
	 * @param string $p_dir_resto
	 * @param string $p_dir_cpostal
	 * @param string $p_dir_localidad
	 * @param string $p_dir_provincia
	 * @param string $p_dir_id_pais
	 * @return mixed En caso de error en la operación devuelve false
	 */
	function nuevaEmpresa( $p_cif, $p_nombre, $p_razon_social, $p_tlf, $p_fax,
						   $p_dir_tipo, $p_dir_nombre, $p_dir_numero,
						   $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, 
						   $p_dir_provincia, $p_dir_id_pais )
	{	  
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //cif
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_cif ) );
       
       //nombre
	   $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_nombre ) );
       
       //razón social
	   $param3 = $doc->createElement( 'param' );
       $param3->appendChild( $doc->createCDATASection( $p_razon_social ) );
       
       //tlf
	   $param4 = $doc->createElement( 'param' );
       $param4->appendChild( $doc->createCDATASection( $p_tlf ) );
       
       //fax
	   $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_fax ) );
       
       //dir_tipo
	   $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_dir_tipo ) );
       
       //dir_nombre
	   $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
        //dir_numero
	   $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_numero ) );
       
       //dir_resto
	   $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_resto ) );
       
       //dir_resto
	   $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection( $p_dir_cpostal ) );
       
       //dir_localidad
	   $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection( $p_dir_localidad ) );
       
       //dir_provincia
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection( $p_dir_provincia ) );
       
       //dir_id_pais
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createCDATASection( $p_dir_id_pais ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $root->appendChild( $param3 );
       $root->appendChild( $param4 );
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $doc->appendChild( $root );       
     
       $dom = simplexml_load_file( $this->UrlWS . 'nuevaEmpresa?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$respuesta = (string) $result; // en este caso, el id_empresa
	   		return $respuesta;
	   }
	   else return false;	   					
	}
	
	/**
	 * Devuelve los datos de la empresa con cif $p_sCifEmpresa
	 * 
	 * @param unknown_type $p_sCifEmpresa
	 * @deprecated Ya que un CIF no identifica a una única empresa
	 * @return mixed falso si no existe la empresa. xml con la información en caso positivo
	 */
	function getEmpresa( $p_sCifEmpresa )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //cif
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sCifEmpresa ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );  
       $dom = simplexml_load_file( $this->UrlWS . 'getEmpresa?p_sParam=' . $doc->saveXML() );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;	
	}
	
	/**
	 * Devuelve los datos de la empresa con id $p_nIdEmpresa
	 * 
	 * @param int $p_nIdEmpresa
	 * @return mixed falso si no existe la empresa. xml con la información en caso positivo
	 */
	function getEmpresaPorId( $p_nIdEmpresa )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //cif
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_nIdEmpresa ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );  
       $dom = simplexml_load_file( $this->UrlWS . 'getEmpresa?p_sParam=' . $doc->saveXML() );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;	
	}
	
	/**
	 * Devuelve una lista de empresas con el CifEspecificado
	 * 
	 * @param string $p_sCifEmpresa
	 * @return mixed falso si no existe la empresa. xml con la información en caso positivo
	 * @todo Actualmente devuelve el campo nombre de las empresas, pero se está a la espera de 
	 *       especificaciones definitivas.
	 */
	function getListaEmpresas( $p_sCifEmpresa )
	{
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //cif
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_sCifEmpresa ) );
       
       $root->appendChild( $param1 );
       $doc->appendChild( $root );  
       $dom = simplexml_load_file( $this->UrlWS . 'getEmpresa?p_sParam=' . $doc->saveXML() );
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );	   		   		
	   		if ( (string)$result[0] == '0' )
	   		{	   			
	   			return false;
	   		}	   		
	   		return $result; // objeto usuario
	   }
	   else return false;	
	}
	
	/**
	 * Actualiza los datos de la empresa $id_empresa
	 * 
	 * @param int $p_idempresa identificador de la empresa
	 * @param string $p_tlf
	 * @param string $p_fax
	 * @param string $p_dir_tipo
	 * @param string $p_dir_nombre
	 * @param string $p_dir_numero
	 * @param string $p_dir_resto
	 * @param string $p_dir_cpostal
	 * @param string $p_dir_localidad
	 * @param string $dir_provincia
	 * @param string $p_dir_id_pais
	 * @return bool verdadero en caso de éxito
	 */
	function setEmpresaDatos( $p_idempresa, $p_tlf, $p_fax,
						   $p_dir_tipo, $p_dir_nombre, $p_dir_numero,
						   $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, 
						   $p_dir_provincia, $p_dir_id_pais )
	{	  
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );
	   
	   //$p_idempresa
	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_idempresa ) );
       
       //tlf
	   $param4 = $doc->createElement( 'param' );
       $param4->appendChild( $doc->createCDATASection( $p_tlf ) );
       
       //fax
	   $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_fax ) );
       
       //dir_tipo
	   $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_dir_tipo ) );
       
       //dir_nombre
	   $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
        //dir_numero
	   $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_numero ) );
       
       //dir_resto
	   $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_resto ) );
       
       //dir_resto
	   $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection( $p_dir_cpostal ) );
       
       //dir_localidad
	   $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection( $p_dir_localidad ) );
       
       //dir_provincia
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection( $p_dir_provincia ) );
       
       //dir_id_pais
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createCDATASection( $p_dir_id_pais ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param4 );
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $doc->appendChild( $root );       
    
       $dom = simplexml_load_file( $this->UrlWS . 'setEmpresaDatos?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (string) $result;
	   		
	   		return true;
	   }
	   else return false;  					
	}
	
	function nuevaCompra( $p_idusuario, $p_total, $p_observaciones,
	                      $p_dir_nombre_per, $p_dir_ap1, $p_dir_ap2, $p_dir_empresa, $p_dir_email,
	                      $p_dir_tlf, $p_dir_tlfmovil,
	                      $p_dir_tipo, $p_dir_nombre, $p_dir_numero,
						  $p_dir_resto, $p_dir_cpostal, $p_dir_localidad, $p_dir_provincia, $p_dir_id_pais, 
						  $p_pago_tipo, $p_pago_rdo, $p_pago_obs, $p_pago_titular, $p_pago_num_cta, $p_pago_num_plazos,
						  $p_pago_importe1, $products_to_ws, $idtransaccion, $cd_camp
						 )
	{
	   
       	
	   $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );

	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_idusuario ) );      
       
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_total ) );
       
		$param4 = $doc->createElement( 'param' );
		$param4->appendChild( $doc->createCDATASection( $p_observaciones ) );
       
       $param200 = $doc->createElement( 'param' );
       $param200->appendChild( $doc->createCDATASection( $p_dir_nombre_per ) );

       $param201 = $doc->createElement( 'param' );
       $param201->appendChild( $doc->createCDATASection( $p_dir_ap1 ) );
       
       $param202 = $doc->createElement( 'param' );
       $param202->appendChild( $doc->createCDATASection( $p_dir_ap2 ) );
       
       $param203 = $doc->createElement( 'param' );
       $param203->appendChild( $doc->createCDATASection( $p_dir_empresa ) );
       
       $param204 = $doc->createElement( 'param' );
       $param204->appendChild( $doc->createCDATASection( $p_dir_email ) );
       
       $param205 = $doc->createElement( 'param' );
       $param205->appendChild( $doc->createCDATASection( $p_dir_tlf ) );
       
       $param206 = $doc->createElement( 'param' );
       $param206->appendChild( $doc->createCDATASection( $p_dir_tlfmovil ) );
       
       
       $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_dir_tipo ) );
       
       $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_dir_nombre ) );
       
       $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_dir_numero ) );
       
       $param8 = $doc->createElement( 'param' );
       $param8->appendChild( $doc->createCDATASection( $p_dir_resto ) );
       
       $param9 = $doc->createElement( 'param' );
       $param9->appendChild( $doc->createCDATASection( $p_dir_cpostal ) );
       
       $param10 = $doc->createElement( 'param' );
       $param10->appendChild( $doc->createCDATASection( $p_dir_localidad ) );
       
       $param11 = $doc->createElement( 'param' );
       $param11->appendChild( $doc->createCDATASection( $p_dir_provincia ) );
       
       $param12 = $doc->createElement( 'param' );
       $param12->appendChild( $doc->createCDATASection( $p_dir_id_pais ) );
       
       $param13 = $doc->createElement( 'param' );
       $param13->appendChild( $doc->createCDATASection( $p_pago_tipo ) );
       
       $param14 = $doc->createElement( 'param' );
       $param14->appendChild( $doc->createCDATASection( $p_pago_rdo ) );
       
       $param15 = $doc->createElement( 'param' );
       $param15->appendChild( $doc->createCDATASection( $p_pago_obs ) );
       
       $param16 = $doc->createElement( 'param' );
       $param16->appendChild( $doc->createCDATASection( $p_pago_titular ) );
       
       $param17 = $doc->createElement( 'param' );
       $param17->appendChild( $doc->createCDATASection( $p_pago_num_cta ) );
       
       $param18 = $doc->createElement( 'param' );
       $param18->appendChild( $doc->createCDATASection( $p_pago_num_plazos ) );
       
       $param19 = $doc->createElement( 'param' );
       $param19->appendChild( $doc->createCDATASection( $p_pago_importe1 ) );
	   
	   $param300 = $doc->createElement( 'param' );
       $param300->appendChild( $doc->createCDATASection( $idtransaccion ) );
	   
	   $param301 = $doc->createElement( 'param' );
       $param301->appendChild( $doc->createCDATASection( $cd_camp ) );
       
       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $root->appendChild( $param4 );
       $root->appendChild( $param200 );
       $root->appendChild( $param201 );
       $root->appendChild( $param202 );
       $root->appendChild( $param203 );
       $root->appendChild( $param204 );
       $root->appendChild( $param205 );
       $root->appendChild( $param206 );
       
       //$root->appendChild( $param3 );
      
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       $root->appendChild( $param8 );
       $root->appendChild( $param9 );
       $root->appendChild( $param10 );
       $root->appendChild( $param11 );
       $root->appendChild( $param12 );
       $root->appendChild( $param13 );
       $root->appendChild( $param14 );
       $root->appendChild( $param15 );
       $root->appendChild( $param16 );
       $root->appendChild( $param17 );
       $root->appendChild( $param18 );
       $root->appendChild( $param19 );
	   $root->appendChild( $param300 );
	   $root->appendChild( $param301 );
       
       foreach( $products_to_ws as $product )
       {
       		foreach( $product as $key => $value )
       		{
       			$param = $doc->createElement( 'param' );
       			$param->appendChild( $doc->createTextNode( $value ) );
       			$root->appendChild( $param );
       		}
       }         
       
       $doc->appendChild( $root ); 
      
       $dom = simplexml_load_file( $this->UrlWS . 'nuevaCompra?p_sParam=' . str_replace( '&', '%26', $doc->saveXML() ) );
	


       eZDebug::writeError( $this->UrlWS . 'nuevaCompra?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		//eZDebug::writeError( 'Envio correcto dom' );
	   		$element = $dom->xpath( '//ns:return' );
            
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (string) $result;
	   		//$checker->logger->writeTimedString( 'Envio correcto' );
	   		//eZDebug::writeError( 'Envio correcto' );
	   		return $respuesta;
	   }
	   else 
	   {	
       	   $checker->logger->writeTimedString( 'Se ha producido un error' );
       	   eZDebug::writeError( 'Envio incorrecto' );
	   } 	
	   eZDebug::writeError( 'Envio correcto' );
	   
	   return true;
       
       
	}

    function setUsuarioDatosPaso3( $p_idusuario, $p_perfil_profesion, $p_perfil_cargo, $p_perfil_dpto, $p_perfil_areaesp, $p_esa_numempl, $p_esa_activ )
    {
       $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );

	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createCDATASection( $p_idusuario ) );
       
       $param2 = $doc->createElement( 'param' );
       $param2->appendChild( $doc->createCDATASection( $p_perfil_profesion ) );
       
       $param3 = $doc->createElement( 'param' );
       $param3->appendChild( $doc->createCDATASection( $p_perfil_cargo ) );
       
       $param4 = $doc->createElement( 'param' );
       $param4->appendChild( $doc->createCDATASection( $p_perfil_dpto ) );
       
       $param5 = $doc->createElement( 'param' );
       $param5->appendChild( $doc->createCDATASection( $p_perfil_areaesp ) );
       
       $param6 = $doc->createElement( 'param' );
       $param6->appendChild( $doc->createCDATASection( $p_esa_numempl ) );
       
       $param7 = $doc->createElement( 'param' );
       $param7->appendChild( $doc->createCDATASection( $p_esa_activ ) );

       $root->appendChild( $param1 );
       $root->appendChild( $param2 );
       $root->appendChild( $param3 );
       $root->appendChild( $param4 );
       $root->appendChild( $param5 );
       $root->appendChild( $param6 );
       $root->appendChild( $param7 );
       
       $doc->appendChild( $root ); 
       
       $dom = simplexml_load_file( $this->UrlWS . 'setUsuarioDatosPaso3?p_sParam=' . $doc->saveXML() );       
       
       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (string) $result;
	   		
	   		return true;
	   }
	   else return false;  			
            
    }

    function setAreasInteres( $p_idusuario, $areas )
    {       
       $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );

	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createTextNode( $p_idusuario ) );
       
       $root->appendChild( $param1 );
       
       foreach( $areas as $area )
       {
            $param = $doc->createElement( 'param' );
            $param->appendChild( $doc->createTextNode( $area ) );
            $root->appendChild( $param );
       }
       $doc->appendChild( $root );
      
      $dom = simplexml_load_file( $this->UrlWS . 'setAreasInteres?p_sParam=' . $doc->saveXML() );

       if( is_object( $dom ) )
	   {
	   		$element = $dom->xpath( '//ns:return' );
	   		$result = simplexml_load_string( (string)$element[0] );
	   		$errores = $result->xpath( '//error' );
	   		if( count( $errores ) )
	   		{
	   			return false;
	   		}
	   		$respuesta = (string) $result;
	   		
	   		return true;
	   }
	   else return false;  			  
    }

    function getUsuarioAreasInteres( $p_idusuario )
    {
  
       $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );

	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createTextNode( $p_idusuario ) );
       
       $root->appendChild( $param1 );       
      
       $doc->appendChild( $root );
  
       $dom = simplexml_load_file( $this->UrlWS . 'getUsuarioAreasInteres?p_sParam=' . $doc->saveXML() );
       if( is_object( $dom ) )
	   {
           $element = $dom->xpath( '//ns:return' );           
	   	   return $element[0];

	   }
	   else return false;  			      
    }

    function getUsuarioDatosPaso3( $p_idusuario )
    {
       $doc = new DOMDocument( '1.0', 'utf-8' );
	   $root = $doc->createElement( 'swEFLU_parametros' );

	   $param1 = $doc->createElement( 'param' );
       $param1->appendChild( $doc->createTextNode( $p_idusuario ) );
       
       $root->appendChild( $param1 );       
      
       $doc->appendChild( $root ); 
       
       $dom = simplexml_load_file( $this->UrlWS . 'getUsuarioDatosPaso3?p_sParam=' . $doc->saveXML() );
 
       if( is_object( $dom ) )
	   {
           $element = $dom->xpath( '//ns:return' );           
	   	   return $element[0];

	   }
	   else return false;  			      
    }
	 
	
	private $Host;
	private $Port;
	private $Path;
	private $UrlWS;
}
?>
