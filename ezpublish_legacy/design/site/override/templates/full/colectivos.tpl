{set-block scope=root variable=cache_ttl}0{/set-block}
{ezpagedata_set( 'menuoption', 2 )}
{ezpagedata_set( 'rss', concat( 'catalogo/', $param1, '/', $param2 ) )}

{def $user = fetch( 'user', 'current_user')}
{def $materia = 'fechapublicacion'}
{if $user.is_logged_in|not}
		
			
		
			<div id="gridThreeColumns" class="clearFix">
			
				<div id="subNavBar">
				
					<div class="currentSection"><a href={$nodefrom.url_alias|ezurl()}><span>{$nodefrom.name}</span></a></div>
					<ul>
						{include uri='design:catalog/menu.tpl' check=$nodefrom actual=$param2}				
					</ul>
				
				
				</div>
			
			
				<div class="columnType1">
					<div id="modColectivos">
						
							<h1>¿Pertenece a un colectivo?</h1>

							<div class="wrap clearFix">
                    	
									<div class="description">
										<div class="wysiwyg">
											 {fetch( 'content', 'node', hash( 'node_id', 1072)).data_map.texto.content.output.output_text}
                                             <div class="listColectivos">
                                            	<p>Colectivos que ya disfrutan de nuestras ventajas:</p>
                                                {def $groups = fetch( 'content', 'list', hash( 'parent_node_id', 411, 'sort_by', array( 'name', true() ), 'limitation', array(), 'as_object', false() ))}
                                                <ul>
                                                    {foreach $groups as $group}
                                                	<li>{$group.name}</li>
                                                    {/foreach}

                                                </ul>
                                                {undef $groups}
                                                
                                            </div>
                                            
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
					<div id="modAccesoAbonados">

						<h2>Acceso usuarios</h2>
						<div class="wrap clearFix">
							<form action={"colectivos/login"|ezurl} method="post">
							
								<ul>
									<li>
										<label for="usuario">Usuario</label>
										<input type="text" class="text" id="usuario" name="Login" />
									</li>

									<li>
										<label for="pass">Contraseña</label>
										<input type="password" class="text" id="pass" name="Password" />
										<span><a href={"basket/forgotpassword"|ezurl}>¿Olvidó su contraseña?</a></span>
									</li>
									<li>
										<span class="submit"><input type="image" src={"btn_entrar.gif"|ezimage} alt="entrar" name="LoginButton" /></span>
									</li>
									<li>
										<br>
										<span>¿Aún no está registrado?&nbsp;<a href={"colectivos/alta-colectivo"|ezurl}>Hágalo aquí</a></span>
									</li>
								</ul>
							
							    <input type="hidden" name="RedirectURI" value="{fetch( 'content', 'node', hash( 'node_id', 166)).url_alias|ezurl}" />
							</form>
																	
						</div>
					</div>
				</div>
			</div>

{else}
<div align="right">
	<a href={"formularios/sugerencias-colectivos"|ezurl}>
   	 <img src={"btn_sugerencia.png"|ezimage} alt="Sugerencias" />
    </a>
</div>

<div id="commonGrid" class="clearFix">
		
				<div id="subNavBar">
					
					<div class="currentSection"><a href={$nodefrom.url_alias|ezurl()}><span>{$nodefrom.name}</span></a></div>
					<ul>
						{include uri='design:catalog/menu.tpl' check=$nodefrom actual=$param2}				
					</ul>
				
				
				</div>

				<div id="content">
					  
                      
                        {if $user.contentobject.main_node.depth|eq(4)}
                     
                        {def $colectivo = $user.contentobject.main_node.parent.object.id}
     
						{if $user.contentobject.main_node.parent.data_map.page.content.zones.0.blocks|count|gt(0)}

						{block_view_gui block=$user.contentobject.main_node.parent.data_map.page.content.zones[0].blocks[0] zone=$user.contentobject.main_node.parent.data_map.page.content.zones[0] attribute=$attribute}
                        {/if}
                        
						 
						{def $materia = fetch( 'content', 'object',  hash( 'object_id', fetch( 'content', 'object', hash( 'object_id', $colectivo)).data_map.materia_ordenar.content.relation_list.0.contentobject_id)).name}

                          <div id="novedades" {if  $user.contentobject.main_node.parent.data_map.page.content.zones.0.blocks|count|eq(0)}style="margin-top:0"{/if}>
                                        {def $number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 )
										 $order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), $materia|downcase() )
										}

