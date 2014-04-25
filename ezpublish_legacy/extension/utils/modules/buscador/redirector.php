<?php

/*
 * Según lo recibido haremos una opción u otra. 
 * Vamos a usar eZPreferences para así recordar las preferencias por usuario.
 * En caso de ser usuario anónimo la preferencia se guarda en una cookie.
 */
$module = $Params['Module']; 
$http = eZHTTPTool::instance();

if ( $http->hasPostVariable( 'mostrar_field' ) and ( $http->postVariable( 'mostrar_field') != '' ) )
{	
	$module->redirectTo( "/user/preferences/set/products_per_page/" . $http->postVariable( 'mostrar_field' ) );
}

if ( $http->hasPostVariable( 'ordenar_field' ) and ( $http->postVariable( 'ordenar_field') != '' ) )
{	
	$module->redirectTo( "/user/preferences/set/order_by/" . $http->postVariable( 'ordenar_field' ) );
}
?>