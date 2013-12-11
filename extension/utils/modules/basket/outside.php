<?php
require( 'kernel/common/template.php' );
$basket = eZBasket::currentBasket();

$ini = eZINI::instance( 'basket.ini' );
if( $basket->OrderID == 0 )
{
    $Params['Module']->redirectTo( 'basket/basket');
}
$tpl = eZTemplate::factory();
$tpl->setVariable( 'basket',  eZBasket::currentBasket() );

$orderInfo = eZPersistentObject::fetchObject( eflOrders::definition(), 
                                                            null, 
                                                            array( 'productcollection_id' => $basket->attribute( 'productcollection_id' ) )  
                                                            );
$info = unserialize( $orderInfo->Order );

$mail = new ezcMail();
               
$mail->from = new ezcMailAddress( $ini->variable( 'Infocompras', 'Mail' ), $ini->variable( 'Infocompras', 'Sender' ) );
              
$mail->addTo( new ezcMailAddress( $info['email'] ) ) ;
              
$mail->subject = "Confirmación de su pedido en Ediciones Francis Lefebvre";
$tplmail = eZTemplate::factory();         
$tplmail->setVariable( 'info', $info );   
$tplmail->setVariable( 'basket', eZBasket::currentBasket() );    
$tplmail->setVariable( 'id', $id_pedido_lfbv );  
$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/outside.tpl' ), 'utf-8' );     



$text->subType = 'html';       
            
$mail->body = $text;
$options = new ezcMailSmtpTransportOptions(); 
$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
$transport->send( $mail  ); 

/******mail editorial *****/


$mail = new ezcMail();
               

              
$mail->addTo( new ezcMailAddress( 'clientes@efl.es' ) );
$mail->addTo( new ezcMailAddress( 'iglesias@efl.es' ) );
$mail->addTo( new ezcMailAddress( 'mourelle@efl.es' ) ); 
$mail->from = new ezcMailAddress( $ini->variable( 'Infocompras', 'Mail' ), $ini->variable( 'Infocompras', 'Sender' ) );

              
//$mail->subject = "Pedido en la tienda. Pedido nº " . $Params['OrderID'] . ' --- PRUEBAS DESDE TANTA, NO PROCESAR!!!!!!!!!!!!';
$mail->subject = 'Pedido internacional en Ediciones Francis Lefebvre';
          
$tplmail->setVariable( 'info', $info );   
$tplmail->setVariable( 'basket', eZBasket::currentBasket() );    
$tplmail->setVariable( 'id', $id_pedido_lfbv );  
$text = new ezcMailText( $tplmail->fetch( 'design:basket/mails/outside.tpl' ), 'utf-8' );     
$text->subType = 'html';                
$mail->body = $text;

$options = new ezcMailSmtpTransportOptions(); 


$transport = new ezcMailSmtpTransport( $ini->variable( 'Infocompras', 'SMTP' ), $ini->variable( 'Infocompras', 'SMTPUser' ), $ini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
$transport->send( $mail  ); 
$basket->remove();

$tpl = eZTemplate::factory();
$Result = array();
$Result['content'] = $tpl->fetch( "design:basket/outside.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => 'Pedido desde fuera de España' ) );
?>
