<?php
$products = eZContentObjectTreeNode::subTreeByNodeId(
	array(
		'ClassFilterType' => 'include',
		'ClassFilterArray' => array( 48 )
	),
	array( 61 )
);
$xml = new DOMDocument( "1.0" );
$xml->formatOutput = TRUE;
$root = $xml->createElement('rss');
$root->setAttribute('xmlns:g', "http://base.google.com/ns/1.0");
$root->setAttribute('version', '2.0' );


$channel = $xml->createElement('channel');
$channel_title = $xml->createElement('title', 'Ediciones Francis Lefebvre' );
$channel_link = $xml->createElement('link', 'http://www.efl.es' );
$channel_desc_txt = $xml->createCDATASection( 'Editorial jurídica Ediciones Francis Lefebvre y cursos de derecho. Compre aquí Mementos y libros de derecho penal, laboral, mercantil, tributario o civil con un 10% de descuento en novedades' );
$channel_desc = $xml->createElement('description');
$channel_desc->appendChild($channel_desc_txt);
$channel->appendChild($channel_title);
$channel->appendChild($channel_link);
$channel->appendChild($channel_desc);

foreach( $products as $product ){

$item = $xml->createElement('item');
$item_title_cdata = $xml->createCDATASection( $product->attribute( 'name' ) );
$item_title = $xml->createElement('title' );
$item_title->appendChild( $item_title_cdata );
$item_link = $xml->createElement('link', 'http://www.efl.es/' . $product->urlAlias() );
$data = $product->dataMap();

$item_description_cdata = $xml->createCDATASection( $data['entradilla']->content()->attribute('output')->attribute('output_text') );
$item_description = $xml->createElement('description' );
$item_description->appendChild( $item_description_cdata);

$item_id = $xml->createElement( 'g:id', 'EFL-' . $product->attribute('node_id' ) );
$item_condition = $xml->createElement( 'g:condition', 'new' );
$item_price = $xml->createElement( 'g:price', number_format( $data['precio']->content()->attribute('inc_vat_price'), 2 )  . ' EUR' );


$item->appendChild( $item_title );
$item->appendChild( $item_link );
$item->appendChild( $item_description );
$item->appendChild( $item_id );
$item->appendChild( $item_condition );
$item->appendChild( $item_price );
if ( $data['precio']->content()->attribute('has_discount' )) {
	$item_offer_price = $xml->createElement( 'g:sale_price', number_format( $data['precio']->content()->attribute('discount_price_inc_vat'), 2 )  . ' EUR' );
	$item->appendChild( $item_offer_price );
}

$item_availabilty = $xml->createElement('g:availability', 'in_stock' );
$item->appendChild( $item_availabilty );


if( $image = $data['imagen']->content() ){
if( $img_object = eZContentObject::fetch( $image['relation_browse']['0']['contentobject_id'] ) ){
$img_object_data = $img_object->dataMap();
$aliasList = $img_object_data['image']->content()->aliasList();

$fullPath = $aliasList['original']['full_path'];


$item_image_link = $xml->createElement('g:image_link', 'http://www.efl.es/' . $fullPath );
$item->appendChild( $item_image_link );
}
}

$isbn = $data['isbn']->content();
$item_gtin = $xml->createElement('g:gtin', $isbn['value_without_hyphens']);
$item->appendChild( $item_gtin );

$item_type_cdata = $xml->createCDATASection('Medios audiovisuales > Libros > No ficción > Manuales de derecho');
$item_type = $xml->createElement('g:product_type'  );
$item_type->appendChild( $item_type_cdata );
$item->appendChild($item_type );

$channel->appendChild($item);

}

$root->appendChild($channel);

$xml->appendchild($root);
header('Content-disposition: attachment; filename="efl_feed.xml"');
header('Content-type: "text/xml"; charset="utf8"');
readfile('efl_feed.xml');
print $xml->saveXML();
eZExecution::cleanExit()


?>
