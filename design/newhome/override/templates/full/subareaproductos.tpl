{ezpagedata_set( 'menuoption', 2 )}
{def $urlexplode = $node.url_alias|explode( '/' ) }
{ezpagedata_set( 'rss', concat( 'catalogo/', $urlexplode.1, '/', $urlexplode.2 ) )}
<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				
					<div class="currentSection"><a href={$node.parent.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
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
								    {def $filtro=array('or')}
                                     {switch match=$order_by}
                                            {case match='precio'}
                                               {set $filtro=''}
                                                {def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}
                                            {/case}
                                            {case match='fechapublicacion'}
                                             {set $filtro=''}
                                                {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                                   
                                            {/case}
                                            {case match='fiscal'}
                                                 {def $sort_array=array()}        
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 147)}
                                            {/case}
                                            {case match='social'}
                    	                        {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 146)}
                                            {/case}
                                            {case match='mercantil'}
                	                            {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 148)}
                                            {/case}
                                            {case match='contable'}
            	                                {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 149)}
                                            {/case}
                                            {case match='inmobiliario'}
        	                                    {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 151)}
                                            {/case}
                                            {case match='administrativo'}
    	                                        {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 153)}
                                            {/case}
                                            {case match='juridico'}
	                                            {def $sort_array=array()}
                                                {set $filtro=concat( 'submeta_', 'area', '___id_si:', 190)}
                                            {/case}
                                         
                                            {case}
                                              {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}
                                               {set $filtro=''}
                                            {/case}
                                        {/switch}
                            {def $parentnode = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'ParentNode', 'catalog.ini')}
                         
                            {def $filter = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'Attr', 'catalog.ini')}
                            {def $classes = ezini( concat( $urlexplode.1, '_', $urlexplode.2|explode('-')|implode('_') ), 'Classes', 'catalog.ini')}
							 {def $filterattrs = array('and')}
                            {foreach $filter as $index => $value }
                                {set $filterattrs = $filterattrs|append( concat( $index, ':', $value ))}
                            {/foreach} 
                            {if $filtro|ne('')}
                            	{set $filterattrs = $filterattrs|append($filtro) }
                            {/if}
                             {def $results = fetch( 'ezfind', 'search', hash(
                                                    'query', '',
                                                    'subtree_array',  $parentnode, 
                                                    'class_id', $classes|explode(','),
                                                    'limit', $number_of_items,
                                                    'offset', $view_parameters.offset,
                                                    'sort_by',   $sort_array,
                                                    'ignore_visibility' , false(),
                                                    'filter', $filterattrs
                                                    ))}
                  
                  			
                           {$filterattrs|attribute(show,3)}
                             
                         
                             {def $filter = fetch( 'catalogo', 'get_filter', hash( 'param1', $urlexplode.1, 'param2', $urlexplode.2 ))}
                                                      
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

                                				{def $sort_array = array( 'subattr_precio___precio_f', 'desc')}
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
												<li><a href="{$node.url_alias|ezurl(no)}#tops">Lo más vendido</a></li>
												<li class="sel"><h2>Lo más consultado</h2></li>
											</ul>
										{else}
										<ul class="tabs">
											<li class="sel"><h2>Lo más vendido</h2></li>
											<li><a href={concat( $node.url_alias, '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>
										</ul>
										{/if}
                                        
										{include uri="design:common/best_sell.tpl" parentnode=61 extended_attribute_filter=array() attribute_filter=array()}
										
											
									</div>

								</div>
							</div>
							
						{def $results = fetch( 'ezfind', 'search', hash(
                                                    'query', '',
                                                    'subtree_array',  $parentnode,
                                                    'class_id', $classes|explode(','),
                                                    'limit', 3000,
                                                    'offset', 0,
                                                    'filter', $filter,
                                                    'as_objects', false()
                                                    ))}

                                                {def $object_ids = array()}
                                                        {foreach $object_ids_query.SearchResult  as $object}
                                                                {set $object_ids = $object.id_si}
                                                        {/foreach}
	
							{include uri="design:common/related_training.tpl"}
							{undef $object_ids_query $object_ids}
						</div>
							
					</div>
						
						
				
					
				</div>
			</div>
				
