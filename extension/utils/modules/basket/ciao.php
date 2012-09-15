<?php

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
				array( 'ClassFilterType' => 'include', 
					   'ClassFilterArray' => array( 48 )
				)
, 61);

$offset = 0;
$counter = 0;
$output = '';

do
{
    $part = array_slice( $nodes, $offset, 10 );
    for( $i = 0; $i < count( $part ) ; $i++ )
    {
        $vector = array();
        $nodo = $part[$i];	
        $data = $nodo->dataMap();
        $vector[] = 'Libros';
        $area = $data['area']->content();
        $vector[] = eZContentObject::fetch( $area['relation_list'][0]['contentobject_id'] )->attribute( 'name' );
        $vector[] = $nodo->attribute( 'name' );
        $vector[] = 'Ediciones Francis Lefebvre';
        $vector[] = 'Ediciones Francis Lefebvre';
        $vector[] = implode( '', explode( '-', $data['isbn']->attribute( 'data_text' )  ) );
        $vector[] = $data['subtitulo']->content();
        $img = $data['imagen']->content();
        $imgobject = eZContentObject::fetch( $img['relation_browse'][0]['contentobject_id'] );
        $dataimg = $imgobject->dataMap();
        $image_alias_handler = new eZImageAliasHandler( $dataimg['image'] );

        $alias = $image_alias_handler->imageAlias( 'fichaproducto' );

        
        $vector[] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $alias['url'];
        $vector[] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $nodo->urlAlias() . '?utm_source=ciao&utm_medium=cpc&utm_content=Ciao&utm_campaign=Ciao' . $data['referencia']->content();
        $precio = $data['precio']->content();
        $vector[] = ( $precio->attribute( 'discount_percent' ) > 0 ) ? str_replace( ".", ",", $precio->attribute( 'discount_price_ex_vat' ) ) : str_replace( ".", ",", $precio->attribute( 'price' ) );
        $vector[] = 0;
        $vector[] = '2-3 días';
        $vector[] = ( $data['fecha_aparicion']->content()->timestamp() < time() ) ? 'En Stock' : 'Prepublicación';
        $output.= implode( '|', $vector ) . "\n";
    }
    $offset += 10;
}

while ( $offset <= count( $nodes ) );
header('Content-type: application/txt');
header('Content-Disposition: attachment; filename="fichero_ciao_EFL.txt"');
echo $output;
echo "\r\n";
eZExecution::cleanExit();
?>
