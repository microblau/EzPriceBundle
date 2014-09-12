<?php 
class eZUtilsUser extends eZUser
{
   /**
	* Constructor
	*
	*/
	function eZUtilsUser()
	{
	
	}
 
	/**
	 * Reimplementación del login
	 * 
	 * 
	 */
	static function loginUser( $login, $password, $authenticationMatch = false )
	{
        die( 'x');
	   $eflWS = new eflWS();
	   $respuesta = $eflWS->validaUsuario( $login, $password );
	   
	   // si la respuesta es 1 tenemos que 
	   // a) crear al usuario en el eZ
	   // b) modificar el usuario si éste ya existe
	   if( is_numeric( $respuesta ) and ( $respuesta != 0 ) )
	   {
         
           $datos = $eflWS->getUsuarioCompleto( $respuesta );
           $cod_colectivo = (string)$datos->usuario->cod_colectivo;
		   
		   // Con el id_usuario($respuesta) busco el producto sugerido
		   $respuesta_prod_sugerido = $eflWS->validaUsuarioProdSugerido( $respuesta );
		   
	   	   $http = eZHTTPTool::instance();
	   	   $http->setSessionVariable( 'id_user_lfbv', $respuesta  ); // guardamos el id del usuario en sesión
		   $http->setSessionVariable( 'cd_prod_sugerido', $respuesta_prod_sugerido  ); // guardamos código de producto sugerido en sesión
	   	   $ini = eZINI::instance();
	   	   $createNewUser = true;
	       $existUser = eZUser::fetchByEmail( $login );	
           /* get colectivo */
           $colectivo = eZContentObjectTreeNode::subTreeByNodeID( 
                                    array( 'ClassFilterType' => 'include',
                                           'ClassFilterInculde' => array( 3 ),
                                           'Limitation' => array(),
                                           'AttributeFilter' => array( array( 984 , '=', strtolower( $cod_colectivo ) ) ) ), 5
                    );   
           $placement = null;
           if( $colectivo[0] )
           {
              $placement = $colectivo[0]->attribute( 'node_id' );
           }
	       if ( $existUser != null )
	       {
	           $createNewUser = false;
	       }
	       if ( $createNewUser )
	       {
	            $userClassID = $ini->variable( "UserSettings", "UserClassID" );
	            $userCreatorID = $ini->variable( "UserSettings", "UserCreatorID" );
	            $defaultSectionID = $ini->variable( "UserSettings", "DefaultSectionID" );
	            $defaultUserPlacement = ( $placement != null ) ? $placement : $ini->variable( "UserSettings", "DefaultUserPlacement" );
	
	            $remoteID = "EFLWeb_" . $login;
	            $contentObject = eZContentObject::fetchByRemoteID( $remoteID );
	            if ( !is_object( $contentObject ) )
	            {
	                $class = eZContentClass::fetch( $userClassID );
	                $contentObject = $class->instantiate( $userCreatorID, $defaultSectionID );
	            }
	            // The content object may already exist if this process has failed once before, before the eZUser object was created.
	            // Therefore we try to fetch the eZContentObject before instantiating it.                            
	            $contentObject->setAttribute( 'remote_id', $remoteID );
	            $contentObject->store();
	            
	            $contentObjectID = $contentObject->attribute( 'id' );
	            $userID = $contentObjectID;
	            $nodeAssignment = eZNodeAssignment::create( array( 'contentobject_id' => $contentObjectID,
	                                                                               'contentobject_version' => 1,
	                                                                               'parent_node' => $defaultUserPlacement,
	                                                                               'is_main' => 1 ) );
	            
	            $nodeAssignment->store();
	            $version = $contentObject->version( 1 );
	            $version->setAttribute( 'modified', time() );
	            $version->setAttribute( 'status', eZContentObjectVersion::STATUS_DRAFT );
	            $version->store();
	
	            $contentObjectID = $contentObject->attribute( 'id' );
	            $contentObjectAttributes = $version->contentObjectAttributes();
	            
	            $contentObjectAttributes[0]->setAttribute( 'data_text', $login );
	            $contentObjectAttributes[0]->store();
	          
	            $user = eZUser::create( $userID );
	          
	            $user->setAttribute( 'login', $login );
	            $user->setAttribute( 'email', $login );
	            $user->setAttribute( 'password_hash', "" );
	            $user->setAttribute( 'password_hash_type', 0 );
	            $user->store();
	           
	            eZUser::updateLastVisit( $userID );	            
	            eZUser::setCurrentlyLoggedInUser( $user, $userID );
                $basket = eZBasket::currentBasket();
                //print_r( $basket );
               // die();
	            
	
	                            // Reset number of failed login attempts
	            eZUser::setFailedLoginAttempts( $userID, 0 );
	
	            $operationResult = eZOperationHandler::execute( 'content', 'publish', array( 'object_id' => $contentObjectID,
	                                                                                                         'version' => 1 ) );
                
	            return $user;
	       }
	       else
	       {
	       	   $basketini = eZIni::instance( 'basket.ini' );
	       	   $userClassID = $ini->variable( "UserSettings", "UserClassID" );
               $userCreatorID = $ini->variable( "UserSettings", "UserCreatorID" );
               $defaultSectionID = $ini->variable( "UserSettings", "DefaultSectionID" );
               $defaultUserPlacement = ( $placement != null ) ? $placement : $ini->variable( "UserSettings", "DefaultUserPlacement" );
    die( 'h');
	           // actualizamos
	           $userID = $existUser->attribute( 'contentobject_id' );
               $contentObject = eZContentObject::fetch( $userID );
			   
               $parentNodeID = $contentObject->attribute( 'main_parent_node_id' );
               $currentVersion = $contentObject->attribute( 'current_version' );

               $version = $contentObject->attribute( 'current' );
               $contentObjectAttributes = $version->contentObjectAttributes();
               // aquí actualizaremos datos cuando tengamos
               
               $existUser = eZUser::fetch(  $userID );
               $existUser->setAttribute('email', $login );
               $existUser->setAttribute('password_hash', "" );
               $existUser->setAttribute('password_hash_type', 0 );
               $existUser->store();

               if ( $defaultUserPlacement != $parentNodeID )
               {
                  
                    
                   /* $newVersion = $contentObject->createNewVersion();
                    $newVersion->assignToNode( $defaultUserPlacement, 1 );
                    $assings = $newVersion->nodeAssignments();
                       
       
                    $newVersion->removeAssignment( $parentNodeID );
                    $newVersionNr = $newVersion->attribute( 'version' );
                    $operationResult = eZOperationHandler::execute( 'content', 'publish', array( 'object_id' => $userID,
                                                                                        'version' => $newVersionNr ) );*/
                    $contentObject = eZContentObject::fetch( $userID );

                    if ( eZOperationHandler::operationIsAvailable( 'content_move' ) )
                    {
                        $operationResult = eZOperationHandler::execute( 'content',
                                                                        'move', array( 'node_id'            => $contentObject->attribute( 'main_node_id' ),
                                                                                       'object_id'          => $contentObject->attribute( 'id' ),
                                                                                       'new_parent_node_id' => $defaultUserPlacement ),
                                                                        null,
                                                                        true );
                    }
                    else
                    {                        
                        eZContentOperationCollection::moveNode( $contentObject->attribute( 'main_node_id' ), $contentObject->attribute( 'id' ), $defaultUserPlacement );
                    }
                    
               }
               
               eZUser::updateLastVisit( $userID );
          
               eZUser::setCurrentlyLoggedInUser( $existUser, $userID );

               // Reset number of failed login attempts
               eZUser::setFailedLoginAttempts( $userID, 0 );
                      
               return $existUser; 
	       }
       } 
       else
       {
            if ( isset( $existUser->ID ) )
                eZUser::setFailedLoginAttempts( $existUser->ID );
		
            return false;
       }     
	   
	   
	 
	   return $user;
    }
}

 
