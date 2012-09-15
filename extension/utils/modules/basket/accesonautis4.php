<?php
require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result['content'] = $tpl->fetch( 'design:basket/accesonautis4.tpl' );
$Result['pagelayout'] = false;

?>
