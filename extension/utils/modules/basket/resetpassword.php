<?php 
$key = $Params['Key'];
$temppassobject = eflTempPassObject::fetchByKey( $key );
$efl = new eflWS();
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
if( $temppassobject )
{
	if( $efl->cambiaPasswordDirecto( $temppassobject->Email, $temppassobject->Password ) )
	{
		$tpl->setVariable( 'ok', 1 );
		$mail_ini = eZINI::instance( 'basket.ini' );
		$subject = $mail_ini->variable( 'ForgotPassword', 'MailSubject' );
		$sender = $mail_ini->variable( 'ForgotPassword', 'MailSender' );
		$mail = new eZMail();
		$mail->setContentType( 'text/plain' );
		$mail->setSender( $sender );
	    $mail->setReceiver( $temppassobject->Email );
	    $mail->setSubject( $subject );
	    $templateMail = eZTemplate::factory();
	    $templateMail->setVariable( 'pass',  $temppassobject->Password );
	    $mail->setBody(  $templateMail->fetch( 'design:basket/resetpassword_email.tpl' ) );
	    $mailResult = eZMailTransport::send( $mail );
	    $temppassobject->remove();
	         
	}
	else
	{
		$tpl->setVariable( 'ok', 0 );
	}
}
else
{
	$tpl->setVariable( 'ok', 0 );
}


$Result = array();
$Result['content'] = $tpl->fetch( "design:basket/resetpassword.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => 'Recuperación de contraseña' ) );

?>
