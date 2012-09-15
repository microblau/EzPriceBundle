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
                       'ClassFilterArray' => array( 66, 49, 61, 100 )
                )
, 61);

foreach( $nodes as $node )
{
    $object = eZContentObject::fetch( $node->attribute( 'object' )->attribute( 'id' ) );
    	$data = $object->dataMap();
    	$data['precio']->setAttribute( 'data_text', '-1,2' );
    	$data['precio']->store();
    	$data['precio_oferta']->setAttribute( 'data_text', '-1,2' );
        $data['precio_oferta']->store();
     
}

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
                array( 'ClassFilterType' => 'include', 
                       'ClassFilterArray' => array( 100 )
                )
, 61);

foreach( $nodes as $node )
{
    $object = eZContentObject::fetch( $node->attribute( 'object' )->attribute( 'id' ) );
    	$data = $object->dataMap();
    	$data['categoria']->setAttribute( 'data_int', '3' );
    	$data['categoria']->store();
    	
     
}

$script->shutdown();

?>
