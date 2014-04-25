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


if ($handle = opendir('extension/utils/pdfs')) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
        
        $name = str_replace( '.pdf', '', $file );
       
       
        $els = eZContentObjectTreeNode::subTreeByNodeID( 
                 array( 'ClassFilterType' => 'include',
                        'ClassFilterArray' => array( 'file' ),
                        'AttributeFilter' => array( 
                                                array( 'file/name', '=',   strtolower( $name )    ) ) )
                , 121
            );
      if( $els[0] )
      {
           $data = $els[0]->dataMap();
           $data['file']->insertRegularFile( $els[0]->attribute( 'object' ), $els[0]->attribute( 'object')->attribute( 'current_version' ), 'esl-ES', 'extension/utils/pdfs/' . $file );
           $data['file']->store();
      }
      else
      {
        $cli->output( $name );
      }
        
        
    }
}


$script->shutdown();

?>
