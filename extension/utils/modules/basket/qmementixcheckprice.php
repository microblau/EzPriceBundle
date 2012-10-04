<?php
$http = eZHTTPTool::instance();
$mementos = $http->getVariable( 'mementos' );

$object = eZContentObject::fetch( $http->getVariable( 'id' ) );
$products = explode( ',', $http->getVariable( 'products' ) );

$tabla = eZContentObject::fetch( eZINI::instance( 'qmementix.ini' )->variable( 'Qmementix', 'Tabla' ) );
$datatabla = $tabla->dataMap();

$data = $object->dataMap();

$preciomonopuesto = $data['precio']->content()->exVATPrice();

if( ( $mementos > 0 ))
{
       $discount = eZPersistentObject::fetchObject( eflImementoDiscountRule::definition(), null, 
                                                     array( 'qte_mem' => array( '>=', $mementos ),
                                                            'contentobjectattribute_id' => $datatabla['tabla_precios']->attribute( 'id' ),
                                                            'contentobjectattribute_version' => $datatabla['tabla_precios']->attribute( 'version' ) ) );
	$precio = 0;
	foreach( $products as $product )
	{

		$pData = eZContentObject::fetch( $product )->dataMap();
				
		if ($pData['oferta_qmementix']->content()->attribute( 'ex_vat_price' ) !=0)
		{
			$precio += $pData['oferta_qmementix']->content()->attribute( 'ex_vat_price' );
			$precionormal += $pData['precio_qmementix']->content()->attribute( 'ex_vat_price' );
		}
		else
		{
			$precio += $pData['precio_qmementix']->content()->attribute( 'ex_vat_price' );
			$precionormal += $pData['precio_qmementix']->content()->attribute( 'ex_vat_price' );
		}	
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

$result = array( 'pricenorm' => number_format( $precionormal, 2, '.', '' ) . ' €','price' => number_format( $precio, 2, '.', '' ) . ' €', 'discount' =>  $discountpercent . '%', 'total' => number_format( $total, 2, '.', '' ) . ' €');
echo json_encode( $result );
eZExecution::cleanExit();
?>
