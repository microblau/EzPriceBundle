<?php 
/**
 * Funciones auxiliares para la recuperación de password
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class eflTempPass
{
	/**
	 * Constructor No hace nada en especial
	 * 
	 */
	function __construct()
	{
		
	}
	
	/**
	 * Crea un nuevo password aleatorio
	 * 
	 * @param int $length Longitud de la password a generar
	 * @return string
	 */
	static function generatePassword ($length = 8)
	{
		// start with a blank password
  		$password = "";

		// define possible characters
  		$possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKMNOPQRSTUVWXYZ"; 
   
		// set up a counter
  		$i = 0; 
    
  		// add random characters to $password until $length is reached
  		while ($i < $length) 
  		{ 
		    // pick a random character from the possible ones
    		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
		    // we don't want this character if it's already in the password
    		if (!strstr($password, $char)) 
    		{ 
      			$password .= $char;
      			$i++;
    		}
  		}
	  //done!
  	   return $password;
	}
        
	
	/**
	 * Crea un nuevo hash que se enviará al usuario para que 
	 * este pueda obtener una nueva clave.
	 * 
	 * @param string $email E-mail del usuario	 
	 * @return string 
	 */
	static function generateKey( $email )
	{
		return md5( $email . ':' . time() . ':' . mt_rand() );	
	}
}
?>