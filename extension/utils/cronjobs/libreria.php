<?php
$cli = eZCLI::instance();


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
                       'ClassFilterArray' => array( 'producto' ),
                       'AttributeFilter' => array( 'and', 
                                                    array( 356, '<', time() ),
                                                    array( 358, '=', 0 )
                                                     )
                )
, 61);


foreach( $nodes as $node )
{
	$data = $node->dataMap();
	$data['disp_librerias']->setAttribute( 'data_int', 1 );
	$data['disp_librerias']->store();	
}

eZContentCacheManager::clearAllContentCache();

?>