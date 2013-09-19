<?php
require( 'kernel/common/template.php' );
$tpl = templateInit();

$tpl->setVariable( "productos", $_SESSION['productsImemento'] );

$Result['content'] = $tpl->fetch( 'design:basket/imemento.tpl' );
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
        'url_alias' => '/catalogo/imemento/imemento',
        'text' => 'Imemento' 
    ),
    array( 
        'url' => false,
        'text' => 'Configuración a la carta' 
    )
);
?>
