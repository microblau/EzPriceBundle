<?php
$http = eZHTTPTool::instance();
$mementos = $http->getVariable( 'mementos' );

$object = eZContentObject::fetch( $http->getVariable( 'id' ) );
$products = explode( ',', $http->getVariable( 'products' ) );

$http->setSessionVariable('productsImemento', "");


$tabla = eZContentObject::fetch( eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Tabla' ) );
$datatabla = $tabla->dataMap();

$data = $object->dataMap();

$preciomonopuesto = $data['precio']->content()->exVATPrice();

if( ( $mementos > 0 ))
{
       
	
	$mayor = $datatabla['tabla_precios']->content()->Matrix["rows"]["sequential"];
	
	if ($mementos <= count($mayor))
	{
		$discount = eZPersistentObject::fetchObject( eflImementoDiscountRule::definition(), null, 
                                                     array( 'qte_mem' => array( '>=', $mementos ),
                                                            'contentobjectattribute_id' => $datatabla['tabla_precios']->attribute( 'id' ),
                                                            'contentobjectattribute_version' => $datatabla['tabla_precios']->attribute( 'version' ) ) );
	}
	else
	{
		$discount = eZPersistentObject::fetchObject( eflImementoDiscountRule::definition(), null, 
                                                     array( 'qte_mem' => array( '>=', (count($mayor)) ),
                                                            'contentobjectattribute_id' => $datatabla['tabla_precios']->attribute( 'id' ),
                                                            'contentobjectattribute_version' => $datatabla['tabla_precios']->attribute( 'version' ) ) );
	}
	
	
	
	
	$precio = 0;
	foreach( $products as $product )
	{

		$pData = eZContentObject::fetch( $product )->dataMap();
		$precio += $pData['precio_imemento']->content()->attribute( 'ex_vat_price' );
	}

        
        $discountpercent = $discount->Discount;
		$total = $precio - ( $discount->Discount / 100 * $precio );

}
else
{
    $precio = 0;
    $discountpercent = 0;
    $total = 0;
}

$http->setSessionVariable('productsImemento', $products);

$result = array( 'price' => number_format( $precio, 2, '.', '' ) . ' €', 'discount' =>  $discountpercent . '%', 'total' => number_format( $total, 2, '.', '' ) . ' €');
echo json_encode( $result );
eZExecution::cleanExit();
?>
