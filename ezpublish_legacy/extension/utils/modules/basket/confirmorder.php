<?php 
$http = eZHTTPTool::instance();
$module = $Params['Module'];

$tpl = eZTemplate::factory();
$tpl->setVariable( "module_name", 'basket' );

$orderID = $http->sessionVariable( 'MyTemporaryOrderID' );

$order = eZOrder::fetch( $orderID );
if ( !is_object( $order ) )
    return $Module->handleError( EZ_ERROR_KERNEL_NOT_AVAILABLE, 'kernel' );

if ( $order instanceof eZOrder )
{
    if ( $http->hasPostVariable( "ConfirmOrderButton" ) )
    {
        $order->detachProductCollection();
        $ini = eZINI::instance();
        if ( $ini->variable( 'ShopSettings', 'ClearBasketOnCheckout' ) == 'enabled' )
        {
            $basket = eZBasket::currentBasket();
            $basket->remove();
        }
        $module->redirectTo( '/basket/checkout/' );
        return;
    }

    if ( $http->hasPostVariable( "CancelButton" ) )
    {
        $order->purge( /*$removeCollection = */ false );
        $module->redirectTo( '/basket/basket/' );
        return;
    }

    $tpl->setVariable( "order", $order );
}

$basket = eZBasket::currentBasket();
$basket->updatePrices();

if( $http->hasPostVariable( 'formPago' ) )
{
    $basket = eZBasket::currentBasket();
    $infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => $basket->attribute( 'productcollection_id') ) );

    $unserialized_order = unserialize($infoOrder->Order);
$user = eZUser::currentUser();
$email = $user->attribute( 'login' );

$eflws = new eflWS();
$existeUsuario = $eflws->existeUsuario( $email );

    
 $usuario_empresa = $eflws->getUsuarioCompleto( $existeUsuario );
    $usuario = $usuario_empresa->xpath( '//usuario' );
    $provincia = (string)$usuario[0]->direnvio_provincia;
      // inicializamos total
            $total = 0;
            // recorremos cesta e incrementamos total si el producto es de categoría 
            // editorial
            // empezamos descartando los cursos

            $products = tantaBasketFunctionCollection::getProductsInBasket($basket->attribute( 'productcollection_id' ) );
