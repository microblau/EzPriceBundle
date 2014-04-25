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

$handle = fopen( 'extension/utils/scripts/12250.txt', 'r' );
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
	$aux = explode( ';', $buffer );
	 $track = CjwNewsletterTrack::create( $aux[0], $aux[1] );
	    $track->store();
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}


$script->shutdown();

?>
