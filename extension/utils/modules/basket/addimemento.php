<?php
$http = eZHTTPTool::instance();
$basket = eZBasket::currentBasket();

$module = $Params['Module'];
$mementosnames = array();
foreach( $http->postVariable( 'mementos' ) as $id )
{
    $memento = eZContentObject::fetch( $id );
    
    $datamemento = $memento->dataMap();
    if( $datamemento['nombre_mementix']->content() != '' )
        $mementosnames[] = $datamemento['nombre_mementix']->content();
    else
        $mementosnames[] = $memento->attribute( 'name' );
    $refs[] = $datamemento['referencia']->content();
}



$object = eZContentObject::fetch( eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Object' ) );
$data = $object->dataMap();
$nodeID = $object->attribute( 'main_node_id' );
$price = 0.0;
$isVATIncluded = true;
$attributes = $object->contentObjectAttributes();

$priceObj = $data['precio']->content();
$currency = $priceObj->attribute( 'currency' );
$collection = $basket->attribute( 'productcollection' );
$collection->setAttribute( 'currency_code', $currency );
$collection->store();
$collectionItems = $collection->itemList( false );

$orderInfo = eZPersistentObject::fetchObject( eflOrders::definition(), 
                                                            null, 
                                                            array( 'productcollection_id' => $basket->attribute( 'productcollection_id' ) )  
                                                            );
if( $orderInfo )
{
    $info = unserialize( $orderInfo->Order );
}
else
{
    $orderInfo = new eflOrders( array( 
                                        'productcollection_id' => $basket->attribute( 'productcollection_id' ), 
                                        'order' => serialize( array() )
                                     ) );
    $orderInfo->store();
    $info = array();
}



$info['has_imemento'] = array();
         
$info['has_imemento']['mementos'] = implode( $mementosnames, ', ' );
$info['has_imemento']['refs'] = implode( $refs, ', ' );
$info['has_imemento']['partial'] = $http->postVariable( 'partial' );
$serialized_order = serialize( $info ); 
$orderInfo->Order = $serialized_order;
$orderInfo->store();

foreach ( $collectionItems as $item )
{
    /* For all items in the basket which have the same object_id: */
    if ( $item['contentobject_id'] ==  eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Object' ) )
    {
        
        $theSame = true;
        if ( $theSame )
        {
            $itemID = $item['id'];
            break;
        }
    }
}

if ( $itemID )
    {
       
          /* If found in the basket, just increment number of that items: */ 
          $item = eZProductCollectionItem::fetch( $itemID ); 
          $item->setAttribute( 'name', 'iMemento'  );
          $item->setAttribute( 'item_count', 1 );
          $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
          $item->setAttribute( "price", $http->postVariable( 'total' ) );  
          $item->store();
    }
else
    {
        
        $item = eZProductCollectionItem::create( $basket->attribute( "productcollection_id" ) );
        $item->setAttribute( 'name', 'iMemento'  );
        $item->setAttribute( "contentobject_id",  eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Object' ) );
        $item->setAttribute( "item_count", 1 );
        $item->setAttribute( "price", (float)$http->postVariable( 'total' ) );
        $item->setAttribute( "is_vat_inc", '0' );                
        $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
        $item->setAttribute( "discount",  0 );

        $item->store();  
    
    }
    




$module->redirectTo( "/basket/basket/" );

?>

