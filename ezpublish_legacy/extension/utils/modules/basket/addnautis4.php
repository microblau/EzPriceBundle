<?php
$http = eZHTTPTool::instance();
$basket = eZBasket::currentBasket();
$module = $Params['Module'];
$mementosnames = array();
$refs = array();

foreach( $http->postVariable( 'mementos' ) as $id )
{
    $memento = eZContentObject::fetch( $id );
    
    $datamemento = $memento->dataMap();
    $mementosnames[] = $datamemento['nombre_mementix']->content();
    $refs[] = $datamemento['referencia']->content();
}



$object = eZContentObject::fetch( $http->postVariable( 'object' ) );

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
$info = unserialize( $orderInfo->Order );


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


$info['has_nautis4'] = array();
$accesos =  $http->postVariable( 'accesos' ) . ' accesos';
$texttoadd = ( $http->postVariable( 'accesos' ) == 1 ) ? 'Individual' :  $accesos;
         
$info['has_nautis4']['mementos'] = implode( $mementosnames, ', ' );
$info['has_nautis4']['refs'] = implode( $refs, ', ' );
$info['has_nautis4']['accesos'] = $texttoadd;
$serialized_order = serialize( $info ); 
$orderInfo->Order = $serialized_order;
$orderInfo->store();


foreach ( $collectionItems as $item )
{
    /* For all items in the basket which have the same object_id: */
    if ( $item['contentobject_id'] == $http->postVariable( 'object' ) )
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
          $item->setAttribute( 'name', 'Nautis 4'  );
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
        $item->setAttribute( 'name', 'Nautis 4'  );
        $item->setAttribute( "contentobject_id", $http->postVariable( 'object' ) );
        $item->setAttribute( "item_count", 1 );
        $item->setAttribute( "price", $http->postVariable( 'total' ) );
        $item->setAttribute( "is_vat_inc", '0' );                
        $item->setAttribute( "vat_value", $priceObj->attribute( 'vat_percent' ) );
        $item->setAttribute( "discount",  0 );

        $item->store();   
    }
    




$module->redirectTo( "/basket/basket/" );

?>

