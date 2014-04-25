<div id="moduloDestacadoContenido">

							<h1 class="mainTitle">{$node.name}</h1>	
						
						
							<div class="wrap">
				
								<div class="inner clearFix">
					
									<div class="wysiwyg">
					
										<div class="attribute-cuerpo clearFix">
											{if $node.data_map.video.has_content}
											{def $video = fetch( 'content', 'object', hash( 'object_id', $node.data_map.video.content.relation_browse.0.contentobject_id ))}                                   
                                            
										
                                            <div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                            {attribute_view_gui attribute=$video.data_map.video width=223 height=189}
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $video}                                            
											{elseif $node.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                   
                                           	<div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                            <img src={$imagen.data_map.image.content.original.url|ezroot()} width="{$imagen.data_map.image.content.original.width}" height="{$imagen.data_map.image.content.original.height}" />
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $image}
                                            {/if}
                                            
                                            <div class="column2">													
                                                {$node.data_map.texto.content.output.output_text}
                                            </div>										
										
										</div>

									</div>
								</div>
							</div>			
						
						
						
						</div>
