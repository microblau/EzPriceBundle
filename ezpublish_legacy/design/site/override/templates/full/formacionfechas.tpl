        
            
        {set-block scope=root variable=cache_ttl}0{/set-block}
            <div id="commonGrid" class="clearFix">
                
                <div id="subNavBar">
                
                    <div class="currentSection"><span >{$node.parent.name}</span></div>
                    <ul>
                       {include uri='design:formacion/menu.tpl' check=$node.parent actual=$node hijo=$node.name|normalize_path()|explode('_')|implode('-')}
                    </ul>
                
                
                </div>
            
                
                <div id="content">
                    
                
                        <div id="moduloDestacadoContenido">
                        
                            <h1 class="mainTitle">Encuentre su curso</h1>                               
                        
                            <div class="wrap">
                
                                <div class="inner clearFix">
                    
                                    <div class="wysiwyg clearFix">
                    
                                        <div class="attribute-cuerpo sinImagen flt">

                                                                                            
                                            <p>Francis Lefebvre le ofrece un amplio número de cursos que le permitirán anticiparse y encontrar soluciones en su área de trabajo.</p>
                                            <div class="clearFix linksModulo">
                                        
                                                <span class="font">Busque el suyo ahora ...</span>
                                                
                                            </div>                                      
                                        </div>
                                        
                                        <div class="buscaCurso frt">
                                            
                                            <h2>Quiero buscar un curso</h2>
                                            <form action="{$node.url_alias|ezurl(no)}" method="get">

                                                <ul>
                                                    <li>
                                                        <label for="areas" class="hide">Áreas:</label>
                                                        <select id="areas" name="area">
                                                            <option selected="selected" value="-" {if or( ezhttp_hasvariable('area', 'get')|not, ezhttp('area', 'get')|eq('-'))}selected="selected"{/if}>En todas las áreas</option>
                                                            {def $areas=fetch('content', 'list', hash('parent_node_id', $node.parent.node_id,
                                                                                                      'sort_by', $node.sort_array,
                                                                                                      'class_filter_type', 'include',
                                                                                                      'class_filter_array', array( 'folder' )      
                                                                                                        
                                                            ))}
                                                            {foreach $areas as $area}
                                                            {if $area.children_count|gt(0)}
                                                            <option value="{$area.node_id}" {if and( ezhttp_hasvariable('area', 'get'), ezhttp('area', 'get')|eq( $area.node_id))}selected="selected"{/if}>{$area.name}</option>
                                                            {/if}
                                                            {/foreach}
                                                        </select>
                                                    </li>
                                                    {*
                                                    <li>

                                                        <label for="ciudad" class="hide">Ciudades:</label>
                                                        <select id="ciudad" name="ciudad">
                                                            <option selected="selected">En todas las ciudades</option>
                                                        </select>
                                                    </li>
                                                    *}
                                                    <li>
                                                        <label for="fecha" class="hide">Fecha:</label>

                                                        <select id="fecha" name="fecha">
                                                            {def $start = currentdate()|datetime( 'custom', '%Y')|int}
                                                            <option value="-" {if and( ezhttp_hasvariable('fecha', 'get'), ezhttp('fecha', 'get')|eq('-'))}selected="selected"{/if}>Sin importar la fecha</option>
                                                            {for $start|sub(2) to $start|sub(1) as $i}
                                                            <option value="{$i}" {if and( ezhttp_hasvariable('fecha', 'get'), ezhttp('fecha', 'get')|eq($i))}selected="selected"{/if}>En {$i}</option>
                                                            {/for}
                                                            <option value="{$start}" {if or( ezhttp_hasvariable('fecha', 'get')|not, ezhttp('fecha', 'get')|eq($start))}selected="selected"{/if}>En {$start}</option>
                                                            {for $start|sum(1) to $start|sum(3) as $i}
                                                            <option value="{$i}" {if and( ezhttp_hasvariable('fecha', 'get'), ezhttp('fecha', 'get')|eq($i))}selected="selected"{/if}>En {$i}</option>
                                                            {/for}
                                                        </select>
                                                    </li>
                                                </ul>
                                                <div class="clearFix">
                                                    <span class="submit frt"><input type="image" alt="Ver curso" src={"btn_verCurso.gif"|ezimage} name="btnSearch" /></span> 
                                                </div>
                                            </form>

                                        
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>                                                                                                                                          
                        
                        </div>      
                        {if ezhttp_hasvariable('fecha', 'get')}
                       <div id="novedades" >
                            
                                 {def $number_of_items=cond( ezpreference( 'products_per_page')|ne(''),   ezpreference( 'products_per_page'), 5 )                                       
                                         $order_by = ezpreference( 'order_by' )
                                    }  
                               {def $nodos=ezini('Nodos','Nodo','filtros.ini')}
                               {def $clases=ezini('Clases','Clase','filtros.ini')}
 {def $number_of_items=cond( ezpreference( 'products_per_page')|ne(''),   ezpreference( 'products_per_page'), 5 )                                       
                                         $order_by = ezpreference( 'order_by' )
                                    }    
                                    {set $number_of_items = $number_of_items|int()}
                              {switch match=$order_by}
                                            {case match='precio'}
                                               
                                                {def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}
                                            {/case}
                                            {case match='fechapublicacion'}
                                                {def $sort_array = hash( 'attr_fecha_inicio_dt', 'asc' )}                                                       
                                            {/case}
                                            {case}
                                              {def $sort_array = hash( 'attr_fecha_inicio_dt', 'asc' )}                                             
                                            {/case}
                                        {/switch}
                                        
                              {def $filter=array()}
                              {if and( ezhttp_hasvariable( 'fecha', 'get'), ezhttp( 'fecha', 'get')|ne('-') ) }
                          
                              {def $intervalstart = maketime( 0, 0, 0, 1, 1, ezhttp( 'fecha', 'get') )|datetime( 'custom', '%Y-%m-%dT%H:%i:%sZ' )}
                              {def $intervalend = maketime( 23, 59, 59, 12, 31, ezhttp( 'fecha', 'get') )|datetime( 'custom', '%Y-%m-%dT%H:%i:%sZ' )}
                            
                                {set $filter = $filter|append( 'or' )}
                                {set $filter = $filter|append( 
                                                            array( 'and', 'attr_fecha_de_fin_dt:[* TO *]',
                                                                           concat( 'attr_fecha_inicio_dt:[', $intervalstart, ' TO ', $intervalend  ,']' ) 
                                             
                                ))}
                                {set $filter = $filter|append( concat( 'attr_fecha_de_fin_dt:[', $intervalstart ,' TO ', $intervalend ,']' ) )}
                              {/if}
                              {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', cond( and( ezhttp_hasvariable( 'area', 'get'),  ezhttp( 'area', 'get')|ne('-') ), array( ezhttp( 'area', 'get') ), array( $node.parent_node_id ) ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', $number_of_items,
                                                                                         'sort_by', $sort_array,
                                                                                         'offset', $view_parameters.offset,
                                                                                         'filter', $filter
                                                                                         
                                                                                         
                                                 ))}

                               {def $elements_count = $results.SearchCount}
                               {def $elements = $results.SearchResult}
                                                                                                    
                            
                            {if gt( $elements_count, 0)}
                            <h2>Se ha{if ne( $elements_count, 1)}n{/if} encontrado {$elements_count} curso{if ne( $elements_count, 1)}s{/if} para su búsqueda</h2>
                            
                            
                            <div class="wrap">
                            
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
                                    {let number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 ) 
                                         order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), 'fechainicio' )
                                    }    
                                    <ul class="clearFix">
                                        <li>{def $options = ezini('OrderingCursosList', 'AvailableOrders', 'filtros.ini' )}
                                            
                                            <label for="ordenar">Ordenar por:</label>
                                            <select id="ordenar" name="ordenar">
                                                {foreach $options as $option}
                                                <option value="{$option}" {if eq($option, $order_by)}selected="selected"{/if}>{ezini( $option, 'Literal', 'filtros.ini' )}</option>
                                                {/foreach}                                              
                                            </select>
                                            {undef $options}    
                                        </li>
                                        <li class="frt">{def $elementstoshow = ezini('OrderingCursosList', 'ElementsToShow', 'filtros.ini' )}
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
                            
                                <div class="description busquedaCursos">
                                    <ul class="wrapAjaxContent clearFix">
                                       
                                         
                                         {foreach $elements as $index => $element}
                                            
                                            {node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=$node.url_alias
         item_count=$elements_count
         view_parameters=$view_parameters
         node_id=$node.node_id
         page_uri_suffix=concat('?fecha=',ezhttp( 'fecha', 'get'),'&area=', ezhttp( 'area', 'get'))
         item_limit=$number_of_items}
         {undef $elements}           {/let}
                                </div>
                            
                            </div>
                            {else}
                                <h2>No hay resultados</h2>
                            {/if}
                            
                        </div>
                        {/if}
                        
                        
                       <div id="gridType6">
                                                        
                        <div class="wrap clearFix">
                            <div class="columnType1 flt">   
                                                            
                                <div class="wrapColumn">                                            
                                    <div id="tops" class="inner">

                                        {if and( is_set($view_parameters.mode), $view_parameters.mode|eq( 'visto' ) )}
                                            <ul class="tabs">
                                                <li><a href="{concat( 'formacion/', $param1, '/', $param2, '/', $param3 )|ezurl(no)}#tops">Lo más vendido</a></li>
                                                <li class="sel"><h2>Lo más consultado</h2></li>
                                            </ul>
                                        {else}
                                        <ul class="tabs">
                                            <li class="sel"><h2>Lo más vendido</h2></li>
                                            <li><a href={concat( 'formacion/', $param1, '/', $param2, '/', $param3, '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>
                                        </ul>
                                        {/if}
                                        {include uri="design:common/best_sell.tpl" parentnode=62}
                                        
                                            
                                    </div>

                                </div>
                            </div>
                            
                            {def $object_ids_query =fetch( 'content', 'tree', hash( 'parent_node_id', 62,
                                                                                         'class_filter_type', 'include',
                                                                                         'class_filter_array', array( $clases[$param1] ),                                                                                                                                                                             
                                                                                         'extended_attribute_filter', $extended_attribute_filter
                                         ))}  
                            {def $object_ids = array()}
                            {foreach $object_ids_query  as $object}
                                {set $object_ids = $object_ids|append( $object.contentobject_id|int() )}
                            {/foreach}  
                            
                            {def $cursos = fetch( 'content', 'tree', hash( 'parent_node_id', $nodefrom.node_id,
                                                                           'main_node_only', true(),
                                                                           'extended_attribute_filter', hash(
                                                                                        'id', 'relatedTraining',
                                                                                        'params', hash( 'items', $object_ids ) 
                                                                           ),
                                                                           'limit', 5                                                                          
                            ))}
                            
                            {if $cursos|count}
                            <div class="columnType2 frt">   
                                                        
                                <div class="wrapColumn">                                            
                                    <div id="modTab" class="inner">                                 
                                                                             
                                        <h2 class="title">Próximos Cursos</h2>
                                        
                                        <ul>
                                            {foreach $cursos as $index => $item }                                           
                                            <li {if eq($index, $cursos|count|sub(1) )}class="reset"{/if}>
                                                <h3><a href={$item.url_alias|ezurl_formacion()}>{$item.name}</a></h3>
                                                {if is_set( $item.data_map.fecha_inicio )}
                                                <span>{$item.data_map.fecha_inicio.content.timestamp|datetime( 'custom', '%d/%m/%y')}
                                            {if $item.data_mapa.fecha_fin.has_content}
                                            - {$item.data_map.fecha_fin.content.timestamp|datetime( 'custom', '%d/%m/%y')}
                                            {/if}</span>
                                            {/if}
                                            </li>
                                            {/foreach}
                                            
                                        </ul>
                                    </div>

                                </div>

                            </div>
                            {/if}
                            {undef $cursos}
                        {undef $object_ids_query $object_ids}
                            </div>
                        </div>
                            
                    </div>
                        
                        
                
                    
                </div>
