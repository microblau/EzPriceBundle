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

$correspondencias = array( 'fiscal' => 147,
                           'social' => 145,
                           'mercantil' => 148,
                           'contable' => 149,
                           'prevencion' => 145,
                           'administrativo' => 153,
                           'civil' => 154,
                           'penal' => 154,
                           'otros' => 145,
                           'medioambiente' => 145,
                           'procesal' => 154,
                           'inmobiliaria' => 151 );

$lines = $db->arrayQuery( "SELECT * FROM usersimport2" );
foreach( $lines as $line )
{   
    $materias = array();
    if( $line['fiscal'] == 1 )
        $materias[] = 147;
    if( $line['social'] == 1 )
        $materias[] = 146;
    if( $line['mercantil'] == 1 )
        $materias[] = 148;
    if( $line['contable'] == 1 )
        $materias[] = 149;
    if( $line['prevencion'] == 1 )
        $materias[] = 146;
    if( $line['administrativo'] == 1 )
        $materias[] = 153;
    if( $line['civil'] == 1 )
        $materias[] = 7466;
    if( $line['penal'] == 1 )
        $materias[] = 7467;
    if( $line['otros'] == 1 )
        $materias[] = 145;
    if( $line['medioambiente'] == 1 )
        $materias[] = 145;
    if( $line['procesal'] == 1 )
        $materias[] = 154;
    if( $line['inmobiliaria'] == 1 )
        $materias[] = 151;
    $materias = array_unique( $materias );
    $text = implode( '-', $materias );
    $cli->output( $line['email'] . ';' . $line['nombre'] . ';;' . $line['actividad'] . ';publicaciones-formacion;' . $text );    
}


$script->shutdown();

?>
