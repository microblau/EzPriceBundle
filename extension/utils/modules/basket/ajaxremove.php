<?php

$http = eZHttpTool::instance();
$module = $Params['Module'];
$ObjectID = $Params['ObjectID'];

var_dump($ObjectID);


$basket = eZBasket::currentBasket();
$db = eZDB::instance();
$db->begin();
$basket->removeItem( $ObjectID );
eZShippingManager::updateShippingInfo( $basket->attribute( 'productcollection_id' ) );
$db->commit();
$basket = eZBasket::currentBasket();


$output = 'Tiene <a href="http://' . $domain . '/' . $url . '">' . count( $basket->items() ) . ' producto' . ( count( $basket->items() ) != 1 ? 's' : '' ) . '</a> en la cesta';
echo json_encode( array( 'output' => $output ) );
eZExecution::cleanExit();
?>
