<?php 
/**
 *
 * Funcionamiento: 
 *  1.- El usuario indica su mail
 *  2.- El sistema le devuelve una url que contiene un hash que queda almacenado en uno de estos objetos
 *  3.- El usuario recibe ese enlace en su e-mail y visita la página (resetpassword)
 *  4.- El sistema le envía de nuevo el password al email y llama al ws para actualizarlo allí. 
*/
require( 'kernel/common/template.php' );
$tpl = templateInit();
$http = eZHTTPTool::instance();

if( $http->hasPostVariable( 'BtnPasswordRecover' ) )
{
	$eflws = new eflWS();
	$existeUsuario = $eflws->existeUsuario( $http->postVariable( 'email' ) );
	$errors = array();
	if( !$existeUsuario )
	{
		$errors['email'] = 'El e-mail introducido no está registrado en nuestra base de datos o es incorrecto.';	
	}
	
	if( count( $errors ) )
	{	
		$tpl->setVariable( 'errors', $errors );
	}
	else
	{
		$tpl->setVariable( 'emailvalido', 1 );
		// creamos el password
		$time = time();
		$email = $http->postVariable( 'email' );		
		$password = eflTempPass::generatePassword( 8 );
		$key = eflTempPass::generateKey( $email );	
		
		$tmp_pass_object = new eflTempPassObject( 
					array( 'email' => $email, 
					       'password' => $password, 
					       'md5_key' => $key ) );
		$mail_ini = eZINI::instance( 'basket.ini' );
		$subject = $mail_ini->variable( 'ForgotPassword', 'MailSubject' );
		$sender = $mail_ini->variable( 'ForgotPassword', 'MailSender' );
		
		$mail = new eZMail();
		$mail->setContentType( 'text/plain' );
		$mail->setSender( $sender );
        $mail->setReceiver( $email );
        $mail->setSubject( $subject );
        $templateMail = templateInit();
        $templateMail->setVariable( 'key', $key );
        $mail->setBody(  $templateMail->fetch( 'design:basket/password_email.tpl' ) ); 
               
        $mailResult = eZMailTransport::send( $mail );
        
		$tmp_pass_object->store();
	} 
}

$Result = array();
$Result['content'] = $tpl->fetch( "design:basket/forgotpassword.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Recuperar Contraseña | Tienda Online EFL' ) ) );

?>
