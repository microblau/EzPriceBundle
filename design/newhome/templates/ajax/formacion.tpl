
<h3>{$att2}</h3>

                        <ul>
                        {foreach $block.valid_nodes as $node}
                            <li class="clear fltitems"><a class="flt" href={$node.url_alias|ezurl_formacion()}>{$node.name}</a> <span class="flt" class="date">{if $node.data_map.fecha_inicio.has_content}{$node.data_map.fecha_inicio.content.timestamp|datetime( 'custom', '%d/%m/%Y')}{/if}{if $node.data_map.fecha_fin.has_content}{$node.data_map.fecha_fin.content.timestamp|datetime( 'custom', '%d/%m/%Y')}{/if}</span> <span class="flt">{cond( $node.object.data_map.ciudad.has_content, $node.object.data_map.ciudad.content, 'Madrid')}</span> <div class="flt"><a href={concat("basket/add/", $node.object.id, '/1')|ezurl()}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a></div></li>
                        {/foreach}                                
                        </ul>   
                        <span class="verMas"><a href="{$att4}">{$att3}</a></span>   
