<div class="columnType1">
					<h2>¿Busca una obra? Le presentamos nuestras novedades</h2>
					<div class="wrap">
                    
                    	<div class="inner">
                    
                            <ul class="clearFix">
                                {foreach $block.valid_nodes as $product_node sequence array( '', '', 'reset') as $clase}
                                <li {if $clase|ne('')}class="reset"{/if}>
                                    {if $product_node.data_map.imagen.has_content}
                                                        {def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
          <a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" alt="{$imagen.data_map.image.content.alternative_text}" class="producto" /></a>
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

                            
                        </div>
					
					</div>
				
				</div>
