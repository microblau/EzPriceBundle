	{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSM-SAGESettings',  'Destacados', 'rpsm.ini' )))}   
	
	<div id="sage_home_recursos">
		<div id="gridHome1" class="clearFix">
			<div class="columnType1">
			
				<div id="presentacionRecursos">
				
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
									<strong>
									{$node.data_map.texto.content.output.output_text}
									</strong>
								</div>
								<div class="novedades">
									<ul>
										<li class="email"><a href={"recursospsm_sage/formularios/formulario-de-inscripcion-boletin-recursos-psm-sage"|ezurl} target="_blank">Novedades por email</a></li>
										<li class="rss"><a href={"recursospsm_sage/rss"|ezurl}>RSS</a></li>
									</ul>
								</div>
							</div>
						</div>
				
					</div>
				
				</div>
			
				<div id="listadoRecursos">
					<h2>Conozca su producto en profundidad</h2>
					<div class="wrap clearFix">
						<div class="columnType1">
							<div class="curveSup wrapAjaxContent clearFix">
								<div class="mementos">
										<h3>Mementos Sage en 60 segundos</h3>
										<p>Descubra cómo empezar a utilizar su producto.</p>
										<div class="img_link">
											{def $video60 = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSM-SAGESettings',  'Video_60segundos', 'rpsm.ini' ) ))}
											<a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video60.data_map.youtube_url.content)|ezurl} target="_blank"><img src={"sage_btn_videoexplicativo.gif"|ezimage} alt=""/></a>
											{undef $video60}
											
											{def $pdf = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSM-SAGESettings',  'PDF_60segundos', 'rpsm.ini' ) ))}
											<a href={concat( 'content/download/', $pdf.data_map.file.contentobject_id, '/', $pdf.data_map.file.id,'/version/', $pdf.data_map.file.version , '/file/', $pdf.data_map.file.content.original_filename|urlencode )|ezurl}><img src={"sage_btn_descarguePDF.gif"|ezimage} alt=""/></a>
											{undef $pdf}
										</div>
										<div class="img_bordeinf">
											<img src={"sage_curve_inf_inner_recursos_der.gif"|ezimage} alt=""/>
										</div>
								</div>
								<div class="formacion">
										<h3>¿Necesita más Formación?</h3>
										<p>Seminarios presenciales y Online.</p>
										<div class="img_link">
											<a href={"recursospsm_sage/formularios/inscribase-en-los-cursos-de-formacion-memento-sage"|ezurl} target="_blank"><img src={"sage_btn_quieroInsc.gif"|ezimage} alt="Quiero inscribirme"/></a>
										</div>
										<div class="img_bordeinf">
											<img src={"sage_curve_inf_inner_recursos_izq.gif"|ezimage} alt=""/>
										</div>
								</div>
								<div class="recursos">
										<h3>Quiero saber más</h3>
										<p>Todos los recursos para dominar los Mementos.</p>
										<div class="img_link">
											<a href={"recursospsm_sage/saber-mas"|ezurl}><img src={"sage_btn_verRec.gif"|ezimage} alt="Ver recursos"/></a>
										</div>
										<div class="img_bordeinf">
											<img src={"sage_curve_inf_inner_recursos.gif"|ezimage} alt=""/>
										</div>
								</div>
								<div class="productos">
										<h3>¿Quiere ampliar sus Mementos Sage?</h3>
										<p>Conozca nuestra gama de productos.</p>
										<div class="img_link">
											<a href={"http://www.mementossage.com"|ezurl} target="_blank"><img src={"sage_btn_masInfo.gif"|ezimage} alt="Quiero ser experto"/></a>
										</div>
										<div class="img_bordeinf">
											<img src={"sage_curve_inf_inner_recursos.gif"|ezimage} alt=""/>
										</div>
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
							<a href="mailto:clientes@efl.es" title="Envíanos un correo electrónico">clientes@efl.es</a>
							<h3>912108000</h3>
						</div>
					</div>
					<div class="wrap clearFix faq">
						<div class="content">
							<h3>Preguntas frecuentes</h3>
							<h4>Todas sus dudas solucionadas en un simple clic</h4>
							<a href={"recursospsm_sage/preguntas-frecuentes/preguntas-de-utilizacion-sage"|ezurl} target="_blank"><img src={"sage_btn_utilizacionFaq.gif"|ezimage} alt="Utilización" /></a>
							<a href={"recursospsm_sage/preguntas-frecuentes/preguntas-tecnicas-sage"|ezurl} target="_blank"><img src={"sage_btn_tecnicasFaq.gif"|ezimage} alt="Técnicas" /></a>
						</div>
					</div>
				</div>

				<div id="modOpinion">
					<h2>Comparta su opinión</h2>
					<h3>¡Su opinión es importante!</h3>
					<h4>Conteste 10 preguntas, nos ayudará a prestarle un mejor servicio.</h4>
					<div class="wrap clearFix opinion">
						<a href={"recursospsm_sage/formularios/que-opina-de-nuestro-portal-soluciones-memento-nautis-mementix-sage"|ezurl} target="_blank">
							<img src={"sage_btn_darOpinion.gif"|ezimage} alt="Quiero dar mi opinión" />
						</a>
					</div>
					<div class="wrap clearFix casos">
						<h3>Casos de éxito</h3>
						
						{def $casos_exito=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSM-SAGESettings',  'Casos_exito', 'rpsm.ini' )))}
									
						{foreach $casos_exito as $caso_exito}
							{if $caso_exito.data_map.portada.content|eq(1)}
								<h4>{$caso_exito.data_map.subtitulo.content}</h4>
								<h5><strong>{$caso_exito.data_map.empleado.content}</strong><br>{$caso_exito.data_map.nombre_empresa.content}</h5>
							{/if}
						{/foreach}
						
						{undef $casos_exito}
						
						<a href={"recursospsm_sage/casos_exito"|ezurl} title="Ver más casos de éxito"><img src={"sage_btn_masCasos.gif"|ezimage} alt="Más casos" /></a>
					</div>
				</div>
				
			</div>

		</div>
	</div>