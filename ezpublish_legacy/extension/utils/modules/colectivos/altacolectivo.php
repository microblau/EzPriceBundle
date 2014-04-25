<?php
/**
 * Registro. Recoge datos de alta para COLECTIVOS por POST y los envía al WS. 
 * Realiza también las validaciones pertinentes.
 * 
 * @author breton@efl.es
 */

require( 'kernel/common/template.php' );
include_once( 'extension/ezhumancaptcha/classes/ezhumancaptchatools.php' );
$tpl = eZTemplate::factory();

$http = eZHTTPTool::instance();

if( $http->hasPostVariable( 'BtnColectivos' ) )
{
	$errors = array();
	
	if( $http->postVariable( 'nombre' ) == '' )
	{
		$errors['nombre'] = "El campo 'Nombre' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'nombre', $http->postVariable( 'nombre' ) );
	}
	
	if( $http->postVariable( 'apellido1' ) == '' )
	{
		$errors['apellido1'] = "El campo 'Primer Apellido' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'apellido1', $http->postVariable( 'apellido1' ) );
	}
	
	if( $http->postVariable( 'apellido2' ) == '' )
	{
		//El campo Apellido2 NO es obligatorio, pero para evitar problemas con los nulos en el WS se pone un espacio en blanco.
		$tpl->setVariable( 'apellido2', ' ' );
	}
	else
	{
		$tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );
	}
	
	if( $http->postVariable( 'asociacion' ) == '' )
	{
		$errors['asociacion'] = "El campo 'Asociación/Colectivo' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'asociacion', $http->postVariable( 'asociacion' ) );
	}
	
	if( $http->postVariable( 'no_colegiado' ) == '' )
	{
		$errors['no_colegiado'] = "El campo 'Número de Colegiado' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'no_colegiado', $http->postVariable( 'no_colegiado' ) );
	}
	
	if( $http->postVariable( 'email' ) == '' )
	{
		$errors['email'] = "El campo 'E-mail' es obligatorio";
		$tpl->setVariable( 'email', $http->postVariable( 'email' ) );
	}
	elseif ( !eZMail::validate( $http->postVariable( 'email' ) ) )
	{
		$errors['email'] = "El formato del campo 'Email' no es correcto";
		$tpl->setVariable( 'email', $http->postVariable( 'email' ) );
	}
	else
	{
		$tpl->setVariable( 'email', $http->postVariable( 'email' ) );
	}
	
	if( $http->postVariable( 'pass' ) == '' )
	{
		$errors['passwd'] = "El campo 'Contraseña' es obligatorio";
	}
	elseif( strlen( $http->postVariable( 'pass' )  ) > 8 )
	{
		$errors['passwd'] = "La longitud del campo 'Contraseña' no puede exceder de 8 caracteres";
	}
	else
	{
		$tpl->setVariable( 'pass', $http->postVariable( 'pass' ) );
	}
	
	if( $http->postVariable( 'repPass' ) == '' )
	{
		$errors['repPass'] = "El campo 'Repetir Contraseña' es obligatorio";
	}
	elseif( strlen( $http->postVariable( 'repPass' )  ) > 8 )
	{
		$errors['repPass'] = "La longitud del campo 'Repetir Contraseña' no puede exceder de 8 caracteres";
	}
	elseif ( $http->postVariable( 'repPass' ) !=  $http->postVariable( 'pass' ) )
	{
		$errors['repPass'] = "Las contraseñas introducidas no coinciden";
	}
	else
	{
		$tpl->setVariable( 'repPass', $http->postVariable( 'repPass' ) );
	}
	
	if( !$http->hasPostVariable( 'tipoCompra' ) )
	{
		$errors['tipocompra'] = "El campo 'Voy a comprar como' es obligatorio";
	}
	else
	{
		$tpl->setVariable( 'tipocompra', $http->postVariable( 'tipoCompra' ) );
	}
	
	if( !$http->hasPostVariable( 'lopd') )
	{
		$errors['lopd'] = "Debe aceptar las condiciones LOPD";
	}
	
	if( !$http->hasPostVariable( 'condiciones') )
	{
		$errors['condiciones'] = "Debe aceptar las condiciones legales";
	}
	    
    $eZHumanCAPTCHAValidation = eZHumanCAPTCHATools::validateHTTPInput();
    if ( count( $eZHumanCAPTCHAValidation ) )
    {
		$errors['captchar'] = "Introduzca los caracteres que visualiza en la imagen inferior";
    }

	
	// Controlamos si hay ERRORES...
	if( count( $errors) )
	{
		$tpl->setVariable( 'errors', $errors );
		$Result = array();
		$Result['content'] = $tpl->fetch( 'design:colectivos/altacolectivo.tpl' );
	}
	else
	{
		$eflWS = new eflWS();
		$existsUser = $eflWS->existeUsuario( $http->postVariable( 'email' ) );
		
		if(  $existsUser )
		{
			// Se controla a través de WS si ya existe ese email en la BD (clave única de la tabla)
			// Ahora que sabemos que el usuario existe en BD, vamos a ver si tiene el Código Colectivo rellenado o no.

			$usuario_empresa = $eflWS->getUsuarioCompleto( $existsUser );
			$usuario = $usuario_empresa->xpath( '//usuario' );
			$cod_colectivo = $usuario[0]->cod_colectivo;

			$url = 'basket/forgotpassword';
			eZURI::transformURI( $url );
			
			if (( $cod_colectivo ) && ( $cod_colectivo <> ' '))
			{
				$errors['email'] = 'El e-mail ya está en nuestra base de datos. ' . '<a href="'. $url . '"><font color=#0000CC>¿Ha olvidado su contraseña?</font></a>';
			}
			else
			{
				$errors['email'] = 'Usted ya está registrado en nuestra base de datos. Para poder acceder al área de su colectivo/asociación profesional, por favor, póngase en contacto con nosotros en el teléfono 91210800 o clientes@efl.es, e indíquenos su colectivo y nº de colegiado.';
			}
			
			$tpl->setVariable( 'errors', $errors );
			$Result = array();
			$Result['content'] = $tpl->fetch( 'design:colectivos/altacolectivo.tpl' );
		}
		else
		{
			$var_apellido2 = '';
			
			if( $http->postVariable( 'apellido2' ) == '' )
			{
				$var_apellido2 = ' ';
			}
			else
			{
				$var_apellido2 = $http->postVariable( 'apellido2' );
			}
			
			// Se crea el Usuario en BD Oracle a través del WS
			$eflWS = new eflWS();
			
			$idUsuario = $eflWS->nuevoUsuarioColectivo( $http->postVariable( 'email' ),
														$http->postVariable( 'pass' ),
														$http->postVariable( 'nombre' ),
														$http->postVariable( 'apellido1' ),
														$var_apellido2,
														0, // Siempre. Confianza de Pago, por defecto NO.
														$http->postVariable( 'tipoCompra' ), // Traerá 1 si es particular, 2 si es empresa
														9, // Estado 9. Viene del formulario de Colectivos.
														1, // Tipo Usuario.
														$http->postVariable( 'asociacion' ),
														$http->postVariable( 'no_colegiado' )
														);
			
			// Si hay éxito en la operación tenemos que crear al usuario en el ez y luego loguearlo automáticamente					 
			if ( is_numeric( $idUsuario ) )
			{
				$http->setSessionVariable( 'id_user_lfbv', $idUsuario );
				eZUtilsUser::loginUser( $http->postVariable( 'email' ), $http->postVariable( 'pass' ) );			
			}
			
			// Si el usuario está logado correctamente, entra en la sección privada de Colectivos.
			$Module = $Params['Module'];
			$user = eZUser::currentUser();
			if( $user->isLoggedIn() )
			{
				$Module->redirectTo( 'catalogo/sector/colectivo-asociacion-profesional' );
			}
		}
	}
}
else
{
	$Result = array();
	$Result['content'] = $tpl->fetch( 'design:colectivos/altacolectivo.tpl' );
}
?>