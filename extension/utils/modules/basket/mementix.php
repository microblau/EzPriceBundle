<?php
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();

$Result['content'] = $tpl->fetch( 'design:basket/mementix.tpl' );
?>
