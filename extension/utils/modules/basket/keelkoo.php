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
    $part = array_slice( $restaurantes, $offset, 10 );
    for( $i = 0; $i < count( $part ) ; $i++ )
    {
        $vector = array();
        $nodo = $part[$i];	
        $data = $nodo->dataMap();
        $vector[]= 'Libros';
        print_r( $data );
        $offset += 10;
    }
}
while ( $offset <= count( $nodes ) );
?>
