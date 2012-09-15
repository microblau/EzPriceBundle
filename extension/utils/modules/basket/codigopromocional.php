<?php
require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result['content'] = $tpl->fetch( 'design:basket/codigopromocional.tpl' );
$Result['pagelayout'] = false;

?>
