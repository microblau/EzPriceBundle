{if $node.data_map.faqs_producto.has_content}
                    <div id="software" class="columnType2"> 
                        <h2>Preguntas frecuentes</h2>                                   
                        <div class="wrapColumn">                                            
                            <div class="inner clearFix">
                                <div id="faq">
                                    <div class="preguntas clearFix">
                                        <div>
                                            <ul>
                                                {foreach $node.data_map.faqs_producto.content.relation_browse as $index => $faq}
                                                {let $nodo = fetch( 'content', 'node', hash('node_id', $faq.node_id ) )}
                                                <li>
                                                    <a href="{$nodo.parent.url_alias|ezurl(no)}#p_{$nodo.node_id}">{$nodo.data_map.texto_pregunta.content.output.output_text|strip_tags()}</a>
                                                   
                                                </li>
                                                {/let}
                                                {/foreach}

                                            </ul>
                                        </div>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    {/if}
