<?php


include_once( 'kernel/common/template.php' );
$tpl = templateInit();
$Result["content"] = $tpl->fetch( "design:efltwitter/status.tpl" );

?>