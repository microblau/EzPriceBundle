<?php

$tpl = eZTemplate::factory();
$Result = array();
$Result['content'] = $tpl->fetch( "design:basket/gastos.tpl" );
$Result['pagelayout'] = false;

?>
