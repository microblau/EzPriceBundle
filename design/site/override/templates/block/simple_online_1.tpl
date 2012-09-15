<h2>{$block.custom_attributes.titulo}</h2>                                
                                        <div class="productoOnline"><img src={"txt_productoOnline.png"|ezimage} alt="producto online" /></div> 
                                        <div class="wrapColumn">                                            
                                            <div class="inner">
                                                <div class="personal clearFix cont">
                                                
                                                    <div class="image">
                                                        
                                                        {def $product_node = fetch( 'content', 'node', hash( 'node_id', $block.valid_nodes.0.node_id ))}
                                                        {if $product_node.data_map.imagen.has_content}
                                                        {def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                                        <a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
                                                        {undef $imagen}
                                                        {else}
                                                         {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                                                        <a href={$product.node.url_alias|ezurl()}><img src={$image.data_map.image.content.block_catalogos.url|ezroot} alt="{$image.data_map.image.content.alternative_text}" class="producto" /></a>
                                                        {undef $image}
                                                        {/if}
                                                 
                                {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $product_node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                              <a href={concat($product_node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a>
								{/if}
                                {undef $cuantasvaloracionestotales}
                                                    </div>
                                                    <div class="description">
                                                        <h3><a href={$block.valid_nodes.0.url_alias|ezurl}>{$block.valid_nodes.0.name}</a></h3>
                                                        {if $block.valid_nodes.0.data_map.subtitulo.has_content}
                                                        <p>{$block.valid_nodes.0.data_map.subtitulo.content}</p>
                                                        {/if}
                                                    </div>
                                                
                                                </div>
                                                <div class="options clearFix">

                                                    <span class="verMas"><a href={$block.custom_attributes.enlace|ezurl}>{$block.custom_attributes.texto_enlace}</a></span>
                                                    <div class="pagination">
                                                        
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
