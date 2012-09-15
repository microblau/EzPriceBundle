	{def $interval_start = maketime( 0, 0, 0, $view_parameters.mes, 1, $view_parameters.anyo )} 
	{def $interval_end = maketime( 0, 0, -1, $view_parameters.mes|sum(1), 1, $view_parameters.anyo )}
	<div id="bodyContent">
	
		<div id="gridHome1" class="clearFix">
			<div class="columnType1">
				<div id="listadoRecursos" class="listadoRecursos clearFix">
					<h2>Videoguías</h2>
					<div id="videoGuias" class="wrap clearFix">
						<div class="description">
							<div id="listadoGuias" class="clearFix">
									<ul>
									{if $view_parameters.mes|gt(0)}
										{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSM-SAGESettings',  'Video_guias', 'rpsm.ini' ),
																						  'sort_by', array('attribute',false(),'video_guias/fecha'),
																						  'attribute_filter', array( array( 'video_guias/fecha', 'between', array( $interval_start, $interval_end )))))}
									{else}
										{def $video_guias=fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSM-SAGESettings',  'Video_guias', 'rpsm.ini' ),
																						  'sort_by', array('attribute',false(),'video_guias/fecha')))}
									{/if}
							
										{foreach $video_guias as $video_guia}
											<li>
											<a href={concat('http://espacioclientes.efl.es/videos.php?video=', $video_guia.data_map.video_html.content)|ezurl} target="_blank"><img src={"sage_img_videoguia.gif"|ezimage} alt="" /></a>
											
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
			
			<div class="columnType2">
				<div id="modAmpliar2">
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
