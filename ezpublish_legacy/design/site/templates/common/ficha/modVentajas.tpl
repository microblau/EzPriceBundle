<div class="column2">
    <div id="modVentajas">
        <h2><span>Compre online</span> y disfrute de todas las ventajas</h2>
        {if $node.parent.parent.parent.node_id|eq(62)}
        {fetch('content', 'node', hash('node_id', 1488)).data_map.texto.content.output.output_text}
        {else}
		{fetch('content', 'node', hash('node_id', 1487)).data_map.texto.content.output.output_text}
        {/if}

    </div>
    {if and( or( $node.parent_node_id|eq(64), $node.parent_node_id|eq(65), $node.parent_node_id|eq(277) ), $node.data_map.integrado_sage.content|eq(1) )}
    <div>{if $node.data_map.enlace_sage.has_content}<a href="{$node.data_map.enlace_sage.content}" target="_blank">{else}<a href={fetch('content', 'node', hash('node_id', 1069)).url_alias|ezurl} target="_blank">{/if}
        <img src={fetch( 'content', 'object', hash('object_id', 2633)).data_map.image.content.original.url|ezroot} />
    </a></div>
    {/if}
    {if and( or( $node.parent_node_id|eq(64), $node.parent_node_id|eq(65), $node.parent_node_id|eq(277), $node.parent_node_id|eq(4058), $node.parent_node_id|eq(7343) ), $node.data_map.integrado_derecho.content|eq(1) )}
    <div>{if $node.data_map.enlace_derecho.has_content}<a href="{$node.data_map.enlace_derecho.content}" target="_blank">{else}<a href={fetch('content', 'node', hash('node_id', 1069)).url_alias|ezurl} target="_blank">{/if}
        <img src={fetch( 'content', 'object', hash('object_id', 4569)).data_map.image.content.original.url|ezroot} />
    </a></div>
    {/if}
</div> 
