<?php

	
require 'autoload.php';
$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish (un)clusterize\n" .
                                                        "Script for moving var_dir files from " .
                                                        "filesystem to database and vice versa\n" .
                                                        "\n" .
                                                        "./bin/php/clusterize.php" ),
                                     'use-session'    => true,
                                     'use-modules'    => true,
                                     'use-extensions' => true ) );

$script->startup();

$script->initialize();

$ini = eZINI::instance();
// Get user's ID who can remove subtrees. (Admin by default with userID = 14)
$userCreatorID = $ini->variable( "UserSettings", "UserCreatorID" );
$user = eZUser::fetch( $userCreatorID );
if ( !$user )
{
    $cli->error( "Subtree remove Error!\nCannot get user object by userID = '$userCreatorID'.\n(See site.ini[UserSettings].UserCreatorID)" );
    $script->shutdown( 1 );
}
eZUser::setCurrentlyLoggedInUser( $user, $userCreatorID );

$db = eZDB::instance();

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 48, 98, 99, 101 )
				)
, 61);


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

//echo count($nodes);
foreach( $nodes as $node ){
	$data = $node->dataMap();
    $cli->output( 'Procesando: ' . $node->attribute( 'name' ) );	
    if( $data['ventajas'] and $data['ventajas']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'ventajas_producto' );
        if( $needToCreate )
	{
           createElement( 'ventajas_producto', $node->attribute( 'node_id' ), 'Ventajas' );			
	}
	}
     
	if( $data['sumario'] and $data['ventajas']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'ventajas_producto' );
        if( $needToCreate )
            createElement( 'ventajas_producto', $node->attribute( 'node_id' ), 'Ventajas' );		
	}
    if( $data['sumario'] and $data['sumario']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'sumario_producto' );
        if( $needToCreate )
            createElement( 'sumario_producto', $node->attribute( 'node_id' ), 'Sumario' );
	}
    if( $data['contenido'] and $data['contenido']->hasContent() )
	{
		
        if( $node->attribute( 'parent_node_id' ) == 70 )
        {
            $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'bases_producto' );
            if( $needToCreate )
            {
                createElement( 'bases_producto', $node->attribute( 'node_id' ), 'Contenido base jurídica' );
            }
        }
        else
        {
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'condiciones_producto' );
        if( $needToCreate )
        {
            if( $node->attribute( 'parent_node_id' ) == 1485 )
                createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Contenido' );
            else
                createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Condiciones' );
        }
        }
	}
    
     if( $data['condiciones'] and $data['condiciones']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'condiciones_producto' );
        if( $needToCreate )
            createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Condiciones' );
	}
    
    if( $data['novedades'] and $data['novedades']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'novedades_producto' );
        if( $needToCreate )
            createElement( 'novedades_producto', $node->attribute( 'node_id' ), 'Novedades' );
	}

    if( $data['novedades'] and $data['novedades']->hasContent() and ( $node->attribute( 'parent_node_id' ) == 66 ) )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'noticias_producto' );
        if( $needToCreate )
            createElement( 'noticias_producto', $node->attribute( 'node_id' ), 'Últimas noticias' );
	}

    if( $data['actualizaciones'] and $data['actualizaciones']->hasContent() )
	{		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'actualizaciones_producto' );
        if( $needToCreate )
            createElement( 'actualizaciones_producto', $node->attribute( 'node_id' ), 'Actualizaciones' );
	}
    
  /*  $testimonios = eZContentObjectTreeNode::subTreeByNodeID( array( 'ClassFilterType' => 'include',
                                                                    'ClassFilterArray' => array( 'testimonio' ) ), $node->attribute( 'node_id' ) );
    if( count( $testimonios ) )
	{	
       
       
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'testimonios_producto' );
        if( $needToCreate )
            createElement( 'testimonios_producto', $node->attribute( 'node_id' ), 'Testimonios' );
  
	}*/

    $query = $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $node->attribute( 'node_id' ). " and visible=1 " );

    if( count( $query ) )
	{	
       
       
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'opiniones_clientes' );
        if( $needToCreate )
            createElement( 'opiniones_clientes', $node->attribute( 'node_id' ), 'Opiniones de los clientes' );

          $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'valoraciones_producto' );
        if( $needToCreate )
            createElement( 'valoraciones_producto', $node->attribute( 'node_id' ), 'Valoraciones' );
  
	}

    if( $data['faqs_producto'] and $data['faqs_producto']->hasContent() )
	{		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'faqs_producto' );
        if( $needToCreate )
            createElement( 'faqs_producto', $node->attribute( 'node_id' ), 'Faqs producto' );
	}

    if( $data['notas_relacionadas'] and $data['notas_relacionadas']->hasContent() )
	{
		
        $needToCreate = checkNeedToCreate( $node->attribute( 'node_id' ), 'notas_relacionadas' );
        if( $needToCreate )
            createElement( 'notas_relacionadas_producto', $node->attribute( 'node_id' ), 'Últimas noticias' );
	}

    
}






$script->shutdown();

?>
