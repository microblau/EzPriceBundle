{ezpagedata_set( 'menuoption', 4 )}


		
			
		
			<div id="commonGrid" class="clearFix">
				
				
				{include uri="design:menus/porquelefebvre.tpl"}
			
				
				<div id="content" class="valores">
					   	
                     
						{if $node.data_map.zona_central.content.zones.0.blocks|count|gt(0)}
						   {block_view_gui block=$node.data_map.zona_central.content.zones[0].blocks[0] zone=$node.data_map.zona_central.content.zones[0] attribute=$attribute}
                        {/if}
						{def $nodes = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
																	  'sort_by', $node.sort_array
						 ) )}
						<ul id="listadoValores">
							{for 0 to $nodes|count|sub(1) as $i}
								{node_view_gui view=valores content_node=$nodes[$i]}
							{/for}						
						</ul>
				
					
				</div>

			</div>
				
			
		
			
		