$productos_editorial = 0;
foreach( $products['result'] as $product ){

$data = eZContentObject::fetch( $product['item_object']->attribute( 'contentobject' )->attribute( 'id' ) )->dataMap() ;
if( $data['categoria']->content()->attribute('name') == 'Editorial' ){
   $total += $product['total_price_ex_vat'];
   $productos_editorial++;
   }
}

    $gastosEnvio = eZShopFunctions::getShippingCost( $provincia, $total, $productos_editorial );

    $payments = new eflPaymentMethods();
    
    switch( $http->postVariable( 'formPago' ) )
    {
        case 1:  // Transferencia
            $unserialized_order['tipopago'] = 1;
            if( $http->postVariable( 'plazos' ) > 0 )
                $unserialized_order['plazos'] = $http->postVariable( 'plazos' );
            $unserialized_order['total'] = $http->postVariable( 'total' ) + $gastosEnvio;
            $unserialized_order['gastosEnvio'] = $gastosEnvio;
            $unserialized_order['aplazado'] = $http->postVariable( 'modPago' );
            $serialized_order = serialize( $unserialized_order ); 
            $infoOrder->Order = $serialized_order;
            $infoOrder->store();
            $paymentObject = eflPaymentObject::createNew( $basket->OrderID, 'Domiciliación' );  
            $paymentObject->store();        
            $datos = $payments->transferencia( $basket->OrderID, $unserialized_order['total'] );
            $tpl->setVariable( 'datos', $datos );  
            break;
            
    	case 2:  // BBVA
    		$unserialized_order['tipopago'] = 2;
    		if( $http->postVariable( 'plazos' ) > 0 )
    		  $unserialized_order['plazos'] = $http->postVariable( 'plazos' );
    		$unserialized_order['total'] = number_format( (float)$http->postVariable( 'total' ) + (float)$gastosEnvio, 2 );
                $unserialized_order['gastosEnvio'] = $gastosEnvio;
    		$unserialized_order['aplazado'] = $http->postVariable( 'modPago' );
    		/*calculo id_transaccion */
    		$y = substr( date( 'Y' ), 3, 1 );
            $DDD = date( 'z' );
            if( ( $DDD < 100 ) and ( $DDD >= 10 ) )
            {
                $DDD = '0' . (string)$DDD; 
            }   
            else if ( $DDD < 10 ) 
            {
                $DDD = '00' . (string)$DDD;
            }   
            $HH = date( 'H' );
            $mm = date( 'i' );
            $ss = date( 's' );
            $SS = rand( 11, 99 );
    		
    		$idtransaccion = "$y$DDD$HH$mm$ss$SS";
    		$unserialized_order['idtransaccion'] = $idtransaccion; 
    		
    		$serialized_order = serialize( $unserialized_order ); 
    		$infoOrder->Order = $serialized_order;
    		$infoOrder->store();
    		$paymentObject = eflPaymentObject::createNew( $basket->OrderID, 'BBVA' );  
    		$paymentObject->store(); 	
	
            $datos = $payments->bbva( $basket->OrderID, $unserialized_order['total'], $idtransaccion );
            $tpl->setVariable( 'datos', $datos );  
            break;
            
        case 3:   // Paypal        	
    		$unserialized_order['tipopago'] = 3;
    		if( $http->postVariable( 'plazos' ) > 0 )
    		  $unserialized_order['plazos'] = $http->postVariable( 'plazos' );
    		$unserialized_order['total'] = $http->postVariable( 'total' ) + $gastosEnvio;
                $unserialized_order['gastosEnvio'] = $gastosEnvio;
    		$unserialized_order['aplazado'] = $http->postVariable( 'modPago' );
    		$serialized_order = serialize( $unserialized_order ); 
    		$infoOrder->Order = $serialized_order;
    		$infoOrder->store(); 
    		$paymentObject = eflPaymentObject::createNew( $basket->OrderID, 'Paypal'  );    		
    		$paymentObject->store();
            $datos = $payments->paypal( $basket->OrderID,  $unserialized_order['total'], $http->postVariable( 'modPago' ), $unserialized_order['gastosEnvio'] );
            $tpl->setVariable( 'datos', $datos );  
            break;
            
         case 4:   // Domiciliación            
            $unserialized_order['tipopago'] = 4;
            if( $http->postVariable( 'plazos' ) > 0 )
              $unserialized_order['plazos'] = $http->postVariable( 'plazos' );
            $unserialized_order['total'] = $http->postVariable( 'total' ) + $gastosEnvio;
            $unserialized_order['gastosEnvio'] = $gastosEnvio;
            $unserialized_order['aplazado'] = $http->postVariable( 'modPago' );
            $unserialized_order['titular_cuenta'] = $http->postVariable( 'titular' );
            $unserialized_order['banco'] = $http->postVariable( 'banco' );
            $unserialized_order['sucursal'] = $http->postVariable( 'sucursal' );
            $unserialized_order['control'] = $http->postVariable( 'control' );
            $unserialized_order['ncuenta'] = $http->postVariable( 'cuenta' );
            $serialized_order = serialize( $unserialized_order ); 
            $infoOrder->Order = $serialized_order;
            $infoOrder->store(); 
            $paymentObject = eflPaymentObject::createNew( $basket->OrderID, 'Domiciliación'  );            
            $paymentObject->store();
            $datos = $payments->domiciliacion( $basket->OrderID, $unserialized_order['total'] );
            $tpl->setVariable( 'datos', $datos );  
            break;
            
    	default: 
    		break;
    }	
}

$Result = array();
$Result['content'] = $tpl->fetch( "design:basket/confirmorder.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
?>
