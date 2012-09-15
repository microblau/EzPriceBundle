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
       <li {if or(eq( $folder.node_id, $actual.node_id),eq( $folder.parent_node_id, $actual.node_id))}class="sel"{/if}>
        {if ne( $folder.node_id, $actualnode)}<a href={concat( $urlarray|implode('/'), '/', $folder.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{else}<strong><span>{/if}{$folder.name}{if ne( $folder.node_id, $actualnode)}</a>{else}</span></strong>{/if}</li>
    {/foreach}
    {undef $filter $parentnode $classname $filtros}




{elseif $type|eq(2)}

    {def $items = ezini( concat( 'Submenu_', $check.node_id ), 'Items', 'submenuscursos.ini' )}
    {foreach $items as $item}
    
        <li {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}class="sel"{/if}>
        {if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}
        
{*        <a href={fetch( 'content', 'node', hash( 'node_path', ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenuscursos.ini' ))).url_alias|ezurl()}>*}
    {def $pat=ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenuscursos.ini' )}
    {def $patnormal=$pat|normalize_path()|explode('_')|implode('-')}
       <a href={$pat|ezurl()}>
        
        {else}
       
        <strong><span>
        {/if}
        {ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )}
        {if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}</a>{else}</span></strong>{/if}
       
       
       
   
                
                
             {*comprobamos que tiene hijos. Indicado en submenucursos.ini*}
             
             {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual.name|normalize_path()|explode('_')|implode('-'))}
         
               {if eq( ezini( concat('Submenu_',$check.node_id,'_',$item), 'Hijos', 'submenuscursos.ini')|normalize_path()|explode('_')|implode('-'),1)}
                <ul>
                    {*sacamos las carpetas hijas*}
                    {def $folders=fetch('content','list',hash('parent_node_id', $check.node_id,
                                                            'class_filter_type','include',
                                                            'class_filter_array', array('folder'))
                                                            )}
                                                            
                    {foreach $folders as $folder}
 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $folder.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0,
                                                                                         
                                                                                         
                                                                                         'filter', array( 'or',
                                                                                                             
                                                                                                          array( 'and', 'attr_fecha_de_fin_dt:[* TO *]', 'attr_fecha_inicio_dt:[NOW TO *]' ),
                                                                                                          'attr_fecha_de_fin_dt:[NOW TO *]' )
                                                                                         
                                                           
                             
                                                 ))}    

{if $results.SearchCount|gt(0)}
                        <li{if eq($hijo|normalize_path()|explode('_')|implode('-'),$folder.name|normalize_path()|explode('_')|implode('-'))} class="sel"{/if}>
                            {*$folder|attribute(show,2)*}
                            {if eq($hijo|normalize_path()|explode('_')|implode('-'), $folder.name|normalize_path()|explode('_')|implode('-'))}
                                <strong>{$folder.name|wash}</strong>
                            {else}
                                <a href={if $hijo}{$folder.url_alias|ezurl}{else}{concat($check.url_alias,'/',$actual,'/',$folder.name|wash|normalize_path()|explode('_')|implode('-'))|ezurl()}{/if}>{$folder.name|wash}</a>
                            {/if}
                       </li>
{/if}
                    {/foreach}
                    
                </ul>
            {/if}
         {/if}
        </li>
    {/foreach}
{elseif $type|eq(4)}
    {def $items = ezini( concat( 'Submenu_', $check.node_id ), 'Items', 'submenuscursos.ini' )}
    {foreach $items as $item}
        <li {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}class="sel"{/if}>
        
            
            
        {if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}<a href={ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenuscursos.ini' )|ezurl()}>{else}<strong><span>{/if}{ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )}{if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}</a>{else}</span></strong>{/if}
       
       
       
       
                
                
             {*comprobamos que tiene hijos. Indicado en submenucursos.ini*}
         
             {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual.name|normalize_path()|explode('_')|implode('-'))}
         
               {if eq( ezini( concat('Submenu_',$check.node_id,'_',$item), 'Hijos', 'submenuscursos.ini')|normalize_path()|explode('_')|implode('-'),1)}
                <ul>
                    {*sacamos las carpetas hijas*}
                    {def $folders=fetch('content','list',hash('parent_node_id', $check.node_id,
                                                            'class_filter_type','include',
                                                            'class_filter_array', array('folder'))
                                                            )}
                                                            
                    {foreach $folders as $folder}
 {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $folder.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0
                                                                                         
                                                                                         
                                                                                        
                                                                                         
                                                           
                             
                                                 ))}    

