{def $filtro="62"|int}
{def $clase=""}

{if not($view_parameters.tipos|eq("-1"))}
    {set $filtro=$view_parameters.tipos|int}
    {def $aux=fetch('content','node',hash('node_id',$filtro))}
    {set $clase=$aux.name|normalize_path()|explode("_")|implode("-")}
{else}
    {def $aux=fetch('content','node',hash('node_id',$padre|int))}
    {set $clase=$aux.name|normalize_path()|explode("_")|implode("-")}
{/if}

{if not($view_parameters.areas|eq("-1"))}
    {set $filtro=$view_parameters.areas|int}
{/if}

{def $nextMonth=currentdate()|datetime('custom','%n')|sum($view_parameters.fecha|int)}
{def $prev_between=makedate($nextMonth,1)}
{def $post_between=makedate($nextMonth|inc(1),0)}


                              
       {def $nodos=ezini('Nodos','Nodo','filtros.ini')}
       {def $clases=ezini('Clases','Clase','filtros.ini')}
       {def $filter=array($clases[$clase])}
       
       
{if $filtro|eq(0)|not}       

<div id="novedades">

        
        {def $attribute_array=array(concat($filter.0,'/fecha_inicio'),'between',array($prev_between, $post_between))}
        
        
        
       {def $elements_count = fetch('content','tree_count', hash('parent_node_id', $filtro|int,
                                                                'class_filter_type','include',
                                                                'class_filter_array', $filter,
                                                                'class_filter_type','exclude',
                                                                'class_filter_array',array('folder','subhome','ponente','testimonio'),
                                                                'attribute_filter',array( array(concat($filter.0,'/fecha_inicio'),
                                                                                                'between',
                                                                                                 array( $prev_between, $post_between ) ) )
        ))}
                                                                            

    {if gt( $elements_count, 0)}
    <h2>Tiene {$elements_count} producto{if ne( $elements_count, 1)}s{/if}</h2>
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
                        {def $sort_array = array( 'attribute', true(), concat($clases[$clase],'/precio'))}
                    {/case}
                    {case match='fechainicio'}
                        {def $sort_array = array( 'attribute', false(), concat($clases[$clase],'/fecha_inicio'))}
                    {/case}
                    {case}
                        {def $sort_array = array( 'attribute', false(), concat($clases[$clase],'/fecha_inicio'))}
                    {/case}
                {/switch}


    {def $elements = fetch('content','tree', hash('parent_node_id', $filtro|int,
                                                                'class_filter_type','include',
                                                                'class_filter_array', $filter,
                                                                'class_filter_type','exclude',
                                                                'class_filter_array',array('folder','subhome','ponente','testimonio'),
                                                                'attribute_filter',array( array(concat($filter.0,'/fecha_inicio'),
                                                                                                'between',
                                                                                                 array( $prev_between, $post_between ) ) )
                                                                                                 ))}
                 
                 {if $elements|count|gt(0)}
                 {foreach $elements as $index => $element}
                    {node_view_gui content_node=$element view=line reset=$index|eq( $elements|count|sub(1) ) }
                 {/foreach}
                 {else}
                    No hay resultados para el filtro indicado
                 {/if}
                                                  
            
                

            </ul>
           {include name=navigator
                    uri='design:navigator/google.tpl'
                    page_uri=concat( 'formacion/', $clase, '/por-fechas' )
                    item_count=$elements_count
                    view_parameters=$view_parameters
                    node_id=$node.node_id
                    item_limit=$number_of_items}
            {undef $elements}  
          {/let}
        </div>
    
    </div>
    
</div>
{/if}