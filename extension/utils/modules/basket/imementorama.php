<?php
require( 'kernel/common/template.php' );
$tpl = templateInit();

$basket = eZBasket::currentBasket();

$content = array();
$removeitem = array();
$productos = array();

foreach ($basket->items() as $item)
{
	$content[$item["item_object"]->ContentObject->ID] = $item["item_object"]->ContentObject->ID;
	$removeitem[$item["item_object"]->ContentObject->ID] = $item["id"];
	
	$pData = eZContentObject::fetch( $item["item_object"]->ContentObject->ID );
	$datos = $pData->dataMap();

	$precio = $datos['precio']->content()->attribute( 'ex_vat_price' );
	$total =  $datos['precio_oferta']->content()->attribute( 'ex_vat_price' );
	$discountpercent = $datos['descuento_pack']->content();
	$name = $datos['nombre']->content();
	$productos[] = array('precio' => $precio, 'total' => $total, 'discountpercent'=> $discountpercent, 'name' => $name);
}

$tpl->setVariable( "content", $content );
$tpl->setVariable( "removeitem", $removeitem );
$tpl->setVariable( "productos", $productos );


$Result['content'] = $tpl->fetch( 'design:basket/imementorama.tpl' );
$Result['path'] = array( 
    array( 
        'url' => '/',
        'text' => 'Inicio' 
    ),
    array( 
        'url_alias' => '/catalogo/',
        'text' => 'Catálogo' 
    ),
    array( 
        'url_alias' => '/catalogo/imemento/imemento',
        'text' => 'Imemento' 
    ),
    array( 
        'url' => false,
        'text' => 'Configuración por rama del derecho' 
    )
);
?>
