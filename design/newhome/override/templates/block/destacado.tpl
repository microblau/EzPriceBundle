<div id="moduloDestacadoContenido">
						
							<h1 class="mainTitle"><a href={$block.valid_nodes.0.url_alias|ezurl}>{$block.valid_nodes.0.name}</a></h1>

                            {if $block.valid_nodes.0.object.main_node.path.1.node_id|eq(61)}
                            <div class="wrap">
								<div class="inner clearFix">
					
									<div class="wysiwyg">
					
										<div class="attribute-cuerpo clearFix">
											                                            
											{if $block.valid_nodes.0.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                   
                                            <div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                       
                                                            
<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" class="producto" alt="{$imagen.data_map.image.content.alternative_text}" />                                                            
                                                            
                                                            
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $image}
                                            {else}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084))}                                   
                                            <div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                        <img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" class="producto" alt="{$imagen.data_map.image.content.alternative_text}" />
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $image}
                                            {/if}
                                            
											<div class="column2">	
                                                {$block.valid_nodes.0.data_map.entradilla.content.output.output_text}
                                                    
                                                    {if $block.valid_nodes.0.object.contentclass_id|eq(98)}
                                                     <a href={concat( "/basket/mementix")|ezurl} class="ejemplar"><img src={"quiero_tenerlo.gif"|ezimage} alt="Quiero tenerlo" /></a>
                                                    {elseif or( $block.valid_nodes.0.object.contentclass_id|eq(99),  $block.valid_nodes.0.object.contentclass_id|eq(101))}
                                                        <a href={$block.valid_nodes.0.url_alias|ezurl} class="ejemplar"><img src={"quiero_tenerlo.gif"|ezimage} alt="Quiero tenerlo" /></a>
                                                    {else}
                                                    <a href={concat( "/basket/add/",$block.valid_nodes.0.object.id, "/1")|ezurl} class="ejemplar"><img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" /></a>
                                                    {/if}

                                            </div>										
										
										</div>
									</div>
								</div>
							</div>	
                            {else}
						
							<div class="wrap">
				
								<div class="inner clearFix">
					
									<div class="wysiwyg">
					
										<div class="attribute-cuerpo clearFix">
											{if $block.valid_nodes.0.data_map.video.has_content}
											{def $video = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.video.content.relation_browse.0.contentobject_id ))}                                   
                                            <div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                            {attribute_view_gui attribute=$video.data_map.video width=236 height=213}
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $video}                                            
											{elseif $block.valid_nodes.0.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                   
                                            <div class="object-left column1">
                                                <div class="content-view-embed">
                                                    <div class="class-image">
                                                        <div class="attribute-image">                                 
                                                         <img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" class="producto" alt="{$imagen.data_map.image.content.alternative_text}" />
                                                        </div>																					
                                                    </div>
                                                </div>
                                            </div>
                                            {undef $image}
                                            {/if}
                                            
											<div class="column2">		
                                                {$block.valid_nodes.0.data_map.texto.content.output.output_text}
                                            </div>										
										
										</div>
									</div>
								</div>
							</div>	
                            {/if}		
						
												
						</div>
