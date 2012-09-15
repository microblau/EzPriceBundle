<h2><strong>Pruebe gratis</strong> nuestros productos electrónicos 15 días</h2>
					<div class="inner">
					
						<form action={"content/action"|ezurl} method="post">
							
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
									<label for="sue">Su email</label>
									<input type="text" id="sue" name="ContentObjectAttribute_data_text_10810" class="text" />
								</li>
								<li>
									<label for="sepro">Seleccione producto</label>
<input type="hidden" name="ContentObjectAttribute_ezselect_selected_array_10807" value="" />

									<select id="sepro" name="ContentObjectAttribute_ezselect_selected_array_10807[]">
										<option selected="selected" value=""></option>
										{*
										<option value="0">QMementix</option>
                                        <option value="1">Qmemento 4</option>
                                        <option value="2">Qmemento Fiscal</option>
                                        <option value="3">Qmemento Social</option>
                                        <option value="4">Qmemento Fiscal Contable</option>
                                        <option value="5">Qmemento Contable</option>
                                        <option value="6">Qmemento Mercantil Concursal</option>
                                        <option value="7">Qmemento Inmobiliario</option>
                                        <option value="8">Qmemento Administrativo</option>
                                        <option value="9">Qmemento Jurídico</option>
                                        <option value="10">VIAbilidad Inmobiliaria</option>
                                        <option value="11">Actum-Actualidad Mementos</option>
										*}
										<option value="0">QMementix</option>
										<option value="1">Qmemento Asesoría</option>
										<option value="2">Qmemento Social</option>
										<option value="3">Qmemento Fiscal</option>
										<option value="4">Qmemento Financiero</option>
										<option value="5">Qmemento Profesional</option>
										<option value="6">Qmemento Contable</option>
										<option value="7">Qmemento Mercantil</option>
										<option value="8">Viabilidad Inmobiliaria</option>
										<option value="9">Actum-Actualidad Mementos</option>
										<option value="10">Nautis Administrativo</option>
<option value="11">Nautis Inmobiliario</option>
<option value="12">Nautis Jurídico</option>
<option value="13">iMemento</option>
									</select>
								</li>
								<li class="acepto">
									<label for="acep"> <input type="checkbox"id="acep" name="ContentObjectAttribute_data_boolean_10812" /> Acepto las <a href={'lightbox/ver/1451'|ezurl}>condiciones legales</a></label>
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
