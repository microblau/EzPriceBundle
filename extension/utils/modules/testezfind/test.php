<?php



$db = eZDB::instance();

$sql="SELECT 
efl_orders.order_serialized,
efl_orders.productcollection_id,
ezorder.user_id,
ezorder.status_modified,
ezorder.id,
ezorder.order_nr
FROM efl_orders,ezorder
WHERE efl_orders.productcollection_id = ezorder.productcollection_id
ORDER BY ezorder.status_modified desc
LIMIT 0,200";

$data = $db->arrayQuery( $sql );


$ids = array(7534,7533,7531,7528,7527,7526,7523,7522,7520,7519,7516,7517,7512,7511,7510,7509,7508,7507,7506,7505,7504,7503,7502,7501,7500,7499,7498,7497,7495,7494,7493);

$cadena="<table>";
$cadena.="<tr><td>email</td><td>tipopago</td><td>id pedido</td><td>producto creado</td><td>usuario creado</td><td>order nr</td><td>colection id</td></tr>";


foreach ($data as $item)
{
	
	$usuario = $item["user_id"];
	$sqluser="SELECT modified FROM ezcontentobject WHERE id=" .$usuario;
	$datauser = $db->arrayQuery( $sqluser );
	$usercreated = date('d/m/Y h:i:s',$datauser[0]["modified"]);
	$modified = date('d/m/Y h:i:s',$item["status_modified"]);
	$ordernr=$item["order_nr"];
	$decode = unserialize($item['order_serialized']);
	$email = $decode["email"];
	$tipopago = $decode["tipopago"];
	$id_pedido = $decode["id_pedido_lfbv"];
	$id_collection = $item["productcollection_id"];	
	//if (($tipopago == 3) || ($tipopago == 2))
	if (in_array($id_pedido,$ids))
	
	{
		
		$cadena.="<tr><td>$email</td><td>$tipopago</td><td>$id_pedido</td><td>$modified</td><td>$usercreated</td><td>$ordernr</td><td>$id_collection</td></tr>";
		
		//echo("email: " .$email. " tipopago: " .$tipopago. " id: " .$id_pedido. " producto creado :".$modified." usuario creado :".$usercreated."<br>" );
	}
	
}

$cadena.="</table>";
	
echo($cadena);
	
	
eZExecution::cleanExit();


/*
require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result['content'] = $tpl->fetch( 'design:testezfind/test.tpl' );
$Result['pagelayout'] = false;
*/


?>

