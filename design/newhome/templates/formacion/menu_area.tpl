{def $type = ezini( concat( 'Submenu_', $check.node_id ), 'Type', 'submenuscursos.ini' )}
{def $nodoHijo=ezini( 'Submenu_porareas', $hijo , 'submenuscursos.ini' )}

{if $type|eq(1)}
    {def $filter = array()}
    {def $parentnode = ezini( concat( 'Submenu_', $check.node_id ), 'ParentNode', 'submenuscursos.ini' )}
    {def $classname = ezini( concat( 'Submenu_', $check.node_id ), 'ClassName', 'submenuscursos.ini' )}      
    {def $filtros = cond( ezini_hasvariable( concat( 'Submenu_', $check.node_id ), 'Filters', 'submenuscursos.ini' ), 
                          ezini( concat( 'Submenu_', $check.node_id ), 'Filters', 'submenuscursos.ini' ) , 
                          null )}
                            
    {def $urlarray = cond( ezini_hasvariable( concat( 'Submenu_', $check.node_id ), 'URL', 'submenuscursos.ini' ), 
                           ezini( concat( 'Submenu_', $check.node_id ), 'URL', 'submenuscursos.ini' ) , 
                           null )}
                                                        
    {foreach $filtros as $filtro}
        {def $aux = $filtro|explode( ';' )}
            {set $filter = $filter|append( array( concat( $classname, '/', $aux[0] ), '=', $aux[1]|int() )) }
        {undef $aux}
    {/foreach}
            
    {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', $parentnode, 
                                                    'class_filter_type', 'include',
                                                    'class_filter_array', array( $classname ),
                                                    'sort_by', array( 'priority', true() ),
                                                    'attribute_filter', cond( $filter|count|gt( 0 ), $filter, null ) 
                                ))
    }
    {foreach $folders as $folder}                       
        <li {if or(eq( $folder.node_id, $actual.node_id),eq( $folder.parent_node_id, $actual.node_id)}class="sel"{/if}>
        {if ne( $folder.node_id, $actualnode)}<a href={concat( $urlarray|implode('/'), '/', $folder.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{else}<strong><span>{/if}{$folder.name}{if ne( $folder.node_id, $actualnode)}</a>{else}</span></strong>{/if}</li>
    {/foreach}
    {undef $filter $parentnode $classname $filtros}
{else}
    {def $items = ezini( concat( 'Submenu_', $check.node_id ), 'Items', 'submenuscursos.ini' )}
    {foreach $items as $item}
        <li {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}class="sel"{/if}>
        
            
            
        {if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}<a href={ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenuscursos.ini' )|ezurl()}>{else}<strong><span>{/if}{ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )}{if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}</a>{else}</span></strong>{/if}
       
       
       
       
            
            
         {*comprobamos que tiene hijos. Indicado en submenucursos.ini*}
         {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}
           {if eq( ezini( concat('Submenu_',$check.node_id,'_',$item), 'Hijos', 'submenuscursos.ini')|normalize_path()|explode('_')|implode('-'),1)}
                {def $nodoSubmenu=ezini(concat('Submenu_',$check.node_id,'_',$item),'NodoTree', 'submenuscursos.ini')}
                <ul>
                    {*sacamos las carpetas hijas*}
                    
                    {def $folders=fetch('content','list',hash('parent_node_id', $nodoSubmenu|int,
                                                            'class_filter_type','include',
                                                            'class_filter_array', array('folder'))
                                                            )}
                                                            
                    {foreach $folders as $folder}
                        <li{if eq($folder.name|normalize_path()|explode('_')|implode('-'),$view_parameters.area)} class="sel"{/if}>
                            {*$folder|attribute(show,2)*}
                            {if eq($folder.name|normalize_path()|explode('_')|implode('-'),$view_parameters.area)}
                                <strong>{$folder.name|wash}</strong>
                            {else}
                                <a href={if $hijo}{concat('formacion/',$check.url_alias,'/',$actual,'/(area)/',$folder.name|wash|normalize_path()|explode('_')|implode('-')),'/(id)/',$folder.node_id|ezurl()}{else}{concat('formacion/',$check.url_alias,'/',$actual,'/(area)/',$folder.name|wash|normalize_path()|explode('_')|implode('-'),'/(id)/',$folder.node_id)|ezurl()}{/if}>{$folder.name|wash}</a>
                            {/if}
                       </li>
                    {/foreach}
                    
                </ul>
            {/if}
         {/if}
        </li>
    {/foreach}
    
{/if}