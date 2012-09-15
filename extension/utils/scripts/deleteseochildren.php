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

$nodes = eZContentObjectTreeNode::subTreeByNodeId( array( 'ClassFilterType' => 'include',
                                                          'ClassFilterArray' => array( 'actualizaciones_producto',
                                                                                       'bases_producto',
                                                                                       'condiciones_producto',
                                                                                       'faqs_producto',
                                                                                       'noticias_producto',
                                                                                       'novedades_producto',
                                                                                       'opiniones_clientes',
                                                                                       'sumario_producto',
                                                                                       'testimonios_producto',
                                                                                       'valoraciones_producto',
                                                                                       'ventajas_producto',
                                                                                       'noticias_relacionadas_producto' ) ), 2

 );

foreach( $nodes as $node )
{
    $cli->output( $node->attribute( 'name'  ));
    eZContentObjectTreeNode::removeSubtrees( array( $node->attribute( 'main_node_id' ) ), false );

}





$script->shutdown();

?>
