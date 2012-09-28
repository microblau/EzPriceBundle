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

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
                array( 'ClassFilterType' => 'include',
                        'ClassFilterArray' => array( 48, 98, 99, 100, 101 )
                )
, 61);
$a = new eZObjectRelationListType();
foreach( $nodes as $node )
{
   
    $data = $node->dataMap();
    
	    if( $data['colectivos'] )
	    {
	        
	        $news = array();
	        $colectivos =  $data['colectivos']->content();
	        $items = $colectivos['relation_list'];
	        $i = 1;
	         
	           $groups = eZContentObjectTreeNode::subTreeByNodeId( array( 
	                                   'ClassFilterType' => 'include',
	                                   'ClassFilterArray' => array( 3 )
	                                  
	           
	                   ),
	               411
	           );
	                  
	        
	        
	        $colectivos['relation_list'] = array();
	        
	        foreach( $groups as $grupo )
	        {
	           $colectivos['relation_list'][] = $a->appendObject( $grupo->attribute( 'object' )->attribute( 'id' ), $i, $data['colectivos'] );
	           $i++;
	        }
            print_r( $colectivos );
	        $a->storeObjectAttributeContent( $data['colectivos'], $colectivos );
            $data['colectivos']->setContent( $content );
            $data['colectivos']->store();
            
	    }
	    else
	    {
	       $cli->output( $node->Name );
	    }
    
      
}



$script->shutdown();

?>
