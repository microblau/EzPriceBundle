<div id="bodyContent">

		
			
		
			<div id="gridTwoColumnsTypeB" class="clearFix">
            	
                <ol id="pasosCompra">
					<li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
					<li><img src={"txt_paso2-sel.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
					<li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
					<li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
				</ol>
                
				<div class="columnType1">
					<div id="modType2">

						
							<h1>Datos de usuario</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">
                                        	{if is_set( $errors )}
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			{foreach $errors as $key => $error }
                                        				<li>{$error}</li>
                                        			{/foreach}
                                        			</ul>
                                        		</div>
                                        	{/if}
                                            <form action="" method="post" id="datosUsuarioForm" name="datosUsuarioForm">
                                            <span class="camposObligatorios">* Datos obligatorios</span>
                                            	<h2>Datos de usuario</h2>                                                
                                                <ul class="datos">

                                                	<li {if is_set( $errors.nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        <input type="text" id="nombre" name="nombre" class="text" value="{cond( is_set( $nombre ), $nombre, '')}" />
                                                    </li>
                                                    <li {if is_set( $errors.apellido1)}class="error"{/if}>
                                                    	<label for="apellido1">Apellido1 *</label>
                                                        <input type="text" id="apellido1" name="apellido1" class="text" value="{cond( is_set( $apellido1 ), $apellido1, '')}" />
                                                    </li>
                                                    
                                                    <li>
                                                    	<label for="apellido2">Apellido 2</label>
                                                        <input type="text" id="apellido2" name="apellido2" class="text" value="{cond( is_set( $apellido2 ), $apellido2, '')}" />
                                                    </li>
                                                    

                                                    <li {if is_set( $errors.email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        <input type="text" id="email" name="email" class="text" value="{cond( is_set( $email ), $email, '')}" />
                                                    </li>                                                  
                                                    <li {if is_set( $errors.passwd)}class="error"{/if}>
                                                    	<label for="pass">Contraseña *</label>
                                                        <input type="password" id="pass" name="pass" class="text" />
                                                        <span>(Máximo 8 caracteres)</span>
                                                    </li> 
                                                    <li {if is_set( $errors.repPass)}class="error"{/if}>
                                                    	<label for="repPass">Repetir contraseña *</label>
                                                        <input type="password" id="repPass" name="repPass" class="text" />
                                                        <span>(Máximo 8 caracteres)</span>

                                                    </li>                      
                                                     <li>
                                                    	<label for="pais">País de residencia *</label>
                                                    	{def $countries=fetch( 'content', 'country_list' )}
                                                    	
                                                        <select id="pais" name="pais">
                                                        
                                                        {foreach $countries as $index => $country}
                                                        <option {if or( and( is_set( $countrycode)|not, eq( $country.Alpha2, 'ES') ), and( is_set( $countrycode), eq( $country.Alpha2, $countrycode) ) )}selected="selected"{/if} value="{$country.Alpha2}">{$country.Name}</option>
                                                        {/foreach}
                                                        </select>
                                                         {undef $countries}
                                                        
                                                    </li>       
                                                    <li >
                                                    	<fieldset>

                                                    		<legend><span {if is_set( $errors.tipocompra)}class="error"{/if}>Voy a comprar como: *</span></legend>
                                                    		<ul>
                                                    			<li>
                                                    				<label for="empresa"><input {if $tipocompra|eq(2)}checked="checked"{/if} value="2" type="radio" id="empresa" name="tipoCompra" /> Una empresa</label>
                                                                </li>
                                                                <li>
                                                    				<label for="particular"><input {if $tipocompra|eq(1)}checked="checked"{/if} value="1" type="radio" id="particular" name="tipoCompra" /> Un particular o profesional</label>

                                                                </li>
                                                    		</ul>
                                                    	</fieldset>
                                                    </li>                           
                                                </ul>
                                                
                                                <ul class="datos">
                                                	
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $errors['condiciones'] )}class="error"{/if}><input type="checkbox" id="condiciones" name="condiciones" /> Acepto las condiciones</label>
                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1321)).data_map.texto.content.output.output_text}
                                                    	</div>

                                                    </li>
                                                                                                    
                                                </ul>
                                                
                                               
                                               <div class="clearFix">
	                                                {*<span class="volver"><a href={"shop/basket"|ezurl}>Volver</a></span>*}
   	                                                <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="BtnRegister" /></span>
                                                
                                                </div>  
                                                    	                                                        
                                            </form>

                                                									
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
                
                	<div id="modComprando">
                		{include uri="design:basket/cart.tpl"}
                    </div>
                    
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>

                    <div id="logohispassl">
					   <script type="text/javascript">TrustLogo("https://www.hispassl.com/entorno_seguro.gif", "HispS", "none");</script>
					</div>
                    
				</div>
                
			</div>

				
			
		
			
		
		</div>
