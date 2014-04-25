<?php

$direcc =$_SERVER['HTTP_REFERER'];
include_once( "kernel/common/template.php" );
include_once( 'kernel/common/i18n.php' );

function createElement( $class, $parent_node_id, $nombre )
{
    $params = array();
    $params['parent_node_id'] = $parent_node_id;
    $params['class_identifier'] = $class;
    $params['creator_id'] = eZUser::currentUser()->id();
    $attributes = array();
    $attributes['nombre'] = $nombre;
    $params['attributes'] = $attributes;
    eZContentFunctions::createAndPublishObject( $params );
}

function checkNeedToCreate( $node_id, $class )
{
    $query = eZContentObjectTreeNode::subTreeByNodeId( 
                                            array( 'ClassFilterType' => 'include',
                                                   'ClassFilterArray' => array( $class ) )
,$node_id );
    return count( $query ) == 0;
}


/*
		
		
		
		*/

foreach ($_POST as $k=>$valor){
	print '<br />';
	print 'k:'.$k;
	print '<br />';
	print 'valor:'.$valor;
	
	$valores=explode('_',$k);
		$node_producto=$valores[1];
		$user_id=$valores[2];
		$valor=$valor;	
		$db = eZDB::instance();
        $db->query( "UPDATE valoraciones_productos SET visible=".$valor." WHERE node_producto=".$node_producto." and user_id=".$user_id."" );
		
		
		if ($valor==1)
		{
			$query = $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $node_producto. " and visible=1 " );	
			
			if( count( $query ) )
			{	
			$needToCreate = checkNeedToCreate( $node_producto, 'opiniones_clientes' );
				if( $needToCreate )
				createElement( 'opiniones_clientes', $node_producto, 'Opiniones de los clientes' );

			$needToCreate = checkNeedToCreate( $node_producto, 'valoraciones_producto' );
				if( $needToCreate )
				createElement( 'valoraciones_producto', $node_producto, 'Valoraciones' );
			}
		}
}

//print "UPDATE valoraciones_productos SET visible=".$valor." WHERE node_producto=".$node_producto." and user_id=".$user_id."";


$tpl=templateInit();
$http=eZHTTPTool::instance();
$parametros=$Params['UserParameters'];

$modificar=$http->postVariable('modificar');
$module=$Params['Module'];
$module->redirectTo($direcc);



?>