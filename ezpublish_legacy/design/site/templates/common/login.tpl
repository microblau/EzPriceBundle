<div id="bodyContent">
<div id="gridWide" class="compraPaso2">
  <div class="inner">

            
                    <div id="gridDatos" class="clearFix">
                    
                        <span class="volver frt"><a href="">Volver</a></span>
                        
                        <div class="colDatos1">

<form method="post" id="datosLoginForm" action={"/basket/login/"|ezurl} name="loginform">

<h2>¿Ya estás registrado?</h2>


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
<label for="usuario">{"Username"|i18n("design/ezwebin/user/login",'User name')}</label>
<input type="text" id="usuario" name="Login" class="text" value="{$User:login|wash}" tabindex="1" />
</li>

<li>
<label for="pass">{"Password"|i18n("design/ezwebin/user/login")}</label>
<input class="text" type="password" size="10" name="Password" id="pass" value="" tabindex="1" />
<span class="olvido"><a href="">¿Olvidó su contraseña?</a></span>

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

<span class="submit"><input type="image" src={"btn_aceptar.gif"|ezimage()} name="LoginButton" alt="Aceptar" /></span>
{def $nodoTemp=fetch('content','node',hash('node_id',$nodo))}



{if ezini( 'SiteSettings', 'LoginPage' )|eq( 'custom' )}
    <p><a href={'/user/forgotpassword'|ezurl}>{'Forgot your password?'|i18n( 'design/ezwebin/user/login' )}</a></p>
{/if}

<input type="hidden" name="RedirectURI" value="{$nodoTemp.url_alias|ezurl('no')}" />

{if and( is_set( $User:post_data ), is_array( $User:post_data ) )}
  {foreach $User:post_data as $key => $postData}
     <input name="Last_{$key}" value="{$postData}" type="hidden" /><br/>
  {/foreach}
{/if}

</form>
<div class="forgotPass">
                                	<p>Escribe la cuenta de correo electrónico con la que diste de alta y te enviaremos a ella tu nueva contraseña.</p>
                              
                              	<form action="" id="rePassForm" name="rePassForm" method="post">
                                    <label for="email">Correo electrónico</label>
                                    <input type="text" id="email" name="email" class="text" />
                                    <span class="volver"><a href="">Cerrar</a></span>

                                    <span class="submit"><input type="image" src={"btn_enviar.gif"|ezimage} alt="Enviar" /></span>
                                    </form>	  	  		
                                </div>
     

</div>

 <div class="colDatos2">
                        	
                            <h2>Regístrese para dar su opinión sobre el [{$nodoTemp.name}]</h2>
                            
                            <ul>
								<li><a href="">Disfruta de ventajas exclusivas</a></li>
                            </ul>
                        
                        	<span class="submit"><a href={"basket/register"|ezurl()}><img src={"btn_registro.gif"|ezimage} alt="Registro" /></a></span>
                        
                        </div>

</div>


</div>

</div>
