{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSMSettings',  'Destacados', 'rpsm.ini' ) ))}        
{def $user = fetch( 'user', 'current_user')}
{if $user.is_logged_in|not}

	<div id="gridTwoColumns" class="clearFix">
		<div class="columnType1" >
			<div id="modAbonados">
				
					<h1>Recursos Portal Soluciones Memento</h1>
					<div class="wrap clearFix">
				
							<div class="description">
								<div class="wysiwyg">
									<h2>Le ayudamos a sacar el máximo partido a su Producto Electrónico, proporcionándole…</h2>
									<br>
									<ul>
										<li><strong>Formación.</strong><ul><li>Acceda a <b>vídeos demostrativos</b> para <b>dominar</b> su producto.</li><li>Participe en <b>sesiones formativas gratuitas.</b></li><li>Consulte <b>documentación con casos prácticos.</b></li></ul></li>
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

	<div id="home_recursos">
		<div id="gridHome1" class="clearFix" >
			<div class="columnType1" style="float:left; width:680px">
			
			
				<div id="presentacionRecursos" class="presentacion">
				
					<h2>Toda la calidad y prestigio de Memento a su disposición</h2>
					<div class="wrap clearFix">
						<div class="columnType1">
							<div class="curveSup wrapAjaxContent clearFix">
								<div class="media">
									<img src={"img_presentacionRecursos.jpg"|ezimage} alt="" />
								</div>
								<div class="description">
									<ul>
										<li><strong>Aprenda</strong></li>
										<li><strong>Conéctese</strong></li>
										<li><strong>Utilícelo</strong></li>
									</ul>
								</div>
								<div class="novedades">
									<ul>
										<li class="email">
											<a href={"recursospsm/formularios/formulario-de-inscripcion"|ezurl} target="_blank">Novedades por email</a>
										</li>
										<li class="rss">
											<a href={"recursospsm/rss"|ezurl}>RSS</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
				
					</div>
				
				</div>
			
				<div id="listadoRecursos" class="listadoRecursos clearFix">
					<h2>Todos los recursos a su disposición</h2>
					<div class="contenido flt">	
						<div class="wrap clearFix">
							<h3>Vídeo Guías</h3>
	
								<div id="guias" class="clearFix">
									<div class="entradilla">
										<p>Descubra las principales funcionalidades de su producto y aprenda como utilizarlas</p>
										<span>Últimas vídeo guías publicadas</span>
									</div>
									<ul>
									
									{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'Video_guias', 'rpsm.ini' ), 'sort_by', array('attribute',false(),'video_guias/fecha')))}
								
									{foreach $video_guias as $video_guia}
										{if $video_guia.data_map.portada.content|eq(1)}
										
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
											
										{/if}
									{/foreach}
									
									{undef $video_guias}
									
									</ul>
									<div class="botones">
										<a href={"recursospsm/saber-mas/video-guias"|ezurl}><img src={"btn_ver-videoguias.png"|ezimage} alt="" /></a>
									</div>
								</div>
							
						</div>
					</div>
					
				</div>	

			
			</div>
			<div class="columnType2">
			
						
				<div id="modDestacado">
					<h2>¿Necesita ayuda?</h2>
					<div class="wrap clearFix chat">
						<div class="content">
							<span>&nbsp;</span>
							<a href="javascript:alert('En estos momentos no está disponible. Disculpe las molestias.')" title="Accede al Chat para obtener ayuda">Chat</a>
						</div>
					</div>
					<div class="wrap clearFix contact">
						<div class="content">
							<span>91 210 80 00</span>
							<a href="mailto:clientes@efl.es" title="Envíanos un correo electrónico">clientes@efl.es</a>
						</div>
					</div>
					<div class="wrap clearFix faq">
						<div class="content">
							<h3>Preguntas frecuentes</h3>
							<p>Todas sus dudas solucionadas en un simple clic</p>
							<div class="clearFix">
								<a href={"preguntas-frecuentes/portal-soluciones-memento-nautis-mementix-actum-formularios-convenios/preguntas-de-utilizacion"|ezurl} target="_blank"><img src={"btn_utilizacionFaq.png"|ezimage} alt="Utilización" /></a>
								<a href={"preguntas-frecuentes/portal-soluciones-memento-nautis-mementix-actum-formularios-convenios/preguntas-tecnicas"|ezurl} target="_blank"><img src={"btn_tecnicasFaq.png"|ezimage} alt="Técnicas" /></a>
							</div>
						</div>
					</div>
				</div>

				<div id="modEnlaces">
					<h2><span class="none">Enlaces</span></h2>
					<div class="wrap clearFix">
						<div class="content">
							<ul>
								<li>
									<a href={"formularios/inscribase-en-los-cursos-de-formacion-nautis-mementix"|ezurl} target="_blank">Necesita más formación</a>
								</li>
								<li>
									<a href={"recursospsm/casos_exito"|ezurl} title="Ver más casos de éxito">Casos de éxito</a>
								</li>
								<li>
									<a href={"recursospsm/formularios/que-opina-de-nuestro-portal-soluciones-memento"|ezurl} target="_blank">Opine sobre su producto</a>
								</li>
							</ul>
						</div>
					</div>
					
				</div>
			
				<div id="modWhite" class="experto">
					<h2>Funcionalidades y Contenidos</h2>

					<div class="wrap clearFix">
						<div class="content">
							<p>Conozca las novedades que contiene su producto</p>
							<div class="botones">
								<a href={"recursospsm/nuevo_contenido"|ezurl}>
									<img src={"btn_experto.png"|ezimage} alt="Quiero ser experto"/>
								</a>
							</div>
						</div>
					</div>
					
				</div>

			</div>
		</div>
	</div>
{/if}
