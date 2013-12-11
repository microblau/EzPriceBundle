
			
		
			<div id="gridWide" class="compraPaso2">
            
            	<ol id="pasosCompra">
					<li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
					<li><h1><img src={"txt_paso2-sel.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></h1></li>
					<li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
					<li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
				</ol>

				
                <div class="inner">

            
                    <div id="gridDatos" class="clearFix">
                    
                        {*<span class="volver frt"><a href="">Volver</a></span>*}
                        
                        <div class="colDatos1">
                        
                        {if $warning.bad_login}
<div class="msgError">
<span>Lo sentimos, pero se han encontrado los siguientes errores</span>
<ul>
    <li>{"Se requiere un email y una contraseña para conectar."|i18n("design/ezwebin/user/login")}</li>
</ul>
</div>
{else}

{*
{if $site_access.allowed|not}
<div class="warning">
<h2>{"Access not allowed"|i18n("design/ezwebin/user/login")}</h2>
<ul>
    <li>{"You are not allowed to access %1."|i18n("design/ezwebin/user/login",,array($site_access.name))}</li>
</ul>
</div>
{/if}
*}
{/if}
                        
                        	<form method="post" id="datosLoginForm" action={"/basket/login/"|ezurl} name="loginform">

<h2>¿Ya está registrado?</h2>




<ul class="datos">
<li {if $warning.bad_login}class="error"{/if}>
<label for="usuario">E-mail *</label>
<input type="text" id="usuario" name="Login" class="text" value="{$login|wash}" tabindex="1" />
</li>

<li {if $warning.bad_login}class="error"{/if}>
<label for="pass">{"Password"|i18n("design/ezwebin/user/login")} *</label>
<input class="text" type="password" size="10" name="Password" id="pass" value="" tabindex="1" />
<span class="olvido"><a href={"basket/forgotpassword"|ezurl}>¿Olvidó su contraseña?</a></span>

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


{if ezini( 'SiteSettings', 'LoginPage' )|eq( 'custom' )}
    <p><a href={'/user/forgotpassword'|ezurl}>¿Has olvidado tu contraseña?</a></p>
{/if}

<input type="hidden" name="RedirectURI" value={"basket/userdata"|ezurl()} />

{if and( is_set( $post_data ), is_array( $post_data ) )}
  {foreach $Basket:post_data as $key => $postData}
     <input name="Last_{$key}" value="{$postData}" type="hidden" /><br/>
  {/foreach}
{/if}

</form>
<div class="forgotPass">
                                	<p>Escriba la cuenta de correo electrónico con la que se dio de alta y le enviaremos a ella su nueva contraseña.</p>
                              
                              	<form action={"basket/forgotpassword"|ezurl} id="rePassForm" name="rePassForm" method="post">
                                    <label for="email">Correo electrónico</label>
                                    <input type="text" id="email" name="email" class="text" />
                                    <span class="volver"><a href="">Cerrar</a></span>

                                    <span class="submit"><input type="image" src={"btn_enviar.gif"|ezimage} alt="Enviar" name="BtnPasswordRecover" /></span>
                                    </form>	  	  		
                                </div>
     

</div>

 <div class="colDatos2">
                        	
                            <h2>¿Aún no está registrado?</h2>
                            
                            <ul>
                            	<li>Automatice su proceso de compra</li>

                                <li>Disfrute de ventajas exclusivas</li>
                            </ul>
                        
                        	<span class="submit"><a href={"basket/register"|ezurl()}><img src={"btn_registro.gif"|ezimage} alt="Registro" /></a></span>
                        	
                        	
                        
                        </div>

</div>

<div id="logohispassl" style="text-align:left; padding-left: 380px">
                                {include uri="design:shop/logo.tpl"}
                            </div>
                
                    </div>
                    
                </div>
            
       
			
		
			
		
		
