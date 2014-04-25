<?php
$http = eZHTTPTool::instance();
$mementos = $http->getVariable( 'mementos' );

$object = eZContentObject::fetch( $http->getVariable( 'id' ) );
$products = explode( ',', $http->getVariable( 'products' ) );

$tabla = eZContentObject::fetch( eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Tabla' ) );
$datatabla = $tabla->dataMap();
$data = $object->dataMap();

$basket = eZBasket::currentBasket();

foreach ($basket->items() as $item)
{
	$content[] = $item["item_object"]->ContentObject->ID;
}

if( ( $mementos > 0 ))
{
	foreach( $products as $product )
	{
		$pData = eZContentObject::fetch( $product );
		$datos = $pData->dataMap();
		
		$precio = $datos['precio']->content()->attribute( 'ex_vat_price' );
		$total = $datos['precio_oferta']->content()->attribute( 'ex_vat_price' );
		$discountpercent = $datos['descuento_pack']->content();
		$name = $datos['nombre']->content();
		$id = $pData->ID;
		//añadimos el producto a la cesta
		
		
		if (!(in_array($id,$content)))
		{
		
		$OptionList = count( $http->sessionVariable( "AddToBasket_OptionList_" . $id )  ) ? $http->sessionVariable( "AddToBasket_OptionList_" . $id ) : array() ;
		
		
		$operationResult = eZOperationHandler::execute( 'shop', 'addtobasket', array( 'basket_id' => $basket->attribute( 'id' ),
                                                                              'object_id' => $id,
                                                                              'quantity' => 1,
                                                                              'option_list' => $OptionList ) );
		
		}
		
		$items = $basket->items();
		$remove = $items[0]["id"];
		$items = count( $basket->items() );
		
		$result['row'][] = array( 'items' => $items ,'remove' => $remove ,'id' => $id ,'name'=> $name, 'price' => number_format( $precio, 2, '.', '' ) . ' €', 'discount' =>  $discountpercent . '%', 'total' => number_format( $total, 2, '.', '' ) . ' €');
		
	}
}
else
{
	$name="";
	$precio="";
	$discountpercent="";
	$id="";
	$total="";
	$remove="";
	$items = 0;
	$result['row'][] = array( 'items' => $items ,'remove' => $remove ,'id' => $id ,'name'=> $name, 'price' => number_format( $precio, 2, '.', '' ) . ' €', 'discount' =>  $discountpercent . '%', 'total' => number_format( $total, 2, '.', '' ) . ' €');
}
echo json_encode( $result );
eZExecution::cleanExit();
?>
