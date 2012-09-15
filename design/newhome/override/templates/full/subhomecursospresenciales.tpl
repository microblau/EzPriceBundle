{def $subareas = fetch('content', 'list', hash( 'parent_node_id', $node.node_id,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}
{foreach $subareas as $subarea}
{if $node.node_id|ne(73)}
 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}   
{else}
{def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $subarea.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0
                                                                                         
                                                           
                             
                                                 ))}   
{/if}
{if $results.SearchCount|gt(0)}

{$subarea.url_alias|redirect}
{/if}
{undef $results}
{/foreach}

{ezpagedata_set( 'menuoption', 3 )}
<div id="commonGrid" class="clearFix">
    <div id="subNavBar">
       <div class="currentSection"><a href={$node.url_alias|ezurl()}><span >{$node.name}</span></a></div>
        <ul>
            {include uri='design:formacion/menu.tpl' check=$node actual=$param2}
        </ul>
    </div>
    {attribute_view_gui attribute=$node.data_map.zona_central param=$node.node_id view_parameters=$view_parameters}

                
