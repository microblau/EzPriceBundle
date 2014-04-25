<?php
$db = eZDB::instance();
$query = $db->arrayQuery( 'SELECT * FROM efl_orders order by productcollection_id DESC' );

$first = $query[0];
$serialized = $first['order_serialized'];
$firstu = unserialize( $serialized );
foreach( $query as $item )
{
    $serialized = $item['order_serialized'];
    $unserialized = unserialize( $serialized );
    if( !isset( $unserialized['id_pedido_lfbv'] ) and isset( $unserialized['idtransaccion']) )
    {
   /* if( $unserialized['idtransaccion'] == '129311503546' ){
        print_r( $unserialized );*/
    $p = eZProductCollection::fetch( $item['productcollection_id'] );
    print 'Fecha: ' . date( 'd-m-Y H:i:s', $p->attribute( 'created' ) ) .  '<br />';
    foreach( unserialize( $serialized ) as $key => $val )
    {
	print $key . ': ' . $val . '<br />';
	
    }
    $items = $p->itemList();  
    foreach ( $items as $item )
    {
	print '<strong>' . $item->Name . '</strong><br />';
    }
    
         echo '<hr />';
    }
   // }
   
}

eZExecution::cleanExit();
?>
