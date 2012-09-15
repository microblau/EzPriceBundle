
	
		<div class="wrap clearFix">
			<div class="columnType1">
				<h2>{$block.custom_attributes.titulo_1}</h2>
				<div class="wrapColumn">
				<div class="inner">
												{def $products = fetch( 'portadas', 'get_elements_for_block', hash( 'block_id', $block.id, 'pos', 1,  'offset', 0, 'limit', 2 ))}
												{def $total = fetch( 'portadas', 'get_total_elements_for_block', hash( 'block_id', $block.id, 'pos', 1, 'items_per_block', 2 ))}												
												<ul class="{if gt($total, 1)}wrapAjaxContent {/if}clearFix cont" id="items_{$block.id}_1">
													{foreach $products as $index => $product}
													<li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
														{def $product_node = fetch( 'content', 'node', hash( 'node_id', $product.node_id ))}
														{if $product_node.data_map.imagen.has_content}
														{def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
														<a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" class="producto" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
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
														<a href={concat( 'basket/ajaxadd/', $product_node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                        
														{undef $product_node}
													</li>
													
													{/foreach}
												</ul>
												
												<div class="options clearFix" id="options_{$block.id}_1">
													<span class="verMas"><a href={$block.custom_attributes.enlace_1|ezurl()}>{$block.custom_attributes.texto_enlace_1}</a></span>
													{if $total|gt(1)}
													<div class="pagination">
														<span class="botones" id="links_{$block.id}_1">
															<span class="prev reset" >anterior</span>
															<a href={concat( 'ezjscore/call/portadas::bloque::', $block.id, '::2::2::1' )|ezurl} class="next">siguiente</a>
														</span>
														<span class="items"><span class="actual" id="actualpage_{$block.id}_1">1</span> / <span class="total">{$total}</span></span>
													</div>
													{/if}
												</div>
												{undef $products $total}
											    {undef $value}
											</div>

										</div>
									</div>
									<div class="columnType2">
										<h2>{$block.custom_attributes.titulo_2}</h2>
										<div class="wrapColumn">
											<div class="inner">
												{def $products = fetch( 'portadas', 'get_elements_for_block', hash( 'block_id', $block.id, 'pos', 2, 'offset', 0, 'limit', 2 ))}
												{def $total = fetch( 'portadas', 'get_total_elements_for_block', hash( 'block_id', $block.id, 'pos', 2, 'items_per_block', 2  ))}
												<ul class="{if gt($total, 1)}wrapAjaxContent {/if}clearFix cont" id="items_{$block.id}_2">
													{foreach $products as $index => $product}
													<li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
														{def $product_node = fetch( 'content', 'node', hash( 'node_id', $product.node_id ))}
														{if $product_node.data_map.imagen.has_content}
														{def $imagen = fetch( 'content', 'object', hash( 'object_id', $product_node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
													<a href={$product_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" class="producto" alt="{$imagen.data_map.image.content.alternative_text}" /></a>
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
                                                        <a href={concat( 'basket/ajaxadd/', $product_node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                        
														{undef $product_node}
													</li>													
													{/foreach}
												</ul>
												

												<div class="options clearFix" id="options_{$block.id}_2">
													<span class="verMas"><a href={$block.custom_attributes.enlace_2|ezurl()}>{$block.custom_attributes.texto_enlace_2}</a></span>
													{if $total|gt(1)}
													<div class="pagination">
														<span class="botones" id="links_{$block.id}_2">
															<span class="prev reset">anterior</span>

															<a href={concat( 'ezjscore/call/portadas::bloque::', $block.id, '::2::2::2' )|ezurl} class="next">siguiente</a>
														</span>
														<span class="items"><span class="actual" id="actualpage_{$block.id}_2">1</span> / <span class="total">{$total}</span></span>
													</div>
													{/if}
												</div>
												{undef $products $total}
											</div>
										</div>
									</div>

								</div>
							
							
