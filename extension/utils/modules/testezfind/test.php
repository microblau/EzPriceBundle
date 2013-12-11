<?php

require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
$Result['content'] = $tpl->fetch( 'design:testezfind/test.tpl' );
$Result['pagelayout'] = false;
?>

