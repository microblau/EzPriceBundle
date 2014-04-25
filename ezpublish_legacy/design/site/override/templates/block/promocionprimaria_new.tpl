{ezscript_require('jquery.fancybox-1.3.0.pack.js')} 
{ezcss_require( 'jquery.fancybox-1.3.0.css')} 

                <h2>{$block.valid_nodes[0].data_map.subtitulo.content}</h2>

                <div class="wrap clearFix">
                    <div class="columnType1">

                        <div class="curveSup wrapAjaxContent clearFix">
                            <div class="description">
                                {$block.valid_nodes[0].data_map.texto.content.output.output_text}

                                {if or($block.valid_nodes.0.data_map.youtube_url.has_content,$block.valid_nodes.0.data_map.video.has_content)}
                                <span class="verVideo"><a href={concat('/producto/vervideo?n=', $block.valid_nodes.0.node_id)} id="video">Mire el vídeo de esta publicación</a></span>

                                {/if}

                            </div>
                        </div>
                    </div>
                    <div class="columnType2">

                        <ul>
                            {foreach $block.valid_nodes as $index => $node}
                            <li {if eq( $index, 0)}class="sel"{/if}><a href={concat( 'ezjscore/call/portadas::promos::', $node.node_id,'::2')|ezurl}>{$node.name}</a></li>
                            {/foreach}
                        </ul>
                        
                    
                    </div>

                
                </div>
            
   
