{ezpagedata_set( 'menuoption', 2 )}
{ezpagedata_set( 'rss', concat( 'catalogo/', $node.name|normalize_path()|explode('_')|implode('-') ) )}  
{def $node = fetch( 'content', 'node', hash( 'node_id', 61 ))}
<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				
					<div class="currentSection"><a href={"catalogo"|ezurl()}><span>Todas las obras</span></a></div>

					<ul>
						{def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61, 
																		'class_filter_type', 'include',
                                                                        
																		'class_filter_array', array( 'folder' ),
																		'sort_by', $node.parent.sort_array,
																		'attribute_filter', array( array( 'priority', '<', 100 ) )
															))
						}
						{foreach $folders as $folder }
						<li {if eq( $folder.node_id, $node.node_id)}class="sel"{/if}>{if ne( $folder.node_id, $node.node_id)}<a href={$folder.url_alias|ezurl()}>{else}<strong><span>{/if}{$folder.name}{if ne( $folder.node_id, $node.node_id)}</a>{else}</span></strong>{/if}</li>
						{/foreach}
					</ul>
				
				
				</div>

			
				
				<div id="content">
					
				{if $node.data_map.zona_central.content.zones.0.blocks|count|gt(0)}
						<div id="moduloDestacadoContenido">
						
							<h1 class="mainTitle">{$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.name}</h1>								
						
							<div class="wrap">
				
								<div class="inner clearFix">
					
									<div class="wysiwyg">
					
										<div class="attribute-cuerpo clearFix">
										            {if $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.data_map.imagen.has_content}
                                                        {def $imagen = fetch( 'content', 'object', hash( 'object_id',   $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}  
													<div class="object-left column1">
														<div class="content-view-embed">

															<div class="class-image">
								    							<div class="attribute-image">                                 
                                                                    <img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
								    							</div>																					
								 							</div>
														</div>
													</div>
                                                    {undef $image}
                                                    {/if}
													
												    <div class="column2">	{$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.data_map.entradilla.content.output.output_text}
                                                    
													<div class="clearFix linksModulo">
														{if $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.object.contentclass_id|eq(98)}
                                                     <a href={concat( "/basket/mementix")|ezurl} class="ejemplar"><img src={"quiero_tenerlo.gif"|ezimage} alt="Quiero tenerlo" /></a>
                                                    {elseif or( $node.data_map.zona_central.content.zones.0.blocks.0.object.contentclass_id|eq(99),  $block.valid_nodes.0.object.contentclass_id|eq(101))}
                                                        <a href={$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.url_alias|ezurl} class="ejemplar"><img src={"quiero_tenerlo.gif"|ezimage} alt="Quiero tenerlo" /></a>
                                                    {else}
                                                    <a href={concat( "/basket/add/",$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.object.id, "/1")|ezurl} class="ejemplar"><img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" /></a>
                                                    {/if}
													</div>
</div>
										
										
										</div>
									</div>
								</div>
                </div>																																			
						
						</div>		
                        {/if}
                        
               
     
                        <div id="novedades" {if $node.data_map.zona_central.content.zones.0.blocks|count|eq(0)}style="margin-top:0"{/if}>
{def $number_of_items=cond( ezpreference( 'products_per_page')|eq(''), 5, ezpreference( 'products_per_page') )
										 $order_by = ezpreference( 'order_by' )
									}    
                              
                                    {set $number_of_items = $number_of_items|int()}
                             {switch match=$order_by}
                                			{case match='precio'}
                                               
                                				{def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}
                                			{/case}
                                			{case match='fechapublicacion'}
                                				{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                             			
                                            {/case}
                                			{case}
                                              {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                             
                                			{/case}
                                		{/switch}
                                
                                		{def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( 61 ),
	 'class_id', array( 48, 98, 99, 101 ),
                                                                                         'limit', $number_of_items,
                                                                                         'sort_by', $sort_array,
                                                                                         'offset', $view_parameters.offset,
                                                                                         'filter', $parameters  
                                                 ))}
                                                      
                        	<h2>Hemos encontrado para usted {$results.SearchCount} productos</h2>
                            
                            <div class="wrap">
                          	
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
									
                                	<ul class="clearFix">
                                    	<li>{def $options = ezini('OrderingProductsList', 'AvailableOrders', 'filtros.ini' )}
                                    		
                                        	<label for="ordenar">Ordenar por:</label>
                                            <select id="ordenar" name="ordenar">
                                            	{foreach $options as $option}
                                            	<option value="{$option}" {if eq($option, $order_by)}selected="selected"{/if}>{ezini( $option, 'Literal', 'filtros.ini' )}</option>
                                            	{/foreach}                                           	
                                            </select>
                                            {undef $options}	
                                        </li>
                                        <li class="frt">{def $elementstoshow = ezini('OrderingProductsList', 'ElementsToShow', 'filtros.ini' )}
                                        	<label for="mostrar">Mostrar:</label>
                                            <select id="mostrar" name="mostrar">
                                           		{foreach $elementstoshow as $n}                                           			
                                            		<option value="{$n}" {if eq( $n, $number_of_items)}selected="selected"{/if}>{$n}</option>
                                            	{/foreach} 	                                            	
                                            </select>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="mostrar_field" id="mostrar_field" value="" />
                                    <input type="hidden" name="ordenar_field" id="ordenar_field" value="" />                                   
                                </form>
                            
                            	<div class="description">
                                	<ul class="clearFix">
                                		
                                         
                                         {foreach $results.SearchResult as $index => $element}

                                         	{node_view_gui content_node=$element view=line reset= $index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=concat( 'buscador/productos/', $sector, '/', $area, '/', $formato )
         item_count=$results.SearchCount
         view_parameters=$view_parameters
         node_id=$node.node_id
         item_limit= cond( $number_of_items|eq(0), 5, $number_of_items)}
         {undef $elements}         	 
                                </div>
                            
                            </div>
                            
                        </div>
                        
                        
                        <div id="gridType6">
														
						<div class="wrap clearFix">
                        
							<div class="columnType1 flt">	
															
								<div class="wrapColumn">											
									<div id="tops" class="inner">
										{if and( is_set($view_parameters.mode), $view_parameters.mode|eq( 'visto' ) )}
											<ul class="tabs">
												<li><a href="{$node.url_alias|ezurl(no)}#tops">Lo más vendido</a></li>
												{*<li class="sel"><h2>Lo más consultado</h2></li>*}
											</ul>
										{else}
										<ul class="tabs">
											<li class="sel"><h2>Lo más vendido</h2></li>
											{*<li><a href={concat( $node.url_alias, '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>*}
										</ul>
										{/if}
										
										
										{include uri="design:common/best_sell.tpl" parentnode=$node.node_id mode=$view_parameters.mode}
										
											
									</div>

								</div>
							</div>
							{def $object_ids_query = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,                                        	                                        												
                                      												 'as_object', false(),
                                                                                     'extended_attribute_filter', $extended_attribute_filter
                            ))}                            
                            {def $object_ids = array()}
							{foreach $object_ids_query  as $object}
								{set $object_ids = $object_ids|append( $object.contentobject_id|int() )}
							{/foreach}	
							
							{include uri="design:common/related_training.tpl"}
							{undef $object_ids_query $object_ids}
						</div>
							
					</div>
						
						
				
					
				</div>
			</div>
				
