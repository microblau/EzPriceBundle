<?php
$http = eZHTTPTool::instance();
$basketINI = eZINI::instance( 'basket.ini' );

if( $http->hasPostVariable( 'StoreChangesButton') )
{
    $basketINI->setVariable( 
        'ShippingCosts', 
        'Limit', 
        $http->postVariable( 'shipping_cost_limit' ) 
    );

    $basketINI->setVariable( 
        'ShippingCosts', 
        'CostZone1', 
        $http->postVariable( 'shipping_cost_zone1' ) 
    );
    
    $basketINI->setVariable( 
        'ShippingCosts', 
        'CostZone2', 
        $http->postVariable( 'shipping_cost_zone2' ) 
    );

    $basketINI->setVariable( 
        'ShippingCosts', 
        'ProvinciasZone1', 
        $http->postVariable( 'provincias_zona_1' ) 
    );
    
    $basketINI->setVariable( 
        'ShippingCosts', 
        'ProvinciasZone2', 
        $http->postVariable( 'provincias_zona_2' ) 
    );
    
    $basketINI->save( 
        'extension/utils/settings/basket.ini',
        false,
        false,
        false,
        false
     );
    $basketINI->resetCache();
}

$tpl = eZTemplate::factory();
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
