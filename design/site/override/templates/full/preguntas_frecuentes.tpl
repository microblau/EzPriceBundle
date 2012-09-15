{ezscript_require( array( 'alberto.js' ) )}


	<div id="gridTwoColumnsTypeB" class="clearFix">
		<div class="columnType1">
			<div id="modType2">
				
					<h1>Preguntas Frecuentes</h1>
					
					<div class="wrap2 clearFix">                    		
							<div class="description">
								<div class="busFaq">
								
								{def $listado_tipos_faq=fetch( 'content', 'tree', hash( 'parent_node_id', 80, 'sort_by', $node.sort_array, 'class_filter_type', 'include', 'class_filter_array', array(65),
                            'attribute_filter', array( array( 'depth', '=', 3 ) )
))}
									
									<form action="" method="post" id="faqForm" name="faqForm">
										<ul>
											<li>
												<label for="tipoPregunta">Seleccione el tipo de preguntas que desea consultar:</label>
											   	
												<select id="tipoPregunta" name="tipoPregunta" onchange="ActualizaFAQS(document.faqForm.tipoPregunta.value)">
													<option value=0 selected="selected">---</option>	
													{foreach $listado_tipos_faq as $tipo_faq}
															{def $listado_subtipos_faq=fetch( 'content', 'list', hash( 'parent_node_id', $tipo_faq.node_id, 'sort_by', $tipo_faq.sort_array, 'class_filter_type', 'include', 'class_filter_array', array(65)  ))}
                                                                
																{if $listado_subtipos_faq|count|gt(0)}
																	<optgroup label="{$tipo_faq.name}">
																	{foreach $listado_subtipos_faq as $subtipo_faq}
																		<option value="{concat( 'http://', ezsys( 'hostname' ), $subtipo_faq.url_alias|ezurl( 'no') )}">{$subtipo_faq.name}</option>
																	{/foreach}
																	</optgroup>
																{else}
																	<option style="font-weight:bold" value="{concat( 'http://', ezsys( 'hostname' ), $tipo_faq.url_alias|ezurl( 'no') )}">{$tipo_faq.name}</option>
																{/if}
															{undef $listado_subtipos_faq}
													{/foreach}
												</select>
												
											</li>
										</ul>															
									</form>		
									
								{undef $listado_tipos_faq}
								
								</div>
								
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
		
	

	

