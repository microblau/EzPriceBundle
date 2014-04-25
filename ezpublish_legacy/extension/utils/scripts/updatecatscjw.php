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

$lines = eZFile::splitLines( 'extension/utils/scripts/export.csv' );
foreach( $lines as $line )
{
    $aux = explode( ';', $line );
	if( $aux[0] != '' )
	{
    $cli->output( "UPDATE cjwnl_user SET about_materia = '$aux[5]' WHERE email = '$aux[0]'" );
    $db->query( "UPDATE cjwnl_user SET about_materia = '$aux[5]' WHERE email = '$aux[0]'" );
//    $db->query( "UPDATE cjwnl_user SET first_name = '$aux[1]' WHERE email = '$aux[0]'" );
       }
}







$script->shutdown();

?>
