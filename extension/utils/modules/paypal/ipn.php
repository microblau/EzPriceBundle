<?php 
$http = eZHTTPTool::instance();
$ini = eZINI::instance( 'basket.ini' );

$order_id = $Params['OrderID'];
$order = eZOrder::fetch( $order_id );

$n = $order->attribute( 'productcollection_id' );

require( 'kernel/common/template.php' );
$tplmail = templateInit();



/*
if (!$http->hasPostVariable( 'invoice')  ) 
{
    return;
}
*/
$cd_camp = $http->getVariable( 'cd_camp' );
//Si la variables "cd_camp" viene nula o vacía le pasamos un guión.
if (($cd_camp == null) || ($cd_camp == ''))
{
	$cd_camp = '-';
}
$order_id = $Params['OrderID'];

$checker = new eflPaypalChecker( 'basket.ini' );
$checker->createDataFromPOST();

//die('ejhe');

if( $response = $checker->requestValidation() or 1 )
{
    if( $checker->checkPaymentStatus() or 1)
    {
        //procesar la orden. aprobar el pago
        $checker->logger->writeTimedString(  'aprobando'  );
        $orderID = $Params['OrderID'];
        if( $checker->setupOrderAndPaymentObject( $order_id ) or 1 )
        {
	        $amount   = $checker->getFieldValue( 'mc_gross' );
	        $checker->logger->writeTimedString(  'aprobando más'  );
	        $checker->logger->writeTimedString(  $amount  );
	        $currency = $checker->getFieldValue( 'mc_currency' );
	        if( ( $checker->checkAmount( $amount ) && $checker->checkCurrency( $currency ) ) or 1)
	        {
	            $checker->logger->writeTimedString(  'ok'  );
	            $checker->approvePayment();
	            $order = eZOrder::fetch( $order_id );
                

	            $checker->logger->writeTimedString(  'activo'  );
	        	$order->detachProductCollection();
	        	$order->activate();	        	

$orderInfo = eZPersistentObject::fetchObject( eflOrders::definition(), 
                                                            null, 
                                                            array( 'productcollection_id' => $n )  
                                                            );


$info = unserialize( $orderInfo->Order );

$order = eZOrder::fetch( $Params['OrderID'] );

$products = $order->productItems();

$cursos = tantaBasketFunctionCollection::getTrainingInBasket( $order->attribute( 'productcollection_id' ) );


                
                $products =  $order->productItems();
                
                $products_to_ws = array();
$i = 1;
                foreach( $products as $product )
                {
                    if ( $product['item_object']->attribute( 'contentobject' )->attribute( 'contentclass_id' ) == 98 )
                    {
                        $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                        
                        $products_to_ws[] = array(
                            'orden' => $i,
                            'ref' => $data['referencia']->content(),
                            'nombre' => $product['object_name'] . ': ' . $info['has_mementix']['refs'] . '. ' . $info['has_mementix']['accesos'],
                            'cantidad' => $product['item_count'],
                            'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                            'iva' => $product['vat_value']
                        );
                    }
                    elseif ( $product['item_object']->attribute( 'contentobject' )->attribute( 'contentclass_id' ) == 101 )
                    {
                        $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                        
                        $products_to_ws[] = array(
                            'orden' => $i,
                            'ref' => $data['referencia']->content(),
                            'nombre' => $product['object_name'] . ': '. $info['has_nautis4']['refs'] . '. ' . $info['has_nautis4']['accesos'],
                            'cantidad' => $product['item_count'],
                            'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                            'iva' => $product['vat_value']
                        );
                    }
elseif ( $product['item_object']->attribute( 'contentobject' )->attribute( 'contentclass_id' ) == eZINI::instance( 'imemento.ini' )->variable( 'iMemento', 'Class' ) )
                        {
                            $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                            
                            $products_to_ws[] = array(
                                'orden' => $i,
                                'ref' => $data['referencia']->content(),
                                'nombre' => $product['object_name'] . ': '. $info['has_imemento']['refs'],
                                'cantidad' => $product['item_count'],
                                'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                                'iva' => $product['vat_value']
                            );
                        }
elseif ( $product['item_object']->attribute( 'contentobject' )->attribute( 'contentclass_id' ) == eZINI::instance( 'qmementix.ini' )->variable( 'Qmementix', 'Class' ) )
                        {
                            $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                            
                            $products_to_ws[] = array(
                                'orden' => $i,
                                'ref' => $data['referencia']->content(),
                                'nombre' => $product['object_name'] . ': '. $info['has_imemento']['refs'],
                                'cantidad' => $product['item_count'],
                                'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                                'iva' => $product['vat_value']
                            );
                        }						
                    else
                    {   
                    $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                    
                    $products_to_ws[] = array(
                        'orden' => $i,
                        'ref' =>  $data['referencia'] ? $data['referencia']->content() : ' -- ',
                        'nombre' => $product['object_name'],
                        'cantidad' => $product['item_count'],
                        'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                        'iva' => $product['vat_value']
                    );
                    }  
                    $i++;
                }
                
              
                // enviamos compra al ws
                $eflWS = new eflWS();
                $user = eZUser::fetch( $order->UserID );
                $userws = $eflWS->existeUsuario( $user->attribute( 'email' ) );
            
                                $id_pedido_lfbv = $eflWS->nuevaCompra( $userws,
                                                     $info['total'],
                                                     $info['observaciones'],  
                                                     $info['nombre2'] ? $info['nombre2'] : $info['nombre'],
                                                     $info['apellido12'] ? $info['apellido12'] : $info['apellido1'],
                                                     $info['apellido22'] ? $info['apellido22'] : $info['apellido2'],                                                                                        
                                                     $info['empresa2'] ? $info['empresa2'] : $info['empresa'],                                                                                        
                                                     
                                                     $info['email2'] ? $info['email2'] : $info['email'],
                                                     $info['telefono2']  ? $info['telefono2'] : $info['telefono'],
                                                     $info['movil2'] ? $info['movil2'] : $info['movil'],
                                                     $info['tipovia2'] ? $info['tipovia2'] : $info['tipovia'],
                                                     $info['dir12'] ?  $info['dir12'] : $info['dir1'],
                                                     $info['num2'] ?  $info['num2'] : $info['num'],
                                                     $info['complemento2'] ?  $info['complemento2'] : $info['complemento'],
                                                     $info['cp2'] ?  $info['cp2'] : $info['cp'],
                                                     $info['localidad2'] ?  $info['localidad2'] : $info['localidad'],
                                                     $info['provincia2'] ?  $info['provincia2'] : $info['provincia'],
                                                     $info['pais'],
                                                     4, // pago paypal
                                                     1,
                                                     '',
                                                     '',
                                                     '',
                                                     1,
                                                     ( $info['plazos'] <= 1 ) ? $info['total'] : str_replace( ',', '.', round( $info['total'] / $info['plazos'], 2 ) ) ,
                                                     $products_to_ws, 
													 '-',
													 $cd_camp
                                                                                       
                                );   
                                $info['id_pedido_lfbv'] = $id_pedido_lfbv;
                                $http->setSessionVariable( 'id_pedido_lfbv', $id_pedido_lfbv );
                                eZLog::write( $http->sessionVariable( 'id_pedido_lfbv' ), 'id_pedido_lfbv.log' );
              $serialized_order = serialize( $info ); 
              $orderInfo->Order = $serialized_order;
              $orderInfo->store();

												/* mail al cliente */
												$mail = new ezcMail();
												               
												$mail->from = new ezcMailAddress( $ini->variable( 'Infocompras', 'Mail' ), $ini->variable( 'Infocompras', 'Sender' ) );
												              
										
												$mail->addTo( new ezcMailAddress(  $info['email'], ( $info['empresa'] != '' ) ? $info['empresa'] : $info['nombre']  ) );
												              
												$mail->subject = "Confirmación de su pedido en Ediciones Francis Lefebvre";
												
                                                                                        
                                                                                         
												$tplmail->setVariable( 'info', $info );   
											
                                               
												$tplmail->setVariable( 'id',  $id_pedido_lfbv  );  
                                                $tplmail->setVariable( 'order', $order );
												$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/frompaypal.tpl' ), 'utf-8' );     
												$text->subType = 'html';                
												$mail->body = $text;
												
												$options = new ezcMailSmtpTransportOptions(); 
												$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
												$transport->send( $mail  ); 
												
												/******mail editorial *****/
												
												
												$mail = new ezcMail();
												               
												$mail->from = new ezcMailAddress( 'clientes@efl.es', 'Ediciones Francis Lefebvre' );
												              
												$mail->addBcc( new ezcMailAddress(  'carlos.revillo@tantacom.com', 'Carlos' ) );
												if ( $info['tipo_usuario'] )
												{
												    $mail->addTo( new ezcMailAddress( 'internet@efl.es' ) );
												    if( count( $cursos['result'] ) )
												    {
												       $mail->addTo( new ezcMailAddress( 'inscripciones@efl.es' ) );
												    }
												}
												$mail->addTo( new ezcMailAddress( 'clientes@efl.es' ) );
												              
												//$mail->subject = "Pedido en la tienda. Pedido nº " . $Params['OrderID'] . ' --- PRUEBAS DESDE TANTA, NO PROCESAR!!!!!!!!!!!!';
												$mail->subject = str_replace( '<pedido>',  $id_pedido_lfbv, $ini->variable( 'Infocompras', 'SubjectEditorial' ) );
												              
												$tplmail->setVariable( 'info', $info );   
												$tplmail->setVariable( 'basket', eZBasket::currentBasket() );    
												$tplmail->setVariable( 'id',  $id_pedido_lfbv  );  
												$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/frompaypal.tpl' ), 'utf-8' );     
												$text->subType = 'html';                
												$mail->body = $text;
												
												$options = new ezcMailSmtpTransportOptions(); 
													$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
                                                $transport->send( $mail  ); 
											
												
												// borramos la información de la cesta, con lo cual evitaremos los doubleposting
												//$basket->remove();
  
   
			   		        	
	        }        
        }
        
    }
    else
    {
        $checker->logger->writeTimedString(  'no aprobando'  );
    }
}


  


?>
