{def $type = ezini( concat( 'Submenu_', $check.node_id ), 'Type', 'submenusproductos.ini' )}
{if $type|eq(1)}
	{def $filter = array()}
	{def $parentnode = ezini( concat( 'Submenu_', $check.node_id ), 'ParentNode', 'submenusproductos.ini' )}
	{def $classname = ezini( concat( 'Submenu_', $check.node_id ), 'ClassName', 'submenusproductos.ini' )}		
	{def $filtros = cond( ezini_hasvariable( concat( 'Submenu_', $check.node_id ), 'Filters', 'submenusproductos.ini' ), 
						  ezini( concat( 'Submenu_', $check.node_id ), 'Filters', 'submenusproductos.ini' ) , 
						  null )}
							
	{def $urlarray = cond( ezini_hasvariable( concat( 'Submenu_', $check.node_id ), 'URL', 'submenusproductos.ini' ), 
						   ezini( concat( 'Submenu_', $check.node_id ), 'URL', 'submenusproductos.ini' ) , 
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
		<li {if eq( $folder.node_id, $actualnode)}class="sel"{/if}>
		{if ne( $folder.node_id, $actualnode)}<a href={concat( $urlarray|implode('/'), '/', $folder.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{else}<strong><span>{/if}{$folder.name}{if ne( $folder.node_id, $actualnode)}</a>{else}</span></strong>{/if}</li>
	{/foreach}
	{undef $filter $parentnode $classname $filtros}
{else}
	{def $items = ezini( concat( 'Submenu_', $check.node_id ), 'Items', 'submenusproductos.ini' )}
	{foreach $items as $item}
		<li {if eq( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenusproductos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}class="sel"{/if}>
		{if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenusproductos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}<a href={ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'URL', 'submenusproductos.ini' )|ezurl()}>{else}<strong><span>{/if}{ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenusproductos.ini' )}{if ne( ezini( concat( 'Submenu_', $check.node_id, '_', $item ), 'Literal', 'submenusproductos.ini' )|normalize_path()|explode('_')|implode('-'), $actual)}</a>{else}</span></strong>{/if}</li>
	{/foreach}
{/if}
