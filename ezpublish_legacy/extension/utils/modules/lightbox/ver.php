<?php 

$tpl = eZTemplate::factory(); 
$n = $Params['NodeID'];

$node = eZContentObjectTreeNode::fetch( $n );

$tpl->setVariable( 'node', $node );
print $tpl->fetch( 'design:ajax/lightbox.tpl' );	
//$tpl->fetch( 'design:ajax/lightbox.tpl' );					                       
eZExecution::cleanExit();


?>
