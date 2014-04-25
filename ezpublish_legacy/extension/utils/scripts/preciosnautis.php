<?php
require 'autoload.php';
$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish (un)clusterize\n" .
                                                        "Script for moving var_dir files from " .
                                                        "filesystem to database and vice versa\n" .
                                                        "\n" .
                                                        "./bin/php/clusterize.php" ),
                                     'use-session'    => false,
                                     'use-modules'    => false,
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

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 99 )
				)
, 61);

foreach( $nodes as $node )
{
	$versiones = eZContentObjectTreeNode::subTreeByNodeID( 
            array( 'ClassFilterType' => 'include',
                   'ClassFilterArray' => array( 100 ),
                   'SortBy' => array( 'attribute', true, 851 )
), $node->attribute( 'node_id' ) );
    $cli->output( $versiones[0]->Name );
	    
	$data = $node->dataMap();
    $dataVersion = $versiones[0]->dataMap();
    $content = $dataVersion['precio']->toString();
    $content2 = $dataVersion['precio_oferta']->toString();
    $finicio = $dataVersion['fecha_inicio_oferta']->toString();
    $ffin = $dataVersion['fecha_fin_oferta']->toString();
    $a = new eZPriceType();
    $cli->output( $dataVersion['precio']->toString() );	
    $a->fromString( $data['precio'], $content );
    $a->fromString( $data['precio_oferta'], $content2 );
    $data['precio']->store();
    $data['precio_oferta']->store();
    $data['fecha_inicio_oferta']->setAttribute( 'data_int', (int)$finicio);
    $data['fecha_inicio_oferta']->store();
    $data['fecha_fin_oferta']->setAttribute( 'data_int', (int)$ffin );
    $data['fecha_fin_oferta']->store();

}




$script->shutdown();

?>
