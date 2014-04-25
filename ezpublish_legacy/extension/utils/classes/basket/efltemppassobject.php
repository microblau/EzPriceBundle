<?php 

/**
 * Fichero que contiene la definición de la clase eflTempPassObject
 * 
 * Objeto temporal para la recuperación de passwords por los usuarios
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class eflTempPassObject extends eZPersistentObject
{
	/**
	 * Constructor. Crea un nuevo objeto
	 * 
	 * @param array $row Array con los datos del objeto	  
	 */
    function eflTempPassObject( $row )
    {
        $this->eZPersistentObject( $row );
    }
    
    /**
     * Método que define un eflTempPassObject persistent object
     * 
     * @static
     * @return array Un array con la definición de un objeto de este tipo
     */
	static function definition()
    {
        return array( 'fields' => array( 'email' => array( 'name' => 'Email',
                                                        'datatype' => 'string',
                                                        'default'  => '',
                                                        'required' => true ),
                                        
                                         'password' => array( 'name' => 'Password',
                                                              'datatype'=> 'string',
                                                              'default' => '',
                                                              'required'=> false ),        
                                         'md5_key' => array( 'name' => 'Key',
                                                                    'datatype'=> 'string',
                                                                    'default' => '',
                                                                    'required'=> true ),
															),
                      'keys' => array( 'email' ),
                      'class_name' => 'eflTempPassObject',
                      'name' => 'efl_tmp_pass'  );
    }
    
    /**
     * Obtiene el objeto correspondiente a la clave dada
     * 
     * @param string $key hash a consultar
     * @return el objeto con esa clave
     */
    static function fetchByKey( $key )
    {
    	return eZPersistentObject::fetchObject( eflTempPassObject::definition(),
												null,
												array( 'md5_key' => $key )
    	);
    }
}
?>