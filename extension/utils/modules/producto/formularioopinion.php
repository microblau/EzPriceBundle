<?php 

$tpl = eZTemplate::factory();
$http=eZHTTPTool::instance();
$errors = array();

$fecha=time();


$user = eZUser::currentUser();
$email = $user->attribute( 'login' );

$eflws = new eflWS();
$existeUsuario = $eflws->existeUsuario( $email );

if ( $existeUsuario == 0 )
{
	print 'no existe usuario';
}
else
{
	$usu = $eflws->getUsuarioCompleto( $existeUsuario );
	$usuario=$usu->xpath( '//usuario' );
		
	$nombre= (string)$usuario[0]->nombre;
	$ape1= (string)$usuario[0]->apellido1;
	$empresa= (string)$usuario[0]->direnvio_empresa;
}



if (isset($_POST['enviar'])){
	
		if ( ($http->hasPostVariable('star1')) && ($http->PostVariable('star1') != '') ){
			$calidad=$http->PostVariable('star1');
		}else{
			$errors['calidad']="Debes rellenar calidad";
			}

		if ( ($http->hasPostVariable('star2')) && ($http->PostVariable('star2') != '') ){	
			$actualizaciones=$http->PostVariable('star2');
		}else{
			$errors['actualizaciones']="Debes rellenar actualizaciones";
			}
	
		if ( ($http->hasPostVariable('star3')) && ($http->PostVariable('star3') != '') ){	
			$facilidad=$http->PostVariable('star3');
		}else{
			$errors['facilidad']="Debes rellenar facilidad";
			}	
		if ( ($http->hasPostVariable('opinion')) && ($http->PostVariable('opinion') != '') ){	
			$opinion=$http->PostVariable('opinion');
		}

		$node_id=$http->PostVariable('node_id');
		$user_id=$http->PostVariable('user_id');
		
		
	
	/*print 'calidad'.$calidad;
	print '<br />';
	print 'actualizaciones'.$actualizaciones;
	print '<br />';
	print 'facilidad'.$facilidad;
	print '<br />';

	print 'node_id'.$node_id;
	print '<br />';

	print 'user_id'.$user_id;
	print '<br />';
*/

}

	if (count($errors) > 0){
		$tpl->setVariable( 'errors',  $errors );
		$tpl->setVariable( 'user_id',  $user_id );
		$tpl->setVariable( 'nodeid',  $node_id );
		print $tpl->fetch( "design:ajax/formularioopinion.tpl" );
		eZExecution::cleanExit();
	}else{

		$db = eZDB::instance();
        $db->query( "INSERT INTO valoraciones_productos ( user_id , node_producto , ha_votado , calidad , actualizaciones , facilidad , comentario, visible ,fecha ,nombre, apellidos ,empresa ) 
		VALUES (".$user_id.",". $node_id.", 1 ,".$calidad." , ".$actualizaciones." , ".$facilidad.",'". $opinion."' ,2,".$fecha." , '".$nombre."','".$ape1."','".$empresa."')");
		print $tpl->fetch( "design:confirmacionopinion.tpl" );
		
		

		
		eZExecution::cleanExit();
	}


?>