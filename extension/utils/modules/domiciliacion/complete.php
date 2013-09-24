<?php 
$tpl = eZTemplate::factory();
$tplmail = eZTemplate::factory();

$http = eZHTTPTool::instance();
$basket = eZBasket::currentBasket();
$tpl->setVariable( 'basket',  eZBasket::currentBasket() );
$ini = eZINI::instance( 'basket.ini' );
$cd_camp = $http->sessionVariable( 'cd_camp_sesion' );
//Si la variables "cd_camp" viene nula o vacía le pasamos un guión.
$tpl->setVariable( 'order_id', $Params['OrderID'] );
if (($cd_camp == null) || ($cd_camp == ''))
{
	$cd_camp = '-';
}

if( $http->hasPostVariable( 'btnContinuar' ) )
{
    $tpl->setVariable( 'id', $Params['OrderID'] );
    $eflws = new eflWS();
    $eflws->setUsuarioDatosPaso3( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'profesiones' ),
                $http->postVariable( 'cargo' ),
                $http->postVariable( 'departamento' ),
                $http->postVariable( 'especialidad' ),
                $http->postVariable( 'numEmple' ),
                $http->postVariable( 'actividad' )
            );
     
     $eflws->setAreasInteres( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'area' )
            );
    $Result = array();
    $Result['content'] = $tpl->fetch( "design:domiciliacion/finproceso.tpl" );
    $Result['path'] = array( array( 'url' => false,
                                    'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
    return;
}

if( ( ( $Params['OrderID'] != $basket->attribute( 'order_id' ) ) or ( !$http->hasPostVariable( 'Btn_' . md5( 'cesta' . $Params['OrderID'] ) ) ) ) and !$http->hasPostVariable( 'send' )  and !$http->hasPostVariable( 'BtnPassSurvey' ) )
{
    return $Module->redirectTo( 'basket/basket' );
}



$order = eZOrder::fetch( $Params['OrderID'] );


if( !$basket->attribute( 'is_empty' ) )
{
    $order->detachProductCollection();
    $order->activate();

    $orderInfo = eZPersistentObject::fetchObject( eflOrders::definition(), 
                                                                null, 
                                                                array( 'productcollection_id' =>  $basket->attribute( 'productcollection_id' )  ) 
                                                                );
    $info = unserialize( $orderInfo->Order );
    $cursos = tantaBasketFunctionCollection::getTrainingInBasket( $basket->attribute( 'productcollection_id' ) );

    $eflWS = new eflWS();
                    
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
                                'ref' => $data['referencia'] ? $data['referencia']->content() : ' -- ',
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
                                'ref' => $data['referencia'] ? $data['referencia']->content() : ' -- ',
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
                            'ref' => $data['referencia'] ? $data['referencia']->content() : ' -- ',
                            'nombre' => $product['object_name'],
                            'cantidad' => $product['item_count'],
                            'precio' =>  str_replace( ',', '.', round( $product['total_price_ex_vat'] / $product['item_count'] , 2 ) ),
                            'iva' => $product['vat_value']
                        );
                        }  
                    }
                    
                  
                    // enviamos compra al ws
                    $eflWS = new eflWS();
                  
                                    $id_pedido_lfbv = $eflWS->nuevaCompra( $http->sessionVariable( 'id_user_lfbv' ),
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
                                                         2, // pago domiciliacion
                                                         1,
                                                         '',
                                                         $info['titular_cuenta'],
                                                         (int)$info['banco'] . $info['sucursal'] . $info['control'] . $info[$ncuenta],
                                                         1,
                                                         ( $info['plazos'] <= 1 ) ? $info['total'] : str_replace( ',', '.', round( $info['total'] / $info['plazos'], 2 ) ) ,
                                                         $products_to_ws, 
													     '-',
													     $cd_camp
                                                                                           
                                    );   
    $info['id_pedido_lfbv'] = $id_pedido_lfbv;
    $http->setSessionVariable( 'id_pedido_lfbv', $id_pedido_lfbv ); 
                  $serialized_order = serialize( $info ); 
                  $orderInfo->Order = $serialized_order;
                  $orderInfo->store();
    /* mail al cliente */

    $mail = new ezcMail();
                   
    $mail->from = new ezcMailAddress( $ini->variable( 'Infocompras', 'Mail' ), $ini->variable( 'Infocompras', 'Sender' ) );

    $mail->addTo( new ezcMailAddress(  $info['email'], ( $info['empresa'] != '' ) ? $info['empresa'] : $info['nombre']  ) );
                  
    $mail->subject = "Confirmación de su pedido en Ediciones Francis Lefebvre";
                  
    $tplmail->setVariable( 'info', $info );   
    $tplmail->setVariable( 'basket', eZBasket::currentBasket() );    
    $tplmail->setVariable( 'id',  $id_pedido_lfbv  );  
    $text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/domiciliacion.tpl' ), 'utf-8' );     
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
    $tplmail->setVariable( 'id', $id_pedido_lfbv  );  
    $text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/domiciliacion.tpl' ), 'utf-8' );     
    $text->subType = 'html';                
    $mail->body = $text;

    $options = new ezcMailSmtpTransportOptions(); 
    $transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
    $transport->send( $mail  ); 

    // borramos la información de la cesta, con lo cual evitaremos los doubleposting
    $basket->remove();
}


