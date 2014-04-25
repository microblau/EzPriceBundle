
{ezpagedata_set( 'menuoption', 2 )}
{def $urlexplode = $node.url_alias|explode( '/' ) }
{ezpagedata_set( 'rss', concat( 'catalogo/', $urlexplode.1, '/', $urlexplode.2 ) )}
<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				
					<div class="currentSection"><a href={$nodefrom.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
					<ul>
						{include uri='design:catalog/menu.tpl' check=$node.parent actual=$node.name|normalize_path()|explode('_')|implode('-')}				
					</ul>
				
				
				</div>

			
				
				<div id="content">
					{if $node.data_map.zona_central.content.zones.0.blocks|count|gt(0)}
								{block_view_gui block=$node.data_map.zona_central.content.zones[0].blocks[0] zone=$node.data_map.zona_central.content.zones[0] attribute=$attribute}
                        {/if}
                        
                        <div id="novedades" {if $node.data_map.zona_central.content.zones.0.blocks|count|eq(0)}style="margin-top:0"{/if}>
                            {def $number_of_items=cond( ezpreference( 'products_per_page')|ne(''),   ezpreference( 'products_per_page'), 5 )                                      
                                         $order_by = ezpreference( 'order_by' )
                                    }    
                                   
                                    {set $number_of_items = $number_of_items|int()}
                            {def $parentnode = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'ParentNode', 'catalog.ini')}
                             {def $filter = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'Attr', 'catalog.ini')}
                             {def $filterattrs = array('and')}
                            {foreach $filter as $index => $value }
                                {set $filterattrs = $filterattrs|append( concat( $index, ':', $value ))}
                            {/foreach} 
                             {def $results = fetch( 'ezfind', 'search', hash(
                                                    'query', '',
                                                    'subtree_array', array( 277, 66, 67, 68, 69, 70, 239, 71, 430 ), 
                                                    'class_id', array( 48, 98, 99, 101 ),
                                                    'limit', $number_of_items,
                                                    'ignore_visibility' , false(),
                                                    'offset', $view_parameters.offset,
                                                    'sort_by',   hash( 'attr_fecha_aparicion_dt', 'desc'
),				

                                                    'filter', $filterattrs

                             ))}
                            
                             
                         
                             {def $filter = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'Attr', 'catalog.ini')}
                            
                                                      
                             {def $extended_filter = array()}
                             


                        	                   	
                        	 
                            {if gt( $results.SearchCount, 0)}
                        	<h2>Tiene {$results.SearchCount} producto{if ne( $results.SearchCount, 1)}s{/if} {$text} en {$node.name|downcase()}</h2>
                        	{/if}
                            
                            <div class="wrap">
                          	
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
                                	{def $number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 ) 
										 $order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), 'fechapublicacion' )
									}    
                                	<ul class="clearFix">
                                    	<li>{def $options = ezini('OrderingProductsList', 'AvailableOrders', 'filtros.ini' )}
                                    		
                                        	<label for="ordenar">Ordenar / filtrar  por:</label>
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
                                		{switch match=$order_by }
                                			{case match='precio'}
                                				{def $sort_array = array( 'attribute', true(), 'producto/precio')}
                                			{/case}
                                			{case match='fechapublicacion'}
                                				{def $sort_array = array( 'attribute', false(), 'producto/fecha_aparicion')}
                                			{/case}
                                			{case}
                                				{def $sort_array = array( 'attribute', false(), 'producto/fecha_aparicion')}
                                			{/case}
                                		{/switch}              
                                               		
                                		
                                         
                                        
                                         
                                         
                                         
                                         {foreach $results.SearchResult as $index => $element}
                                         	{node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=$node.url_alias
         item_count=$results.SearchCount
         view_parameters=$view_parameters
         node_id=$node.node_id
         item_limit=$number_of_items}
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
												<li><a href="{concat( 'catalogo/', $param1, '/', $param2 )|ezurl(no)}#tops">Lo más vendido</a></li>
												<li class="sel"><h2>Lo más consultado</h2></li>
											</ul>
										{else}
										<ul class="tabs">
											<li class="sel"><h2>Lo más vendido</h2></li>
											<li><a href={concat( 'catalogo/', $param1, '/', $param2, '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>
										</ul>
										{/if}
										{include uri="design:common/best_sell.tpl" parentnode=$parentnode extended_attribute_filter=array() attribute_filter=array()}
										
											
									</div>

								</div>
							</div>
							
							{foreach $object_ids_query  as $object}
								{set $object_ids = $object_ids|append( $object.contentobject_id|int() )}
							{/foreach}	
							
							{include uri="design:common/related_training.tpl"}
							{undef $object_ids_query $object_ids}
						</div>
							
					</div>
						
						
				
					
				</div>
			</div>
				
