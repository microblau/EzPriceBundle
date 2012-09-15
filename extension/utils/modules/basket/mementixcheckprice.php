<?php
$http = eZHTTPTool::instance();
$accesos = $http->getVariable( 'accesos' );
$mementos = $http->getVariable( 'mementos' );

$object = eZContentObject::fetch( $http->getVariable( 'id' ) );
$tabla = eZContentObject::fetch( 332 );
$datatabla = $tabla->dataMap();
$data = $object->dataMap();

$preciomonopuesto = $data['precio']->content()->exVATPrice();

if( ( $accesos > 0 ) and ( $mementos > 0 ) )
{
       $discount = eZPersistentObject::fetchObject( eflMementixDiscountRule::definition(), null, 
                                                     array( 'qte_min' => array( '<=', $accesos ),
                                                            'qte_max' => array( '>=', $accesos ),
                                                            'qte_mem' => $mementos,
                                                            'contentobjectattribute_id' => $datatabla['tabla_precios']->attribute( 'id' ),
                                                            'contentobjectattribute_version' => $datatabla['tabla_precios']->attribute( 'version' ) ) );

        $precio = $preciomonopuesto * $mementos * $accesos;
        $discountpercent = $discount->Discount;
        $total = $precio - ( $discount->Discount / 100 * $precio );

}
else
{
    $precio = $preciomonopuesto;
    $discountpercent = 0;
    $total = $preciomonopuesto;
}

$result = array( 'price' => number_format( $precio, 2, '.', '' ) . ' €', 'discount' =>  $discountpercent . '%', 'total' => number_format( $total, 2, '.', '' ) . ' €');
echo json_encode( $result );
eZExecution::cleanExit();
?>
