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

$dir = 'extension/utils/csvs';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $aux = explode( '.', $file );
            $n = explode( '_', $aux[0] );
            $id = $n[1];
            if( $id != '' )
            {
                $db->query( "DELETE FROM valoraciones_productos WHERE node_producto = $id" );
                $lines = eZFile::splitLines( $dir . '/' . $file );
             
                foreach( $lines as $index => $line )
                {
                    $data = explode( ';', $line );
                    if( ( $index > 0 ) and ( count( $data ) == 8 ) )
                    {
                       
                        

                        $user_id = 10;
                        $node_id = $id;
                        $ha_votado = 1;
                        $calidad = $data[3];
                        $facilidad = $data[2];
                        $actualizaciones = $data[1];
                        $comentario = str_replace( '"', '', $data[4] );
                        $visible = 1;
                        $fechadatapars = explode( ' ', $data[0] );
                        $fechadataparst1 = explode( '/', $fechadatapars[0] );
                        $fechadataparst2 = explode( ':', $fechadatapars[1] );
                       
                        $time = mktime( $fechadataparst2[0], $fechadataparst2[1], $fechadataparst2[2],
                                        $fechadataparst1[1], $fechadataparst1[2], $fechadataparst1[0] );
                        $empresa = str_replace( '"', '', $data[6] );
                        $datanombre = explode( ' ', $data[5] );
                        $nombre = str_replace( '"', '', $datanombre[0] );
                        array_shift( $datanombre );
                        $apellidos =  str_replace( '"', '', implode( ' ', $datanombre ) );
                        $db->query( "INSERT INTO valoraciones_productos VALUES( $user_id, $node_id, 1, $calidad, $actualizaciones, $facilidad, '$comentario', 1, $time, '$nombre', '$apellidos', '$empresa' )" );
			$cli->output( "INSERT INTO valoraciones_productos VALUES( $user_id, $node_id, 1, $calidad, $actualizaciones, $facilidad, '$comentario', 1, $time, '$nombre', '$apellidos', '$empresa' )" );
                    }
                    
                }
            }
        }
        closedir($dh);
    }
}







$script->shutdown();

?>
