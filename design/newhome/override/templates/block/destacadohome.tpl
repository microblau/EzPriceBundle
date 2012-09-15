   
                {def $object = fetch( 'content', 'node', hash( 'node_id', $block.custom_attributes.objeto ))}
                <div id="modDestacado">
                    <h2>{$block.custom_attributes.titulo}</h2>
                    <div class="wrap clearFix">
                        {if $object.data_map.imagen.has_content}
                            {def $img = fetch( 'content', 'object', hash( 'object_id', $object.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                            <img src={$img.data_map.image.content.block_destacado_home.url|ezroot()} alt="{$img.data_map.image.content.alternative_text}" />
                            {undef $img}
                        {/if}
                        <p>{$block.custom_attributes.texto}</p>
                        <span class="button"><a href={$object.url_alias|ezurl()}>{$block.custom_attributes.texto_enlace}</a></span>
                    </div>
                
                </div>
