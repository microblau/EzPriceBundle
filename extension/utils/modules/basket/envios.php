<?php

$tpl = eZTemplate::factory();

$Result['content'] = $tpl->fetch( "design:basket/envios.tpl" );
$Result['path'] = array( array( 'url' => '/basket/envios/',
                                'text' => ezpI18n::tr( 'kernel/shop', 'Envíos' ) ) );


?>
