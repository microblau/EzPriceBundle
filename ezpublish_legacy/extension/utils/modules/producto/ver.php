<?php 

$tpl = eZTemplate::factory(); 
$n = $_GET['n'];
$node = eZContentObjectTreeNode::fetch( $n );
$tpl->setVariable( 'node', $node );
print $tpl->fetch( 'design:ajax/videoproducto.tpl' );	
//$tpl->fetch( 'design:ajax/videoproducto.tpl' );					                       
eZExecution::cleanExit();


?>
