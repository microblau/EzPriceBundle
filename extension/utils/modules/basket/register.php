<?php
//
// Created on: <22-Mar-2010 12:47:49 carlos.revillo@tantacom.com>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

/*! \file
*/

/**
 * Registro. Recoge datos por post y los envía al WS. 
 * Realiza también las validaciones pertinents.
 * 
 * @author carlos.revillo@tantacom.com
 */

require( 'kernel/common/template.php' );
$tpl = templateInit();

$http = eZHTTPTool::instance();

if( $http->hasPostVariable( 'BtnRegister' ) )
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
		$errors['apellido1'] = "El campo 'Apellido 1' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'apellido1', $http->postVariable( 'apellido1' ) );
	}
	$tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );	
	
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
	
	if( !$http->hasPostVariable( 'tipoCompra' ) )
	{
		$errors['tipocompra'] = "El campo 'Voy a comprar como' es obligatorio";
	}
	else
	{
		$tpl->setVariable( 'tipocompra', $http->postVariable( 'tipoCompra' ) );
	}
	$tpl->setVariable( 'countrycode', $http->postVariable( 'pais' ) );
	
	if( !$http->hasPostVariable( 'condiciones') )
	{
		$errors['condiciones'] = 'Debe aceptar las condiciones legales';
	}
	// si hay errores...
	if( count( $errors) )
	{
		$tpl->setVariable( 'errors', $errors );
		$Result = array();
		$Result['content'] = $tpl->fetch( 'design:basket/register.tpl' );
	}
	else
	{

		$eflWS = new eflWS();
		$existsUser = $eflWS->existeUsuario( $http->postVariable( 'email' ) );
		if(  $existsUser )
		{
			$url = 'basket/forgotpassword';
			eZURI::transformURI( $url );
			
			$errors['email'] = 'El e-mail ya está en nuestra base de datos. ' . '<a href="'. $url . '">¿Ha olvidado su contraseña?</a>';
			$tpl->setVariable( 'errors', $errors );
			$Result = array();
			$Result['content'] = $tpl->fetch( 'design:basket/register.tpl' );
		}
		else
		{
               
			/* aquí registramos al usuario, solo con algunos datos */
			/* cambio realizado tras reunion en oficinas Francis Lefebvre 06/04/2010*/
			// solo registramos si viene de España
			if( $http->postVariable( 'pais' ) == 'ES' )
			{
				// creamos empresa
			    $eflWS = new eflWS();
			/*$idEmpresa = $eflWS->existeEmpresa( $http->postVariable( 'nif' ) );	
			if( !$idEmpresa )
			{*/
				/*$idEmpresa = $eflWS->nuevaEmpresa( '',
												   $http->postVariable( 'nombre' ) . ' ' . $http->postVariable( 'apellido1' ) . ' ' . $http->postVariable( 'apellido2' )  ,
												   '',
												  '',
												  '',
												  '',
												  '',
												  '', 	
												  '',
												  '',
												  '',
												  '',
												  $http->postVariable( 'pais' )
												);
				if( $idEmpresa )
				{*/
					// si la empresa se ha creado ok, creamos al usuario
					$idUsuario = $eflWS->nuevoUsuarioPaso1(  $http->postVariable( 'email' ),
													  $http->postVariable( 'pass' ),
												   $http->postVariable( 'nombre' ),
												   $http->postVariable( 'apellido1' ),
												   $http->postVariable( 'apellido2' ),
												   0, // siempre
												   $http->postVariable( 'tipoCompra' ), // traerá 1 si es particular, 2 si es empresa
												   1, // paso 1
												   1 // viene de la tienda											   
												);
					
					// si hay éxito en la operación tenemos que crear al usuario en el ez 
					// y luego loguearlo automáticamente					 
					if ( is_numeric( $idUsuario ) )
					{
						$http->setSessionVariable( 'id_user_lfbv', $idUsuario );
						/*$http->setSessionVariable( 'id_empresa_lfbv', $idEmpresa );*/	
						eZUtilsUser::loginUser( $http->postVariable( 'email' ), $http->postVariable( 'pass' ) );
						//relacionamos usuario y empresa
						/*$eflWS->setUsuarioEmpresa( $idUsuario, $idEmpresa );*/					
					}
				//}
				// mantenemos lo hecho con el fin de no cambiar demasiado después. 
				$http->setSessionVariable( 'register_nombre', $http->postVariable( 'nombre' ) );
				$http->setSessionVariable( 'register_apellido1', $http->postVariable( 'apellido1' ) );
				$http->setSessionVariable( 'register_apellido2', $http->postVariable( 'apellido2' ) );
				$http->setSessionVariable( 'register_email', $http->postVariable( 'email' ) );
				$http->setSessionVariable( 'register_pass', $http->postVariable( 'pass' ) ); // encriptar?			
				$http->setSessionVariable( 'register_country', $http->postVariable( 'pais' ) );
				$basket = eZBasket::currentBasket();
				$infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => $basket->attribute( 'productcollection_id') ) );

                $unserialized_order = unserialize($infoOrder->Order);
				
								
                if( $unserialized_order['has_nautis4'] )
                            {
                                $order['has_nautis4'] = $unserialized_order['has_nautis4'];                
                            }
                            if( $unserialized_order['has_mementix'] )
                            {
                                $order['has_mementix'] = $unserialized_order['has_mementix'];                
                            }
							if( $unserialized_order['has_imemento'] )
                            {
                                $order['has_imemento'] = $unserialized_order['has_imemento'];
                            }
                $order['codigopromocional'] = $unserialized_order['codigopromocional'];
                $order['productos_bono'] = $unserialized_order['productos_bono'];
                $order['descuento'] = $unserialized_order['descuento'];
                $order['tipo_usuario'] = 1; // particular
            	$order['email'] = $http->sessionVariable( 'register_email' );
	            $order['nombre'] = $http->sessionVariable( 'register_nombre' );
            	$order['apellido1'] = $http->sessionVariable( 'register_apellido1' );
            	$order['apellido2'] = $http->sessionVariable( 'register_apellido2' );
             	$order['pais'] = $http->sessionVariable( 'register_country' );
                $basket = eZBasket::currentBasket();
                // creamos info de orden
                if( $basket->OrderID == 0 )
                {
                     $shoporder = $basket->createOrder();
                }               
                else
                {
                    $shoporder = eZOrder::fetch( $basket->OrderID );
                }
    			$http->setSessionVariable( 'MyTemporaryOrderID', $shoporder->attribute( 'id' ) );       
    			$order_object = new eflOrders( array( 
			                                    'productcollection_id' => $basket->attribute( 'productcollection_id' ),
			                                    'order_serialized' => serialize( $order )
        	        ) );        
	    		$order_object->store();

                
				if( $http->postVariable( 'tipoCompra') == 1 )
				{
					$Result = array();
					$Result['content'] = $tpl->fetch( 'design:basket/register_particular.tpl' );
				}
				else
				{
					$Result = array();
					$Result['content'] = $tpl->fetch( 'design:basket/register_empresa.tpl' );
				}
			}
			else
			{
				$http->setSessionVariable( 'register_nombre', $http->postVariable( 'nombre' ) );
				$http->setSessionVariable( 'register_apellido1', $http->postVariable( 'apellido1' ) );
				$http->setSessionVariable( 'register_apellido2', $http->postVariable( 'apellido2' ) );
				$http->setSessionVariable( 'register_email', $http->postVariable( 'email' ) );
				$http->setSessionVariable( 'register_pass', $http->postVariable( 'pass' ) ); // encriptar?			
				$http->setSessionVariable( 'register_country', $http->postVariable( 'pais' ) );
				$tpl->setVariable( 'nombre', $http->postVariable( 'nombre' ) );
				$tpl->setVariable( 'apellidos', $http->postVariable( 'apellido1' ) . ' ' .  $http->postVariable( 'apellido2' ) );
				$tpl->setVariable( 'email', $http->postVariable( 'email' ) );
				$tpl->setVariable( 'pais', $http->postVariable( 'pais' ) );
                
				$Result = array();
				$Result['content'] = $tpl->fetch( 'design:basket/register_outside.tpl' );
			}
			
		}
	}
}
elseif ( $http->hasPostVariable( 'BtnRegisterParticular' ) )
{
	// validamos
	// además formamos un array con la información de la orden
	$errors = array();
	$order = array();
	
	$order['tipo_usuario'] = 1; // particular
	$order['email'] = $http->sessionVariable( 'register_email' );
	$order['nombre'] = $http->sessionVariable( 'register_nombre' );
	$order['apellido1'] = $http->sessionVariable( 'register_apellido1' );
	$order['apellido2'] = $http->sessionVariable( 'register_apellido2' );
	$order['pais'] = $http->sessionVariable( 'register_country' );
	
	
	if( $http->postVariable( 'nif' ) == '' )
	{
		$errors['nif'] = "El campo 'NIF' es obligatorio";		
	}
	elseif( !ezEflUtils::validateNIF( $http->postVariable( 'nif' ) ) )
	{
		$errors['nif'] = "El campo 'NIF' no tiene un formato correcto";
	}
	$tpl->setVariable( 'nif', $http->postVariable( 'nif' ) );
	$order['nif'] = $http->postVariable( 'nif' );
	
	
	if( $http->postVariable( 'telefono' ) == '' )
	{
		$errors['telefono'] = "El campo 'Teléfono' es obligatorio";		
	}	
    elseif( strlen( $http->postVariable( 'telefono' ) ) > 16  )
    {
       $errors['telefono'] = "El campo 'Teléfono' no puede tener más de 16 caracteres";		
    }
	$tpl->setVariable( 'telefono', $http->postVariable( 'telefono' ) );
	$order['telefono'] = $http->postVariable( 'telefono' );

    if( ( $http->postVariable( 'movil' ) != '' )  and strlen( $http->postVariable( 'movil' ) ) > 16  )
    {
       $errors['movil'] = "El campo 'Móvil' no puede tener más de 16 caracteres";		
    }
	
	if( ( $http->postVariable( "tipoV" ) == '' ) or ( $http->postVariable( "dir1" ) == '' ) or ( $http->postVariable( "num" ) == '' ) )
	{
		$errors['direccion'] = "El campo 'Dirección' de 'Datos de facturación' es obligatorio";
	}	
	$tpl->setVariable( 'tipovia', $http->postVariable( 'tipoV' ) );
	$order['tipovia'] = $http->postVariable( 'tipoV' );
	
	$tpl->setVariable( 'dir1', $http->postVariable( 'dir1' ) );
	$order['dir1'] = $http->postVariable( 'dir1' );
	
	$tpl->setVariable( 'num', $http->postVariable( 'num' ) );
	$order['num'] = $http->postVariable( 'num' );
	
	if( $http->postVariable( 'provincia' ) == '' )
	{
		$errors['provincia'] = "El campo 'Provincia' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'provincia', $http->postVariable( 'provincia' ) );
	}
	$order['provincia'] = $http->postVariable( 'provincia' );
		
	if( $http->postVariable( 'localidad' ) == '' )
	{
		$errors['localidad'] = "El campo 'Localidad' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'localidad', $http->postVariable( 'localidad' ) );
	}
	$order['localidad'] = $http->postVariable( 'localidad' );	
	
	if( $http->postVariable( 'cp' ) == '' )
	{
		$errors['cp'] = "El campo 'CP' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'cp', $http->postVariable( 'cp' ) );
	}
	$order['cp'] = $http->postVariable( 'cp' );
    
	
	$tpl->setVariable( 'fax', $http->postVariable( 'fax' ) );
	$order['fax'] = $http->postVariable( 'fax' );
	
	$tpl->setVariable( 'movil', $http->postVariable( 'movil' ) );
    $order['movil'] = $http->postVariable( 'movil' );
	
	$tpl->setVariable( 'complemento', $http->postVariable( 'complemento' ) );
	$order['complemento'] = $http->postVariable( 'complemento' );
	
	//si los datos de envío no coinciden con facturación hay que validar más cosas
	$tpl->setVariable( 'datos_coinciden', $http->postVariable( 'datos' ) );
	$order['datos_coinciden'] = $http->postVariable( 'datos' );
	if( $http->postVariable( 'datos' ) == 'no' )
	{
		if( $http->postVariable( 'nombre2' ) == '' )
		{
			$errors['nombre2'] = "El campo 'Nombre' de 'Datos de Envío' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'nombre2', $http->postVariable( 'nombre2' ) );
			$order['nombre2'] = $http->postVariable( 'nombre2' );
		}
		
		if( $http->postVariable( 'apellido12' ) == '' )
		{
			$errors['apellido12'] = "El campo 'Apellido 1' de 'Datos de Envío' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'apellido12', $http->postVariable( 'apellido12' ) );
			$order['apellido12'] = $http->postVariable( 'apellido12' );
		}
		$tpl->setVariable( 'apellido22', $http->postVariable( 'apellido22' ) );
		$order['apellido22'] = $http->postVariable( 'apellido22' );
		/*
		if( $http->postVariable( 'nif2' ) == '' )
		{
			$errors['nif2'] = "El campo 'NIF' de 'Datos de Envío' es obligatorio";		
		}
		elseif( !ezEflUtils::validateNIF( $http->postVariable( 'nif2' ) ) )
		{
			$errors['nif2'] = "El campo 'NIF' de 'Datos de Envío' no tiene un formato correcto";
		}*/
		$tpl->setVariable( 'nif2', $http->postVariable( 'nif2' ) );
		$order['nif2'] = $http->postVariable( 'nif2' );
		
		
		if( $http->postVariable( 'telefono2' ) == '' )
		{
			$errors['telefono2'] = "El campo 'Teléfono' de 'Datos de Envío' es obligatorio";		
		}	
		elseif( strlen( $http->postVariable( 'telefono2' ) >  16 ) )
		{
			$errors['telefono2'] = "El campo 'Teléfono' de 'Datos de Envío' no puede tener más de 16 caracteres";					
		}
        $tpl->setVariable( 'telefono2', $http->postVariable( 'telefono2' ) );
	    $order['telefono2'] = $http->postVariable( 'telefono2' );

        if( ( $http->postVariable( 'movil2' ) != '' )  and strlen( $http->postVariable( 'movil2' ) ) > 16  )
        {
           $errors['movil2'] = "El campo 'Móvil'  de 'Datos de Envío' no puede tener más de 16 caracteres";		
        }
		/*
		if( $http->postVariable( 'email2' ) == '' )
		{
			$errors['email2'] = "El campo 'E-mail' de 'Datos de Envío' es obligatorio";		
		}*/
		if( ( $http->postVariable( 'email2' ) != '' ) and ( !eZMail::validate( $http->postVariable( 'email2' ) ) ) )
		{
			$errors['email2'] = "El campo 'E-mail' de 'Datos de Envío' no tiene un formato correcto";
		}
		$tpl->setVariable( 'email2', $http->postVariable( 'email2' ) );
		$order['email2'] = $http->postVariable( 'email2' );
		
		if( ( $http->postVariable( "tipoV2" ) == '' ) or ( $http->postVariable( "dir12" ) == '' ) or ( $http->postVariable( "num2" ) == '' ) )
		{
			$errors['direccion2'] = "El campo 'Dirección' de 'Datos de Envío' es obligatorio";
		}
		
		$tpl->setVariable( 'tipovia2', $http->postVariable( 'tipoV2' ) );
		$order['tipovia2'] = $http->postVariable( 'tipoV2' );
		$tpl->setVariable( 'dir12', $http->postVariable( 'dir12' ) );
		$order['dir12'] = $http->postVariable( 'dir12' );
		$tpl->setVariable( 'num2', $http->postVariable( 'num2' ) );
		$order['num2'] = $http->postVariable( 'num2' );
		
		if( $http->postVariable( 'provincia2' ) == '' )
		{
			$errors['provincia2'] = "El campo 'Provincia' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'provincia2', $http->postVariable( 'provincia2' ) );
			$order['provincia2'] = $http->postVariable( 'provincia2' );
		}
		
		if( $http->postVariable( 'localidad2' ) == '' )
		{
			$errors['localidad2'] = "El campo 'Localidad' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'localidad2', $http->postVariable( 'localidad2' ) );
			$order['localidad2'] = $http->postVariable( 'localidad2' );
		}
		
		if( $http->postVariable( 'cp2' ) == '' )
		{
			$errors['cp2'] = "El campo 'CP' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'cp2', $http->postVariable( 'cp2' ) );
			$order['cp2'] = $http->postVariable( 'cp2' );
		}		
		$tpl->setVariable( 'complemento2', $http->postVariable( 'complemento2' ) );
		$order['complemento2'] = $http->postVariable( 'complemento2' );

        $tpl->setVariable( 'empresa2', $http->postVariable( 'empresa2' ) );
		$order['empresa2'] = $http->postVariable( 'empresa2' );

        $tpl->setVariable( 'movil2', $http->postVariable( 'movil2' ) );
		$order['movil2'] = $http->postVariable( 'movil2' );
	}
	
	if( $http->hasPostVariable( 'cursos' ) )
	{
		$order['cursos'] = array();
		foreach ( explode( ',',  $http->postVariable( 'cursos' ) ) as $curso )
		{
			$tpl->setVariable( 'datosc'. $curso, $http->postVariable( 'datosc' . $curso ) );
			
			if( ( $http->postVariable( 'nombrec' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['nombrec'.$curso] = "El campo 'Nombre' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'nombrec'.$curso, $http->postVariable( 'nombrec' . $curso ) );
			}
			
			if( ( $http->postVariable( 'apellido1c' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['apellido1c'.$curso] = "El campo 'Apellido 1' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'apellido1c'.$curso, $http->postVariable( 'apellido1c' . $curso ) );
			}
			$tpl->setVariable( 'apellido2c'.$curso, $http->postVariable( 'apellido2c' . $curso ) );
			
			if( ( $http->postVariable( 'profesionc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['profesionc'.$curso] = "El campo 'Profesión' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'profesionc'.$curso, $http->postVariable( 'profesionc' . $curso ) );
			}
			
			if( ( $http->postVariable( 'telefonoc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['telefonoc'.$curso] = "El campo 'Teléfono' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'telefonoc'.$curso, $http->postVariable( 'telefonoc' . $curso ) );
			}
			
			if( ( $http->postVariable( 'emailc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['emailc' . $curso] = "El campo 'E-mail' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso ) . "' es obligatorio";		
			}
			elseif( ( !eZMail::validate( $http->postVariable( 'emailc' . $curso ) ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) ) )
			{
				$errors['emailc' . $curso] = "El campo 'E-mail' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso ) . "' no tiene un formato válido";
			}
			$tpl->setVariable( 'emailc' . $curso, $http->postVariable( 'emailc' . $curso ) );
			
			$tpl->setVariable( 'emailc'.$curso, $http->postVariable( 'emailc' . $curso ) );
			$tpl->setVariable( 'faxc'.$curso, $http->postVariable( 'faxc' . $curso ) );
			$info = array( 'id' => $http->postVariable( 'datosc' . $curso ),
										'nombre' => $http->postVariable( 'nombrecurso_' . $curso),
										'asistente' => array() );			
								
			
			if( $http->postVariable( 'datosc' . $curso ) == 'no' )
			{
				$info['asistente']['nombre'] = 	$http->postVariable( 'nombrec' . $curso );
				$info['asistente']['apellido1'] = 	$http->postVariable( 'apellido1c' . $curso );
				$info['asistente']['apellido2'] = 	$http->postVariable( 'apellido2c' . $curso );
				$info['asistente']['profesion'] = 	$http->postVariable( 'profesionc' . $curso );
				$info['asistente']['telefono'] = 	$http->postVariable( 'telefonoc' . $curso );
				$info['asistente']['email'] = 	$http->postVariable( 'emailc' . $curso );
				$info['asistente']['fax'] = 	$http->postVariable( 'faxc' . $curso );
			}
			$order['cursos'][] = $info;
			
			
		}
	}
	
	
	
	$tpl->setVariable( 'observaciones', $http->postVariable( 'observaciones' ) );
	$order['observaciones'] = $http->postVariable( 'observaciones' );
	
	if( count( $errors) )
	{
		$tpl->setVariable( 'errors', $errors );
		$Result = array();
		$Result['content'] = $tpl->fetch( 'design:basket/register_particular.tpl' );
	}
	else
	{
		//actualizamos datos
		$eflWS = new eflWS();
        if( $http->postVariable( 'datos' ) == 'si' )
        {
		    $idUsuario = $eflWS->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),												  
											   $http->postVariable( 'telefono' ),
											   $http->postVariable( 'movil' ),											 
                                               $http->postVariable( 'observaciones' ),
                                               $http->sessionVariable( 'register_nombre' ), 
                                               $http->sessionVariable( 'register_apellido1' ),
                                               $http->sessionVariable( 'register_apellido2' ),
                                               '',
                                                eZUser::currentUser()->Email,
                                               $http->postVariable( 'telefono' ),
                                               $http->postVariable( 'movil' ),
                                              
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
											   2, // paso dos
											   $http->postVariable( 'nif' ), // nif, que sirve para cif
											   '',  // es un usuario luego va vacío
											   $http->sessionVariable( 'register_nombre' ) . ' ' . $http->sessionVariable( 'register_apellido1' ) . ' ' . $http->sessionVariable( 'register_apellido2' ) , // razón social
											   $http->postVariable( 'telefono' ),
                                               $http->postVariable( 'movil' ),
											   '',
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
                                               1										   
											);
						
		}
        else
        {
            $idUsuario = $eflWS->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),												  
											   $http->postVariable( 'telefono' ),
											   $http->postVariable( 'movil' ),											
                                               $http->postVariable( 'observaciones' ),
                                               $http->postVariable( 'nombre2' ), 
                                               $http->postVariable( 'apellido12' ),
                                               $http->postVariable( 'apellido22' ),
                                               $http->postVariable( 'empresa2' ),     
                                               $http->postVariable( 'email2' ),   
                                               $http->postVariable( 'telefono2' ),
                                               $http->postVariable( 'movil2' ),                                             
											   $http->postVariable( 'tipoV2' ),
											   $http->postVariable( 'dir12' ),
											   $http->postVariable( 'num2' ), 	
											   $http->postVariable( 'complemento2' ),
											   $http->postVariable( 'cp2'),
											   $http->postVariable( 'localidad2'),
											   $http->postVariable( 'provincia2'),
											   $http->sessionVariable( 'register_country' ),
											   2, // paso dos
											   $http->postVariable( 'nif' ), // nif, que sirve para cif
											   '',
											   $http->sessionVariable( 'register_nombre' ) . ' ' . $http->sessionVariable( 'register_apellido1' ) . ' ' . $http->sessionVariable( 'register_apellido2' ) , // razón social
											   $http->postVariable( 'telefono' ),
                                               $http->postVariable( 'movil' ), 
											   '',
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
                                               0									   
											);
        }
        			
			//guardamos la orden;
			$basket = eZBasket::currentBasket();
           
            if( $basket->OrderID == 0 )
            {
    			$shoporder = $basket->createOrder();
            }
            else
            {
                $shoporder = eZOrder::fetch( $basket->OrderID );
                
            }
			$http->setSessionVariable( 'MyTemporaryOrderID', $shoporder->attribute( 'id' ) );
			$infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => $basket->attribute( 'productcollection_id') ) );
            $unserialized_order = unserialize($infoOrder->Order);
            if( $unserialized_order['has_nautis4'] )
            {
                $order['has_nautis4'] = $unserialized_order['has_nautis4'];                
            }
            if( $unserialized_order['has_mementix'] )
            {
                $order['has_mementix'] = $unserialized_order['has_mementix'];                
            }
			if( $unserialized_order['has_imemento'] )
			{
				$order['has_imemento'] = $unserialized_order['has_imemento'];
            }
            $order['codigopromocional'] = $unserialized_order['codigopromocional'];
            $order['productos_bono'] = $unserialized_order['productos_bono'];
            $order['descuento'] = $unserialized_order['descuento'];       
			$order_object = new eflOrders( array( 
			                                    'productcollection_id' => $basket->attribute( 'productcollection_id' ),
			                                    'order_serialized' => serialize( $order )
			        ) );        
			$order_object->store();
			        // redirigimos
			$Params['Module']->redirectTo( 'basket/payment/' . md5( 'eflbasket' . $basket->attribute( 'productcollection_id' ) ) );	
	}
	
}
elseif ( $http->hasPostVariable( 'BtnRegisterEmpresa' ) )
{
	// validamos
	// además formamos un array con la información de la orden
	$errors = array();
	$order = array();
	
	$doc = new DOMDocument( '1.0', 'utf-8' );
	$root = $doc->createElement( 'order' );
	$facturacion = $doc->createElement( 'facturacion' );
	$order['tipo_usuario'] = 2; // empresa
	$order['email'] = $http->sessionVariable( 'register_email' );
	$order['nombre'] = $http->sessionVariable( 'register_nombre' );
	$order['apellido1'] = $http->sessionVariable( 'register_apellido1' );
	$order['apellido2'] = $http->sessionVariable( 'register_apellido2' );
	$order['pais'] = $http->sessionVariable( 'register_country' );
	
	
	if( $http->postVariable( 'empresa' ) == '' )
	{
		$errors['empresa'] = "El campo 'Nombre de Empresa' es obligatorio";		
	}	
	$tpl->setVariable( 'empresa', $http->postVariable( 'empresa' ) );
	$order['empresa'] = $http->postVariable( 'empresa' );
	
	if( $http->postVariable( 'cif' ) == '' )
	{
		$errors['cif'] = "El campo 'CIF' es obligatorio";		
	}
	elseif( !ezEflUtils::validateCIF( $http->postVariable( 'cif' ) ) )
	{
		$errors['cif'] = "El campo 'CIF' no tiene un formato correcto";
	}
	$tpl->setVariable( 'cif', $http->postVariable( 'cif' ) );
	$order['cif'] = $http->postVariable( 'cif' );
	
	if( $http->postVariable( 'telefono' ) == '' )
	{
		$errors['telefono'] = "El campo 'Teléfono' es obligatorio";		
	}	
    elseif( strlen( $http->postVariable( 'telefono' ) ) > 16  )
    {
       $errors['telefono'] = "El campo 'Teléfono'  de 'Datos de Facturación' no puede tener más de 16 caracteres";		
    }
	$tpl->setVariable( 'telefono', $http->postVariable( 'telefono' ) );
	$order['telefono'] = $http->postVariable( 'telefono' );

    if( ( $http->postVariable( 'movil' ) != '' )  and strlen( $http->postVariable( 'movil' ) ) > 16  )
    {
       $errors['movil'] = "El campo 'Móvil'  de 'Datos de Facturación' no puede tener más de 16 caracteres";		
    }

    if( ( $http->postVariable( 'telefonoEmp' ) != '' )  and ( strlen( $http->postVariable( 'telefonoEmp' )  ) > 16 )  )
    {
       $errors['telefonoEmp'] = "El campo 'Teléfono de empresa' de 'Datos de Facturación' no puede tener más de 16 caracteres";		
    }

      if( ( $http->postVariable( 'fax' ) != '' )  and strlen( $http->postVariable( 'fax' ) ) > 16  )
    {
       $errors['fax'] = "El campo 'Fax' de 'Datos de Facturación' no puede tener más de 16 caracteres";		
    }

	$order['telefono'] = $http->postVariable( 'telefono' );
	$tpl->setVariable( 'telefonoEmp', $http->postVariable( 'telefonoEmp' ) );
	$order['telefonoEmp'] = $http->postVariable( 'telefonoEmp' );
	
	if( ( $http->postVariable( "tipoV" ) == '' ) or ( $http->postVariable( "dir1" ) == '' ) or ( $http->postVariable( "num" ) == '' ) )
	{
		$errors['direccion'] = "El campo 'Dirección' de 'Datos de facturación' es obligatorio";
	}	
	$tpl->setVariable( 'tipovia', $http->postVariable( 'tipoV' ) );
	$order['tipovia'] = $http->postVariable( 'tipoV' );
	
	$tpl->setVariable( 'dir1', $http->postVariable( 'dir1' ) );
	$order['dir1'] = $http->postVariable( 'dir1' );
	
	$tpl->setVariable( 'num', $http->postVariable( 'num' ) );
	$order['num'] = $http->postVariable( 'num' );
	
	if( $http->postVariable( 'provincia' ) == '' )
	{
		$errors['provincia'] = "El campo 'Provincia' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'provincia', $http->postVariable( 'provincia' ) );
	}
	$order['provincia'] = $http->postVariable( 'provincia' );
		
	if( $http->postVariable( 'localidad' ) == '' )
	{
		$errors['localidad'] = "El campo 'Localidad' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'localidad', $http->postVariable( 'localidad' ) );
	}
	$order['localidad'] = $http->postVariable( 'localidad' );	
	
	if( $http->postVariable( 'cp' ) == '' )
	{
		$errors['cp'] = "El campo 'CP' de 'Datos de facturación' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'cp', $http->postVariable( 'cp' ) );
	}
	$order['cp'] = $http->postVariable( 'cp' );
    
    $tpl->setVariable( 'telefonoEmp', $http->postVariable( 'telefonoEmp' ) );
	$order['telefonoEmp'] = $http->postVariable( 'telefonoEmp' );	

    $tpl->setVariable( 'movil', $http->postVariable( 'movil' ) );
	$order['movil'] = $http->postVariable( 'movil' );	

	$tpl->setVariable( 'fax', $http->postVariable( 'fax' ) );
	$order['fax'] = $http->postVariable( 'fax' );
	
	$tpl->setVariable( 'complemento', $http->postVariable( 'complemento' ) );
	$order['complemento'] = $http->postVariable( 'complemento' );
	
	//actua como persona de contacto
	//$tpl->setVariable( 'personaContacto', $http->postVariable( 'personaContacto' ) );
//si los datos de envío no coinciden con facturación hay que validar más cosas
	$tpl->setVariable( 'datos_coinciden', $http->postVariable( 'datos' ) );
	$order['datos_coinciden'] = $http->postVariable( 'datos' );
	if( $http->postVariable( 'datos' ) == 'no' )
	{
		if( $http->postVariable( 'nombre2' ) == '' )
		{
			$errors['nombre2'] = "El campo 'Nombre' de 'Datos de Envío' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'nombre2', $http->postVariable( 'nombre2' ) );
			$order['nombre2'] = $http->postVariable( 'nombre2' );
		}

        if( $http->postVariable( 'apellido12' ) == '' )
		{
			$errors['apellido12'] = "El campo 'Apellido 1' de 'Datos de Envío' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'apellido12', $http->postVariable( 'apellido12' ) );
			$order['apellido12'] = $http->postVariable( 'apellido12' );
		}       
		
		/*if( $http->postVariable( 'cif2' ) == '' )
		{
			$errors['cif2'] = "El campo 'CIF' de 'Datos de Envío' es obligatorio";		
		}
		elseif( !ezEflUtils::validateCIF( $http->postVariable( 'cif2' ) ) )
		{
			$errors['cif2'] = "El campo 'CIF' de 'Datos de Envío' no tiene un formato correcto";
		}
		$tpl->setVariable( 'cif2', $http->postVariable( 'cif2' ) );
		$order['cif2'] = $http->postVariable( 'cif2' );
		*/
		
		if( $http->postVariable( 'telefono2' ) == '' )
	    {
	    	$errors['telefono2'] = "El campo 'Teléfono' es obligatorio";		
    	}	
        elseif( strlen( $http->postVariable( 'telefono2' ) ) > 16  )
        {
           $errors['telefono2'] = "El campo 'Teléfono'  de 'Datos de Envío' no puede tener más de 16   caracteres";		
        }
    	$tpl->setVariable( 'telefono2', $http->postVariable( 'telefono2' ) );
	    $order['telefono2'] = $http->postVariable( 'telefono2' );

        if( ( $http->postVariable( 'movil2' ) != '' )  and strlen( $http->postVariable( 'movil2' ) ) > 16  )
        {
           $errors['movil2'] = "El campo 'Móvil'  de 'Datos de Envío' no puede tener más de 16 caracteres";		
        }
		
		$tpl->setVariable( 'telefonoEmp2', $http->postVariable( 'telefonoEmp2' ) );
		$order['telefonoEmp2'] = $http->postVariable( 'telefonoEmp2' );
		
		$tpl->setVariable( 'fax2', $http->postVariable( 'fax2' ) );
		$order['fax2'] = $http->postVariable( 'fax2' );		
		
		if( ( $http->postVariable( "tipoV2" ) == '' ) or ( $http->postVariable( "dir12" ) == '' ) or ( $http->postVariable( "num2" ) == '' ) )
		{
			$errors['direccion2'] = "El campo 'Dirección' de 'Datos de Envío' es obligatorio";
		}
		
		$tpl->setVariable( 'tipovia2', $http->postVariable( 'tipoV2' ) );
		$order['tipovia2'] = $http->postVariable( 'tipoV2' );
		$tpl->setVariable( 'dir12', $http->postVariable( 'dir12' ) );
		$order['dir12'] = $http->postVariable( 'dir12' );
		$tpl->setVariable( 'num2', $http->postVariable( 'num2' ) );
		$order['num2'] = $http->postVariable( 'num2' );
		
		if( $http->postVariable( 'provincia2' ) == '' )
		{
			$errors['provincia2'] = "El campo 'Provincia' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'provincia2', $http->postVariable( 'provincia2' ) );
			$order['provincia2'] = $http->postVariable( 'provincia2' );
		}
		
		if( $http->postVariable( 'localidad2' ) == '' )
		{
			$errors['localidad2'] = "El campo 'Localidad' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'localidad2', $http->postVariable( 'localidad2' ) );
			$order['localidad2'] = $http->postVariable( 'localidad2' );
		}
		
		if( $http->postVariable( 'cp2' ) == '' )
		{
			$errors['cp2'] = "El campo 'CP' de 'Datos de Envío' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'cp2', $http->postVariable( 'cp2' ) );
			$order['cp2'] = $http->postVariable( 'cp2' );
		}		
		$tpl->setVariable( 'complemento2', $http->postVariable( 'complemento2' ) );
		$order['complemento2'] = $http->postVariable( 'complemento2' );
        
        $tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );
		$order['apellido2'] = $http->postVariable( 'apellido2' );
        
        $tpl->setVariable( 'empresa2', $http->postVariable( 'empresa2' ) );
		$order['empresa2'] = $http->postVariable( 'empresa2' );

        $tpl->setVariable( 'movil2', $http->postVariable( 'movil2' ) );
		$order['movil2'] = $http->postVariable( 'movil2' );
		
		$tpl->setVariable( 'email2', $http->postVariable( 'email2' ) );
        $order['email2'] = $http->postVariable( 'email2' );
        
		
		$tpl->setVariable( 'apellido22', $http->postVariable( 'apellido22' ) );
        $order['apellido22'] = $http->postVariable( 'apellido22' );
	}
	
	if( $http->hasPostVariable( 'cursos' ) )
	{
		$order['cursos'] = array();
		foreach ( explode( ',',  $http->postVariable( 'cursos' ) ) as $curso )
		{
			$tpl->setVariable( 'datosc'. $curso, $http->postVariable( 'datosc' . $curso ) );
			
			if( ( $http->postVariable( 'nombrec' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['nombrec'.$curso] = "El campo 'Nombre' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'nombrec'.$curso, $http->postVariable( 'nombrec' . $curso ) );
			}
			
			if( ( $http->postVariable( 'apellido1c' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['apellido1c'.$curso] = "El campo 'Apellido 1' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'apellido1c'.$curso, $http->postVariable( 'apellido1c' . $curso ) );
			}
			$tpl->setVariable( 'apellido2c'.$curso, $http->postVariable( 'apellido2c' . $curso ) );
			
			if( ( $http->postVariable( 'profesionc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['profesionc'.$curso] = "El campo 'Profesión' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'profesionc'.$curso, $http->postVariable( 'profesionc' . $curso ) );
			}
			$tpl->setVariable( 'cargoc'.$curso, $http->postVariable( 'cargoc' . $curso ) );
			
			if( ( $http->postVariable( 'telefonoc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['telefonoc'.$curso] = "El campo 'Teléfono' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso) . "' es obligatorio";
			}
			else
			{
				$tpl->setVariable( 'telefonoc'.$curso, $http->postVariable( 'telefonoc' . $curso ) );
			}
			
			if( ( $http->postVariable( 'emailc' . $curso ) == '' ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) )
			{
				$errors['emailc' . $curso] = "El campo 'E-mail' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso ) . "' es obligatorio";		
			}
			elseif( ( !eZMail::validate( $http->postVariable( 'emailc' . $curso ) ) and ( $http->postVariable( 'datosc' . $curso ) != 'si' ) ) )
			{
				$errors['emailc' . $curso] = "El campo 'E-mail' del asistente al curso '" . $http->postVariable( 'nombrecurso_' . $curso ) . "' no tiene un formato válido";
			}
			$tpl->setVariable( 'emailc' . $curso, $http->postVariable( 'emailc' . $curso ) );
			
			$tpl->setVariable( 'emailc'.$curso, $http->postVariable( 'emailc' . $curso ) );
			$tpl->setVariable( 'faxc'.$curso, $http->postVariable( 'faxc' . $curso ) );
			$info = array( 'id' => $http->postVariable( 'datosc' . $curso ),
										'nombre' => $http->postVariable( 'nombrecurso_' . $curso),
										'asistente' => array() );			
								
			
			if( $http->postVariable( 'datosc' . $curso ) == 'no' )
			{
				$info['asistente']['nombre'] = 	$http->postVariable( 'nombrec' . $curso );
				$info['asistente']['apellido1'] = 	$http->postVariable( 'apellido1c' . $curso );
				$info['asistente']['apellido2'] = 	$http->postVariable( 'apellido2c' . $curso );
				$info['asistente']['profesion'] = 	$http->postVariable( 'profesionc' . $curso );
				$info['asistente']['cargo'] = 	$http->postVariable( 'cargoc' . $curso );
				$info['asistente']['telefono'] = 	$http->postVariable( 'telefonoc' . $curso );
				$info['asistente']['email'] = 	$http->postVariable( 'emailc' . $curso );
				$info['asistente']['fax'] = 	$http->postVariable( 'faxc' . $curso );
			}
			$order['cursos'][] = $info;	
		}
	}
	
	/*if( !$http->hasPostVariable( 'condiciones') )
	{
		$errors['condiciones'] = 'Debe aceptar las condiciones legales';
	}*/
	
	$tpl->setVariable( 'observaciones', $http->postVariable( 'observaciones' ) );
	$order['observaciones'] = $http->postVariable( 'observaciones' );
	
	if( count( $errors) )
	{
		$tpl->setVariable( 'errors', $errors );
		$Result = array();
		$Result['content'] = $tpl->fetch( 'design:basket/register_empresa.tpl' );
	}
	
	else
	{
		
		// actualizamos datos
		$eflWS = new eflWS();
        if( $http->postVariable( 'datos' ) == 'si' )
        {
        
		    $idUsuario = $eflWS->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),												  
											//   $http->sessionVariable( 'register_nombre' ),
											//   $http->sessionVariable( 'register_apellido1' ),
											//   $http->sessionVariable( 'register_apellido2' ),
											   $http->postVariable( 'telefono' ),
											   $http->postVariable( 'movil' ),											   
                                               $http->postVariable( 'observaciones' ),
                                               $http->sessionVariable( 'register_nombre' ), 
                                               $http->sessionVariable( 'register_apellido1' ),
                                               $http->sessionVariable( 'register_apellido2' ),                                              
                                               $http->postVariable( 'empresa' ),                                               
                                               eZUser::currentUser()->Email,
                                               $http->postVariable( 'telefonoEmp' ),
                                               $http->postVariable( 'movil' ),
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
											   2, // paso dos
											   $http->postVariable( 'cif' ), // nif, que sirve para cif
											   '',
											   $http->postVariable( 'empresa' ), // razón social
											   $http->postVariable( 'telefonoEmp' ),
                                               $http->postVariable( 'movil' ),
											   $http->postVariable( 'fax' ),
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
                                               1									   
											);
						
		}
        else
        {
            $idUsuario = $eflWS->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),												  
											//   $http->sessionVariable( 'register_nombre' ),
											//   $http->sessionVariable( 'register_apellido1' ),
											//   $http->sessionVariable( 'register_apellido2' ),
											   $http->postVariable( 'telefono' ),
											   $http->postVariable( 'movil' ),											  
                                               $http->postVariable( 'observaciones' ),
                                               $http->postVariable( 'nombre2' ), 
                                               $http->postVariable( 'apellido12' ),
                                               $http->postVariable( 'apellido22' ),
                                               $http->postVariable( 'empresa2' ),
                                               $http->postVariable( 'email2' ),
                                               $http->postVariable( 'telefono2' ),
                                               $http->postVariable( 'movil2' ),
											   $http->postVariable( 'tipoV2' ),
											   $http->postVariable( 'dir12' ),
											   $http->postVariable( 'num2' ), 	
											   $http->postVariable( 'complemento2' ),
											   $http->postVariable( 'cp2'),
											   $http->postVariable( 'localidad2'),
											   $http->postVariable( 'provincia2'),
											   $http->sessionVariable( 'register_country' ),
											   2, // paso dos
											   $http->postVariable( 'cif' ), // cif, que sirve para cif
											   '',
                                               $http->postVariable( 'empresa' ),
											   // razón social
											   $http->postVariable( 'telefonoEmp' ),
											   $http->postVariable( 'movil' ),
											   $http->postVariable( 'fax' ),
											   $http->postVariable( 'tipoV' ),
											   $http->postVariable( 'dir1' ),
											   $http->postVariable( 'num' ), 	
											   $http->postVariable( 'complemento' ),
											   $http->postVariable( 'cp'),
											   $http->postVariable( 'localidad'),
											   $http->postVariable( 'provincia'),
											   $http->sessionVariable( 'register_country' ),
                                               0									   
											);
        }
				// por si acaso, llamo también a setEmpresaDatos

		  /* $idEmpresa = $eflWS->setEmpresaDatos( $http->sessionVariable( 'id_empresa_lfbv' ),
		     									  $http->postVariable( 'telefono' ),
												  $http->postVariable( 'fax' ),
												  $http->postVariable( 'tipoV' ),
												  $http->postVariable( 'dir1' ),
												  $http->postVariable( 'num' ), 	
												  $http->postVariable( 'complemento' ),
			 									  $http->postVariable( 'cp'),
												  $http->postVariable( 'localidad'),
												  $http->postVariable( 'provincia'),
												  $http->sessionVariable( 'register_country' )				    									
				    					);								
											*/
					 
			//guardamos la orden;
			$basket = eZBasket::currentBasket();
			if( $basket->OrderID == 0 )
            {
    			$shoporder = $basket->createOrder();
            }
            else
            {
                $shoporder = eZOrder::fetch( $basket->OrderID );
                
            }
			$http->setSessionVariable( 'MyTemporaryOrderID', $shoporder->attribute( 'id' ) );
			$infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => $basket->attribute( 'productcollection_id') ) );
            $unserialized_order = unserialize($infoOrder->Order);
            if( $unserialized_order['has_nautis4'] )
            {
                $order['has_nautis4'] = $unserialized_order['has_nautis4'];                
            }
            if( $unserialized_order['has_mementix'] )
            {
                $order['has_mementix'] = $unserialized_order['has_mementix'];                
            }
			if( $unserialized_order['has_imemento'] )
			{
				$order['has_imemento'] = $unserialized_order['has_imemento'];
            }
            $order['codigopromocional'] = $unserialized_order['codigopromocional'];
            $order['productos_bono'] = $unserialized_order['productos_bono'];
            $order['descuento'] = $unserialized_order['descuento'];       
			$order_object = new eflOrders( array( 
			                                    'productcollection_id' => $basket->attribute( 'productcollection_id' ),
			                                    'order_serialized' => serialize( $order )
			        ) );        
			$order_object->store();
			$Params['Module']->redirectTo( 'basket/payment/' . md5( 'eflbasket' . $basket->attribute( 'productcollection_id' ) ) );	
	}
	
}
elseif( $http->hasPostVariable( 'BtnRegisterOutside') )
{
	$errors = array();
	$order = array();
	
	/*if( $http->postVariable( 'empresa' ) == '' )
	{
		$errors['nombre'] = "El campo 'Empresa' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'empresa', $http->postVariable( 'empresa' ) );
	}
	$order['empresa'] = $http->postVariable( 'empresa' );*/
	
	if( $http->postVariable( 'nombre' ) == '' )
	{
		$errors['nombre'] = "El campo 'Nombre' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'nombre', $http->postVariable( 'nombre' ) );
	}
	$order['nombre'] = $http->postVariable( 'nombre' );
	
	if( $http->postVariable( 'apellido1' ) == '' )
	{
		$errors['apellido1'] = "El campo 'Apellido1' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'apellido1', $http->postVariable( 'apellido1' ) );
	}
	$tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );
	$order['apellido1'] = $http->postVariable( 'apellido1' );
	$order['apellido2'] = $http->postVariable( 'apellido2' );

	if( $http->postVariable( 'telefono' ) == '' )
	{
		$errors['telefono'] = "El campo 'Teléfono' es obligatorio";		
	}
	else
	{
		$tpl->setVariable( 'telefono', $http->postVariable( 'telefono' ) );
	}
	$order['telefono'] = $http->postVariable( 'telefono' );	
	
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
	$order['email'] = $http->postVariable( 'email' );	
	$tpl->setVariable( 'pais', $http->postVariable( 'pais' ) );
	$order['pais'] = $http->postVariable( 'pais' );
	
	$tpl->setVariable( 'observaciones', $http->postVariable( 'observaciones' ) );
	$order['observaciones'] = $http->postVariable( 'observaciones' );
	
	/*if( !$http->hasPostVariable( 'condiciones') )
	{
		$errors['condiciones'] = 'Debe aceptar las condiciones legales';
	}*/
	
	if( count( $errors) )
	{
		$tpl->setVariable( 'errors', $errors );
		$Result = array();
		$Result['content'] = $tpl->fetch( 'design:basket/register_outside.tpl' );
	}	
	else
	{
		//guardamos la orden;
			$basket = eZBasket::currentBasket();
            
			if( $basket->OrderID == 0 )
            {
    			$shoporder = $basket->createOrder();
            }
            else
            {
                $shoporder = eZOrder::fetch( $basket->OrderID );
                
            }
			$http->setSessionVariable( 'MyTemporaryOrderID', $shoporder->attribute( 'id' ) );       
			$order_object = new eflOrders( array( 
			                                    'productcollection_id' => $shoporder->attribute( 'productcollection_id' ),
			                                    'order_serialized' => serialize( $order )
			        ) );
			        
			$order_object->store();
			$Params['Module']->redirectTo( 'basket/outside');	
	}	
	
	
}
else
{
	$Result = array();
	$Result['content'] = $tpl->fetch( 'design:basket/register.tpl' );
}


?>
