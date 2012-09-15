
	<div id="gridTwoColumnsTypeB" class="clearFix">
		<div class="columnType1">
			<div id="modType2">
				
					<h1>Preguntas Frecuentes</h1>
					
					<div class="wrap2 clearFix">                    		
							<div class="description">
								
							{if eq($node.node_id,80)|not}
							
								<div id="faq">
									<h2>{$node.name}</h2>
									
									{def $listado_preguntas=fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id, 'sort_by', $node.sort_array ))}
									
									<div class="preguntas">
										<ul>
											{foreach $listado_preguntas as $pregunta}
												<li><a href="#p_{$pregunta.node_id}">{$pregunta.data_map.texto_pregunta.content.output.output_text}</a></li>
											{/foreach}
											
										</ul>
									</div>
									
									<div class="respuestas">
										<ul>
										
											{foreach $listado_preguntas as $pregunta}
												<li>
													<h3><a name="p_{$pregunta.node_id}">{$pregunta.data_map.texto_pregunta.content.output.output_text}</a></h3>
													<div class="wysiwyg">
														<p>{$pregunta.data_map.texto_respuesta.content.output.output_text}</p>
													</div>
													<span class="ancla"><a href="#wrapper">Subir</a></span>
												</li>
											{/foreach}
											
										</ul>
									</div>
								</div>
								
							{/if}
							{undef $listado_preguntas}
								
							</div>								                        											
						</div>
				
			</div>
		</div>
		<div class="sideBar">
			<div id="modContacto">
				<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
				</div>
			</div>
		</div>
	</div>
		
	

	

