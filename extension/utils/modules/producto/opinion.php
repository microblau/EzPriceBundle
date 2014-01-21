<?php 

$tpl = eZTemplate::factory();
$v = new Valoraciones(); 
$havotado = false;
if( is_numeric( $_GET['n'] ) && eZUser::currentUser()->isLoggedIn() )
    $havotado = $v->havotado( $_GET['n'], eZUser::currentUser()->id() );

$n = $_GET['n'];
if ( ($n=='already') or ($havotado['result'] == 1 ) ){
	print $tpl->fetch( 'design:ajax/yahasvotado.tpl' );	
	eZExecution::cleanExit();

	}else{
$node = eZContentObjectTreeNode::fetch( $n );
$tpl->setVariable( 'node', $node );
print $tpl->fetch( 'design:ajax/formularioopinion.tpl' );	
eZExecution::cleanExit();
	}

?>
