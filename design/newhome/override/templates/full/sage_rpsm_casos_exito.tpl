	<div id="bodyContent">
	
		<div id="gridWide" class="moduloDestacadoContenido">
							
			<h1>Casos de éxito</h1>
		
			<div class="wrap">
				<div class="inner">
					<div class="wysiwyg">
						<div class="attribute-cuerpo clearFix">
								Aquí se presentan una serie de Casos de Éxito de clientes de Ediciones Francis Lefebvre con los productos ofrecidos por el Portal Soluciones Memento: Nautis, Mementix, Formularios, Actum y Convenios Colectivos.
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div id="sage_casos">
			
				<div id="gridType2">
					<div class="wrap clearFix">
						<div class="columnType1">
							<div class="wrapColumn">
								<div id="listadoCasos">
								
									{def $listado-casos-exito=fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id ))}
									
									<ul>
									
										{foreach $listado-casos-exito as $caso-exito}
											<li>
												<div class="description">
													<div class="wysiwyg">
														<img src={$caso-exito.data_map.logo.content.fichaproducto.url|ezroot}>
														<h2>{$caso-exito.data_map.titulo.content}</h2>
														<p>{$caso-exito.data_map.descripcion.content.output.output_text}</p>
													</div>
												</div>
											</li>										
										{/foreach}
									</ul>
									
									{undef $listado-casos-exito}
									
								</div>
							</div>
							<img src={"sage_curve_infWrapColumn_926.gif"|ezimage} alt=""/>
						</div>
					</div>
		
				</div>
		</div>
			
	</div>