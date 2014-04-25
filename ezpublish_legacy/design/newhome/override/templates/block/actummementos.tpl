                {ezcss_require( array( 'css::tabscss' ) ) }
                <div id="modActum">
                    <h2>{$block.custom_attributes.titulo}</h2>
                    <div id="categoriesTabs">
                        <ul class="tabs clearFix">
                            {def $canales = fetch('content', 'list', hash('parent_node_id', 554,
                                                                          'sort_by', array( 'priority', true() )
                            ))}
                            {foreach $canales as $index => $canal }
                            <li class="cat{$index|sum(1)}{if eq( $index, 0)} sel{/if}"><a href={concat( 'ezjscore/call/portadas::mementum::', $canal.node_id)|ezurl}>{if eq( $index, 0)}<strong>{/if}{$canal.name}{if eq($index,0)}</strong>{/if}</a></li>
                            {/foreach}                                                       
                        </ul>
                        <div class="wrap">  
                            <ul class="wrapAjaxContent">
                                {def $items = fetch('content', 'list', hash('parent_node_id', $canales[0].node_id,
                                                                          'sort_by', array( 'published', false() ),
                                                                           'limit', 3
                            ))}
                                {foreach $items as $item}                                
                                <li><a target="_blank" href="{$item.data_map.url.content|wash( xhtml )}">{$item.name} - {$item.object.published|datetime('custom', '%d/%m/%Y')}</a></li>
                                {/foreach}
                                <li style="font-size:10px"><a target="_blank" href="http://www.rssactum.es">ver más noticias</a></li>
                                  </ul>
                            <a href="http://www.rssactum.es" target="_blank"><img src={"txt_quieres.gif"|ezimage} alt="¿Quieres Actum gratis durante un mes?" class="oferta" /></a>
                           
                        </div>
                        
                    </div>
                </div>              
