
        <div id="modType2" class="formacion">
            <h1 >{$block.valid_nodes.0.name}</h1>
            
			<div class="wrap clearFix">                         
			    <div class="description">
			        <div class="wysiwyg">
			        
			            <div class="attribute-cuerpo clearFix">
    		             {if $block.valid_nodes.0.data_map.video.has_content}
                            {def $video = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.video.content.relation_browse.0.contentobject_id ))}
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
                          {elseif $block.valid_nodes.0.data_map.imagen.has_content}
                            {def $imagen = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                            <div class="object-left column1">
                                <div class="content-view-embed">
                                    <div class="class-image">
                                        <div class="attribute-image">                                 
                                            <img src={$imagen.data_map.image.content.destacadohomeformacion.url|ezroot()} alt="{$imagen.data_map.image.content.alternative_text}"/>
                                           

                                        </div>                                                                                  
                                    </div>
                                 </div>
                            </div>
                            {undef $image}
                          {/if}
                                                 
				          <div class="column2">                                    
				                {$block.valid_nodes.0.data_map.texto.content.output.output_text}
				                {if $block.valid_nodes.0.data_map.enlace_a.has_content}
				                    {def $nodo=fetch('content','node',hash( 'node_id', $block.valid_nodes.0.data_map.enlace_a.content.main_node_id))} 
				                    <span class="verMas"><a href={$nodo.url_alias|ezurl()}>{$block.valid_nodes.0.data_map.texto_enlace_a.value}</a></span>
				                {/if}
				          </div>
			            </div>
			        </div>
			    </div>                                                                                                  
			</div>
		</div>
