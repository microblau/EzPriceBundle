<?php
include_once( "kernel/common/template.php" );
include_once( 'kernel/common/i18n.php' );
$tpl=templateInit();

$parametros=$Params['UserParameters'];
$Result=array();
$tpl->setVariable( 'params',$parametros);
$Result['content']=$tpl->fetch("design:vista.tpl");
//$Result['left_menu']='design:menu/leftmenu.tpl';
$Result['path']=array(
	array(
		'url' => false,
		'text' =>'valoraciones'
		)
	);
?>