$contents = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' )->fetchContents();
$unserialized_cache = unserialize( $contents );
$encuesta = eZContentObject::fetch( $unserialized_cache['encuesta'] );

if( $encuesta != 0 )
{
    $data = $encuesta->dataMap();
    $survey = $data['survey']->content();    
    $surveyvalidation = $survey['survey_validation'];
    if ( ( isset( $surveyvalidation['one_answer'] ) || ( isset( $surveyvalidation['one_answer_count']) &&  ( $surveyvalidation['one_answer_count']>0 ) ) ) === false )
    {
        if( !$http->hasPostVariable( 'BtnPassSurvey' ) &&  !$http->hasPostVariable                               ( 'ContentObjectAttribute_ezsurvey_store_button'  ) )
        {
            
            
             $tpl->setVariable( 'encuesta', true );
                $tpl->setVariable( 'node', $encuesta->attribute( 'main_node' ) );
                $Result = array();
            	$Result['content'] = $tpl->fetch( "design:transferencia/complete.tpl" );
	            $Result['path'] = array( array( 'url' => false,
	                                        'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
        } 
        elseif( $http->hasPostVariable                               ( 'ContentObjectAttribute_ezsurvey_store_button'  ) )
        {
          
            
             $tpl->setVariable( 'encuesta', false );
                $tpl->setVariable( 'node', $encuesta->attribute( 'main_node' ) );
                $Result = array();
            	$Result['content'] = $tpl->fetch( "design:transferencia/complete.tpl" );
	            $Result['path'] = array( array( 'url' => false,
	                                        'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
        }
    }
}
if( $http->hasPostVariable( 'btnContinuar' ) )
{
    $eflws = new eflWS();
    $eflws->setUsuarioDatosPaso3( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'profesiones' ),
                $http->postVariable( 'cargo' ),
                $http->postVariable( 'departamento' ),
                $http->postVariable( 'especialidad' ),
                $http->postVariable( 'numEmple' ),
                $http->postVariable( 'actividad' )
            );
     
     $eflws->setAreasInteres( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'area' )
            );
    $Result = array();
    $Result['content'] = $tpl->fetch( "design:transferencia/finproceso.tpl" );
}
else
{
    
	$tpl->setVariable( 'id', $http->sessionVariable( 'id_pedido_lfbv' ) );
    
	$Result = array();
	$Result['content'] = $tpl->fetch( "design:transferencia/complete.tpl" );
	$Result['path'] = array( array( 'url' => false,
	                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
}
?>
