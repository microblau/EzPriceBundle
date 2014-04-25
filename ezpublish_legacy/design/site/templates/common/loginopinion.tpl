<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Datos de Usuario - Ediciones Francis Lefebvre.</title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Metadatos para los buscadores -->
	<meta name="description" content="..." />
	<meta name="keywords" content="..." />
	<meta name="language" content="es" />
	<!-- Icono en la barra de la URL -->
	 <link rel="shortcut icon" href="favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/styles.css" media="all" />	
    <link rel="stylesheet" type="text/css" href="/design/site/stylesheets/jquery.rating.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/design/site/stylesheets/custom.css" media="all" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" href="css/fixIE.css" /> 
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="css/fixIE6.css" />	
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/print.css" media="print" />
</head>
<body id="lightboxWrap">
	<div id="wrapper">
		<div id="bodyContent">
				<div id="videoLightbox" class="columnType1">
					<div id="modType2">
							<h1>Login</h1>
							<div class="wrap clearFix">                    		
									<div class="description">
                                    	<div class="opinionForm">
 <p>Identifíquese para darnos su opinión sobre esta obra</p>
<form method="post" id="datosLoginForm" action={concat( "/producto/login/(opinion)/", $nodo )|ezurl} name="loginform">




{if $User:warning.bad_login}
<div class="warning">
<h2>{"Could not login"|i18n("design/ezwebin/user/login")}</h2>
<ul>
    <li>{"A valid username and password is required to login."|i18n("design/ezwebin/user/login")}</li>
</ul>
</div>
{else}

{if $site_access.allowed|not}
<div class="warning">
<h2>{"Access not allowed"|i18n("design/ezwebin/user/login")}</h2>
<ul>
    <li>{"You are not allowed to access %1."|i18n("design/ezwebin/user/login",,array($site_access.name))}</li>
</ul>
</div>
{/if}

{/if}

<ul class="datos">
<li>
<label for="usuario">Usuario</label>
<input type="text" id="usuario" name="Login" class="text" value="{$User:login|wash}" tabindex="1" />
</li>

<li>
<label for="pass">{"Password"|i18n("design/ezwebin/user/login")}</label>
<input class="text" type="password" size="10" name="Password" id="pass" value="" tabindex="1" />


</li>
</ul>


{if ezini( 'SiteSettings', 'AdditionalLoginFormActionURL' )}
<div class="block">
<label for="id3">{"Log in to the eZ Publish Administration Interface"|i18n("design/ezwebin/user/login")}</label><div class="labelbreak"></div>
<input type="checkbox" size="10" name="AdminSiteaccessURI" id="id3" value="" tabindex="1" onclick="AdminSiteaccessCheckbox(this);" />
</div>

{*
    Set URL for login form action
    site.ini.[SiteSettings].AdditionalLoginFormActionURL
    If empty then checkbox will not appear
*}
<script type="text/javascript">
<!--

var loginForm = document.loginform;
var loginFormDefaultAction = loginForm.action;

function AdminSiteaccessCheckbox( val )
{ldelim}

    if( val.checked )
        loginForm.action = '{ezini( 'SiteSettings', 'AdditionalLoginFormActionURL' )}';
    else 
        loginForm.action = loginFormDefaultAction;

{rdelim} 

-->
</script>
{/if}
{if ezini( 'Session', 'RememberMeTimeout' )}
<div class="block">
<input type="checkbox" tabindex="1" name="Cookie" id="id4" /><label for="id4" style="display:inline;">{"Remember me"|i18n("design/ezwebin/user/login")}</label>
</div>
{/if}
<span class="verMas"><a href={"producto/forgotpassword"|ezurl}>¿Ha olvidado su contraseña?</a></span>
<span class="submit"><input type="image" src={"btn_aceptar.gif"|ezimage()} name="LoginButton" alt="Aceptar" /></span>
{def $nodoTemp=fetch('content','node',hash('node_id',$nodo))}



{if ezini( 'SiteSettings', 'LoginPage' )|eq( 'custom' )}
    <p><a href={'/user/forgotpassword'|ezurl}>{'Forgot your password?'|i18n( 'design/ezwebin/user/login' )}</a></p>
{/if}

<input type="hidden" name="RedirectURI" value="{concat('/producto/opinion?n=', $nodo)|ezurl(no)}" />

{if and( is_set( $User:post_data ), is_array( $User:post_data ) )}
  {foreach $User:post_data as $key => $postData}
     <input name="Last_{$key}" value="{$postData}" type="hidden" /><br/>
  {/foreach}
{/if}

</form>
</div></div></div></div></div></div></div>
{literal}
    <script type="text/javascript" src="/design/site/javascript/jquery-1.3.1.js"></script>   	 
   <script type="text/javascript" src="/design/site/javascript/jquery.rating.js"></script>  
   <script type="text/javascript" src="/design/site/javascript/langEs.js"></script>
   <script type="text/javascript" src="/design/site/javascript/common.js"></script>
{/literal}
