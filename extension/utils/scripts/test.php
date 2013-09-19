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


$db = eZDB::instance();
$query = $db->arrayQuery( 'SELECT * FROM efl_orders where productcollection_id = 13158 ');
$unserialized = $query[0]['order_serialized'];
print_r( unserialize( $unserialized ) );


$script->shutdown();

?>

