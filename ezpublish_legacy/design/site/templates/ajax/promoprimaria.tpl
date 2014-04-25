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
                                        <img src={$imagen.data_map.image.content.original.url|ezroot()} width="{$imagen.data_map.image.content.original.width}" height="{$imagen.data_map.image.content.original.height}" />
                                        </div>                            
                             		{/if}	
                                
                                {/if }
                       {/if}
                            <div class="description">
                                {$node.data_map.texto.content.output.output_text}
                            </div>

