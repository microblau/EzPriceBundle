<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<!-- Metadatos para los buscadores -->
	<title>Datos de Usuario - Ediciones Francis Lefebvre.</title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Metadatos para los buscadores -->
	<meta name="description" content="..." />

	<meta name="keywords" content="..." />

	<meta name="language" content="es" />
	<!-- Icono en la barra de la URL -->
	 <link rel="shortcut icon" href="favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href={"stylesheets/styles.css"|ezdesign} media="all" />	
    <link rel="stylesheet" type="text/css" href={"stylesheets/jquery.rating.css"|ezdesign} media="all" />
    <link rel="stylesheet" type="text/css" href={"stylesheets/custom.css"|ezdesign} media="all" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" href={"stylesheets/fixIE.css"|ezdesign} /> 
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href={"stylesheets/fixIE6.css"|ezdesign} />	
	<![endif]-->

	<link rel="stylesheet" type="text/css" href={"stylesheets/print.css"|ezdesign} media="print" />

</head>
<body id="lightboxWrap">
	<div id="wrapper">
		<div id="bodyContent">
            <div id="videoLightbox" class="columnType1">
                <div id="modType2">
                    <h1>Olvido de contraseña</h1>
                    <div class="wrap clearFix">                    		
                        <div class="description">
                                <div class="opinionForm">




a{$emailvalido}b
{if and(is_set($emailvalido), $emailvalido|eq(1) )}
<p>
Las instrucciones para generar una nueva contraseña han sido enviadas a su e-mail.
</p>
{else}
   {if $wrong_email}
  <div class="msgError">
    <ul>
   <li>{"There is no registered user with that email address."|i18n('design/standard/user/forgotpassword')}</li>
</ul>
   </div>
   {/if}
   {if $generated}
   <p>
   {"Password was successfully generated and sent to: %1"|i18n('design/standard/user/forgotpassword',,array($email))}
   </p>
   {else}
      {if $wrong_key}
      <div class="warning">
      <h2>{"The key is invalid or has been used. "|i18n('design/standard/user/forgotpassword')}</h2>
      </div>
      {else}
      <p>Escriba la cuenta de correo electrónico con la que se dio de alta y le enviaremos a ella su nueva contraseña.
      </p>
      <form method="post" name="forgotpassword" action={"/producto/forgotpassword/"|ezurl}>
    

      
       <ul class="datos">
     <li>
      <label for="email">{"Email"|i18n('design/standard/user/forgotpassword')}:</label>
    
      <input class="text" type="text" name="UserEmail" tabindex="1"  value="{$wrong_email|wash}" /></li>
      </ul>

      <span class="submit">
      <input type="image" src={"btn_aceptar.gif"|ezimage} name="GenerateButton" value="{'Generate new password'|i18n('design/standard/user/forgotpassword')}" />
      </span>
      </form>
      {/if}
   {/if}
{/if}

</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src={"javascript/jquery-1.3.1.js"|ezdesign}></script>   	 
   	<script type="text/javascript" src={"javascript/jquery.rating.js"|ezdesign}></script>
   	<script type="text/javascript" src={"javascript/langEs.js"|ezdesign}></script>
	<script type="text/javascript" src={"javascript/common.js"|ezdesign}></script>

</body>
</html> 
