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
$cli->output( 'hola' );
$lines = eZFile::splitLines( '/home/carlosrevillo/Fichero_Tanta.csv' );
$db->query( "TRUNCATE usersimport" );

foreach( $lines as $line )
{
    $aux = explode(';', $line );
        $p0 = utf8_encode( $aux[0] );
        $p1 = utf8_encode( $aux[1] );
        $p3 = ( isset( $aux[3] ) and ( $aux[3] == 1 ) ) ? 1 : 0;
        $p4 = ( isset( $aux[4] ) and ( $aux[4] == 1 ) ) ? 1 : 0;
        $p5 = ( isset( $aux[5] ) and ( $aux[5] == 1 ) ) ? 1 : 0;
        $p6 = ( isset( $aux[6] ) and ( $aux[6] == 1 ) ) ? 1 : 0;
        $p7 = ( isset( $aux[7] ) and ( $aux[7] == 1 ) ) ? 1 : 0;
        $p8 = ( isset( $aux[8] ) and ( $aux[8] == 1 ) ) ? 1 : 0;
        $p9 = ( isset( $aux[9] ) and ( $aux[9] == 1 ) ) ? 1 : 0;
        $p10 = ( isset( $aux[10] ) and ( $aux[10] == 1 ) ) ? 1 : 0;
        $p11 = ( isset( $aux[11] ) and ( $aux[11] == 1 ) ) ? 1 : 0;
        $p12 = ( isset( $aux[12] ) and ( $aux[12] == 1 ) ) ? 1 : 0;
        $p13 = ( isset( $aux[13] ) and ( $aux[13] == 1 ) ) ? 1 : 0;
        $p14 = ( isset( $aux[14] ) and ( $aux[14] == 1 ) ) ? 1 : 0;
        $cli->output( "INSERT INTO usersimport VALUES( '$p0', '$p1', '$aux[2]', $p3, 
                       $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12, $p13, $p14
                                                    
 )" );
    
        $db->query( utf8_decode( "INSERT INTO usersimport VALUES( '$p0', '$p1', '$aux[2]', $p3, 
                       $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12, $p13, $p14
                                                    
 )" ) );
    
}


$script->shutdown();

?>
