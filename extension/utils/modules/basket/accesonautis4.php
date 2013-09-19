<?php
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
$Result['content'] = $tpl->fetch( 'design:basket/accesonautis4.tpl' );
$Result['pagelayout'] = false;

?>
