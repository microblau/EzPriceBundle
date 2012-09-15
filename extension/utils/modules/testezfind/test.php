<?php

require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result['content'] = $tpl->fetch( 'design:testezfind/test.tpl' );
$Result['pagelayout'] = false;
?>

