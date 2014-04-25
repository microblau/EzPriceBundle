<div id="subNavBar">
					
					<div class="currentSection"><a href="#"><span>{$node.path.1.name}</span></a></div>
					<ul>
						{def $items = fetch('content', 'list', hash( 'parent_node_id', $node.path.1.node_id,
																	 'class_filter_type', 'include', 
																	 'class_filter_array', array( 'folder' ),
																	 'sort_by', $node.path.1.sort_array	
						))}
						{foreach $items as $item}
							<li {if eq($item.node_id, $node.node_id)}class="sel"{/if}>{if eq($item.node_id, $node.node_id)|not}<a href={$item.url_alias|ezurl()}>{else}<strong><span>{/if}{$item.name}{if eq($item.node_id, $node.node_id)|not}</a>{else}</span></strong>{/if}</li>
						{/foreach}
						{undef $items}						
					</ul>
				
				
				</div>
