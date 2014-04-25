<?php 
$module = $Params['Module'];
$key = $Params['Key'];
$email = base64_decode( $key );

$eflws = new eflWS();
$existeUsuario = $eflws->existeUsuario( $email );
if( ( $existeUsuario ) and ( eZUser::fetchByEmail( $email ) ) )
{
	$respuesta_prod_sugerido = $eflws->validaUsuarioProdSugerido( $existeUsuario );
		   
	$http = eZHTTPTool::instance();
	$http->setSessionVariable( 'id_user_lfbv', $respuesta  ); // guardamos el id del usuario en sesión
	$http->setSessionVariable( 'cd_prod_sugerido', $respuesta_prod_sugerido  ); // guardamos código de producto sugerido en sesión
		   
	$user = eZUser::fetchByEmail( $email );
	eZUser::setCurrentlyLoggedInUser( $user, $user->attribute( 'contentobject_id' ) );
}
$module->redirectTo( '/recursospsm' );
?>
