<?php
require( 'kernel/common/template.php' );
$tpl = templateInit();

$Result['content'] = $tpl->fetch( 'design:basket/imementorama.tpl' );
$Result['path'] = array( 
    array( 
        'url' => '/',
        'text' => 'Inicio' 
    ),
    array( 
        'url_alias' => '/catalogo/',
        'text' => 'Catálogo' 
    ),
    array( 
        'url_alias' => '/catalogo/imemento/imemento',
        'text' => 'Imemento' 
    ),
    array( 
        'url' => false,
        'text' => 'Configuración por rama del derecho' 
    )
);
?>
