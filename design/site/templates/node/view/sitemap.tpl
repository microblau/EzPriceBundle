
		
			
		
			<div id="gridWide">
								
				<h1>Mapa Web</h1>
			
				<div class="wrap clearFix">
                
                	<div class="columnType1">
				
                        <div class="inner mapaWeb">
                    
                            <div class="wysiwyg">
                        
                                <ul>
                                    <li>

                                        <h2><a href={"catalogo"|ezurl}>Catálogo</a></h2>
                                        <ul>
                                            <li>
                                                <h3><a href={"catalogo"|ezurl}>Tipo de producto</a></h3>
                                                <ul>
                                                	{def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                													'class_filter_type', 'include', 
                                                													'class_filter_array', array( 'folder'),
                                                													'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array
                                                					
                                                	 ))}
                                                	 {foreach $folders as $folder}
                                                    <li><a href={$folder.url_alias|ezurl()}>{$folder.name}</a></li>
                                                    {/foreach}
                                                    {undef $folders}                                                    
                                                </ul>

                                            </li>
                                            
                                            <li>
                                            	<h3>Por Área</h3>
                                                <ul>{def $areas = fetch( 'content', 'list', hash( 'parent_node_id', 143, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 143 )).sort_array
                                                                                  
                                     				))}
				                                    {foreach $areas as $area}
				                                        <li><a href={concat( "catalogo/area/", $area.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$area.name}</a></li>
				                                    {/foreach}
				                                    {undef $areas}       
				                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>Por formato</h3>
                                                <ul>
                                                	{def $formatos = fetch( 'content', 'list', hash( 'parent_node_id', 156, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 156 )).sort_array
                                                                                  
                                     				))}
				                                    {foreach $formatos as $formato}
				                                        <li><a href={concat( "catalogo/formato/", $formato.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$formato.name}</a></li>
				                                    {/foreach}
				                                    {undef $formatos}   
                                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>Por sector profesional</h3>
                                                <ul>

                                                	{def $sectores = fetch( 'content', 'list', hash( 'parent_node_id', 157, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 157 )).sort_array
                                                                                  
                                     				))}
				                                    {foreach $sectores as $sector}
				                                        <li><a href={concat( "catalogo/sector/", $sector.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$sector.name}</a></li>
				                                    {/foreach}
				                                    {undef $sectores}   
                                                </ul>

                                            </li>
                                            
                                            <li>
                                            	<h3>Novedades</h3>
                                            	{def $els = ezini( 'Submenu_423', 'Items', 'submenusproductos.ini')}
                                                <ul>
                                                	{foreach $els as $el}
                                                	<li><a href={ezini(concat( 'Submenu_423_', $el ), 'URL', 'submenusproductos.ini')|ezurl}>{ezini(concat( 'Submenu_423_', $el ), 'Literal', 'submenusproductos.ini')}</a></li>
                                                	{/foreach}
                                                </ul>
                                                {undef $els}
                                            </li>
                                            
                                            <li>
                                            	<h3>Ofertas</h3>
                                                <ul>
                                                	{def $els = ezini( 'Submenu_426', 'Items', 'submenusproductos.ini')}
	                                                <ul>
	                                                	{foreach $els as $el}
	                                                	<li><a href={ezini(concat( 'Submenu_426_', $el ), 'URL', 'submenusproductos.ini')|ezurl}>{ezini(concat( 'Submenu_426_', $el ), 'Literal', 'submenusproductos.ini')}</a></li>
	                                                	{/foreach}
	                                                </ul>
                                                	{undef $els}
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                    
                                    <li class="reset">
                                        <h2>Formación</h2>
                                        <ul>
                                            <li>
                                                <h3>Formación Presencial</h3>
                                                {def $subareas = fetch('content', 'list', hash( 'parent_node_id', 72,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}
{foreach $subareas as $subarea}

 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
  

{if $results.SearchCount|gt(0)}

{def $porareaurl = $subarea.url_alias}

{/if}
{undef $results}
{break}
{/foreach}
                                                <ul>
                                                    <li><a href={$porareaurl|ezurl_formacion}>Por Área</a>

                                                    	<ul class="bullet">
                                                            {foreach $subareas as $subarea}
                                                            {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
                                                            {if $results.SearchCount|gt(0)}

                                                                <li><a href={$subarea.url_alias|ezurl}>{$subarea.name}</a></li>
    
                                                            {/if}    
                                                            {undef $results}
                                                            {/foreach}
                                                        	
                                                        </ul>

                                                    </li>
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 473 )).url_alias|ezurl_formacion}>Por fechas</a></li>
                                                    {def $nodoofertas = fetch( 'content', 'node', hash( 'node_id', 474))}
                                                    {if $nodoofertas.is_hidden|not}
                                                    
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 473 )).url_alias|ezurl_formacion}>Ofertas</a></li>                                                                                                  {/if}
                                                     {undef $nodoofertas}
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 1110 )).url_alias|ezurl_formacion}>Ventajas</a></li>   
                                                      <li><a href={fetch( 'content', 'node', hash( 'node_id', 1111 )).url_alias|ezurl_formacion}>Metología</a></li>   
                                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>Formación "E-learning"</h3>
                                                <ul>
                                                    {def $subareas = fetch('content', 'list', hash( 'parent_node_id', 73,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}

{foreach $subareas as $subarea}

 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0
                                                                                         
                                                                                         
                                                                                       
                                                                                         
                                                           
                             
                                                 ))}   
  

