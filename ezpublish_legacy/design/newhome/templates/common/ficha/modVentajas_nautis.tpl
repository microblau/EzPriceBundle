
        <h2><span>Compre online</span> y disfrute de todas las ventajas</h2>
        {if $node.parent.parent.parent.node_id|eq(62)}
        {fetch('content', 'node', hash('node_id', 1488)).data_map.texto.content.output.output_text}
        {else}
		{fetch('content', 'node', hash('node_id', 1487)).data_map.texto.content.output.output_text}
        {/if}

    </div>
    {if and( or( $node.parent_node_id|eq(64), $node.parent_node_id|eq(65), $node.parent_node_id|eq(277) ), $node.data_map.integrado_sage.content|eq(1) )}
    <div><a href={fetch('content', 'node', hash('node_id', 1069)).url_alias|ezurl}><img src={"sage.gif"|ezimage} alt="integrado en sage" /></a></div>
    {/if}
    

