<?php
/********************************************************************************************************/
/*
	Script que actualiza todos los nodos de tipo "productos" y "ficheros" modificando el estado e
	inicializándolo al mismo estado que tiene su padre (carpeta)
	
	Víctor Aranda

*/
/********************************************************************************************************/
	
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
					   'ClassFilterArray' => array( 'producto' )
				)
, 61);

//echo count($nodes);
foreach( $nodes as $node ){

	
	$ParentNodeID = $node->ParentNodeID;	
	$object_padre = eZContentObject::fetchByNodeID( $ParentNodeID );     	

	
	$estados = $object_padre->stateIDArray();
	

	eZContentOperationCollection::updateObjectState(  $node->attribute( 'object' )->attribute( 'id' ), array( $estados['3'] ) );
	
}


$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 'file' )
				)
, 121);

//echo count($nodes);
foreach( $nodes as $node ){

	
	$ParentNodeID = $node->ParentNodeID;	
	$object_padre = eZContentObject::fetchByNodeID( $ParentNodeID );     	

	
	$estados = $object_padre->stateIDArray();
	

	eZContentOperationCollection::updateObjectState(  $node->attribute( 'object' )->attribute( 'id' ), array( $estados['3'] ) );
	
}






$script->shutdown();

?>
