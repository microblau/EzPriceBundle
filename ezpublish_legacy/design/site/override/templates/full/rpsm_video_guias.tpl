{def $user = fetch( 'user', 'current_user')}
{if $user.is_logged_in|not}

	<div id="gridTwoColumns" class="clearFix">
		<div class="columnType1">
			<div id="modAbonados">
				
					<h1>Recursos Portal Soluciones Memento</h1>
					<div class="wrap clearFix">
				
							<div class="description">
								<div class="wysiwyg">
									<h2>Le ayudamos a sacar el máximo partido a su Producto Electrónico, proporcionándole…</h2>
									<br>
									<ul>
										<li><strong>Formación.</strong><ul><li>Acceda a <b>videos demostrativos</b> para <b>dominar</b> su producto.</li><li>Participe en <b>sesiones formativas gratuitas.</b></li><li>Consulte <b>documentación con casos prácticos.</b></li></ul></li>
										<li><strong>Asistencia.</strong> <b>Solucione</b> todas sus dudas con nuestra <b>asistencia On line.</b></li>
										<li><strong>Experiencia.</strong><ul><li><b>Comparta su opinión</b> sobre nuestros productos.</li><li>Lea los <b>casos de éxito</b> de clientes que, como Usted, utilizan el Portal Soluciones Memento.</li></ul></li>
										<li><strong>Noticias.</strong> Reciba todas las <b>novedades relacionadas con su producto</b> a través de e-mail y RSS.</li>
									</ul>
								</div>
							</div>								                        											
					</div>
				
			</div>
		</div>
		<div class="sideBar">
			<div id="modAccesoAbonados">

				<h2>Acceso usuarios</h2>
				<div class="wrap clearFix">
					<form action={"colectivos/login"|ezurl} method="post">
						<ul>
							<li>
								<label for="usuario">Usuario</label>
								<input type="text" class="text" id="usuario" name="Login" />
							</li>

							<li>
								<label for="pass">Contraseña</label>
								<input type="password" class="text" id="pass" name="Password" />
								<span><a href={"basket/forgotpassword"|ezurl}>¿Olvidó su contraseña?</a></span>
							</li>
							<li>
								<span class="submit"><input type="image" src={"btn_entrar.gif"|ezimage} alt="entrar" name="LoginButton" /></span>
							</li>
						</ul>
						
						<input type="hidden" name="RedirectURI" value="RecursosPSM" />
						
					</form>
															
				</div>
			</div>
			<br>
			<div align="center">
				<a href={"formularios/pruebe-nuestros-productos-electronicos-15-dias-sin-compromiso"|ezurl} target="_blank"><img src={"banner_prueba_gratuita_rpsm.jpg"|ezimage} alt="" /></a>
			</div>
		</div>
	</div>

{else}
	{def $interval_start = maketime( 0, 0, 0, $view_parameters.mes, 1, $view_parameters.anyo )} 
	{def $interval_end = maketime( 0, 0, -1, $view_parameters.mes|sum(1), 1, $view_parameters.anyo )}
	<div id="bodyContent">
	
		<div id="gridTwoColumnsTypeB" class="clearFix">
			<div class="columnType1">
				<div id="modType2">
					
						<h1><span class="none">Videoguías</span></h1>
						
						<div class="wrap clearFix">                    		
								<div class="description">
									<div id="guias" class="clearFix">
										<ul>
										{if $view_parameters.mes|gt(0)}
											{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'Video_guias', 'rpsm.ini' ),
																						      'sort_by', array('attribute',false(),'video_guias/fecha'),
																							  'attribute_filter', array( array( 'video_guias/fecha', 'between', array( $interval_start, $interval_end )))))}
										{else}
											{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'Video_guias', 'rpsm.ini' ),
																						      'sort_by', array('attribute',false(),'video_guias/fecha')))}
										{/if}
								
											{foreach $video_guias as $video_guia}
												<li>
												<a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video_guia.data_map.video_html.content)|ezurl} target="_blank"><img src={"img_videoguia.gif"|ezimage} alt="" /></a>
												
												<div class="flt">
													<h4><a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video_guia.data_map.video_html.content)|ezurl} target="_blank">{$video_guia.data_map.titulo.content}</a></h4>
													<span class="fecha">{$video_guia.data_map.fecha.content.timestamp|datetime('custom', '%d/%m/%Y')}</span>
													<p>{$video_guia.data_map.descripcion.content.output.output_text}</p>
													<div>
														<a href={concat( 'content/download/', $video_guia.data_map.pdf.contentobject_id, '/', $video_guia.data_map.pdf.id,'/version/', $video_guia.data_map.pdf.version , '/file/', $video_guia.data_map.pdf.content.original_filename|urlencode )|ezurl} title="Descargar la guía en formato pdf" class="pdf">Descargar pdf</a>
														
														<span class="youtube">Si no puedes descargar la guía pincha <a href={$video_guia.data_map.video_youtube.content|ezurl} target="_blank">aquí</a></span>
													</div>
												</div>
											</li>
											{/foreach}
											
											{undef $video_guias}

										</ul>
									</div>
								</div>								                        											
						</div>
				</div>
			</div>
			<div class="sideBar">
				<div id="modBlanco">
					<h2>Año 2011</h2>
					<ul>
						<li><a href={concat($node.name,'/(mes)/1/(anyo)/2011')}>Enero</a></li>
						<li><a href={concat($node.name,'/(mes)/2/(anyo)/2011')}>Febrero</a></li>
						<li><a href={concat($node.name,'/(mes)/3/(anyo)/2011')}>Marzo</a></li>
						<li><a href={concat($node.name,'/(mes)/4/(anyo)/2011')}>Abril</a></li>
						<li><a href={concat($node.name,'/(mes)/5/(anyo)/2011')}>Mayo</a></li>
						<li><a href={concat($node.name,'/(mes)/6/(anyo)/2011')}>Junio</a></li>
						<li><a href={concat($node.name,'/(mes)/7/(anyo)/2011')}>Julio</a></li>
						<li><a href={concat($node.name,'/(mes)/8/(anyo)/2011')}>Agosto</a></li>
						<li><a href={concat($node.name,'/(mes)/9/(anyo)/2011')}>Septiembre</a></li>
						<li><a href={concat($node.name,'/(mes)/10/(anyo)/2011')}>Octubre</a></li>
						<li><a href={concat($node.name,'/(mes)/11/(anyo)/2011')}>Noviembre</a></li>
						<li><a href={concat($node.name,'/(mes)/12/(anyo)/2011')}>Diciembre</a></li>
					</ul>
				</div>
			</div>
		</div>
			
	</div>
{/if}
