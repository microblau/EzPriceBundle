<?php 

print_r( $_GET );

require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result = array();
$Result['content'] = $tpl->fetch( "design:tpv/cancel.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezi18n( 'kernel/shop', 'Basket' ) ) );
?>