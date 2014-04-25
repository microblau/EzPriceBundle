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
$date = time();
$list = eZCustomDiscountSubRule::fetchList();
print_r( $list );

foreach( $list as $item )
{
    $start = $item->Start;
    $end = $item->End;
    if( ( $start < $date ) and ( $date <= $end ) )
    {
        
         $valid = new eZDiscountSubRule( array( 
                                'id' => $item->ID,
                                'discountrule_id' => $item->DiscountRuleID,
                                'name' => trim( $item->Name ),
                                'discount_percent' =>  $item->DiscountPercent,
                                'limitation' => $item->Limitation
        ) );
        $valid->store();
    }
    else
    {

        if( $rule = eZDiscountSubRule::fetch( $item->ID ) )
        {
        $rule->remove( $item->ID );
        }
    }
}

eZContentCacheManager::clearAllContentCache();

// and we update solr
    $nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 48, 98, 99, 100, 101 )
				)
    , 61);
    $solr = new eZSolr();
    foreach( $nodes as $node )
    {
        $solr->addObject( $node->attribute( 'object' ), false ) ;
    }
    $solr->optimize( true );

?>
