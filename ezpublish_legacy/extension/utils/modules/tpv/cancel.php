<?php 

print_r( $_GET );

require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
$Result = array();
$Result['content'] = $tpl->fetch( "design:tpv/cancel.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
?>