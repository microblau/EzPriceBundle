{def $nodo=fetch('content','node',hash('node_id',$param|int))}
<div id="content">
    {* zone 0 *}                    
        {if and( is_set( $zones[0].blocks ), $zones[0].blocks|count() )}
            {foreach $zones[0].blocks as $block}
                {block_view_gui block=$block padre=$padre view_parameters=$view_parameters}
            {/foreach}
        {/if}      
        
    {* zone 1 *}      
     <div id="listadoAreas">
         {if and( is_set( $zones[1].blocks ), $zones[1].blocks|count() )}
            <ul>
            {foreach $zones[1].blocks as $index => $block}
            <li{cond(eq($index|mod(2),1),' class="reset"')}>

                <div class="area">
                    <h2>{$block.name}</h2>                                                         
                    <div class="wrap">
                        <div class="inner clearFix">
                            <div class="detail clearFix">
                                {def $ofertaDestacada=fetch('content','node',hash('node_id',$block.custom_attributes.oferta|int))}
                                {if and(not($ofertaDestacada.is_hidden),not($ofertaDestacada.is_invisible))}                                                                               
                                <img src={"img_oferta.png"|ezimage()} alt="oferta" />
                                <h3><a href={$ofertaDestacada.url_alias|ezurl}>{$ofertaDestacada.name}</a></h3>
                                <span>{$ofertaDestacada.fecha_inicio|datetime('custom', '%d %F')} - {$ofertaDestacada.fecha_de_fin|datetime('custom', '%d %F'}</span>
                                <div class="action"><span class="btn"><a href={concat( "basket/add/", $ofertaDestacada.object.id, '/1')|ezurl}>Lo quiero</a><span class="cL sp">&nbsp;</span><span class="cR sp">&nbsp;</span></span></div>
                                {/if}
                                {undef $ofertaDestacada}
                                
                            </div>
                            <h3>Otros cursos para este área...</h3>
                            <div class="otros">
                                <ul>
                                    {foreach $block.valid_nodes as $indiceCursos => $curso}
                                    {if and(not($curso.is_hidden),not($curso.is_invisible))}
                                    <li{cond(eq($indiceCursos|inc(1),$block.valid_nodes|count),' class="reset"')}>                                                                
                                            <h4><a href={$curso.url_alias|ezurl}>{$curso.name}</a></h4>

                                            <div class="info">
                                                <span>{$curso.fecha_inicio|datetime('custom', '%d %F')} - {$curso.fecha_de_fin|datetime('custom', '%d %F')}</span>
                                                <span>Ponente{cond($curso.data_map.ponentes.content.relation_browse|count|gt(1),'s')}:
	                                                {foreach $curso.data_map.ponentes.content.relation_browse as $index => $pon}
	                                                   {def $quien=fetch('content','node',hash('node_id', $pon.node_id|int))}
                                                       {$quien.data_map.nombre.content} 
                                                       {undef $quien}
	                                                {/foreach}
                                                 </span>
                                            </div>
                                            <div class="action"><span class="btn"><a href={concat( "basket/add/", $curso.object.id, '/1')|ezurl}>Lo quiero</a><span class="cL sp">&nbsp;</span><span class="cR sp">&nbsp;</span></span></div>
                                        </li>
                                     {/if}
                                     {/foreach}                              
                                </ul>

                            </div>
                            {def $areaRelacionada=fetch('content','node',hash('node_id', $block.custom_attributes.areaRelacionada|int))}
                            
                            <span class="verMas">
                            <a href={concat('formacion/',$nodo.url_alias,'/',$areaRelacionada.name)|ezurl()}>Ver todos los <strong>cursos de {$block.name}</strong></a></span>
                            {undef $areaRelacionada}
                        </div>
                    </div>
                </div>
            </li>
            {/foreach}
            </ul>
         {/if}                   
    </div>
</div>
{undef $nodo}            
                
                

          
                