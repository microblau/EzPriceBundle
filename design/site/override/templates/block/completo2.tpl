<div id="gridType5">
                                <h2>{$block.custom_attributes.titulo}</h2>                     
                                <div class="wrap clearFix">
                                    <div class="columnType1">                                       
                                        <div class="wrapColumn">

                                            <div class="inner">
                                                {def $products = fetch( 'portadas', 'get_elements_for_block', hash( 'block_id', $block.id, 'offset', 0, 'limit', 4 ))}
                                                {def $total = fetch( 'portadas', 'get_total_elements_for_block', hash( 'block_id', $block.id, 'items_per_block', ezini( $block.type, 'ItemsPerBlock', 'block.ini' ) ) )}                                              
                                            
                                                <ul class="{if gt($total, 1)}wrapAjaxContent {/if}clearFix cont">
                                                    {foreach $products as $index => $product}
                                                    <li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
                                                        {def $product_node = fetch( 'content', 'node', hash( 'node_id', $product.node_id ))}
                                                        {if $product_node.data_map.imagen.has_content}
                                                        {def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                                        <a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
                                                        {undef $imagen}
                                                        {else}
                                                         {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                                                        <a href={$product.node.url_alias|ezurl()}><img src={$image.data_map.image.content.block_catalogos.url|ezroot} alt="" class="producto" /></a>
                                                        {undef $image}
                                                        {/if}
                                                        
                                                        <h3><a href={$product_node.url_alias|ezurl()}>{$product_node.name}</a></h3>
                                                        <p>{$product_node.data_map.subtitulo.content}</p>
                                                  
                                                       
                                                        {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $product_node.node_id ))}                               {if $cuantasvaloracionestotales|gt(0)}
                                             <a href={concat($product_node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a>
								{/if}
                                {undef $cuantasvaloracionestotales}
                                                       <a href={concat( 'basket/ajaxadd/', $product_node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
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
                                                            <a href={concat( 'ezjscore/call/portadas::bloque::', $block.id, '::4::4' )|ezurl} class="next">siguiente</a>
                                                        </span>
                                                        <span class="items"><span class="actual" id="actualpage_{$block.id}">1</span> / <span class="total">{$total}</span></span>
                                                    </div>
                                                    {/if}
                                                </div>
                                            
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        
