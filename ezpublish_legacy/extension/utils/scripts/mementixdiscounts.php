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

$object = eZContentObject::fetch( 332 );
$versions = $object->versions();
foreach( $versions as $item )
{
    
   
        $data = $item->dataMap();
        $content = $data['price_table']->attribute( 'data_text' );
        $data['tabla_precios']->setAttribute( 'data_text', $content );
        $data['tabla_precios']->store();
        $dom = simplexml_load_string( $content );
        $valores = $dom->xpath( '//c' );
        $rows = count ( $valores ) / 4;
        /*for( $i = 0; $i < $rows; $i++ )
        {
            $discount = new eflMementixDiscountRule( 
                                    array( 'qte_min' => (int)$valores[$i*4],
                                           'qte_max' => (int)$valores[ ($i*4) + 1],
                                           'qte_mem' => (int)$valores[ ($i*4) + 2],
                                           'discount' => (int)$valores[ ($i*4) + 3],
                                           'contentobjectattribute_id' => $data['price_table']->attribute( 'id' ),
                                           'contentobjectattribute_version' => $item->Version
                                        )  
                                );      
            $discount->store();
        }*/
    
}



$script->shutdown();
?>
