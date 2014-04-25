<?php
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();

$Result['content'] = $tpl->fetch( 'design:basket/qmementix.tpl' );
$Result['path'] = array( 
    array( 
        'url' => '/',
        'text' => 'Inicio' 
    ),
    array( 
        'url_alias' => '/catalogo',
        'text' => 'Catálogo' 
    ),
    array( 
        'url_alias' => '/catalogo/qmementix/qmementix',
        'text' => 'Qmementix' 
    ),
    array( 
        'url' => false,
        'text' => 'Configuración a la carta' 
    )
);
?>