{if $results.SearchCount|gt(0)}

<li><a href={$subarea.url_alias|ezurl_formacion}>{$subarea.name}</a></li>

{/if}
{undef $results}

{/foreach}

                                               <li><a href={fetch( 'content', 'node', hash( 'node_id', 1122 )).url_alias|ezurl_formacion}>Ventajas</a></li>   
                                                      <li><a href={fetch( 'content', 'node', hash( 'node_id', 1123 )).url_alias|ezurl_formacion}>Metología</a></li>   
                                                </ul>
                                            </li>

                                            <li>
                                                <h3>Formación Blended</h3>
                                                {def $subareas = fetch('content', 'list', hash( 'parent_node_id', 173,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}
{foreach $subareas as $subarea}

 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
  

{if $results.SearchCount|gt(0)}

{def $porareaurl = $subarea.url_alias}

{/if}
{undef $results}
{break}
{/foreach}
                                                <ul>
                                                    <li><a href={$porareaurl|ezurl_formacion}>Por Área</a>

                                                    	<ul class="bullet">
                                                            {foreach $subareas as $subarea}
                                                            {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
                                                            {if $results.SearchCount|gt(0)}

                                                                <li><a href={$subarea.url_alias|ezurl}>{$subarea.name}</a></li>
    
                                                            {/if}    
                                                            {undef $results}
                                                            {/foreach}
                                                        	
                                                        </ul>

                                                    </li>
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 1190 )).url_alias|ezurl_formacion}>Por fechas</a></li>
                                                    {def $nodoofertas = fetch( 'content', 'node', hash( 'node_id', 474))}
                                                    {if $nodoofertas.is_hidden|not}
                                                    
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 473 )).url_alias|ezurl_formacion}>Ofertas</a></li>                                                                                                  {/if}
                                                     {undef $nodoofertas}
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 1192 )).url_alias|ezurl_formacion}>Ventajas</a></li>   
                                                      <li><a href={fetch( 'content', 'node', hash( 'node_id', 1193 )).url_alias|ezurl_formacion}>Metología</a></li>   
                                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3><a href={fetch( 'content', 'node', hash( 'node_id', 74 )).url_alias|ezurl_formacion}>Formación "in company"</a></h3>
 
                                                

                                            </li>
                                            
                                            {*<li>
                                            	<h3>Másters</h3>
                                                <ul>
                                                	<li><a href="">Másters 1</a></li>
                                                    <li><a href="">Másters 2</a></li>
                                                    <li><a href="">Másters 3</a></li>

                                                </ul>
                                            </li>*}
                                            
                                            <li>
                                            	<h3>eConferencias</h3>
                                                {def $subareas = fetch('content', 'list', hash( 'parent_node_id', 76,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}
{foreach $subareas as $subarea}

 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
  

{if $results.SearchCount|gt(0)}

{def $porareaurl = $subarea.url_alias}

{/if}
{undef $results}
{break}
{/foreach}
                                                <ul>
                                                    <li><a href={$porareaurl|ezurl_formacion}>Por Área</a>

                                                    	<ul class="bullet">
                                                            {foreach $subareas as $subarea}
                                                            {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
                                                            {if $results.SearchCount|gt(0)}

                                                                <li><a href={$subarea.url_alias|ezurl}>{$subarea.name}</a></li>
    
                                                            {/if}    
                                                            {undef $results}
                                                            {/foreach}
                                                        	
                                                        </ul>

                                                    </li>
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 1314 )).url_alias|ezurl_formacion}>Por fechas</a></li>
                                                    {def $nodoofertas = fetch( 'content', 'node', hash( 'node_id', 474))}
                                                    {if $nodoofertas.is_hidden|not}
                                                    
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 473 )).url_alias|ezurl_formacion}>Ofertas</a></li>                                                                                                  {/if}
                                                     {undef $nodoofertas}
                                                    <li><a href={fetch( 'content', 'node', hash( 'node_id', 1316 )).url_alias|ezurl_formacion}>Ventajas</a></li>   
                                                      <li><a href={fetch( 'content', 'node', hash( 'node_id', 1317 )).url_alias|ezurl_formacion}>Metología</a></li>   
                                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>¿Por qué elegirnos?</h3>
                                                <ul>
                                                	<li><a href={fetch('content', 'node', hash('node_id', 84)).url_alias|ezurl_formacion()}>Valores</a></li>
                                                    <li><a href={fetch('content', 'node', hash('node_id', 85)).url_alias|ezurl_formacion()}>Ponentes</a></li>

                                                    <li><a href={fetch('content', 'node', hash('node_id', 172)).url_alias|ezurl_formacion()}>Formación subvencionada</a></li>
                                                    <li><a href={fetch('content', 'node', hash('node_id', 86)).url_alias|ezurl_formacion()}>Convenios</a></li>
                                                    <li><a href={fetch('content', 'node', hash('node_id', 87)).url_alias|ezurl_formacion()}>Preguntas frecuentes</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                    
                                </ul>                                             
                        
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="columnType2">
				
                        <div class="inner mapaWeb">
                    
                            <div>
                        
                                <ul>
                                    <li>

                                        <h2><a href={fetch( 'content', 'node', hash( 'node_id', 63 )).url_alias|ezurl}>{fetch( 'content', 'node', hash( 'node_id', 63 )).name}</a></h2>
                                         {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 63,
							                     'sort_by', fetch( 'content', 'node', hash( 'node_id', 63 )).sort_array
									 ))}
                            <ul>{foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl}>{$child.name}</a></li>
				{/foreach}
                            </ul>
			    {undef $children}
                                    </li>

                                    
                                    <li>
                                    	<h2><a href={fetch( 'content', 'node', hash( 'node_id', 88 )).url_alias|ezurl}>{fetch( 'content', 'node', hash( 'node_id', 88 )).name}</a></h2>
                                         {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 88,
							                     'sort_by', fetch( 'content', 'node', hash( 'node_id', 88 )).sort_array
									 ))}
                            <ul>{foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl}>{$child.name}</a></li>
				{/foreach}
                            </ul>
			    {undef $children}
                                    </li>
                                    
                                    <li><h2><a href={"acceso-abonados"|ezurl()}>Abonados</a></h2></li>
                                    <li><h2><a href={"colectivos"|ezurl()}>Colectivos</a></h2></li>
                                    {*<li><h2><a href={"agentes"|ezurl()}>Agentes</a></h2></li>*}
                                    <li><h2><a href={"formularios/suscribase-a-nuestro-boletin-de-novedades"|ezurl}>Newsletter</a></h2></li>
                                    <li><h2><a href={"contacto"|ezurl()}>Contacto</a></h2></li>

                                </ul> 
                            
                            
                        
                            </div>
                            
                        </div>
                        
                    </div>
				
				</div>
			
			
			</div>
		
				
			
		
			
		
		
