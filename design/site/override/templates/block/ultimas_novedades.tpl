                        <div id="modNovedades">
                            <h3>Últimas novedades</h3>
                            <div class="carrousel">
                            	{def $products = fetch( 'content', 'tree', hash( 
                            												'parent_node_id', 61,
                            												'class_filter_type', 'include',
                            												'class_filter_array', array( 'producto' ),
                            												'sort_by', array( 'attribute', false(), 'producto/fecha_aparicion' ),
                            												'attribute_filter', array( array( 'producto/fecha_aparicion', 'between', array( currentdate()|sub( 86400|mul(90) ), currentdate() ) ) )
                            	))}
                                <ul class="carrousel" id="itemscarrousel">
                                	{foreach $products as $node}
                                    <li>
                                    	{def $area_node = fetch( 'content', 'object', hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id ) )}
                                       <h4>{$area_node.name}</h4>
                                        {undef $area_node}
                                        {if $node.data_map.imagen.has_content}                                        
                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
                                       	<img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="" />
                                        {undef $image}
                                        {else}
                                        <div class="multim">
                                        {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                                        <img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="{$image.data_map.image.content.alternative_text}" class="producto" />
                                        {undef $image}
                                        </div>
                                        {/if}
                                        <a href={$node.url_alias}><span>{$node.name}</span></a>
                                        {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                         <span class="verMas">     <a href={concat($node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a></span>
								{/if}                        
                                {undef $cuantasvaloracionestotales}
                                        <div class="button"><a href={concat( 'basket/add/', $node.object.id, '/1')|ezurl}>Lo quiero</a></div>
                                        
                                        
                                        <span class="verMas"><a href="">Ver más mementos para {$area_node.name}</a></span>
                                   </li>
                                   {/foreach}
                                </ul>
                            </div>
                        </div>
