<?php 
$http = eZHTTPTool::instance();
$ini = eZINI::instance( 'basket.ini' );

$order_id = $Params['OrderID'];
$order = eZOrder::fetch( $order_id );

eZDebug::writeError( 'bbbb' . $_GET['peticion'],
                             'tpv/notification' );

require( 'kernel/common/template.php' );
$tplmail = templateInit();


if (!$http->hasGetVariable( 'peticion')  ) 
{
    return;
}


$peticion = $http->getVariable( 'peticion' );
$dom = simplexml_load_string( $peticion );
$respuesta = $dom->xpath( '//respago' );
$importe = (string)$respuesta[0]->importe;
$estado = (string)$respuesta[0]->estado;
$idtransaccion = (string)$respuesta[0]->idtransaccion;
$cd_camp = $Params['cd_camp'];    
//Si la variables "cd_camp" viene nula o vacía le pasamos un guión.
if (($cd_camp == null) || ($cd_camp == ''))
{
	$cd_camp = '-';
}

$order_id = $Params['OrderID'];        	
	        	
$orderInfo = eZPersistentObject::fetchObject( eflOrders::definition(), 
                                                            null, 
                                                            array( 'productcollection_id' => $order->attribute( 'productcollection_id' )   ) 
                                                            );


$info = unserialize( $orderInfo->Order );
//$order = eZOrder::fetch( $Params['OrderID'] );


if( ( $info['idtransaccion'] == $idtransaccion ) and ( $estado == '2' ) )
{

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
                    else
                    {   
                    $data = $product['item_object']->attribute( 'contentobject' )->dataMap();
                    
                    $products_to_ws[] = array(
                        'orden' => $i,
                        'ref' => $data['referencia'] ? $data['referencia']->content() : '--',
                        'nombre' => $product['object_name'],
                        'cantidad' => $product['item_count'],
                        'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                        'iva' => $product['vat_value']
                    );
                    }  
                }
                
              
                // enviamos compra al ws
                $eflWS = new eflWS();
                $user = eZUser::fetch( $order->UserID );
                $userws = $eflWS->existeUsuario( $user->Email );
            
            
                          $id_pedido_lfbv =   $eflWS->nuevaCompra( $userws,
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
                                                     1, // tpv
                                                     1,
                                                     '',
                                                     '',
                                                     '',
                                                     1,
                                                     ( $info['plazos'] <= 1 ) ? $info['total'] : str_replace( ',', '.', round( $info['total'] / $info['plazos'], 2 ) ) ,
                                                     $products_to_ws,
													 $idtransaccion,
													 $cd_camp
                                                                                       
                                );   
                                $info['id_pedido_lfbv'] = $id_pedido_lfbv;
				              $serialized_order = serialize( $info ); 
				              $orderInfo->Order = $serialized_order;
				              $orderInfo->store();

												/* mail al cliente */
												$mail = new ezcMail();
												               
												$mail->from = new ezcMailAddress( $ini->variable( 'Infocompras', 'Mail' ), $ini->variable( 'Infocompras', 'Sender' ) );
												              
												
												$mail->addTo( new ezcMailAddress(  $info['email'], ( $info['empresa'] != '' ) ? $info['empresa'] : $info['nombre']  ) );
												              
												$mail->subject = "Confirmación de su pedido en Ediciones Francis Lefebvre";
												
                                                                                        
                                                                                         
												$tplmail->setVariable( 'info', $info );   
											
                                               
												$tplmail->setVariable( 'id', $id_pedido_lfbv );  
                                                $tplmail->setVariable( 'order', $order );
												$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/tpv.tpl' ), 'utf-8' );     
												$text->subType = 'html';                
												$mail->body = $text;
												
												$options = new ezcMailSmtpTransportOptions(); 
												$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
												$transport->send( $mail  ); 
												
												/******mail editorial *****/
												
												
												$mail = new ezcMail();
												               
												$mail->from = new ezcMailAddress( 'clientes@efl.es', 'Ediciones Francis Lefebvre' );
												              
												
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
												$mail->subject = str_replace( '<pedido>', $id_pedido_lfbv, $ini->variable( 'Infocompras', 'SubjectEditorial' ) );
												              
												$tplmail->setVariable( 'info', $info );   
												$tplmail->setVariable( 'basket', eZBasket::currentBasket() );    
												$tplmail->setVariable( 'id', $id_pedido_lfbv );  
												$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/tpv.tpl' ), 'utf-8' );     
												$text->subType = 'html';                
												$mail->body = $text;
												
												$options = new ezcMailSmtpTransportOptions(); 
												$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
                                                $transport->send( $mail  ); 
												
												// borramos la información de la cesta, con lo cual evitaremos los doubleposting
												//$basket->remove();
  
   
			

}


?>
