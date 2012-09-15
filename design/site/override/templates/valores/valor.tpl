<li>
								<div class="valor">
									<h2>{$node.name}</h2>
									<div class="wrap">

				
										<div class="inner clearFix">
					
											<div class="wysiwyg">
					
												<div class="attribute-cuerpo">
													{if $node.data_map.imagen.has_content}
                                   					{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
                                   
													<div class="object-left">
														<div class="content-view-embed">
															<div class="class-image">
								    							<div class="attribute-image">                                 
										  							<img src={$imagen.data_map.image.content.valor.url|ezroot()} alt="" />
								    							</div>																					
								 							</div>

														</div>
													</div>
													{undef $imagen}
													{/if}
													{$node.data_map.descripcion.content.output.output_text}
												</div>
											</div>
										</div>

									</div>		
								</div>	
								
							</li>