{ezpagedata_set( 'menuoption', 2 )}
{ezpagedata_set( 'rss', concat( 'catalogo/', $param1, '/', $param2 ) )}
<div id="commonGrid" class="clearFix">
				
				<div id="subNavBar">
				 
					<div class="currentSection"><a href={$nodefrom.url_alias|ezurl()}><span >{$nodefrom.name}</span></a></div>
					<ul>
						{include uri='design:catalog/menu.tpl' check=$nodefrom actual=$param2}				
					</ul>
				
				
				</div>

			
				
				<div id="content">
					

						{if $node.data_map.zona_central.content.zones.0.blocks|count|gt(0)}
						<div id="moduloDestacadoContenido">
										  
							<h1 class="mainTitle"><a href={$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.url_alias|ezurl}>{$node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.name}</a></h1>								
						
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
													{else}
													{def $imagen = fetch( 'content', 'object', hash( 'object_id',  2084 ))}  
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
														{if $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.object.contentclass_id|eq(98) }
                                                     <a href={concat( "/basket/mementix")|ezurl} class="ejemplar"><img src={"quiero_tenerlo.gif"|ezimage} alt="Quiero tenerlo" /></a>
                                                    {elseif or( $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.object.contentclass_id|eq(99),   $node.data_map.zona_central.content.zones.0.blocks.0.valid_nodes.0.object.contentclass_id|eq(101))}
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
                           {def $number_of_items=cond( ezpreference( 'products_per_page')|ne(''),   ezpreference( 'products_per_page'), 5 )                                       
                                         $order_by = ezpreference( 'order_by' )
                                    }    
                                    {def $ff=''}
                                    {set $number_of_items = $number_of_items|int()}
                               		{def $padre=array(61)}
                                    {switch match=$order_by}
                                            {case match='precio'}
                                               {set $ff=''}
                                                {def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}
                                            {/case}
                                            {case match='fechapublicacion'}
                                                {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                                 {set $ff=''}      
                                            {/case}
                                             {case match='fiscal'}
                                                 {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 147)}
                                            {/case}
                                            {case match='social'}
                    	                          {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 146)}
                                              
                                            {/case}
                                            {case match='mercantil'}
                	                             {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 148)}
                                               
                                            {/case}
                                            {case match='contable'}
            	                                 {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 149)}
                                            {/case}
                                            {case match='inmobiliario'}
        	                                    {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 151)}
                                            {/case}
                                            {case match='administrativo'}
    	                                        {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 153)}
                                            {/case}
                                            {case match='juridico'}
	                                             {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'area', '___id_si:', 190)}
                                            {/case}
                                         
                                             {case match='digital'}
                                                 {def $sort_array=array()} 
                                                 {set $ff=concat( 'submeta_', 'formato', '___id_si:', 162)}
                                            {/case}
                                             {case match='e-book'}
                                                 {def $sort_array=array()}
                                                  {set $ff=array('or')}        
                                                  {set $ff=$ff|append('producto/formato:E-book')}
                                                  {set $ff=$ff|append('producto_mementix/formato:E-book')}
                                                  {set $ff=$ff|append('producto_nautis/formato:E-book')}
                                                  {set $ff=$ff|append('producto_nautis4/formato:E-book')  }
                                            {/case}
                                             {case match='papel'}
                                                 {def $sort_array=array()}  
                                                 {set $ff=concat( 'submeta_', 'formato', '___id_si:', 160)}
                                            {/case}
                                             {case match='papel+digital'}
                                                 {def $sort_array=array()}
                                                 {set $ff=concat( 'submeta_', 'formato', '___id_si:', 163)}
                                            {/case}
                                            
                                           {case match='=mementos'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(64)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='mementos_expertos'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(65)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='respuestas_memento'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(277)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='actum'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(66)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='formularios'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(67)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='packs'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(68)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='mementix'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(69)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='nautis'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(70)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='dossier'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(239)}
                                                 {set $ff=''}
                                             {/case}
                                            {case match='software'}
                                            	 {def $sort_array=array()}        
                                                 {set $padre=array(71)}
                                                 {set $ff=''}
                                             {/case}
                                            
                                            {case}
                                              {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                             {set $ff=''}
                                            {/case}
                                         {/switch}
                                         {def $filtros_array=array('and')}
                                         {def $otro_filtro=concat( 'submeta_', $param1, '___id_si:', $node.object.id)}
                                         {set $filtros_array = $filtros_array|append($otro_filtro)}
                                         {if  $ff|ne('') }
                                        	{set $filtros_array = $filtros_array|append($ff)}
                                         {/if} 
                                         {*$filtros_array|attribute(show)*}
                                        {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', $padre,
                                                                                         'class_id', array( 48, 98, 99, 101 ),
                                                                                         'limit', $number_of_items,
                                                                                         'sort_by', $sort_array,
                                                                                         'offset', $view_parameters.offset,
                                                                                         'ignore_visibility' , false(),
                                                                                         'filter', $filtros_array ))}
                        
                            {if gt( $results.SearchCount, 0)}
                        	<h2>Tiene {$results.SearchCount} producto{if ne( $results.SearchCount, 1)}s{/if} {$text} {$node.name}</h2>
                        	{/if}
                            
                            <div class="wrap">
                          	
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
                                	{def $number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 ) 
										 $order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), 'fechapublicacion' )
									}    
                                	<ul class="clearFix">
                                    	<li>
                                      {if $node.parent_node_id|ne('156')}    <!--or 157-->
                                            {def $options = ezini('OrderingProductsListAreas', 'AvailableOrders', 'filtros.ini' )}
                                      {else}
                                             {def $options = ezini('OrderingProductsList', 'AvailableOrders', 'filtros.ini' )}   
                                       {/if} 	
                                        	<label for="ordenar">Ordenar / filtrar por:</label>
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
                                         	{node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=concat( 'catalogo/', $param1, '/', $param2 )
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
										{include uri="design:common/best_sell.tpl" parentnode=61 mode=$view_parameters.mode extended_attribute_filter=$query_extended_filter  attribute_filter=array()}
										
											
									</div>

								</div>
							</div>
						{def $object_ids_query =  fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( 61 ),
                                                                                         'class_id', array( 48, 98, 99, 101 ),
                                                                                          'as_objects', false(),
                                                                                          'limit', 3000,
                                                                                         'filter', array( concat( 'submeta_', $param1, '-id_si:', $node.object.id ) ) 
                                                                                         
                                                 ))}
                        
                            
                            {def $object_ids = array()}
							{foreach $object_ids_query.SearchResult  as $object}
								{set $object_ids = $object_ids|append( $object.id_si )}
							{/foreach}		
							{include uri="design:common/related_training.tpl" attribute_filter=array()  extended_attribute_filter=$query_extended_filter}
							{undef $object_ids_query $object_ids}

							</div>
						</div>
							
					</div>
						
						
				
					
				</div>
			
				
