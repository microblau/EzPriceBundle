{ezpagedata_set( 'menuoption', 3 )}
<div id="commonGrid" class="clearFix">

    <div id="subNavBar">
        <div class="currentSection"><a href={$node.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
        <ul>
            {include uri='design:formacion/menu.tpl' check=$node.parent actual=$node.name|normalize_path()|explode('_')|implode('-')}
        </ul>
    </div>
                
                
                {* cogemos los valores del nodo que debemos pintar de filtros.ini *}
                {def $nodos=ezini('Nodos','Nodo','filtros.ini')}
                {def $clases=ezini('Clases','Clase','filtros.ini')}
                {def $filter=array($clases[$node.parent.name|normalize_path()|explode('_')|implode('-')])}
                
                {* para tomar el destacado cogeremos el bloque del nodo correspondiente *}
                
                {def $nodoActual=fetch('content','node',hash('node_id',$nodos[$node.parent.name|normalize_path()|explode('_')|implode('-')]))}
               
                
                <div id="content">
                        {* modulo destacado *}
                        {*block_view_gui block=$nodoActual.data_map.zona_central.value.zones.0.blocks.0*}
                        
                        <div id="novedades">
                            
                                
                               {def $nodos=ezini('Nodos','Nodo','filtros.ini')}
                               {def $clases=ezini('Clases','Clase','filtros.ini')}
                                
                               {def $elements_count = fetch('content','tree_count', hash('parent_node_id', $nodos[$node.parent.name|normalize_path()|explode('_')|implode('-')],
                                                                                        'class_filter_type','include',
                                                                                        'class_filter_array', $filter,
                                                                                        'class_filter_type','exclude',
                                                                                        'class_filter_array',array('folder','subhome','ponente','testimonio'),
                                                                                        'attribute_filter',array('and',
                                                                                                                array(concat( $filter.0,'/fecha_inicio_oferta' ), '<',  currentdate()  ),
                                                                                                                array(concat( $filter.0,'/fecha_fin_oferta' ), '>',  currentdate()  )
                                                                                                                )
                                ))}
                                                                                                    

                            {if gt( $elements_count, 0)}
                            <h2>Tiene {$elements_count} producto{if ne( $elements_count, 1)}s{/if} {$text} {$param3|downcase()}</h2>
                            {/if}
                            
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
                                        {switch match=$order_by }
                                            {case match='precio'}
                                                {def $sort_array = array( 'attribute', true(), concat($filter.0,'/precio'))}
                                            {/case}
                                            {case match='fechainicio'}
                                                {def $sort_array = array( 'attribute', false(), concat($filter.0,'/fecha_inicio'))}
                                            {/case}
                                            {case}
                                                {def $sort_array = array( 'attribute', false(), concat($filter.0,'/fecha_inicio'))}
                                            {/case}
                                        {/switch}
                                           
                                            
                                         {def $elements = fetch('content','tree', hash('parent_node_id', $nodos[$node.parent.name|normalize_path()|explode('_')|implode('-')],
                                                                                        'class_filter_type','include',
                                                                                        'class_filter_array', $filter,
                                                                                        'attribute_filter',array('and',
                                                                                                                array(concat( $filter.0,'/fecha_inicio_oferta' ), '<',  currentdate()  ),
                                                                                                                array(concat( $filter.0,'/fecha_fin_oferta' ), '>',  currentdate()  )
                                                                                                                ),
                                                                                                                                                                             
                                                                                        'limit', $number_of_items,
                                                                                        'offset', $view_parameters.offset
                                           ))}
                                           

                                         

                                         {foreach $elements as $index => $element}
                                            {node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                                         {/foreach}
                                                                          
                                    
                                        

                                    </ul>
                                   {include name=navigator
                                        uri='design:navigator/google.tpl'
                                        page_uri=concat( 'formacion/', $node.parent.name|normalize_path()|explode('_')|implode('-'), '/' , $node.name|normalize_path()|explode('_')|implode('-')  )
                                         item_count=$elements_count
                                        view_parameters=$view_parameters
                                         node_id=$node.node_id
                                         item_limit=$number_of_items}
                                         
                {undef $elements}           
         {/let}
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
                                                <li><a href="{concat( 'formacion/', $node.parent.name|normalize_path()|explode('_')|implode('-'), '/' , $node.name|normalize_path()|explode('_')|implode('-') )|ezurl(no)}#tops">Lo más vendido</a></li>
                                                <li class="sel"><h2>Lo más consultado</h2></li>
                                            </ul>
                                        {else}
                                        <ul class="tabs">
                                            <li class="sel"><h2>Lo más vendido</h2></li>
                                            <li><a href={concat( 'formacion/', $node.parent.name|normalize_path()|explode('_')|implode('-'), '/' , $node.name|normalize_path()|explode('_')|implode('-') , '/(mode)/visto#tops' )|ezurl() }>Lo más consultado</a></li>
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
  
                
