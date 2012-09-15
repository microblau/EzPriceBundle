{def $testimonios = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                            'class_filter_type', 'include',
                                                            'class_filter_array', array( 'testimonio' ),
                                                            'sort_by', $node.sort_array
        ))}
        
{if $testimonios|count|gt(0)} 
<div class="column2">
    <div class="testimonio clearFix">
        <h3>Profesionales que ya conocen sus ventajas...</h3>
                                                                               
            {if $testimonios.0.data_map.foto_testimonio.has_content}
                {def $foto_testimonio = fetch( 'content', 'object', hash( 'object_id', $testimonios.0.data_map.foto_testimonio.content.relation_browse.0.contentobject_id ))}                                      
                 <img src={$foto_testimonio.data_map.image.content.testimonio.url|ezroot()} alt="" class="flt" />
             {/if}
            <q>"{$testimonios.0.data_map.testimonio.content.output.output_text|strip_tags()}"</q>
            <span><span class="nombre">{$testimonios.0.data_map.nombre_persona.content}. </span>{$testimonios.0.data_map.empresa.content}</span>
         
            {if $testimonios|count|gt(1)}
                <div class="botonTestimonio">
                    <span class="left"><img src={'btn_testimonioDisabled-lf.gif'|ezimage} alt="" /></span>
                    <span class="mas">Más testimonios</span>
                    <span class="right"><a href=""><img src={'btn_testimonioDisabled-rg.gif'|ezimage} alt="" /></a></span>
                </div>
            {/if}
    </div>
</div>
{/if}