<div id="promocionPrimaria">
            
                <h2>{$block.valid_nodes[0].data_map.subtitulo.content}</h2>

                <div class="wrap clearFix">
                    <div class="columnType1">
                        <!--h2>Toda la calidad y prestigio de Memento a su disposición</h2-->
                        <div class="curveSup wrapAjaxContent clearFix">
                     

{if $block.valid_nodes.0.data_map.youtube_url.has_content}
	    <div class="media"> 
                                         	<div id="mediaspace">
                		                   	{eflyoutube( $block.valid_nodes.0.data_map.youtube_url.content, 236, 213 )}
    	                	        	 	</div>
                                         </div>
{else}
		{if $block.valid_nodes.0.data_map.video.has_content}
        	{def $video = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.video.content.relation_browse.0.contentobject_id ))}                         <div class="media">
                               {attribute_view_gui attribute=$video.data_map.video width=236 height=213 autostart=0}
                                                   
                            </div>
        
        {else}
        	{if $block.valid_nodes.0.data_map.imagen.has_content}
        	      {def $imagen = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                        <div class="media">
                                        <a href={$block.valid_nodes.0.url_alias|ezurl}><img src={$imagen.data_map.image.content.original.url|ezroot()} width="{$imagen.data_map.image.content.original.width}" height="{$imagen.data_map.image.content.original.height}" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
                                        </div>       
        	{/if}
        {/if}

{/if}


                            <div class="description">
                                {$block.valid_nodes[0].data_map.texto.content.output.output_text}
                            </div>
                        </div>
                    </div>
                    <div class="columnType2">

                        <ul>
                            {foreach $block.valid_nodes as $index => $node}
                            <li {if eq( $index, 0)}class="sel"{/if}><a href={concat( 'ezjscore/call/portadas::promos::', $node.node_id)|ezurl}>{$node.name}</a></li>
                            {/foreach}
                        </ul>
                    </div>

                
                </div>
            
            </div>

