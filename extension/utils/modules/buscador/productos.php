<?php
$tpl = eZTemplate::factory();
$tpl->setVariable( 'sector', $Params['sector'] );
$tpl->setVariable( 'area', $Params['area'] );
$tpl->setVariable( 'formato', $Params['formato'] );

$tpl->setVariable( 'view_parameters', $Params['UserParameters'] );

$parameters = array( 'and' );
if( $Params['sector'] != 0 )
{
	$parameters[] = 'submeta_sector___id_si:' . $Params['sector'];
}

if( $Params['area'] != 0 )
{
	$parameters[] = 'submeta_area___id_si:' . $Params['area'];
}

if( $Params['formato'] != 0 )
{
	$parameters[] = 'submeta_formato___id_si:' . $Params['formato'];
}


$tpl->setVariable( 'parameters', $parameters );

$Result = array();

$Result['content'] = $tpl->fetch( 'design:buscador/productos.tpl' );
$Result['path'] = array( array( 'text' => 'Buscador de productos',
                                'url' => false )
                          );


?>
