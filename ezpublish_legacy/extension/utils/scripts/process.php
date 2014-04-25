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

if ($dir = opendir('/home/wwwuser/logs')) 
{
    while (false !== ($entry = readdir($dir))) 
    {
       
        $handle = fopen( '/home/wwwuser/logs/' . $entry, 'r' );
        if ($handle) 
        {
            while (($buffer = fgets($handle, 4096)) !== false) 
            {
               
                if( preg_match( '/id=12250/', $buffer ) )
                {
                    $c1 = strpos( $buffer, '=' );
                    $c2 = strpos( $buffer, '&' );
                   echo substr( $buffer, $c1+1, $c2 - $c1 -1  ) . ";12250\n";            
                }
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
    }
}


closedir( $dir );
$script->shutdown();

?>
