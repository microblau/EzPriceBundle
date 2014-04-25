<?php
$cli = eZCLI::instance();


$ini = eZINI::instance();
// Get user's ID who can remove subtrees. (Admin by default with userID = 14)
$userCreatorID = $ini->variable( "UserSettings", "UserCreatorID" );
$user = eZUser::fetch( $userCreatorID );
if ( !$user )
{
    $cli->error( "Subtree remove Error!\nCannot get user object by userID = '$userCreatorID'.\n(See site.ini[UserSettings].UserCreatorID)" );
    $script->shutdown( 1 );
}
eZUser::setCurrentlyLoggedInUser( $user, $userCreatorID );

$nodes = eZContentObjectTreeNode::subTreeByNodeID( 
                array( 'ClassFilterType' => 'include', 
                       'ClassFilterArray' => array( 'producto' )
                )
, 61);

$text = 'Las ofertas creadas para los siguientes productos caducarán dentro  de los próximos 2 días:' . '<br />';


$objects = array();

foreach( $nodes as $node )
{
   
    
    $object = eZContentObject::fetch( $node->attribute( 'object' )->attribute( 'id' ) );
    $db = eZDB::instance();
    
    $data = $object->dataMap();
 
    if( ( $data['precio_oferta']->content()->hasDiscount() ) and ( $data['fecha_fin_oferta']->hasContent() ) and( $data['fecha_fin_oferta']->content()->timestamp() > time() ) and ( $data['fecha_fin_oferta']->content()->timestamp() < ( time() + 86400*2) )   and ( $data['fecha_inicio_oferta']->content()->timestamp()  < time() ) )
    {      
	

       $objects[] = $node->attribute( 'object' )->attribute( 'id' );
       $text.= '<a href="http://www.efl.es/' . $node->attribute( 'url_alias' ) . '">' . $node->attribute( 'name' ) . '</a><br>'; 
    }
    
}
$basketini = eZINI::instance( 'basket.ini' );
if( count( $objects ) )
{
	$mail = new ezcMail();
    $mail->subject = 'Aviso de caducidad de ofertas';
    $mail->from = new ezcMailAddress( $basketini->variable( 'Infocompras', 'Mail' ), $basketini->variable( 'Infocompras', 'Sender' ) );
              
  $mail->addTo( new ezcMailAddress(  'mourelle@efl.es' ) );
   $mail->addTo( new ezcMailAddress(  'iglesias@efl.es' ) );
$mail->addTo( new ezcMailAddress(  'jvicente@efl.es' ) );
 $mail->addTo( new ezcMailAddress(  'carlos.revillo@tantacom.com' ) );
   //$mail->addTo( new ezcMailAddress(  $info['email'], ( $info['empresa'] != '' ) ? $info['empresa'] : $info['nombre']  ) );
    $text = new ezcMailText( $text, 'utf-8' );  
    $text->subType = 'html';                 
    $mail->body = $text;
    
    $options = new ezcMailSmtpTransportOptions(); 
    $transport = new ezcMailSmtpTransport( $basketini->variable( 'Infocompras', 'SMTP' ), $basketini->variable( 'Infocompras', 'SMTPUser' ), $basketini->variable( 'Infocompras', 'SMTPPassword' ), null, $options );
   $transport->send( $mail  ); 
	
}



?>
