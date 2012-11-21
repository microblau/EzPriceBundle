<?php 
require( 'kernel/common/template.php' );
$tpl = templateInit();
$Result = array();
$Result['content'] = $tpl->fetch( "design:paypal/cancel.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
?>