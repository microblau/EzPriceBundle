									<li class="clear{if $reset} reset{/if}">
											{if $node.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
                                   
                                        	<div class="image flt">                                            	
                                            	<img src={$imagen.data_map.image.content.listadoproductos.url|ezroot()} width="{$imagen.data_map.image.content.listadoproductos.width}" height="{$imagen.data_map.image.content.listadoproductos.height}" class="producto" />
                                            </div>
                                            {undef $imagen}
                                            {else}
                                            {def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084))}                                    
                                   
                                        	<div class="image flt">                                            	
                                            	<img src={$imagen.data_map.image.content.listadoproductos.url|ezroot()} width="{$imagen.data_map.image.content.listadoproductos.width}" height="{$imagen.data_map.image.content.listadoproductos.height}" class="producto" />
                                            </div>
                                            {/if}
                                            <div class="wysiwyg flt" >
                                            	<h3><a href={$node.url_alias|ezurl()}>{$node.name}</a></h3>

								{def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))} 
                                {if $cuantasvaloracionestotales|gt(0)}
                                              <h2><a href={concat($node.url_alias, '/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></h2> 
								{/if}
                                               
                                               
                                            	<p>{$node.data_map.subtitulo.content}</p>
                                            	{$node.data_map.ventajas.content.output.output_text} 
                                            </div>
                                            <div class="action flt">                                           	                                    	
                                            	<div class="precioIva">{if $node.class_identifier|eq('producto_qmementix')}Desde {/if}{if $node.data_map.precio.content.has_discount}<s>{/if}{$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA{if $node.data_map.precio.content.has_discount}</s>{/if}
{if $node.data_map.precio.content.has_discount}<br /><span class="price_offer">{$node.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}  € <span class="iva">+ IVA</span></span>{/if}</div>
                                            	
                                           </div>
                                          
                                           {if $node.class_identifier|eq('producto_qmementix')}
                                              <a href={concat( 'basket/qmementix')|ezurl} class="boton {if $node.class_identifier|eq('producto_qmementix')|not}loQuiero{/if}"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            {/if}
                                            {if $node.class_identifier|eq('producto')}
                                           <a href={concat( 'basket/ajaxadd/', $node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            {/if}
                                            {if $node.class_identifier|eq('producto_nautis4')}
                                                <a href={$node.url_alias|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            {/if}
                                        
                                        </li>
