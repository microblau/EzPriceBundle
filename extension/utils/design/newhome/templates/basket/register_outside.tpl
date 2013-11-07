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

						
							<h1>Datos para compras internacionales</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosFacturacion">
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
                                            <form action={"basket/register"|ezurl} method="post" id="datosContactoInteForm" name="datosContactoInteForm" class="formulario">
                                            <span class="camposObligatorios">* Datos obligatorios</span>
                                            <p>La facturación y envío de su compra se va a hacer fuera de España. Para formalizar su compra, rellene el siguiente formulario y nos pondremos en contacto con usted lo antes posible.</p>
                                            	<h2>Datos de contacto</h2>

                                                
                                                <ul class="datos">
                                                	 
                                                    
                                                     
                                                    <li {if is_set( $errors.nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        <input type="text" id="nombre" name="nombre" class="text" value="{$nombre}" readonly="yes" />

                                                        
                                                    </li> 
                                                     <li  {if is_set( $errors.apellido1)}class="error"{/if}>
                                                    	<label for="apellido1">Apellido 1 *</label>
                                                        <input type="text" id="apellido1" name="apellido1" class="text" value="{$apellido1}" readonly="yes" />
                                                        
                                                    </li>  
                                                    
                                                    <li >
                                                    	<label for="apellido2">Apellido 2</label>
                                                        <input type="text" id="apellido2" name="apellido2" class="text" value="{$apellido2}" readonly="yes" />
                                                        
                                                    </li>   
                                                    <li {if is_set( $errors.telefono)}class="error"{/if}>
                                                    	<label for="telefono">Teléfono *</label>
                                                        <input type="text" id="telefono" name="telefono" class="text" />
                                                    </li>                                                       
                                                    <li {if is_set( $errors.email)}class="error"{/if} >

                                                    	<label for="email">Email *</label>
                                                        <input type="text" id="email" name="email" class="text" value="{$email}" readonly="yes" />
                                                    </li>  
                                                    
                                                    
                                                   
                                                    <li>
                                                    	<label for="pais">País *</label>
                                                       {def $countries=fetch( 'content', 'country_list' )}
                                                    	
                                                        <select id="pais" name="pais" readonly="yes">
                                                        
                                                        {foreach $countries as $index => $country}
                                                        <option {if eq( $country.Alpha2, $pais|trim() )}selected="selected"{/if} value="{$country.Alpha2}">{$country.Name}</option>
                                                        {/foreach}
                                                        </select>
                                                         {undef $countries}
                                                    </li>  
                                                                                                    
                                                </ul>

                                                
                                                
                                                
                                                <h2>Observaciones</h2>
                                                
                                                <ul class="datos">
                                                	<li>
                                                    	<label for="observaciones">Observaciones</label>
                                                        <textarea id="observaciones" name="observaciones" class="text" rows="5" cols="5">{$observaciones}</textarea>
                                                    </li>
                                                    
                                                   <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $errors['condiciones'] )}class="error"{/if}><input type="checkbox" id="condiciones" name="condiciones" /> Acepto las condiciones de contratación</label>
                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1321)).data_map.texto.content.output.output_text}
                                                    	</div>

                                                    </li>
                                                    {*<li class="condiciones">

                                                    	<label for="condiciones"><input type="checkbox" id="condiciones" name="condiciones" /> Acepto las condiciones</label>
                                                    	<div>
                                                    		<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has 
roots in a piece of classical Latin literature from 45 BC, making it over 
2000 years old. Richard McClintock, a Latin professor at Hampden-
Sydney College in Virginia, looked up one of the more obscure Latin 
words, consectetur, from a Lorem Ipsum passage, and going through
the cites of the word in classical literature, discovered the undoubtabl</p>
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has 
roots in a piece of classical Latin literature from 45 BC, making it over 
2000 years old. Richard McClintock, a Latin professor at Hampden-
Sydney College in Virginia, looked up one of the more obscure Latin 
words, consectetur, from a Lorem Ipsum passage, and going through
the cites of the word in classical literature, discovered the undoubtabl</p>
                                                    	</div>
                                                    </li>*}
                                                                                                    
                                                </ul>

                                               
                                               <div class="clearFix">
	                                                {*<span class="volver"><a href="">Volver</a></span>*}
   	                                             <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="BtnRegisterOutside" /></span>
                                                
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
