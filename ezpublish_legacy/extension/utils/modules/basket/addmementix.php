<?php
$http = eZHTTPTool::instance();
$basket = eZBasket::currentBasket();

$module = $Params['Module'];
$mementosnames = array();
foreach( $http->postVariable( 'mementos' ) as $id )
{
    $memento = eZContentObject::fetch( $id );
    
    $datamemento = $memento->dataMap();
    $mementosnames[] = $datamemento['nombre_mementix']->content();
    $refs[] = $datamemento['referencia']->content();
}



$object = eZContentObject::fetch( 1604 );
$data = $object->dataMap();
$nodeID = $object->attribute( 'main_node_id' );
$price = 0.0;
$isVATIncluded = true;
$attributes = $object->contentObjectAttributes();

$priceObj = $data['precio']->content();
$preciomultiusuario = $data['precio_multiusuario']->content()->exVATPrice();
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



$info['has_mementix'] = array();
$accesos =  $http->postVariable( 'accesos' ) . ' accesos';
$texttoadd = ( $http->postVariable( 'accesos' ) == 1 ) ? 'Individual' :  $accesos;
         
$info['has_mementix']['mementos'] = implode( $mementosnames, ', ' );
$info['has_mementix']['refs'] = implode( $refs, ', ' );
$info['has_mementix']['accesos'] = $texttoadd;
$serialized_order = serialize( $info ); 
$orderInfo->Order = $serialized_order;
$orderInfo->store();

foreach ( $collectionItems as $item )
{
    /* For all items in the basket which have the same object_id: */
    if ( $item['contentobject_id'] == 1604 )
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
       $accesos =  $http->postVariable( 'accesos' ) . ' accesos';
       $texttoadd = ( $http->postVariable( 'accesos' ) == 1 ) ? 'Individual' :  $accesos;
          /* If found in the basket, just increment number of that items: */ 
          $item = eZProductCollectionItem::fetch( $itemID ); 
          $item->setAttribute( 'name', 'Mementix'  );
          $item->setAttribute( 'item_count', 1 );
          $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
          $item->setAttribute( "price", $http->postVariable( 'total' ) );  
          $item->store();
    }
else
    {
         $accesos =  $http->postVariable( 'accesos' ) . ' accesos';
        $texttoadd = ( $http->postVariable( 'accesos' ) == 1 ) ? 'Individual' :  $accesos;
        $x =  ( $http->postVariable( 'accesos' ) != 1 ) ? 's' : '';
        $item = eZProductCollectionItem::create( $basket->attribute( "productcollection_id" ) );
        $item->setAttribute( 'name', 'Mementix'  );
        $item->setAttribute( "contentobject_id", 1604 );
        $item->setAttribute( "item_count", 1 );
        $item->setAttribute( "price", $http->postVariable( 'total' ) );
        $item->setAttribute( "is_vat_inc", '0' );                
        $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
        $item->setAttribute( "discount",  0 );

        $item->store();   
    }
    




$module->redirectTo( "/basket/basket/" );

?>

