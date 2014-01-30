<li {if $reset}class="reset"{/if}>
    <div class="image">
        {if and(ge(currentdate(),$node.data_map.fecha_inicio_oferta.value.timestamp|int),le(currentdate(),$node.data_map.fecha_fin_oferta.value.timestamp|int))}
           <p><img class="novedad" src={"img_oferta.png"|ezimage} alt="oferta" /></p>
        {/if}
        
        {if $node.data_map.imagen.has_content}
            {def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
                <p><img src={$imagen.data_map.image.content.listadoproductos.url|ezroot()} width="{$imagen.data_map.image.content.listadoproductos.width}" height="{$imagen.data_map.image.content.listadoproductos.height}" class="producto"/></p>
            {undef $imagen}
        {else}
            <p><img src={$node.parent.data_map.area.content.data_map.birrete.content.listadoproductos.url|ezroot()} alt="" class="producto"/></p>    
        {/if}
        {if $node.data_map.programa_experto.content|eq(1)}
                             <div class="pexperto">Programa Experto</div>
                            {/if}
 {if $node.data_map.curso_subvencionable.content|eq(1)}
                           <div class="pexperto" style="text-align:left"><span style="color:maroon">¡CURSO SUBVENCIONADO!</span><br/> <a href={fetch( 'content', 'node', hash( 'node_id', 172)).url_alias|ezurl} style="color:#4B90CC; font-weight:normal">Sepa por qué.</a></div>
 
{/if}

       
    </div>
    
    <div class="wysiwyg">
        
        <h3><a href={$node.url_alias|ezurl()}>{$node.name}</a></h3>
        {if $node.data_map.subtitulo.has_content}
        <p class="spInf">{$node.data_map.subtitulo.content.output.output_text|strip_tags()}</p> 
        {/if}
        <ul>
            {if $node.data_map.ponentes.has_content}
            <li>
                <strong>Ponente:</strong>
                {foreach $node.data_map.ponentes.content.relation_browse as $index => $ponente}
                   {let $pon = fetch('content','node',hash('node_id',$ponente.node_id))}
                       {$pon.data_map.nombre.content}.
                   {/let}
               {/foreach}
            </li>
            {/if}
            {if $node.parent.parent_node_id|ne(76)}
            {if $node.data_map.fecha_inicio.has_content}
            <li>
                <strong>Fecha:</strong> 
                    {attribute_view_gui attribute=$node.data_map.fecha_inicio}
                    {if and( $node.data_map.fecha_de_fin.has_content, $node.data_map.fecha_de_fin.content.timestamp|ne( $node.data_map.fecha_inicio.content.timestamp ) ) }
                    - {attribute_view_gui attribute=$node.data_map.fecha_de_fin}
                    {/if} 
            </li>
            {/if}
            {if $node.data_map.lugar.has_content}
            <li>
                <strong>Impartido en:</strong>
                     {$node.data_map.lugar.content.output.output_text}
            </li>
            {/if}
            {/if}
        </ul>
        
    </div>
                                                                 
     <div class="action">
                                                 {if $nodefrom|ne(74)}
                                                <div class="difPrecios">
                                                    {if $node.data_map.precio.content.has_discount}
                                                    <span class="antes">Antes <span>{$node.data_map.precio.content.price|round()} €</span></span>
                                                    {/if}
                                                    <span class="ahora{if $node.data_map.precio.content.has_discount|not} soloPrecio{/if}">{if $node.data_map.precio.content.has_discount}Ahora{/if} <span>{if $node.data_map.precio.content.has_discount}{$node.data_map.precio.content.discount_price_ex_vat|round()}{else}{$node.data_map.precio.content.price|round()}{/if} €</span></span>
                                                </div>
                                                {/if}
                                                {if $nodefrom|eq(74)}
                                               <span class="frt"><a href="{fetch( 'content', 'node', hash('node_id', 2801 )).url_alias|ezurl_www(no)}/(from)/{$node.node_id}"><img src={"preguntenos.png"|ezimage} alt="pregúntenos" /></a></span>
                                                {else}
                                                {if or(       
                                                      $node.object.contentclass_id|eq( 61 ),
and( $node.data_map.fecha_fin.has_content, $node.data_map.fecha_fin.content.timestamp|gt(currentdate() ) ),
                                                                            and( $node.data_map.fecha_fin.has_content|not, $node.data_map.fecha_inicio.content.timestamp|gt(currentdate() ) ) )
                                                 }  
                                                <span class="frt"><a href={concat("basket/ajaxadd/", $node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a></span>
                                                {/if}
                                                {/if}
                                           </div>

    
</li>
