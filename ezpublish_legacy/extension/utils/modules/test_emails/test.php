<?php

$http = eZHTTPTool::instance();
$tipo = $http->getVariable( 'tipo' );
require( 'kernel/common/template.php' );

$tpl = eZTemplate::factory();

if($tipo == 'tarjeta')
	$Result['content'] = $tpl->fetch( 'design:test_emails/mail_pedido_tarjeta.tpl' );
else if ($tipo == 'domiciliacion')
	$Result['content'] = $tpl->fetch( 'design:test_emails/mail_pedido_domiciliacion.tpl' );
else if ($tipo == 'paypal')
	$Result['content'] = $tpl->fetch( 'design:test_emails/mail_pedido_paypal.tpl' );
else if ($tipo == 'transferencia')
	$Result['content'] = $tpl->fetch( 'design:test_emails/mail_pedido_transferencia.tpl' );
else{
	echo "<br>Debes indicar con 'get' el parametro 'tipo' la plantilla de email a visualizar:";
	echo "<br>Ejemplo 1 : http://efl.tantacom.com/test_emails/test/?tipo=tarjeta";
	echo "<br>Ejemplo 2 : http://efl.tantacom.com/test_emails/test/?tipo=domiciliacion";
	echo "<br>Ejemplo 3 : http://efl.tantacom.com/test_emails/test/?tipo=paypal";
	echo "<br>Ejemplo 4 : http://efl.tantacom.com/test_emails/test/?tipo=transferencia"; 	 	 	
} 	 	 	 	 	



$Result['pagelayout'] = false;
?>

