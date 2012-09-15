<?php
$cli = eZCLI::instance();


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
$customgroups = eZPersistentObject::fetchObjectList( eZCustomDiscountSubRule::definition(),
                                                     null,
                                                    array( 'end' => array( '<', time() + 86400 ) )
                                                    );
print count ($customgroups );
die( count( $customgroups ) );

foreach( $customgroups as $customGroup )
{
    $id = $customGroup->attribute( 'id' );
    print $id;
    $group = eZDiscountSubRule::fetch( $id );
    print_r( $customGroup );
    /*$customGroup->remove( $id );
    $group->remove( $id );*/
}

?>
