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
$root->setAttribute('version', '2.0' );
$root->setAttribute('xmlns:g', "http://base.google.com/ns/1.0");

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
print_r(array_keys($precio) );
$item_description_cdata = $xml->createCDATASection( $data['entradilla']->content()->attribute('output')->attribute('output_text') );
$item_description = $xml->createElement('description' );
$item_description->appendChild( $item_description_cdata);

$item_id = $xml->createElement( 'g:id', 'EFL-' . $product->attribute('node_id' ) );
$item_condition = $xml->createElement( 'g:condition', 'new' );


$item->appendChild( $item_title );
$item->appendChild( $item_link );
$item->appendChild( $item_description );
$item->appendChild( $item_id );
$item->appendChild( $item_condition );

$channel->appendChild($item);

}

$root->appendChild($channel);

$xml->appendchild($root);
header('Content-Type: text/xml');
echo $xml->saveXML();
eZExecution::cleanExit()


?>
