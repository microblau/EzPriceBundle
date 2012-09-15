<?php
$db = eZDB::instance();
$query = $db->arrayQuery( 'SELECT * FROM efl_orders order by productcollection_id desc');
$i = 0;
foreach( $query as $item )
{
$unserialized = unserialize( $item['order_serialized'] );
if( ( $unserialized['tipopago'] == 2 ) and !$unserialized[ 'id_pedido_lfbv' ] )
{
        $i++;
}
}
?>
