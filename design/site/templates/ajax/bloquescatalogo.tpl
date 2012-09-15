{foreach $products as $index => $product}
													<li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
														{def $product_node = fetch( 'content', 'node', hash( 'node_id', $product.node_id ))}
														{if $product_node.data_map.imagen.has_content}
														{def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
														<a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" class="producto" /></a>
														{undef $imagen}
														{else}
                                                       {def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}
														<a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" class="producto" /></a>
														{undef $imagen}
                                                        {/if}														
														<h3><a href={$product_node.url_alias|ezurl()}>{$product_node.name}</a></h3>
														<p>{$product_node.data_map.subtitulo.content}</p>
                                                        {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $product_node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                         <span>    <a href={concat($product_node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a></span>
								{/if}                        
                                {undef $cuantasvaloracionestotales}
														 {if $product_node.object.contentclass_id|eq(48)}
                                                        <a href={concat( 'basket/ajaxadd/', $product_node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                        {else}
                                                         <a href={$product_node.url_alias|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                        {/if}
														{undef $product_node}
													</li>
													
													{/foreach}
