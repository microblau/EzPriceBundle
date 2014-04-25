<?php
require 'autoload.php';
$cli = eZCLI::instance();
$script = eZScript::instance( array( 'description' => ( "eZ Publish (un)clusterize\n" .
                                                        "Script for moving var_dir files from " .
                                                        "filesystem to database and vice versa\n" .
                                                        "\n" .
                                                        "./bin/php/clusterize.php" ),
                                     'use-session'    => false,
                                     'use-modules'    => false,
                                     'use-extensions' => true ) );

$script->startup();

$script->initialize();


$db = eZDB::instance();
//$query = $db->arrayQuery( 'SELECT * FROM efl_orders where productcollection_id = 15405 ');
/*$query = $db->arrayQuery('select ezorder.created , ezorder.id, ezorder.productcollection_id, efl_orders.order_serialized,ezorder.user_id
from efl_orders, ezorder where ezorder.productcollection_id=efl_orders.productcollection_id and ezorder.created>1391558401 and ezorder.created<1391644799
ORDER BY ezorder.productcollection_id ');

foreach ($query as $row){
	$cli->output( 'fecha '.date('d/m/Y H:i', $row['created']));
	$cli->output( 'ID '.$row["id"]);
	$cli->output( 'PRODCOLLECTION '.$row["productcollection_id"]);
	$unserialized = $row['order_serialized'];
	$unun=unserialize( $unserialized );
	$cli->output( 'PAGO '.$unun["tipopago"]);
	$cli->output( 'ID_pEDIDO_LFBV '.$unun["id_pedido_lfbv"]);
	$cli->output( 'usuario '.$row["user_id"]);
	$cli->output( '----');

}
*/
/*$queryn = $db->arrayQuery( 'SELECT * FROM efl_orders where productcollection_id = 336149 ');
foreach ($queryn as $row){
	//$cli->output( 'fecha '.date('d/m/Y H:i', $row['created']));
	//$cli->output( 'ID '.$row["id"]);
	$cli->output( 'PRODCOLLECTION '.$row["productcollection_id"]);
	$unserialized = $row['order_serialized'];
	$unun=unserialize( $unserialized );
	$cli->output( 'PAGO '.$unun["tipopago"]);
	$cli->output( 'ID_pEDIDO_LFBV '.$unun["id_pedido_lfbv"]);
	$cli->output( 'usuario '.$row["user_id"]);
	$cli->output( '----');

}*/

$query = $db->arrayQuery('select ezorder.created , ezorder.id, ezorder.productcollection_id, efl_orders.order_serialized,ezorder.user_id
from efl_orders, ezorder where ezorder.productcollection_id=efl_orders.productcollection_id 
ORDER BY ezorder.productcollection_id desc limit 11 ');

foreach ($query as $row){
	$cli->output( 'fecha '.date('d/m/Y H:i', $row['created']));
	$cli->output( 'ID '.$row["id"]);
	$cli->output( 'PRODCOLLECTION '.$row["productcollection_id"]);
	$unserialized = $row['order_serialized'];
	$unun=unserialize( $unserialized );
	$cli->output( 'PAGO '.$unun["tipopago"]);
	$cli->output( 'ID_pEDIDO_LFBV '.$unun["id_pedido_lfbv"]);
	$cli->output( 'usuario '.$row["user_id"]);
	$cli->output( '----');

}



//$unserialized = $query[0]['order_serialized'];
//print_r( unserialize( $unserialized ) );

//var_dump($query);

$script->shutdown();

?>