{if $results.SearchCount|gt(0)}
                        <li{if eq($hijo|normalize_path()|explode('_')|implode('-'),$folder.name|normalize_path()|explode('_')|implode('-'))} class="sel"{/if}>
                            {*$folder|attribute(show,2)*}
                            {if eq($hijo|normalize_path()|explode('_')|implode('-'), $folder.name|normalize_path()|explode('_')|implode('-'))}
                                <strong>{$folder.name|wash}</strong>
                            {else}
                                <a href={if $hijo}{$folder.url_alias|ezurl}{else}{concat($check.url_alias,'/',$actual,'/',$folder.name|wash|normalize_path()|explode('_')|implode('-'))|ezurl()}{/if}>{$folder.name|wash}</a>
                            {/if}
                       </li>
{/if}
                    {/foreach}
                    
                </ul>
            {/if}
         {/if}
        </li>
    {/foreach}
{else}

    {def $subfolders = fetch( 'content', 'list', hash('parent_node_id', $check.node_id, 
                                                                'class_filter_type', 'include',
                                                                'class_filter_array', array( 'folder'),
                                                                'sort_by', $check.sort_array ))
                                                                }
    {foreach $subfolders as $subfolder}
    
    {if $subfolder.children_count|gt(0)}
     <li {if eq( $subfolder.node_id, $actual.node_id)}class="sel"{/if}>
     {if ne( $subfolder.node_id, $actual.node_id)}<a href={$subfolder.url_alias|ezurl()}>{else}<strong><span>{/if}{$subfolder.name}{if ne( $subfolder.node_id, $actual.node_id)}</a>{else}</span></strong>{/if}
     </li>
    {/if} 
    {/foreach}
    
    {def $items = ezini( concat( 'Submenu_', $check.node_id ), 'Items', 'submenuscursos.ini' )}
    {foreach $items as $item}
        <li {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}class="sel"{/if}>
        
            
            
        {if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}<a href={ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenuscursos.ini' )|ezurl()}>{else}<strong><span>{/if}{ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )}{if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Checked', 'submenuscursos.ini' ), $actual.node_id)}</a>{else}</span></strong>{/if}
       
       
       
       
            
            
         {*comprobamos que tiene hijos. Indicado en submenucursos.ini*}
         
         {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenuscursos.ini' )|normalize_path()|explode('_')|implode('-'), $actual.name|normalize_path()|explode('_')|implode('-'))}
         
           {if eq( ezini( concat('Submenu_',$check.node_id,'_',$item), 'Hijos', 'submenuscursos.ini')|normalize_path()|explode('_')|implode('-'),1)}
                <ul>
                    {*sacamos las carpetas hijas*}
                    {def $folders=fetch('content','list',hash('parent_node_id', $check.node_id,
                                                            'class_filter_type','include',
                                                            'class_filter_array', array('folder'))
                                                            )}
                                                            
                    {foreach $folders as $folder}
                        {def $results = fetch( 'ezfind', 'search', hash( 'query', '',
                                                                                         'subtree_array', array( $folder.node_id ),
                                                                                         'class_id', array( 49, 66, 61, 94, 64 ),
                                                                                         'limit', 0))}

{if $results.SearchCount|gt(0)}
                        <li{if eq($hijo|normalize_path()|explode('_')|implode('-'),$folder.name|normalize_path()|explode('_')|implode('-'))} class="sel"{/if}>
                            {if eq($hijo|normalize_path()|explode('_')|implode('-'), $folder.name|normalize_path()|explode('_')|implode('-'))}
                                <strong>{$folder.name|wash}</strong>
                            {else}
                                <a href={if $hijo}{$folder.url_alias|ezurl}{else}{concat($check.url_alias,'/',$actual,'/',$folder.name|wash|normalize_path()|explode('_')|implode('-'))|ezurl()}{/if}>{$folder.name|wash}</a>
                            {/if}
                       </li>
                     {/if}
                    {/foreach}
                   
                    {undef $results}
                </ul>
            {/if}
         {/if}
        </li>
    {/foreach}
{/if}
