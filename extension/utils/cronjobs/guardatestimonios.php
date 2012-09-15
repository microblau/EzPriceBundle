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
                       'IgnoreVisibilty' => true,
					   'ClassFilterArray' => array( 'testimonio' )
				)
, 61);

foreach( $nodes as $node )
{
    $data = $node->dataMap();
   
    $nombre_persona = $data['nombre_persona']->toString();

    $empresa = $data['empresa']->toString();
    $user_id = 10;
    $node_producto = $node->attribute( 'parent' )->attribute( 'node_id' );
    $ha_votado = 1;
    $calidad = 4;
    $actualizaciones = 4;
    $facilidad = 4;
    $testimonio = strip_tags( $data['testimonio']->content()->attribute( 'output' )->attribute( 'output_text' ) );
    print_r( $testimonio );
    $visible = 1;
    $fecha = $node->attribute( 'object' )->attribute( 'published' );
    $aux = explode( ' ', $nombre_persona );

    $nombre = $aux[0];


    array_shift( $aux );
    $apellidos = implode( " ", $aux );
    $cli->output( $apellidos );
    $cli->output( "INSERT INTO valoraciones_productos VALUES ( $user_id, $node_producto, $ha_votado, $calidad, $actualizaciones, $facilidad, '$testimionio', $visible, $fecha, '$nombre', '$apellidos', '$empresa') ") ;
    $db->query( "INSERT INTO valoraciones_productos VALUES ( $user_id, $node_producto, $ha_votado, $calidad, $actualizaciones, $facilidad, '$testimonio', $visible, $fecha, '$nombre', '$apellidos', '$empresa')");
   
}







$script->shutdown();

?>