{def $filtro =  array( 'and',
                                                                    
                                                                     concat( 'subattr_precio___discount_', $user.contentobject.main_node.parent_node_id ,'_i:1' )
                                                                   )}
																   
                                     {def $attribute='812;770;398;884'}
                                     {def $params = array( 'or' )}
                                     {foreach $attribute|explode(';') as $attribute_id}
                                        {set $params = $params|append( $attribute_id ) }
                                        {set $params = $params|append( $colectivo ) }
                                    {/foreach}
                               
                                    {switch match=$order_by}
                                			{case match='precio'}
                                               
                                                {def $sort_array = hash( concat( 'subattr_precio___precio_', $user.contentobject.main_node.parent_node_id ,'_f' ), 'asc' )} 
                                            {/case}
                                            {case match='fechapublicacion'}
                                                {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                                       
                                            {/case}
                                            {case}
                                              {def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}                                             
                                            {/case}
                                            {case match='fiscal'}
                                                    
                                                 {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 147))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )} 
                                            {/case}
                                            {case match='social'}
                    	                      
                                                  {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 146))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}    
                                            {/case}
                                            {case match='mercantil'}
                	                            
                                                {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 148))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}    
                                            {/case}
                                            {case match='contable'}
            	                                
                                                {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 149))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )} 

                                            {/case}
                                            {case match='inmobiliario'}
        	                                   
                                                {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 151))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )} 
                                            {/case}
                                            {case match='administrativo'}
    	                                        
                                                {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 153))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}  
                                            {/case}
                                            {case match='juridico'}
	                                          
                                                {set $filtro=$filtro|append(concat( 'submeta_', 'area', '___id_si:', 190))}
{def $sort_array = hash( 'attr_fecha_aparicion_dt', 'desc' )}   
                                            {/case}
                                		{/switch}
                                		{def $results = fetch( 'ezfind', 'search', hash(
                                                    'query', '',
                                                    'subtree_array',  array(61), 
                                                    'class_id', array( 48, 98, 99, 101 ),
                                                    'limit', $number_of_items,
                                                    'offset', $view_parameters.offset,
                                                    'sort_by', $sort_array,
                                                    'filter', $filtro
                                                    ))}
                                         
                                         
                                         
                                       
                            {if gt( $results.SearchCount, 0)}
                        	<h2>Tiene {$results.SearchCount} producto{if ne( $results.SearchCount, 1)}s{/if} para el Colectivo/Asociación Profesional {$user.contentobject.main_node.parent.object.name}</h2>
                        	{/if}
                            
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
                                         	{node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                        

                                    </ul>
                                
{*Código de Alberto

                                   {include name=navigator

         uri='design:navigator/google.tpl'

         page_uri=concat( 'catalogo/', $param1, '/', $param2 )

         item_count=$results.SearchCount

         view_parameters=$view_parameters

         node_id=X.node_id

         item_limit=$number_of_items}
 *}
{include name=navigator

         uri='design:navigator/google.tpl'

         page_uri=concat( 'catalogo/', $param1, '/', $param2 )

         item_count=$results.SearchCount

         view_parameters=$view_parameters         

         item_limit=$number_of_items}

         {undef $elements}  </div>
                            
                            </div>
                            
                        </div>
                        {else}
                            {'colectivos/alta-colectivo'|redirect()}
                        {/if}
                        
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
							{def $object_ids_query =fetch( 'content', 'tree', hash( 'parent_node_id', 61,
                                														 'class_filter_type', 'include',
                                														 'class_filter_array', array( 'producto' ),                                        												                                        												
                                        												 'extended_attribute_filter', $extended_attribute_filter
                                         ))}  
                            {def $object_ids = array()}
							{foreach $object_ids_query  as $object}
								{set $object_ids = $object_ids|append( $object.contentobject_id|int() )}
							{/foreach}	
							
							{include uri="design:common/related_training.tpl" attribute_filter=array()  extended_attribute_filter=$query_extended_filter}
							{undef $object_ids_query $object_ids}

							</div>
						</div>
                       
							
					</div>
						
						
				
					
				</div>
			
	 {/if}			
