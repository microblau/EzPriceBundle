!<?php
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

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 48, 98, 99, 100, 101, 49, 61, 66, 94 )
				)
, 2);

$rules = eZPersistentObject::fetchObjectList( eZDiscountSubRule::definition(), null,
                                              array ( 'discountrule_id' => 82 ) );

eZPersistentObject::removeObject( eZDiscountSubRule::definition(), array ( 'discountrule_id' => 82 ) );
//die();
//eZPersistentObject::removeObject( eZDiscountSubRuleValue::definition(), array( 'discountrule_id' => 82 ) );

foreach( $nodes as $node )
{
	
	$object = eZContentObject::fetch( $node->attribute( 'object' )->attribute( 'id' ) );
	$db = eZDB::instance();
	
	$data = $object->dataMap();
if( $data['precio_oferta'] )
{	
	if( ( $data['fecha_inicio_oferta']->content()->timestamp() < time() ) and ( $data['fecha_fin_oferta']->content()->timestamp() + 86400 >  time() ) )
	{	
        $cli->output ($node->Name );
	    $db->begin();
		$discount = abs( ( $data['precio_oferta']->content()->attribute( 'price') - $data['precio']->content()->attribute( 'price') ) / $data['precio']->content()->attribute( 'price') * 100 );
		$cli->output( $discount );
		$discountGroupID = 82;
		
		/***borramos la relacionada con el producto en cuestion*/
		$subrules = eZPersistentObject::fetchObjectList( 
													eZDiscountSubRuleValue::definition(),
													null,
													array( 'value' => $object->attribute( 'id' ) ),
													null,
													null,
													false,
													false,
													array( array( 'operation' => 'ezdiscountsubrule.id' ) ),
													array( 'ezdiscountsubrule' ),
													' AND ezdiscountsubrule.id = ezdiscountsubrule_value.discountsubrule_id AND ezdiscountsubrule.discountrule_id = 82 '
													
														
		);
		
		
		foreach( $subrules as $subrule )
		{
			$s = eZDiscountSubRule::fetch( $subrule['id'] );
			 
			
			eZPersistentObject::removeObject( eZDiscountSubRule::definition(), array ( 'id' => $subrule['id'] ));
			eZPersistentObject::removeObject( eZDiscountSubRuleValue::definition(), array( 'discountsubrule_id' => $subrule['id'] ) );
		}
		
        $max = $db->arrayQuery( "select max(discountsubrule_id) as max from ezdiscountsubrule_value" );

  
		$discountRule = eZDiscountSubRule::create( $discountGroupID );
        $discountRule->setAttribute( 'id', $max[0]['max'] + 1 );
	    $discountRule->store();
	    $discountRuleID = $discountRule->attribute( 'id' );
      
	    
	    $discountRule->setAttribute( 'name', trim( $object->Name ) );
	    $discountRule->setAttribute( 'discount_percent', $discount );
	    $discountRule->setAttribute( 'limitation', '*' );
	    //eZDiscountSubRuleValue::remove( array( 'discountsubrule_id' => $discountRuleID, 'value' => 565  ) );
        
	    $ruleValue = eZDiscountSubRuleValue::create( $discountRuleID, $object->attribute( 'id' ), 2 );

       
	    $ruleValue->store();
	    $discountRule->setAttribute( 'limitation', false );
	    
	    $discountRule->store();
	    
	    $db->commit();
	
	   
	    
	}	
	else
	{

                   $subrules = eZPersistentObject::fetchObjectList( 
                                                                eZDiscountSubRuleValue::definition(),
                                                                null,
                                                                array( 'value' => $object->attribute( 'id' ) ),
                                                                null,
                                                                null,
                                                                false,
                                                                false,
                                                                array( array( 'operation' => 'ezdiscountsubrule.id' ) ),
                                                                array( 'ezdiscountsubrule' ),
                                                                ' AND ezdiscountsubrule.id = ezdiscountsubrule_value.discountsubrule_id AND ezdiscountsubrule.discountrule_id = 3 '
                                                                
                                                                    
                    );

                    
                    foreach( $subrules as $subrule )
                    {
                        $s = eZDiscountSubRule::fetch( $subrule['id'] );                        
                        eZPersistentObject::removeObject( eZDiscountSubRule::definition(), array ( 'id' => $subrule['id'] ));
                        eZPersistentObject::removeObject( eZDiscountSubRuleValue::definition(), array( 'discountsubrule_id' => $subrule['id'], 'value' => $object->attribute( 'id' )  ) );
                    }
	}
}
}

// we changed prices => remove content cache
eZContentCacheManager::clearAllContentCache();
/*
// and we update solr
    $nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 48, 98, 99, 100, 101 )
				)
    , 61);
    $solr = new eZSolr();
    foreach( $nodes as $node )
    {
        print $node->attribute( 'object' )->attribute( 'id' );
        $solr->addObject( $node->attribute( 'object' ), true ) ;
    }*/

?>
