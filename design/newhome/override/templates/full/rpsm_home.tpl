{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSMSettings',  'Destacados', 'rpsm.ini' )))}        
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
	<div align="right"><a href="http://solucionesmemento-indiv.efl.es" target="_blank"><b>Acceso a PSM</b></a></div>
	
	<div id="home_recursos">

		<div id="gridHome1" class="clearFix">
			<div class="columnType1" style="float:left; width: 680px">
			
				<div id="presentacionRecursosVid" class="presentacion">
				
					<h2>{$node.data_map.subtitulo.content}</h2>
					
					<div class="wrap clearFix">
						<div class="columnType1">
							<div class="curveSup wrapAjaxContent clearFix">
							
								{if $node.data_map.youtube_url.has_content}
										<div class="media"> 
											<div id="mediaspace">
												{eflyoutube( $node.data_map.youtube_url.content, 236, 213 )}
											</div>
										</div>
									{else}
										{if $node.data_map.video.has_content}
											{def $video = fetch( 'content', 'object', hash( 'object_id', $node.data_map.video.content.relation_browse.0.contentobject_id ))}                         
											<div class="media">
												{attribute_view_gui attribute=$video.data_map.video width=236 height=213 autostart=0}                       
											</div>
										{else}
											{if $node.data_map.imagen.has_content}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
												<div class="media">
													<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
												</div>
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
														<div class="class-image">
															<div class="attribute-image">                                 
																<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
															</div>                                                                                  
														</div>
											{/if}
										{/if}
									{/if}
								
								<div class="description">
									<table border="0" align="center" valign="center" width="380" cellpadding="5" cellspacing="5">
										<tr>
											<td>{$node.data_map.texto.content.output.output_text}</td>
											<td><img src={"ico_play.png"|ezimage} alt="" /></td>
										</tr>
									</table>
								</div>
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
			
				<div id="listadoRecursos" class="listadoProfundidad clearFix">
					<h2>Conozca su producto en profundidad</h2>
					<div class="contenido flt">	
						<div class="wrap clearFix">
							<ul>
								<li>
									<div class="modWhite">
										<h3>PSM en 60 segundos</h3>
										<div class="wrap clearFix">
											<div class="content">
												<p>Descubra como empezar a utilizar su producto</p>
												<ul>
												
													{def $pdf = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSMSettings',  'PDF_60segundos', 'rpsm.ini' ) ))}
														<li><a href={concat( 'content/download/', $pdf.data_map.file.contentobject_id, '/', $pdf.data_map.file.id,'/version/', $pdf.data_map.file.version , '/file/', $pdf.data_map.file.content.original_filename|urlencode )|ezurl}>Descargue el pdf</a></li>
													{undef $pdf}
													
													{def $video60 = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSMSettings',  'Video_60segundos', 'rpsm.ini' ) ))}                        
														<li><a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video60.data_map.youtube_url.content)|ezurl} target="_blank">Vídeo explicativo</a></li>
													{undef $video60}

												</ul>
											</div>
										</div>
									</div>
								</li>
								<li class="reset">
									<div class="modWhite">
										<h3>Quiero saber más</h3>
										<div class="wrap clearFix">
											<div class="content">
												<p>Todos los recursos para dominar su producto</p>
												<div class="botones">
													<a href={"recursospsm/saber-mas"|ezurl}><img src={"btn_recursos.png"|ezimage} alt="Ver recursos"/></a>
												</div>
											</div>
										</div>
									</div>
								</li>									
								<li>
									<div class="modWhite">
										<h3>¿Necesita más Formación?</h3>
										<div class="wrap clearFix">
											<div class="content">
												<p>Seminarios Presenciales y On-line conducidos por nuestros expertos</p>
												<div class="botones">
													<a href={"formularios/inscribase-en-los-cursos-de-formacion-nautis-mementix"|ezurl} target="_blank"><img src={"btn_inscribirme.png"|ezimage} alt="Quiero inscribirme"/></a>
												</div>
											</div>
										</div>
									</div>
								</li>									
								<li class="reset">
									<div class="modWhite">
										<h3>Funcionalidades y Contenidos</h3>
										<div class="wrap clearFix">
											<div class="content">
												<p class="mini">Conozca las novedades que contiene su producto</p>
												<div class="botones">
													<a href={"recursospsm/nuevo_contenido"|ezurl}>
														<img src={"btn_experto.png"|ezimage} alt="Quiero ser experto"/>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li>									

							</ul>
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

				<div id="modExperiencia">
					<h2>Comparta su experiencia</h2>
					<div class="wrap clearFix">
						<div class="content">
							<ul>
								<li>
									<h3>¡Su opinión es importante!</h3>
									<p>Conteste a nuestro breve formulario, nos ayudará a prestarle un mejor servicio</p>
									<div class="clearFix">
										<a href={"recursospsm/formularios/que-opina-de-nuestro-portal-soluciones-memento"|ezurl} target="_blank">
											<img src={"btn_opinion.png"|ezimage} alt="Quiero dar mi opinión" />
										</a>
									</div>
								</li>
								<li class="reset">
									<h3>Casos de éxito <img src={"valoracion_5.gif"|ezimage} alt="" /></h3>
									
									{def $casos_exito=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'Casos_exito', 'rpsm.ini' )))}
									
									{foreach $casos_exito as $caso_exito}
										{if $caso_exito.data_map.portada.content|eq(1)}
											<div class="bocadillo">
												<p>{$caso_exito.data_map.subtitulo.content}</p>
											</div>
											<br>
											<div class="mas">
												<span><strong>{$caso_exito.data_map.empleado.content}</strong><br />{$caso_exito.data_map.nombre_empresa.content}</span>
												<a href={"recursospsm/casos_exito"|ezurl} title="Ver más casos de éxito">Más casos</a>
											</div>
										{/if}
									{/foreach}
									
									{undef $casos_exito}
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div id="modWhite">
					<h2>Le recomendamos</h2>
					<div class="wrap clearFix">
						<div class="content">						
						{def $referencia_ws = ezhttp( 'cd_prod_sugerido', 'session' )}						
						
						{if $referencia_ws|eq('0')}{set $referencia_ws = 'SP'}{/if}
   
						{def $productos_sugeridos=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'Productos_sugeridos', 'rpsm.ini' ) ))}
																				
						{foreach $productos_sugeridos as $producto_sugerido}
							{if $producto_sugerido.data_map.referencia.content|eq($referencia_ws)}
								<!--
								<div class="image flt">
									<img src={$producto_sugerido.data_map.imagen.content.fichaproducto.url|ezroot} width="65" height="44" />
								</div>
								-->
								
								<div class="description frt">

									<a href={$producto_sugerido.data_map.url.content|ezurl} target="_blank">{$producto_sugerido.data_map.titulo.content}</a>
									<p>{$producto_sugerido.data_map.subtitulo.content}</p>
								
								<div class="action" style="text-align:center;"><a href={$producto_sugerido.data_map.url.content|ezurl} target="_blank"><img alt="Lo quiero" src={"btn_masinfo.png"|ezimage} /></a></div>
							</div>
							{/if}
						{/foreach}
									
						{undef $productos_sugeridos}
						
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
{/if}
