<?php

$tpl = eZTemplate::factory();
$basketINI = eZINI::instance( 'basket.ini' );
$tpl->setVariable( 'shipping_cost_limit', $basketINI->variable( 'ShippingCosts',  'Limit' ) );
$tpl->setVariable( 'shipping_cost_zone1', $basketINI->variable( 'ShippingCosts',  'CostZone1' ) );
$tpl->setVariable( 'shipping_cost_zone2', $basketINI->variable( 'ShippingCosts',  'CostZone2' ) );
$tpl->setVariable( 'provincias', $basketINI->variable( 'ProvinciasNames', 'Provincias' ) );
$tpl->setVariable( 'provincias_zone_1', $basketINI->variable( 'ShippingCosts', 'ProvinciasZone1' ) );
$tpl->setVariable( 'provincias_zone_2', $basketINI->variable( 'ShippingCosts', 'ProvinciasZone2' ) );

$Result['content'] = $tpl->fetch( "design:basket/envios.tpl" );
$Result['path'] = array( array( 'url' => '/basket/envios/',
                                'text' => ezpI18n::tr( 'kernel/shop', 'Envíos' ) ) );


?>
