<?php 

require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();

$user = eZUser::currentUser();
$email = $user->attribute( 'login' );

$eflws = new eflWS();
if ( $user->isLoggedIn() )
    $existeUsuario = $eflws->existeUsuario( $email );
else
    $existeUsuario == 0;

$basket = eZBasket::currentBasket();
$basket->updatePrices();
$key = $Params['key'];
if( ( $basket->attribute( 'order_id' ) == 0 ) or ( $key != md5( 'eflbasket' . $basket->attribute( 'productcollection_id' ) ) ) )
{
	return $Module->redirectTo( 'basket/basket' );
}

if ( $existeUsuario == 0 )
{
	// error
	// no puede acceder aquí
	$confianza_pago = 0;
	$Result = array();
    $Result['content'] = $tpl->fetch( "design:basket/payment.tpl" );
    $Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
}
else
{
	$usuario_empresa = $eflws->getUsuarioCompleto( $existeUsuario );
	$usuario = $usuario_empresa->xpath( '//usuario' );
	$confianza_pago = (int)$usuario[0]->confianza_pago;
	$aplazado = (int)$usuario[0]->confianza_pago;
	$tpl->setVariable( 'confianza_pago', $confianza_pago );
	$tpl->setVariable( 'aplazado', $aplazado );
	$basket = eZBasket::currentBasket();
	//$training = tantaBasketFunctionCollection::getTrainingInBasket( $basket->attribute( 'productcollection_id') );
	if( count( $training['result'] ) > 0 )
	{
		$tpl->setVariable( 'aplazado', 0 );
	}	
	$tpl->setVariable( 'plazos', 0 );
	if( $confianza_pago == 1 )
	{
		$basket = eZBasket::currentBasket();
		$plazos = tantaBasketFunctionCollection::getPlazos( $basket->totalIncVAT() );		
		$tpl->setVariable( 'plazos', $plazos );
	}
	
	$Result = array();
	$Result['content'] = $tpl->fetch( "design:basket/payment.tpl" );
	$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
}
?>
