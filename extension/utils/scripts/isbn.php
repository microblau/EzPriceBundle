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
					   'ClassFilterArray' => array( 'producto' )
				)
, 61);

foreach( $nodes as $node ){


	$object = eZContentObject::fetch( $node->attribute( 'object' )->attribute( 'id' ) );
	
	$data = $object->dataMap();
	if( $data['isbn']->toString() != '' )
	{
       $cli->output( $data['isbn']->toString(), false );	
	$number13 = $data['isbn']->toString();
      $isbn13 = new eZISBN13();
      $isbn13Value = $isbn13->formatedISBNValue( $number13, $error );
      $cli->output( ' - ' . $isbn13Value );
	$data['isbn']->setAttribute( 'data_text', $isbn13Value );
	$data['isbn']->store();
	}
	
}



$script->shutdown();

?>
