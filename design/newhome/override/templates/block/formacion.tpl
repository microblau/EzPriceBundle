
            <div id="modFormacion">
                <h2>La formación en Francis Lefebvre es distinta. ¿Quiere saber por qué?</h2>
                <div class="grid clearFix">
                    <div id="tiposFormacion">
                        <ul>
                            {foreach $zone.blocks as $index => $itemblock}                            
                            <li {if $index|eq(0)}class="sel"{/if}><a href={concat( 'ezjscore/call/portadas::formacion::', $itemblock.id, '::', $attribute.id, '::', $attribute.version )|ezurl()}>{$itemblock.custom_attributes.titulo_pestana}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                    <div class="description wrapAjaxContent">
                        <h3>{$zone.blocks[0].custom_attributes.titulo_bloque}</h3>

                        <ul>
                        {foreach $zone.blocks[0].valid_nodes as $node}
                                <li class="clear fltitems"><a class="flt" href={$node.url_alias|ezurl_formacion()}>{$node.name}</a> <span class="flt date">{if $node.data_map.fecha_inicio.has_content}{$node.data_map.fecha_inicio.content.timestamp|datetime( 'custom', '%d/%m/%Y')}{/if}{if $node.data_map.fecha_fin.has_content}{$node.data_map.fecha_fin.content.timestamp|datetime( 'custom', '%d/%m/%Y')}{/if}</span> <span class="flt">{cond( $node.object.data_map.ciudad.has_content, $node.object.data_map.ciudad.content, 'Madrid')}</span> <div class="flt"><a href={concat("basket/add/", $node.object.id, '/1')|ezurl()}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a></div></li>
                        {/foreach}                                
                        </ul>   
                        <span class="verMas"><a href="{$zone.blocks[0].custom_attributes.enlace}">{$zone.blocks[0].custom_attributes.texto_enlace}</a></span>                   
                    </div>
              </div>
            
