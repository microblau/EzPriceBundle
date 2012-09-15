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
					   'ClassFilterArray' => array( 'opiniones_clientes' )
				)
, 2);

foreach( $nodes as $node )
{
    $cli->output(  $node->attribute( 'object' )->attribute( 'id' ) );
    $operationResult = eZOperationHandler::execute( 'content', 'publish', array( 
                                                      'object_id' =>  $node->attribute( 'object' )->attribute( 'id' ),
                                                      'version' =>  $node->attribute( 'object' )->attribute( 'current_version' )                                                  
                                ) );
}
    







$script->shutdown();

?>
