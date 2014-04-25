<?php

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
    array(
        'ClassFilterType' => 'include',
        'ClassFilterArray' => array( 48, 98, 99, 101, 112 )
    ), 61
);

$output = '';
foreach( $nodes as $node )
{
    $data = $node->dataMap();
    $output .= '"'. $node->attribute( 'name' ) . '","' . $data['referencia']->content() . '","http://www.efl.es/' . $node->attribute( 'url_alias' ) . '"' . "\n";
}
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header("Content-type: text/x-csv");
	//header("Content-type: text/csv");
	//header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=productos". date( 'dmYHis' ) .".csv");
echo $output;
eZExecution::cleanExit();            
                                                        

?>
