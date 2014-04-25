{ezpagedata_set( 'menuoption', 2 )}
{ezpagedata_set( 'rss', concat( 'catalogo/', $param1, '/', $param2 ) )}
<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				
					<a href={$nodefrom.url_alias|ezurl()}><span class="currentSection">{$nodefrom.name}</span></a>
					<ul>
						{include uri='design:catalog/menu.tpl' check=$nodefrom actual=$param2}				
					</ul>
				
				
				</div>

			
				
				<div id="content">
					
				
						<div id="moduloDestacadoContenido">
						
							<h1 class="mainTitle">Memento Fiscal 2009</h1>								
						
							<div class="wrap">
				
								<div class="inner clearFix">
					
									<div class="wysiwyg">
					
										<div class="attribute-cuerpo">
										
													<div class="object-left">
														<div class="content-view-embed">

															<div class="class-image">
								    							<div class="attribute-image">                                 
                                                                    <img src={"img_libroIRPF.gif"|ezimage} alt="" />
								    							</div>																					
								 							</div>
														</div>
													</div>
													
													<ul>
														<li>No es una simple transcripción de normas.</li>

														<li>Contiene un <strong>profundo análisis práctico de cada caso.</strong></li>
														<li><strong>Ejemplos</strong> concretos para cada referencia.</li>	
                                                        <li>Todas las novedades sobre IRPF, Patrimonio sociedades...</li>													
													</ul>
													<div class="clearFix linksModulo">
														<a href=""><img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" /></a>
													</div>

										
										
										</div>
									</div>
								</div>
							</div>																																			
						
						</div>		
                        
                        <div id="novedades">
                        	                   	
                        	 {def $elements_count = fetch( 'content', 'tree_count', hash( 'parent_node_id', $parentnode,
                                														 'class_filter_type', 'include',
                                														 'class_filter_array', array( 'producto' ),
                                        												 'attribute_filter', cond( $filter|count|gt(0), $filter, null ),
                                        												 'extended_attribute_filter', cond( $extendedfilter|count|gt(0), $extendedfilter, null )
                                         ))}
                            {if gt( $elements_count, 0)}
                        	<h2>Tiene {$elements_count} producto{if ne( $elements_count, 1)}s{/if} {$text} {$node.name|downcase()}</h2>
                        	{/if}
                            
                            <div class="wrap">
                          	
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
                                	{def $number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 ) 
										 $order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), 'fechapublicacion' )
									}    
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
                                               		
                                		{def $elements = fetch( 'content', 'tree', hash( 'parent_node_id', $parentnode,
                                														 'class_filter_type', 'include',
                                														 'class_filter_array', array( 'producto' ),
                                        												 'sort_by', $sort_array,                                        												
                                        												 'limit', $number_of_items,
                                        												 'offset', cond( is_set( $offset), $offset, 0 ),
                                        												 'attribute_filter', cond( $filter|count|gt(0), $filter, null ),
                                        												 'extended_attribute_filter', cond( $extendedfilter|count|gt(0), $extendedfilter, null )
                                         ))}
                                         
                                        
                                         
                                         
                                         
                                         {foreach $elements as $index => $element}
                                         	{node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=concat( 'catalogo/', $param1, '/', $param2 )
         item_count=$elements_count
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
										{include uri="design:common/best_sell.tpl" parentnode=$parentnode extended_attribute_filter=$extendedfilter attribute_filter=cond( $filter|count|gt(0), $filter, null )}
										
											
									</div>

								</div>
							</div>
							{def $object_ids_query =fetch( 'content', 'tree', hash( 'parent_node_id', $parentnode,
                                														 'class_filter_type', 'include',
                                														 'class_filter_array', array( 'producto' ),  
                                														 'attribute_filter', cond( $filter|count|gt(0), $filter, null ),                                      												                                        												
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
				
