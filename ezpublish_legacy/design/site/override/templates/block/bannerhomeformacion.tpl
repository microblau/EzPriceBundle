{def $valid_nodes = $block.valid_nodes}

{if $valid_nodes}
	<div>
 		
            {foreach $valid_nodes as $valid_node}
            	{if $block.custom_attributes.url|ne('')}
                <a href="{$block.custom_attributes.url}">
		        {/if}
                    {attribute_view_gui attribute=$valid_node.data_map.image image_class=bannerhomeformacion}
               	{if $block.custom_attributes.url|ne('')}    
                </a>
                {/if}
            {/foreach}

    </div>
    <br />
{/if}
