<?php
require 'autoload.php';

$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "Creador de webs\n" .
                                                        "Allows for easy clearing of Cache files\n"
                                                        ),
                                     'use-session' => true,
                                     'use-modules' => true,
                                     'use-extensions' => true ) );

$script->startup();

$script->initialize();

$user = eZUser::fetchByEmail( 'leclerc@efl.es' );
print_r( $user );
eZUser::setCurrentlyLoggedInUser( $user, $user->attribute( 'contentobject_id' ) );  
$object = eZContentObject::fetch( 335 );
$solr = new eZSolr();
$solr->addObject( $object );
$script->shutdown();
?>
