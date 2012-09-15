{ezscript_require('jquery.fancybox-1.3.0.pack.js')} 
{ezcss_require( 'jquery.fancybox-1.3.0.css')} 

                <h2>{$block.valid_nodes[0].data_map.subtitulo.content}</h2>

                <div class="wrap clearFix">
                    <div class="columnType1">

                        <div class="curveSup wrapAjaxContent clearFix">
                            <div class="description">
                                {if $block.valid_nodes.0.data_map.youtube_url.has_content}
	    <div class="object-left"> 
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
                                        <div class="object-left">
                                        <img src={$imagen.data_map.image.content.original.url|ezroot()} width="{$imagen.data_map.image.content.original.width}" height="{$imagen.data_map.image.content.original.height}" alt="{$imagen.data_map.image.content.alternative_text}" />
                                        </div>       
        	{/if}
        {/if}

{/if}
                                <div class="wrapDesc">
                                {$block.valid_nodes[0].data_map.texto.content.output.output_text}

                               

                                </div>
                            </div>
                        </div>
                    </div>                   

                
                </div>
            
   
