{ezscript_require( 'novedades.js' )}
<ul id="tabsNov">
    <li id="news"><h3>Novedades</h3></li>
    <li id="bestsell"><a href="#">Las + compradas</a></li>
    <li id="bestviewed"><a href="#">Las + consultadas</a></li>
</ul>
<div id="modNovedades">
    <h3>Últimas novedades</h3>
    <div class="carrousel jcarousel tops">
        <ul class="carrousel" id="itemscarrousel">
        {foreach $block.valid_nodes as $node}
            <li>
            {def $area_node = fetch( 'content', 'object', hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id ) )}
                <h4>{$area_node.name}</h4>
                {if $node.data_map.imagen.has_content}
                {def $image = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
                <div class="multim">
                    <img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="" class="producto" />
                </div>
                {undef $image}
                {else}
                <div class="multim">
                {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                    <img src={$image.data_map.image.content.block_novedades.url|ezroot} alt="{$image.data_map.image.content.alternative_text}" class="producto" />
                    {undef $image}
                </div>
                {/if}
                <a href={$node.url_alias|ezurl}><span>{$node.name}</span></a>
                <span class="comments">
                {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))}
                {if $cuantasvaloracionestotales|gt(0)}
                    <span><a href={concat($node.url_alias, '/(ver)/valoraciones')|url()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} comentario{else} comentarios{/if}</a></span>
                {/if}
                {undef $cuantasvaloracionestotales}
                    <a href={concat( 'basket/ajaxadd/', $node.object.id, '/1')|ezurl}class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a></span>
                    <span class="verMas"><a style="background:none; padding-top:10px" href={concat("catalogo/area/", $area_node.name|normalize_path()|explode("_")|implode('-'))|ezurl}>Más obras del Área {$area_node.name}</a></span>
                {undef $area_node}
            </li>
            {/foreach}
        </ul>
    </div>
</div>
