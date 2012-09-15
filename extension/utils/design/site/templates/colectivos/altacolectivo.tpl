<!-- Google Code for Colectivos Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "cK3MCNPSkgIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?label=cK3MCNPSkgIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
 {literal}<script type="text/javascript" src = "/design/site/javascript/yahoo-dom-event.js"></script>
<script type="text/javascript" src = "/design/site/javascript/ie-select-width-fix.js"></script>
<script type="text/javascript">
	new YAHOO.Hack.FixIESelectWidth( 'asociacion' ); 
	new YAHOO.Hack.FixIESelectWidth( 'asociacion' );
</script>{/literal}
<div id="bodyContent">

			<div id="gridTwoColumnsTypeB" class="clearFix">
                
				<div class="columnType1">
					<div id="modType2">
				
							<h1>Quiero acceder al área de mi colectivo/asociación profesional.</h1>
							
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
											
											<p><p>Por favor, cumplimente el formulario para poder acceder al área de su colectivo/asociación profesional y beneficiarse de las ventajas que tenemos para Usted.</p></p><br>
											
                                            <form action="" method="post" id="datosUsuarioColectivo" name="datosUsuarioColectivo">
                                            <span class="camposObligatorios">* Datos obligatorios</span>
                                            	<h2>Datos de alta</h2>             
												
                                                <ul class="datos">
                                                	<li {if is_set( $errors.nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        <input type="text" id="nombre" name="nombre" class="text" value="{cond( is_set( $nombre ), $nombre, '')}" />
                                                    </li>
													
                                                    <li {if is_set( $errors.apellido1)}class="error"{/if}>
                                                    	<label for="apellido1">Primer Apellido *</label>
                                                        <input type="text" id="apellido1" name="apellido1" class="text" value="{cond( is_set( $apellido1 ), $apellido1, '')}" />
                                                    </li>
													
                                                    <li {if is_set( $errors.apellido2)}class="error"{/if}>
                                                    	<label for="apellido2">Segundo Apellido</label>
                                                        <input type="text" id="apellido2" name="apellido2" class="text" value="{cond( is_set( $apellido2 ), $apellido2, '')}" />
                                                    </li>
													
													<li {if is_set( $errors.asociacion)}class="error"{/if}>
                                                    	<label for="asociacion">Asociación / Colectivo *</label>
                                                        {def $groups = fetch( 'content', 'list', hash( 'parent_node_id', 411, 'sort_by', array( 'name', true() ), 'limitation', array() ))}
                                                           <span class="select-box" style="padding:0;margin:0;">
                                                            <select name="asociacion" id="asociacion" >
                                                                <option value=""></option>
                                                                {foreach $groups as $group}
																	{if eq( $asociacion, $group.data_map.siglas.content )}
																		<option value="{$group.data_map.siglas.content}" selected>{$group.name}</option>
																	{else}
																		<option value="{$group.data_map.siglas.content}">{$group.name}</option>
																	{/if}
																{/foreach}
                                                            </select>  
                                                            </span>  
                                                           {undef $groups}
                                                    </li>
													
													<li {if is_set( $errors.no_colegiado)}class="error"{/if}>
                                                    	<label for="no_colegiado">Nº Colegiado *</label>
                                                        <input type="text" id="no_colegiado" name="no_colegiado" class="text" value="{cond( is_set( $no_colegiado ), $no_colegiado, '')}" />
                                                    </li>
													
                                                    <li {if is_set( $errors.email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        <input type="text" id="email" name="email" class="text" value="{cond( is_set( $email ), $email, '')}" />
                                                    </li>     
													
                                                    <li {if is_set( $errors.passwd)}class="error"{/if}>
                                                    	<label for="pass">Contraseña *</label>
                                                        <input type="password" id="pass" name="pass" class="text" value="{cond( is_set( $pass ), $pass, '')}" />
                                                        <span>(Máximo 8 caracteres)</span>
                                                    </li> 
													
                                                    <li {if is_set( $errors.repPass)}class="error"{/if}>
                                                    	<label for="repPass">Repetir contraseña *</label>
                                                        <input type="password" id="repPass" name="repPass" class="text" value="{cond( is_set( $repPass ), $repPass, '')}" />
                                                        <span>(Máximo 8 caracteres)</span>
                                                    </li>     
													
                                                    <li >
                                                    	<fieldset>

                                                    		<legend><span {if is_set( $errors.tipocompra)}class="error"{/if}>En caso de compra, ¿cómo va a facturar?: *</span></legend><br>
                                                    		<ul>
                                                    			<li>
                                                    				<label for="empresa"><input {if $tipocompra|eq(2)}checked="checked"{/if} value="2" type="radio" id="empresa" name="tipoCompra" /> Con CIF</label>
                                                                </li>
                                                                <li>
                                                    				<label for="particular"><input {if $tipocompra|eq(1)}checked="checked"{/if} value="1" type="radio" id="particular" name="tipoCompra" /> Con NIF</label>
                                                                </li>
                                                    		</ul>
                                                    	</fieldset>
                                                    </li>
                                                </ul>
                                                
                                                <ul class="datos2">
												
													<li class="condiciones">
														<label for="lopd" {if is_set( $errors.lopd)}class="error"{/if}><input type="checkbox" name="lopd">&nbsp;&nbsp;Autorizo que Ediciones Francis Lefebvre confirme mis datos de colegiado con el colectivo al que pertenezco</label>
													</li>
													
                                                    <li class="condiciones">
														<label for="condiciones" {if is_set( $errors.condiciones)}class="error"{/if}><input type="checkbox" name="condiciones">&nbsp;&nbsp;Acepto las condiciones</label>
														
                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1451)).data_map.texto.content.output.output_text}
                                                    	</div>
                                                    </li>
													
                                                    <li>
														<label for="capchar" {if is_set( $errors.captchar)}class="error"{/if}>Introduzca los caracteres que visualiza en la imagen inferior *:</label>
														<input type="text" id="eZHumanCAPTCHACode" name="eZHumanCAPTCHACode" class="text" value="" />
														<br><br><br>
															<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHA" />
														<br><br/>
													</li>                                           
                                                </ul>
                                                
                                               
                                               <div class="clearFix">
   	                                                <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="BtnColectivos" /></span>
                                                </div>  
                                                    	                                                        
                                            </form>
							
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
				
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
					
				</div>
                
			</div>	
		
		</div>