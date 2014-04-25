{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSM-SAGESettings',  'Destacados', 'rpsm.ini' ) ))}        

	<div id="sage_home_recursos">
		<div id="gridHome1" class="clearFix">
			<div class="columnType1" style="float:left; width:680px">
			
			
				<div id="presentacionRecursos">
				
					<h2>Saque el máximo rendimiento a su Memento Sage.</h2>
					<div class="wrap clearFix">
						<div class="columnType1">
							<div class="curveSup wrapAjaxContent clearFix">
								<div class="media">
									<img src={"sage_sabermas_img_presentacionRecursos.jpg"|ezimage} alt="" />
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
											<a href={"recursospsm_sage/formularios/formulario-de-inscripcion-boletin-recursos-psm-sage"|ezurl} target="_blank">Novedades por email</a>
										</li>
										<li class="rss">
											<a href={"recursospsm_sage/rss"|ezurl}>RSS</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
				
					</div>
				
				</div>
			
				<div id="listadoRecursos" class="listadoRecursos clearFix">
					<h2>Todos los recursos a su disposición</h2>
					<div id="videoGuias" class="contenido flt">
						<div class="wrap clearFix" id="guias-titulo">
							<h3>Vídeo Guías</h3>
	
								<div id="guias" class="clearFix">
									<div class="entradilla">
										<p>Descubra las principales funcionalidades de su producto y aprenda como utilizarlas.</p>
										<span>Últimas vídeo guías publicadas</span><br><br>
									</div>
									<ul>
									
									{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSM-SAGESettings',  'Video_guias', 'rpsm.ini' ), 'sort_by', array('attribute',false(),'video_guias/fecha')))}
								
									{foreach $video_guias as $video_guia}
										{if $video_guia.data_map.portada.content|eq(1)}
										
											<li>
												<a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video_guia.data_map.video_html.content)|ezurl} target="_blank"><img src={"sage_img_videoguia.gif"|ezimage} alt="" /></a>
												
												<div class="flt">
													<h4><a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video_guia.data_map.video_html.content)|ezurl} target="_blank">{$video_guia.data_map.titulo.content}</a></h4>
													<span class="fecha">{$video_guia.data_map.fecha.content.timestamp|datetime('custom', '%d/%m/%Y')}</span>
													<p>{$video_guia.data_map.descripcion.content.output.output_text}</p>
													<div>
														<a href={concat( 'content/download/', $video_guia.data_map.pdf.contentobject_id, '/', $video_guia.data_map.pdf.id,'/version/', $video_guia.data_map.pdf.version , '/file/', $video_guia.data_map.pdf.content.original_filename|urlencode )|ezurl} title="Descargar la guía en formato pdf" class="pdf">Descargar pdf</a>
														
														<span class="youtube">Si no puede descargar la guía pinche <a href={$video_guia.data_map.video_youtube.content|ezurl} target="_blank">aquí</a></span>
													</div>
												</div>
											</li>
											
										{/if}
									{/foreach}
									
									{undef $video_guias}
									
									</ul>
									<div class="botones">
										<a href={"recursospsm_sage/saber-mas/video-guias"|ezurl}><img src={"sage_btn_ver-videoguias.png"|ezimage} alt="" /></a>
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

				<div id="modLinks">
					<h4></h4>
					<li><a href={"recursospsm_sage/formularios/inscribase-en-los-cursos-de-formacion-memento-sage"|ezurl} target="_blank">Necesita más formación</a></li>
					<li><a href={"recursospsm_sage/casos_exito"|ezurl} title="Ver más casos de éxito">Casos de éxito</a></li>
					<li><a href={"recursospsm_sage/formularios/que-opina-de-nuestro-portal-soluciones-memento-nautis-mementix-sage"|ezurl} target="_blank">Opine sobre su producto</a></li>
				</div>
				
				<div id="modAmpliar">
					<h2>¿Quiere ampliar sus Mementos Sage?</h2>
					<h4>Conozca nuestra gama de productos.</h4>
					<div class="imgAmpliar">
						<a href="http://www.mementossage.com" target="_blank"><img src={"sage_btn_masInfo.gif"|ezimage} alt="Ampliar información"/></a>
					</div>
				</div>

			</div>
		</div>
	</div>
