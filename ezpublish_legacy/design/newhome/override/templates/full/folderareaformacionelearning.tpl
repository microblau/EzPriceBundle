{ezpagedata_set( 'menuoption', 3 )}

<div id="commonGrid" class="clearFix">

                <div id="subNavBar">
                    <div class="currentSection"><a href={$node.parent.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
                    <ul>
        
                        {include uri='design:formacion/menu.tpl' check=$node.parent actual=$node hijo=$node.name|normalize_path()|explode('_')|implode('-')}              
                    </ul>
                    
                </div>
                
                
                {* cogemos los valores del nodo que debemos pintar de filtros.ini *}
                {def $nodos=ezini('Nodos','Nodo','filtros.ini')}
                {def $clases=ezini('Clases','Clase','filtros.ini')}
                
                {* para tomar el destacado cogeremos el bloque del nodo correspondiente *}
                
                {def $nodoActual=fetch('content','node',hash('node_id',$node.node_id))}
                
                                
                
                <div id="content">
                        {* modulo destacado *}
                        {block_view_gui block=$nodoActual.data_map.zona_central.value.zones.0.blocks.0}
                        {block_view_gui block=$nodoActual.data_map.zona_central.value.zones.0.blocks.1}

                        <div id="novedades" {if $nodoActual.data_map.zona_central.content.zones.0.blocks|count|eq(0)}style="margin-top:0px"{/if}>
                            
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
                                                {def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}                                                       
                                            {/case}
                                            {case}
                                              {def $sort_array = hash( 'subattr_precio___precio_f', 'asc' )}                                             
                                            {/case}
                                        {/switch}
                              {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $node.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94 ),
                                                                                         'limit', $number_of_items,
                                                                                         'sort_by', $sort_array,
                                                                                         'offset', $view_parameters.offset))}
                                                                                         

                               {def $elements_count = $results.SearchCount}
                               {def $elements = $results.SearchResult}
                                                                                                    

                            {if gt( $elements_count, 0)}
                            <h2>Tiene {$elements_count} curso{if ne( $elements_count, 1)}s{/if} {$text} en el área {$node.name}</h2>
                            {/if}
                            
                            <div class="wrap">
                            
                                <form action={"buscador/redirector"|ezurl()} method="post" id="filtrosform">
                                    {let number_of_items=cond( ne( ezpreference( 'products_per_page'), ''), ezpreference( 'products_per_page'), 5 ) 
                                         order_by = cond( ne( ezpreference( 'order_by'), ''), ezpreference( 'order_by'), 'fechainicio' )
                                    }    
                                    <ul class="clearFix">
                                        <li class="flt">{def $options = ezini('OrderingCursosList', 'AvailableOrders', 'filtros.ini' )}
                                            
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
                                            {*buscamosq que nodo queremos*}
                                            {def $nodetoshow=null}
                                            {foreach $element.object.assigned_nodes as $n}
                                                {if $n.parent_node_id|eq( $node.node_id )}
                                                {set $nodetoshow = $n}
                                                {/if}    
                                            {/foreach}
                                            {node_view_gui content_node=$nodetoshow view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=$node.url_alias
         item_count=$elements_count
         view_parameters=$view_parameters
         node_id=$node.node_id
         item_limit=$number_of_items}
         {undef $elements}           {/let}
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
                                                <li><a href="{concat( 'formacion/', $param1, '/', $param2, '/', $param3 )|ezurl(no)}#tops">Lo más vendido</a></li>
                                                <li class="sel"><h2>Lo más consultado</h2></li>
                                            </ul>
                                        {else}
                                        <ul class="tabs">
                                            <li class="sel"><h2>Lo más vendido</h2></li>
                                            {*<li><a href={concat( 'formacion/', $param1, '/', $param2, '/', $param3, '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>*}
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
           
                
