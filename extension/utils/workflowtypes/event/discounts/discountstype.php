<?php
/**
 * Workflow que habilitará o deshabilitará descuentos tras cada publicación de un determinado producto
 * 
 * @author carlos.revillo@tantacom.com
 *
 */
class discountsType extends eZWorkflowEventType
{
	const WORKFLOW_TYPE_STRING = "discounts";
	
	function discountsType()
    {
        $this->eZWorkflowEventType( discountsType::WORKFLOW_TYPE_STRING, 'Descuentos en productos' );
        $this->setTriggerTypes( array( 'content' => array( 'publish' => array( 'after' ) ) ) );
    }
    
    function execute( $process, $event )
    {
    	$parameters = $process->attribute( 'parameter_list' );
    	$objectID = $parameters['object_id'];
        $object = eZContentObject::fetch( $objectID );      
        if( ( $object->attribute( 'contentclass_id' ) == 49 ) or  ( $object->attribute( 'contentclass_id' ) == 48 ) or ( $object->attribute( 'contentclass_id' ) == 100 ) or ( $object->attribute( 'contentclass_id' ) == 61 ) )
        {
	        $data = $object->dataMap();
		
			if( $data['precio_oferta'] && $data['fecha_inicio_oferta'] && $data['fecha_fin_oferta'] && ( $data['precio_oferta']->content()->attribute( 'price' ) > 0 ) and ( $data['fecha_inicio_oferta']->content()->timestamp() < time() ) and ( $data['fecha_fin_oferta']->content()->timestamp() + 86400 >  time() ) )
			{	

				$db = eZDB::instance();
			    $db->begin();
				$discount = abs( ( $data['precio_oferta']->content()->attribute( 'price') - $data['precio']->content()->attribute( 'price') ) / $data['precio']->content()->attribute( 'price') * 100 );
				
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
															' AND ezdiscountsubrule.id = ezdiscountsubrule_value.discountsubrule_id AND ezdiscountsubrule.discountrule_id = 3 '
															
																
				);

               
				
				foreach( $subrules as $subrule )
				{
					$s = eZDiscountSubRule::fetch( $subrule['id'] );
					 
					
					eZPersistentObject::removeObject( eZDiscountSubRule::definition(), array ( 'id' => $subrule['id'] ));
					eZPersistentObject::removeObject( eZDiscountSubRuleValue::definition(), array( 'discountsubrule_id' => $subrule['id'], 'value' => $object->attribute( 'id' )  ) );
				}
				
				$discountRule = eZDiscountSubRule::create( $discountGroupID );
                
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
			
			    // we changed prices => remove content cache
			    eZContentCacheManager::clearAllContentCache();
			    
			}
       		else
	        {
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
						eZPersistentObject::removeObject( eZDiscountSubRuleValue::definition(), array( 'discountsubrule_id' => $subrule['id'], 'value' => $object->attribute( 'id' )  ) );
					}
	        }
        }
       
    	
    	return eZWorkflowType::STATUS_ACCEPTED;
    }
}

eZWorkflowEventType::registerEventType( discountsType::WORKFLOW_TYPE_STRING, "discountsType" );
