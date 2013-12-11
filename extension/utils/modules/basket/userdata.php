<?php
$tpl = eZTemplate::factory();
$user = eZUser::currentUser();
$email = $user->attribute( 'login' );

$eflws = new eflWS();
$existeUsuario = $eflws->existeUsuario( $email );

$tpl = eZTemplate::factory();

$http = eZHTTPTool::instance();

$infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => eZBasket::currentBasket()->attribute( 'productcollection_id') ) );
                $unserialized_order = unserialize($infoOrder->Order) ;

if ( $existeUsuario == 0 )
{
	// error
	// no puede acceder aquí
	return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}
else
{
	$usuario_empresa = $eflws->getUsuarioCompleto( $existeUsuario );

    
 	$usuario = $usuario_empresa->xpath( '//usuario' );
	
	$empresa = $usuario_empresa->xpath( '//empresa' );
	if ( $http->hasPostVariable( 'BtnContinuar' ) )
	{
		$errors = array();
		$order = array();		
		$order['email'] = $email;
		$order['pais'] =  (string)$usuario[0]->direnvio_id_pais;
		$order['tipo_usuario'] =  ( (string)$usuario[0]->tipo_usuario == '1' ) ? 1 : 2;
		if( ( $http->postVariable( 'nombre' ) == '' ) and ( $http->postVariable( 'tipo') == 1 )  ) 
		{
			$errors['nombre'] = "El campo 'Nombre' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'nombre', $http->postVariable( 'nombre' ) );
		}
		$order['nombre'] = $http->postVariable( 'nombre' );
		
		if( ( $http->postVariable( 'apellido1' ) == '' ) and  ( $http->postVariable( 'tipo') == 1 )  ) 
		{
			$errors['apellido1'] = "El campo 'Apellido 1' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'apellido1', $http->postVariable( 'apellido1' ) );
		}
		$order['apellido1'] = $http->postVariable( 'apellido1' );
		/*
		if( $http->postVariable( 'apellido2' ) == '' )
		{
			$errors['apellido2'] = "El campo 'Apellido 2' es obligatorio";		
		}	
		else
		{
			$tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );
		}*/
		$tpl->setVariable( 'apellido2', $http->postVariable( 'apellido2' ) );
		$tpl->setVariable( 'email', $http->postVariable( 'email' ) );
		$order['apellido2'] = $http->postVariable( 'apellido2' );
		$order['apellido2'] = $http->postVariable( 'apellido2' );
		
		if( ( $http->postVariable( 'nif' ) == '' )  and ( $http->postVariable( 'tipo') == 1 )  ) 
		{
			$errors['nif'] = "El campo 'NIF' es obligatorio";		
		}
		elseif( ( !ezEflUtils::validateNIF( $http->postVariable( 'nif' ) ) )  and ( $http->postVariable( 'tipo') == 1 )  ) 
		{
			$errors['nif'] = "El campo 'NIF' no tiene un formato correcto";
		}
		$tpl->setVariable( 'nif', $http->postVariable( 'nif' ) );
		$order['nif'] = $http->postVariable( 'nif' );
		
		
		
		if( ( $http->postVariable( 'empresa' ) == '' ) and ( $http->postVariable( 'tipo') == 2 )  ) 
		{
            $errors['nombre'] = "El campo 'Nombre de Empresa' es obligatorio";     
        }   
        else
        {
            $tpl->setVariable( 'empresa', $http->postVariable( 'empresa' ) );
        }
        $order['empresa'] = $http->postVariable( 'empresa' );
        
        if( ( $http->postVariable( 'cif' ) == '' )  and ( $http->postVariable( 'tipo') == 2 )  ) 
        {
            $errors['cif'] = "El campo 'CIF' de Datos de Facturación es obligatorio";       
        }
        elseif( ( !ezEflUtils::validateCIF( $http->postVariable( 'cif' ) ) )  and ( $http->postVariable( 'tipo') == 2 )  ) 
        {
            $errors['cif'] = "El campo 'CIF' de Datos de Facturación no tiene un formato correcto";
        }
        $tpl->setVariable( 'cif', $http->postVariable( 'cif' ) );
        $order['cif'] = $http->postVariable( 'cif' );
		
		
		if( $http->postVariable( 'telefono' ) == '' )
		{
			$errors['telefono'] = "El campo 'Teléfono' es obligatorio";		
		}	
		elseif( strlen( $http->postVariable( 'telefono' ) ) > 16 )
		{
			$errors['telefono'] = "El campo 'Teléfono' no puede tener más de 16 caracteres";	
		}

        $tpl->setVariable( 'tlf', $http->postVariable( 'telefono' ) );
    	$order['telefono'] = $http->postVariable( 'telefono' );

        if( ( $http->postVariable( 'telefonoEmp' ) != '' )  and strlen( $http->postVariable( 'telefonoEmp' ) ) > 16  )
        {
           $errors['telefonoEmp'] = "El campo 'Teléfono de Empresa'  de 'Datos de Facturación' no puede tener más de 16 caracteres";		
        }

        if( ( $http->postVariable( 'movil' ) != '' )  and strlen( $http->postVariable( 'movil' ) ) > 16  )
        {
           $errors['movil'] = "El campo 'Móvil'  de 'Datos de Facturación' no puede tener más de 16 caracteres";		
        }

        

        if( ( $http->postVariable( 'fax' ) != '' )  and strlen( $http->postVariable( 'fax' ) ) > 16  )
        {
           $errors['fax'] = "El campo 'Fax'  de 'Datos de Facturación' no puede tener más de 16 caracteres";		
        }

       
        $tpl->setVariable( 'tlf_empresa', $http->postVariable( 'telefonoEmp' ) );
		$order['telefono_emp'] = $http->postVariable( 'telefonoEmp' );

		$tpl->setVariable( 'movil', $http->postVariable( 'movil' ) );
		$order['movil'] = $http->postVariable( 'movil' );
		
		$tpl->setVariable( 'fax', $http->postVariable( 'fax' ) );
        $order['fax'] = $http->postVariable( 'fax' );
		
		if( ( $http->postVariable( "tipoV" ) == '' ) or ( $http->postVariable( "dir1" ) == '' ) or ( $http->postVariable( "num" ) == '' ) )
		{
			$errors['direccion'] = "El campo 'Dirección' de 'Datos de facturación' es obligatorio";
		}	
		$tpl->setVariable( 'dir_tipo', $http->postVariable( 'tipoV' ) );
		$order['tipovia'] = $http->postVariable( 'tipoV' );
		
		$tpl->setVariable( 'dir_nombre', $http->postVariable( 'dir1' ) );
		$order['dir1'] = $http->postVariable( 'dir1' );
		
		$tpl->setVariable( 'dir_num', $http->postVariable( 'num' ) );
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
			$tpl->setVariable( 'dir_localidad', $http->postVariable( 'localidad' ) );
		}
		$order['localidad'] = $http->postVariable( 'localidad' );	
		
		if( $http->postVariable( 'cp' ) == '' )
		{
			$errors['cp'] = "El campo 'CP' de 'Datos de facturación' es obligatorio";		
		}
		else
		{
			$tpl->setVariable( 'dir_cpostal', $http->postVariable( 'cp' ) );
		}
		$order['cp'] = $http->postVariable( 'cp' );
	    
		
		$tpl->setVariable( 'fax', $http->postVariable( 'fax' ) );
		$order['fax'] = $http->postVariable( 'fax' );
		
		$tpl->setVariable( 'dir_resto', $http->postVariable( 'complemento' ) );
		$order['complemento'] = $http->postVariable( 'complemento' );
		
		//si los datos de envío no coinciden con facturación hay que validar más cosas
		$tpl->setVariable( 'datos_coinciden', $http->postVariable( 'datos' ) );
		$order['datos_coinciden'] = $http->postVariable( 'datos' );
		$order['nombre2'] = $http->postVariable( 'nombre2' );
		$order['apellido12'] = $http->postVariable( 'apellido12' );
		$order['apellido22'] = $http->postVariable( 'apellido22' );
		$order['empresa2'] = $http->postVariable( 'empresa2' );
		$order['telefono2'] = $http->postVariable( 'telefono2' );
		$order['movil2'] = $http->postVariable( 'movil2' );
		$order['email2'] = $http->postVariable( 'email2' );
		$order['tipovia2'] = $http->postVariable( 'tipoV2' );
		$order['dir12'] = $http->postVariable( 'dir12' );
		$order['num2'] = $http->postVariable( 'num2' );
		$order['provincia2'] = $http->postVariable( 'provincia2' );
		$order['localidad2'] = $http->postVariable( 'localidad2' );
		$order['cp2'] = $http->postVariable( 'cp2' );
		$order['complemento2'] = $http->postVariable( 'complemento2' );

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
			
			$tpl->setVariable( 'empresa2', $http->postVariable( 'empresa2' ) );
            $order['empresa2'] = $http->postVariable( 'empresa2' );
			
			/*if( $http->postVariable( 'nif2' ) == '' )
			{
				$errors['nif2'] = "El campo 'NIF' de 'Datos de Envío' es obligatorio";		
			}
			elseif( !ezEflUtils::validateNIF( $http->postVariable( 'nif2' ) ) )
			{
				$errors['nif2'] = "El campo 'NIF' de 'Datos de Envío' no tiene un formato correcto";
			}
			$tpl->setVariable( 'nif2', $http->postVariable( 'nif2' ) );
			$order['nif2'] = $http->postVariable( 'nif2' );*/
			
			
			if( $http->postVariable( 'telefono2' ) == '' )
		    {
			    $errors['telefono2'] = "El campo 'Teléfono' de 'Datos de Envío' es obligatorio";		
		    }	
		    elseif( strlen( $http->postVariable( 'telefono2' ) ) >  16  )
		    {
			    $errors['telefono2'] = "El campo 'Teléfono' de 'Datos de Envío' no puede tener más de 16 caracteres";					
		    }
            $tpl->setVariable( 'telefono2', $http->postVariable( 'telefono2' ) );
			$order['telefono2'] = $http->postVariable( 'telefono2' );
            if( ( $http->postVariable( 'movil2' ) != '' )  and strlen( $http->postVariable( 'movil2' ) ) > 16  )
            {
               $errors['movil2'] = "El campo 'Móvil'  de 'Datos de Envío' no puede tener más de 16 caracteres";		
            }

			
			$tpl->setVariable( 'movil2', $http->postVariable( 'movil2' ) );
            $order['movil2'] = $http->postVariable( 'movil2' );
			/*
			if( ( $http->postVariable( 'email2' ) == '' ) and ( $http->postVariable( 'tipo') == 1 ) )
			{
				$errors['email2'] = "El campo 'E-mail' de 'Datos de Envío' es obligatorio";		
			}
			elseif( ( !eZMail::validate( $http->postVariable( 'email2' ) ) )  and ( $http->postVariable( 'tipo') == 1 ) )
			{
				$errors['email2'] = "El campo 'E-mail' de 'Datos de Envío' no tiene un formato correcto";
			}*/
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
					$info['asistente']['cargo'] =  $http->postVariable( 'cargoc' . $curso );
					$info['asistente']['profesion'] = 	$http->postVariable( 'profesionc' . $curso );
					$info['asistente']['telefono'] = 	$http->postVariable( 'telefonoc' . $curso );
					$info['asistente']['email'] = 	$http->postVariable( 'emailc' . $curso );
					$info['asistente']['fax'] = 	$http->postVariable( 'faxc' . $curso );
				}
				$order['cursos'][] = $info;
				
				
				
				
			}
			
		}
		
		if( !$http->hasPostVariable( 'condiciones') )
		{
			$errors['condiciones'] = 'Debe aceptar las condiciones legales';
		}
                
                if( !$http->hasPostVariable( 'avisolegal') )
		{
			$errors['avisolegal'] = 'Debe aceptar la política de privacidad y el aviso legal';
		}
		
		
		$tpl->setVariable( 'observaciones', $http->postVariable( 'observaciones' ) );
		$order['observaciones'] = $http->postVariable( 'observaciones' );
		
		
		$a =  ( ( $http->postVariable( 'tipoV' ) == $http->postVariable( 'tipoV2' ) ) and 
             ( $http->postVariable( 'dir1' ) == $http->postVariable( 'dir1' ) ) and
             ( $http->postVariable( 'num' ) == $http->postVariable( 'num2' ) ) and
             ( $http->postVariable( 'complemento' ) == $http->postVariable( 'complemento2' ) ) and
             ( $http->postVariable( 'cp' ) == $http->postVariable( 'cp2' ) ) and ( $http->postVariable( 'datos' ) == 'si' ) );
             
             $tpl->setVariable( 'datos_coinciden', $a );
		
		if( count( $errors) )
		{
			$tpl->setVariable( 'errors', $errors );
			$Result = array();
			if( (int)$usuario[0]->tipo_usuario == 1 )
                $Result['content'] = $tpl->fetch( "design:basket/userdata.tpl" );
            else
                $Result['content'] = $tpl->fetch( "design:basket/userdata_empresa.tpl" );
		}
		else
		{
			
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
				
				//debemos hacer llamada a setUsuarioPaso2
		if( (int)$usuario[0]->tipo_usuario == 1 )
		{
			//seteamos user
		
			if( $http->postVariable( 'datos' ) == 'si' )
	        {
	        	
	            $idUsuario = $eflws->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),                                               
	                                            //   $http->sessionVariable( 'register_nombre' ),
	                                            //   $http->sessionVariable( 'register_apellido1' ),
	                                            //   $http->sessionVariable( 'register_apellido2' ),
	                                               $http->postVariable( 'telefono' ),
	                                               $http->postVariable( 'movil' ),	                                               
	                                               $http->postVariable( 'observaciones' ),
	                                               $http->postVariable( 'nombre' ), 
	                                               $http->postVariable( 'apellido1' ),
	                                               $http->postVariable( 'apellido2' ),
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
	                                               'ES',
	                                               2, // paso dos
	                                               $http->postVariable( 'nif' ), // nif, que sirve para cif
	                                               '',
	                                               $http->postVariable( 'nombre' ). ' ' .  $http->postVariable( 'apellido1' ) . ' ' .$http->postVariable( 'apellido2' ) , // razón social
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
	                                               'ES',
                                                    1                                    
	                                            );
	                        
	        }
	        else
	        {
	        	
	            $idUsuario = $eflws->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),                                               
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
	                                               'ES',
	                                               2, // paso dos
	                                               $http->postVariable( 'nif' ), // nif, que sirve para cif
	                                               '',
	                                               $http->postVariable( 'nombre' ). ' ' .  $http->postVariable( 'apellido1' ) . ' ' .$http->postVariable( 'apellido2' ) , // razón social
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
	                                               'ES',
                                                    0                                     
	                                            );
	        }
		}	
		else
		{
			//EMPRESA
           
           if( $http->postVariable( 'datos' ) == 'si' )
        {
        	
             
            $idUsuario = $eflws->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),                                               
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
                                               eZUser::currentUser()->attribute( 'email' ),
                                               $http->postVariable( 'telefono2' ),
                                               $http->postVariable( 'movil2' ),
                                               
                                               $http->postVariable( 'tipoV' ),
                                               $http->postVariable( 'dir1' ),
                                               $http->postVariable( 'num' ),    
                                               $http->postVariable( 'complemento' ),
                                               $http->postVariable( 'cp'),
                                               $http->postVariable( 'localidad'),
                                               $http->postVariable( 'provincia'),
                                               'ES',
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
                                               'ES',           
                                                1                          
                                            );
                        
        }
        else
        {

            $idUsuario = $eflws->setUsuarioDatosPaso2( $http->sessionVariable( 'id_user_lfbv'),                                               
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
                                               'ES',
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
                                              'ES',
                                               0                                      
                                            );
        }
                // por si acaso, llamo también a setEmpresaDatos
           /*
           $idEmpresa = $eflws->setEmpresaDatos( $http->sessionVariable( 'id_empresa_lfbv' ),
                                                  $http->postVariable( 'telefono' ),
                                                  $http->postVariable( 'fax' ),
                                                  $http->postVariable( 'tipoV' ),
                                                  $http->postVariable( 'dir1' ),
                                                  $http->postVariable( 'num' ),     
                                                  $http->postVariable( 'complemento' ),
                                                  $http->postVariable( 'cp'),
                                                  $http->postVariable( 'localidad'),
                                                  $http->postVariable( 'provincia'),
                                                  'ES'                                                      
                                        );         */                 
        
		
        }		
        $Params['Module']->redirectTo( 'basket/payment/' . md5( 'eflbasket' . $basket->attribute( 'productcollection_id' ) ) );	
        }			
        	
        
	}
	else
	{		
		$tpl->setVariable( 'nombre', (string)$usuario[0]->nombre );
		$tpl->setVariable( 'apellido1', (string)$usuario[0]->apellido1 );
		$tpl->setVariable( 'apellido2', (string)$usuario[0]->apellido2 );
		$tpl->setVariable( 'email', (string)$usuario[0]->email ); 
		$tpl->setVariable( 'empresa', (string)$empresa[0]->razonsocial ); 
		$tpl->setVariable( 'nif', (string)$empresa[0]->cif );
		$tpl->setVariable( 'cif', (string)$empresa[0]->cif );
		if( (int)$usuario[0]->tipo_usuario == 1 )
		{			
		  $tpl->setVariable( 'tlf', (string)$usuario[0]->tlf );
		  $tpl->setVariable( 'movil', (string)$usuario[0]->tlfmovil );
		}
		else
		{
		  $tpl->setVariable( 'tlf', (string)$usuario[0]->tlf );
          $tpl->setVariable( 'movil', (string)$usuario[0]->tlfmovil );
		}
		$tpl->setVariable( 'tlf_empresa', (string)$empresa[0]->tlf );
		$tpl->setVariable( 'fax', (string)$empresa[0]->fax );	
		$tpl->setVariable( 'dir_tipo', (string)$empresa[0]->dir_tipo );
		$tpl->setVariable( 'dir_nombre', (string)$empresa[0]->dir_nombre );
		$tpl->setVariable( 'dir_num', (string)$empresa[0]->dir_numero );
		$tpl->setVariable( 'dir_resto', (string)$empresa[0]->dir_resto );
		$tpl->setVariable( 'dir_cpostal', (string)$empresa[0]->dir_cpostal );
		$tpl->setVariable( 'dir_localidad', (string)$empresa[0]->dir_localidad );
		$tpl->setVariable( 'provincia', (string)$empresa[0]->dir_provincia );
		$tpl->setVariable( 'dir_id_pais', (string)$empresa[0]->dir_id_pais );
		$c1 = ( (string)$empresa[0]->dir_tipo == (string)$usuario[0]->direnvio_tipo ) ;
		$c2 = ( (string)$empresa[0]->dir_numero == (string)$usuario[0]->direnvio_numero );
		$c3 = ( (string)$empresa[0]->dir_nombre == (string)$usuario[0]->direnvio_nombre );
		$c4 = ( (string)$empresa[0]->dir_resto == (string)$usuario[0]->direnvio_resto );
		$c5 = ( (string)$empresa[0]->dir_cpostal == (string)$usuario[0]->direnvio_cpostal );
		$a =  ( $c1 and $c2 and $c3 and $c4 and $c5 );
	  
		$tpl->setVariable( 'datos_coinciden', $a );		
		$tpl->setVariable( 'nombre2', (string)$usuario[0]->direnvio_nombre_pers );
		$tpl->setVariable( 'apellido12', (string)$usuario[0]->direnvio_apellido1 );
		$tpl->setVariable( 'apellido22', (string)$usuario[0]->direnvio_apellido2 );
		$tpl->setVariable( 'empresa2', (string)$usuario[0]->direnvio_empresa );
		$tpl->setVariable( 'telefono2', (string)$usuario[0]->direnvio_tlf );
		$tpl->setVariable( 'movil2', (string)$usuario[0]->direnvio_tlfmovil );
		$tpl->setVariable( 'email2', (string)$usuario[0]->direnvio_email );
		$tpl->setVariable( 'fax2', (string)$usuario[0]->fax );
		$tpl->setVariable( 'tipovia2', (string)$usuario[0]->direnvio_tipo );
		$tpl->setVariable( 'dir12', (string)$usuario[0]->direnvio_nombre );
		$tpl->setVariable( 'num2', (string)$usuario[0]->direnvio_numero );
		$tpl->setVariable( 'complemento2', (string)$usuario[0]->direnvio_resto );		
		$tpl->setVariable( 'provincia2', (string)$usuario[0]->direnvio_provincia );
		$tpl->setVariable( 'localidad2', (string)$usuario[0]->direnvio_localidad );
		$tpl->setVariable( 'cp2', (string)$usuario[0]->direnvio_cpostal);
		$Result = array();
		if( (int)$usuario[0]->tipo_usuario == 1 )
		  $Result['content'] = $tpl->fetch( "design:basket/userdata.tpl" );
		  else
		  $Result['content'] = $tpl->fetch( "design:basket/userdata_empresa.tpl" );
		$Result['path'] = array( array( 'url' => false,
		                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
	}
}


?>
