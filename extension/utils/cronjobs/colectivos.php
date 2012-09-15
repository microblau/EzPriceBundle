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
$nodes = $db->arrayQuery( 'SELECT * FROM efl_colectivos' );



foreach( $nodes as $node )
{
  
        $cli->output( $node['CO'] );
	

        $parent_node = eZContentObjectTreeNode::fetch(411);
     
        $params = array();
        $params ['class_identifier'] = 'user_group'; //class name (found within setup=>classes in the admin if you need it
        $params['creator_id'] = $user->ContentObjectID;//using the user created above
        $params['parent_node_id']=$parent_node->NodeID;//pulling the node id out of the parent
        $params['section_id'] = $parent_node->ContentObject->SectionID;
        
        $attributesData = array ( ) ;
        $attributesData['name'] = $node['LB_COLECTIVO']; 
        $attributesData['siglas'] =  $node['CO'];
       // $attributesData['ref'] =  $node->attribute( 'object' )->attribute( 'id' );  
        $params['attributes'] = $attributesData;



        $group = eZContentFunctions::createAndPublishObject($params);
        eZOperationHandler::execute( 'content', 'publish', array( 
                                                      'object_id' => $group->attribute( 'id' ),
                                                      'version' => 1                                                 
                                ) );
         

    
}



$script->shutdown();

?>
