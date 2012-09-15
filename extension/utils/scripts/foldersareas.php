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


$folders = eZContentObjectTreeNode::subTreeByNodeID( array( 
                                                        'ClassFilterType' => 'include',
                                                        'ClassFilterArray' => array( 'folder' ),
                                                        'AttributeFilter' => array( array( 'depth', '=', 4 ) ),
), 2 );

foreach( $folders as $folder )
{
    
    $cli->output( $folder->Name );
    $areas = eZContentObjectTreeNode::subTreeByNodeID( array( 
                                                        'ClassFilterType' => 'include',
                                                        'ClassFilterArray' => array( 'area_interes' ),
                                                        'AttributeFilter' => array( array( 'name', '=', $folder->Name ) )
                ), 2 );
   if( $areas[0] )
   {

    $cli->output( $areas[0]->attribute( 'object' )->attribute( 'id' ) .  ' ' . $folder->attribute( 'node_id' ) );
    $data = $folder->dataMap();
    $data['area']->setAttribute( 'data_int', $areas[0]->attribute( 'object' )->attribute( 'id' ) );
    $data['area']->store();
    }
}



$script->shutdown();

?>
