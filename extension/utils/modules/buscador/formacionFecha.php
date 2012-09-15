<?php

/*
 * Recogemos los valores del formulario de busqueda por fecha de formacion 
 * Montamos la url con viewparameters para evitar el cache
 * redirigimos a la misma pagina que nos llamo.
 */
$module = $Params['Module']; 
$http = eZHTTPTool::instance();

print_r($http->postVariable('areas'));
print_r("@@");
print_r($http->postVariable('fecha'));
print_r("@@");
print_r($http->postVariable('tipos'));


print_r($_SERVER["HTTP_REFERER"]);

if ( $http->hasPostVariable( 'areas' ) and ( $http->postVariable( 'areas') != '' ) )
{   
    $url=explode("/(areas)/",$_SERVER["HTTP_REFERER"]);
    $module->redirectTo( $url[0] .
	                      "/(areas)/" . 
						  $http->postVariable( 'areas' ) . 
						  "/(tipos)/" . 
						  $http->postVariable('tipos' ) . 
						  "/(fecha)/" . 
						  $http->postVariable('fecha') );
}


?>