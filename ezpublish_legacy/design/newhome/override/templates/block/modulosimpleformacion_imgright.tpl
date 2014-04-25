<div class="wrapColumn">        
    <div class="inner">                                 
      
        <div class="attribute-cuerpo clearFix">
        
            <div class="object-left">
                <div class="content-view-embed">
                    <div class="class-image">
                        <div class="attribute-image">    
                            {if $block.valid_nodes.0.data_map.imagen.has_content}
                                {def $imagen = fetch( 'content', 'object', hash( 'object_id', $block.valid_nodes.0.data_map.imagen.content.relation_browse.0.contentobject_id ))}                             
                                <img src={$imagen.data_map.image.content.original.url|ezroot()} alt="{$image.data_map.image.content.alternative_text}" />
                            {/if}
                        </div>                                                                                  
                    </div>
                </div>
            </div>
                  
            <h2>{$block.valid_nodes.0.name}</h2>      
            <p>{$block.valid_nodes.0.data_map.texto.content.output.output_text}</p>
            {if $block.valid_nodes.0.data_map.enlace_a.has_content}
                {def $nodo=fetch('content','node',hash( 'node_id', $block.valid_nodes.0.data_map.enlace_a.content.main_node_id))} 
                
                {if or( is_set( $nodo.path.1)|not, $nodo.path.1.node_id|ne( 62 ) ) }
                <span class="verMas"><a href={$nodo.url_alias|ezurl_www()}>{$block.valid_nodes.0.data_map.texto_enlace_a.value}</a></span>               
                {else}          
                 <span class="verMas"><a href={$nodo.url_alias|ezurl_formacion()}>{$block.valid_nodes.0.data_map.texto_enlace_a.value}</a></span>               
                {/if}
            {/if}
        </div>
    </div>
</div>
