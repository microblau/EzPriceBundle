<h2>{$block.custom_attributes.titulo}</h2>                                 
                                         <div class="productoOnline"><img src={"txt_productoOnline.png"|ezimage} alt="producto online" /></div>
                                        {def $products = fetch( 'portadas', 'get_elements_for_block', hash( 'block_id', $block.id, 'offset', 0, 'limit', 2 ))}
                                        {def $total = fetch( 'portadas', 'get_total_elements_for_block', hash( 'block_id', $block.id, 'items_per_block', ezini( $block.type, 'ItemsPerBlock', 'block.ini' ) ) )}                                              
                                            
                                        <div class="wrapColumn">                                            
                                            <div class="inner">
                                                <ul class="{if gt($total, 1)}wrapAjaxContent {/if}clearFix cont" id="items_{$block.id}_1">
                                                    {foreach $products as $index => $product}
                                                    <li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
                                                        {def $product_node = fetch( 'content', 'node', hash( 'node_id', $product.node_id ))}
                                                        {if $product_node.data_map.imagen.has_content}
                                                        {def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
          <a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
                                                        {undef $imagen}
                                                        {else}
                                                       <a href={$product_node.url_alias|ezurl()}><img src={"logo_efl.gif"|ezimage} alt="" /></a>
                                                        {/if}
                                                        
                                                        <h3><a href={$product_node.url_alias|ezurl()}>{$product_node.name}</a></h3>
                                                        <p>{$product_node.data_map.subtitulo.content}</p>
                                                        {if array( 99,101)|contains( $product_node.object.contentclass_id)}
                                                        {def $value = 4}
                                                        {else}
                                                      
                                                        {def $value = sum( $product_node.data_map.calidad_rate.content.rounded_average, $product_node.data_map.actualizaciones_rate.content.rounded_average, $product_node.data_map.facilidad_rate.content.rounded_average )|div( 3) }
                                                        {/if}
                                               
                                                        {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $product_node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                              <a href={concat($product_node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a>
								{/if}
                                                        {if $product_node.object.contentclass_id|eq(48)}
                                                        <a href={concat( 'basket/ajaxadd/', $product_node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                        {else}
                                                         <a href={$product_node.url_alias|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                        {/if}
                                                        {undef $product_node}
                                                     
                                                    </li>
                                                    
                                                    {/foreach}
                                                </ul>
                                                <div class="options clearFix">
                                                    <span class="verMas"><a href={$block.custom_attributes.enlace|ezurl}>{$block.custom_attributes.texto_enlace}</a></span>
                                                    {if $total|gt(1)}
                                                    <div class="pagination">
                                                        <span class="botones" id="links_{$block.id}">
                                                            <span class="prev reset" >anterior</span>
                                                            <a href={concat( 'ezjscore/call/portadas::bloque::', $block.id, '::2::2' )|ezurl} class="next">siguiente</a>
                                                        </span>
                                                        <span class="items"><span class="actual" id="actualpage_{$block.id}">1</span> / <span class="total">{$total}</span></span>
                                                    </div>
                                                    {/if}
                                                </div>

                                            </div>
                                        </div>
