<h2><strong>Pruebe gratis</strong> nuestros productos electrónicos 15 días</h2>
					<div class="inner">
					
						<form action={"utils/action"|ezurl} method="post">
							
							<span>* Datos obligatorios</span>
							<ul>
								<li>
									<label for="sun">Su nombre*</label>
									<input type="text" id="sun" name="ContentObjectAttribute_ezstring_data_text_10808" class="text" />
								</li>
								<li>
									<label for="sua">Sus apellidos*</label>
									<input type="text" id="sua" name="ContentObjectAttribute_ezstring_data_text_10809" class="text" />
								</li>
								<li>
									<label for="sut">Su teléfono*</label>
									<input type="text" id="sut" name="ContentObjectAttribute_ezstring_data_text_10811" class="text" />
								</li>
								<li>
									<label for="sue">Su email*</label>
									<input type="text" id="sue" name="ContentObjectAttribute_data_text_10810" class="text" />
								</li>
<li>
<label for="cp">Su código postal*</label>
									<input type="text" id="cp" name="ContentObjectAttribute_ezstring_data_text_276769" class="text" />
								</li>
								<li>
									<label for="sepro">Seleccione producto*</label>
<input type="hidden" name="ContentObjectAttribute_ezselect_selected_array_10807" value="" />


									<select name="ContentObjectAttribute_ezselect_selected_array_10807[]" id="sepro"><option value=""></option><option value="0" >Bases de datos jurídicas El Derecho</option><option value="1">QMemento</option><option value="2">Mementos en Internet (QMementix)</option><option value="3">Mementos para iPad (iMemento)</option></select>
										
									
								</li>
								<li class="acepto">
                                                                    <label for="acep"> <input type="checkbox"id="acep" name="ContentObjectAttribute_data_boolean_10812" /> He leído y acepto las condiciones de la <a id="politicaligthBox" href={'lightbox/ver/19526'|ezurl}>Política de Privacidad</a> y el <a id="avisoLightbox" href={'lightbox/ver/292'|ezurl}>Aviso Legal</a></label>
								</li>
							</ul>
							<span class="submit"><input name="ActionCollectInformation" type="image" src={"btn_enviarSoli.png"|ezimage} alt="enviar solicitud" /></span>
	{def $currentusuario = fetch( 'user', 'current_user') }				
						 <input class="box" type="hidden" size="70" name="ContentObjectAttribute_ezstring_data_text_21371" value="" id="colectivo" value="{cond( $currentusuario.is_logged_in, $currentusuario.contentobject.main_node.parent.name, '')}
" />						   <input type="hidden" name="ContentNodeID" value="1456" />
						   <input type="hidden" name="ContentObjectID" value="1512" />
						   <input type="hidden" name="ViewMode" value="full" />

						
						</form>
					
					</div>
