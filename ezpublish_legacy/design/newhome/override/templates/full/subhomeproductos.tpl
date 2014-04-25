{if eq( $node.node_id, 423)}
{concat( 'catalogo/novedades/', fetch( 'content', 'node', hash('node_id', 2255)).name|normalize_path()|explode('_')|implode('-') )|redirect()}
{/if}
{if eq( $node.node_id, 425)}
{concat( 'catalogo/formato/', fetch( 'content', 'node', hash('node_id', 158)).name|normalize_path()|explode('_')|implode('-') )|redirect()}
{/if}
{if eq( $node.node_id, 426)}
{concat( 'catalogo/ofertas/', fetch( 'content', 'node', hash('node_id', 2217)).name|normalize_path()|explode('_')|implode('-') )|redirect()}
{/if}
{ezpagedata_set( 'menuoption', 2 )}
{if array( 'novedades', 'ofertas')|contains( $node.name|downcase() )}
	{ezpagedata_set( 'rss', concat( 'catalogo/', $node.name|downcase()))}
{/if}

<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				
					<div class="currentSection"><a href={$node.url_alias|ezurl()}><span >{$node.name}</span></a></div>

					<ul>
						{include uri='design:catalog/menu.tpl' check=$node}
					</ul>
				
				
				</div>

			
				
				
					
				
						<div id="content">				
							{attribute_view_gui attribute=$node.data_map.page}						
						
                            
                
                        
                        
                        <div id="gridType6">
														
						<div class="wrap clearFix">
							<div class="columnType1 flt">	
															
								<div class="wrapColumn">											
									<div id="tops" class="inner">

									
										{if and( is_set($view_parameters.mode), $view_parameters.mode|eq( 'visto' ) )}
											<ul class="tabs">
												<li><a href="{$node.path_identification_string|explode("_")|implode("-")|ezurl(no)}#tops">Lo más vendido</a></li>
												<li class="sel"><h2>Lo más consultado</h2></li>
											</ul>
										{else}
										<ul class="tabs">
											<li class="sel"><h2>Lo más vendido</h2></li>
											<li><a href={concat( $node.path_identification_string|explode("_")|implode("-"), '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>
										</ul>
										{/if}
										{include uri="design:common/best_sell.tpl" parentnode=61 extended_attribute_filter=null attribute_filter=null mode=$view_parameters.mode}
										
										
											
									</div>

								</div>
							</div>
							{def $object_ids_query =fetch( 'content', 'tree', hash( 'parent_node_id', 61,
																						 'as_object', false(),
                                														 'class_filter_type', 'include',
                                														 'class_filter_array', array( 'producto' ),  
                                														 'attribute_filter', null,                                      												                                        												
                                        												 'extended_attribute_filter', null
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
				
