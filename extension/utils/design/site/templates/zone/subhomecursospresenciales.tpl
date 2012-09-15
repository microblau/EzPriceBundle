
                {def $nodo=fetch('content','node',hash('node_id', $param|int))}
            
                
                <div id="content">
                        {* zona 0 *}
                        
                        {if and( is_set( $zones[0].blocks ), $zones[0].blocks|count() )}
                            {foreach $zones[0].blocks as $block}
                                {block_view_gui block=$block nodo=$nodo.node_id}
                            {/foreach}
                        {/if}
                           
                        
                        {* zona 1 *}
                        <div id="cursos">
                            
                            <div class="modType5">
                                                                                        
                                <div class="wrap">
                                    <ul class="tabs clearFix">
                                        
                                        {def $areas=fetch('content','list', hash('parent_node_id', $nodo.node_id,
                                                                                'class_filter_type', 'include',
                                                                                'class_filter_array', array('folder')))}
                                         
                                        
                                        
                                        {foreach $zones[1].blocks as $index => $area}
                                            <li class="cat{$index|inc(1)}{if or(and(is_set( $view_parameters.area), $view_parameters.area|eq($area.name) ), and(is_set( $view_parameters.area)|not, $index|eq(0)))} sel{/if}">
                                                {if and(is_set( $view_parameters.area), $view_parameters.ver|eq($area.name) )}<h2>{else}<a href="{concat($nodo.url_alias, '/(area)/',$area.name)|ezurl(no)}">{/if}{$area.name}{if and( is_set($view_parameters.area, $view_parameters.ver|eq($area.name) )}</h2>{else}</a>{/if}
                                            </li>
                                                {if or(and(is_set( $view_parameters.area), $view_parameters.area|eq($area.name) ), and(is_set( $view_parameters.area)|not, $index|eq(0)))}
                                                    {def $areaSeleccionada=$area.name}
                                                {/if}
                                        {/foreach}
                                    </ul>
                                </div>
                                <div class="description">
                                    {foreach $zones[1].blocks as $block}
                                        {if eq($areaSeleccionada,$block.name)}
                                            {*$block.valid_nodes|attribute(show,1)*}
                                            <ul class="clearFix">        
                                                <li>
                                                    {def $novedad=fetch('content','node',hash('node_id',$block.custom_attributes.novedad|int))}
                                                      {if array(  49, 66, 61, 94 )|contains($novedad.object.contentclass_id)}
                                                    {if and(not($novedad.is_hidden),not($novedad.is_invisible))}
                                                    
                                                    <h3>Novedad</h3>
                                                    <div class="image">
                                                        <img class="novedad" alt="Novedad" src={"txt_novedad.png"|ezimage()} />
                                                    </div>
                                                    <div class="wysiwyg">
                                                        
                                                        
                                                        <h4><a href={$novedad.url_alias|ezurl()}>{$novedad.name}</a></h4>
                                                        {if or($novedad.fecha_inicio.has_content, $novedad.fecha_de_fin.has_content)}
                                                            <span>{$novedad.fecha_inicio} - {$novedad.fecha_de_fin}</span>
                                                        {/if}
                                                    </div>
                                                    <div class="action">
                                                         <a href={concat( 'basket/add/', $novedad.object.id, '/1')|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                   </div>
                                                   {/if}
                                                   {/if}
                                                   {undef $novedad}
                                                </li>
                                                
                                                <li class="reset">
                                                    {def $ofertaDestacada=fetch('content','node',hash('node_id', $block.custom_attributes.ofertaDestacada|int))}
                                                    {if array(  49, 66, 61, 94 )|contains($ofertaDestacada.object.contentclass_id)}
                                                    {if and(not($ofertaDestacada.is_hidden),not($ofertaDestacada.is_invisible))}
                                                    <h3>Oferta destacada</h3>
                                                    <div class="image">
                                                        <img class="novedad" alt="Oferta" src={"img_oferta.png"|ezimage()} />
                                                    </div>
                                                    

                                                    <div class="wysiwyg">
                                                        
                                                        <h4><a href={$ofertaDestacada.url_alias|ezurl()}>{$ofertaDestacada.name}</a></h4>
                                                        {if or($ofertaDestacada.fecha_inicio.has_content, $ofertaDestacada.fecha_de_fin.has_content)}
                                                            <span>{$ofertaDestacada.fecha_inicio} - {$ofertaDestacada.fecha_de_fin}</span>
                                                        {/if}
                                                    </div>
                                                    <div class="action">
                                                        <a href={concat( 'basket/add/', $ofertaDestacada.object.id, '/1')|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                    </div>
                                                    {/if}
                                                    {/if}
                                                    {undef $ofertaDestacada}
                                                </li>
                                            </ul>

                                                                                      
                                            <div class="cursosRel">
                                                <h3>Otros cursos para este área...</h3>
                                                <div class="wrap">
                                                    <div class="description">
                                                        <ul>
                                                            
                                                            {foreach $block.valid_nodes as $index => $curso}
                                                            {if and(not($curso.is_hidden),not($curso.is_invisible))}
                                                            <li{cond($index|eq($block.valid_nodes|count|dec(1)),' class="reset"')}>
                                                                <div class="wysiwyg">
                                                                    <h4><a href={$curso.url_alias|ezurl}>{$curso.name}</a></h4>
                                                                    {if or($curso.data_map.fecha_inicio.has_content, $curso.data_map.fecha_de_fin.has_content)}
                                                                        <span>
                                                                            {$curso.data_map.fecha_inicio.content.timestamp|datetime('custom', '%d/%m/%Y')} 
                                                                            {if and( $curso.data_map.fecha_fin.has_content, $curso.data_map.fecha_fin.content.timestamp|ne($curso.data_map.fecha_de_inicio.content.timestamp) )}- {$curso.data_map.fecha_fin.content.timestamp|datetime('custom', '%d/%m/%Y')} {/if}</span>
                                                                    {/if}
                                                                </div>
                                                                <div class="action">
                                                                    {if 
                                                                        and( $curso.object.contentclass_id|ne(61) , 
                                                                        or( 
                                                                            and( $curso.data_map.fecha_fin.has_content, $curso.data_map.fecha_fin.content.timestamp|lt(currentdate() ) ),
                                                                            and( $curso.data_map.fecha_fin.has_content|not, $curso.data_map.fecha_inicio.content.timestamp|lt(currentdate() ) )
                                                                        ) ) 
                                                                        }
                                                                    {else}
                                                                    <a href={concat( 'basket/add/', $curso.object.id, '/1')|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                                    {/if}
                                                               </div>
                                                            </li>
                                                            {/if}
                                                            {/foreach}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                    {/foreach}
                                </div>
                                
                                {* zona 2 *}
                                {if and(is_set( $zones[2].blocks ), $zones[3].blocks|count() )}
                                <div class="cursosFormacion clearFix">
                                    <div class="wysiwyg">
                                        <span class="verMas"><a href={fetch('content', 'node', hash( 'node_id', 1457)).url_alias|ezurl()}>¿Quiere estar al día de nuestra oferta formativa?</a></span>
                                        {*
                                        <form action="" method="post">
                                            <label for="informacion">Quiero recibir información en</label>
                                            <select id="informacion" name="informacion">
                                                <option selected="selected">Mayo</option>
                                            </select>
                                        </form>
                                         *}
                                    </div>
                                    <div class="action">
                                        
                                        {def $path = cond(  $view_parameters.area|eq(''), 'fiscal', $view_parameters.area|normalize_path()|explode('_')|implode('-') )}
                                        <a href={concat("formacion-presencial/", $path)|ezurl}><img src={"btn_verCursos.gif"|ezimage} alt="" /></a>
                                    </div>
                                </div>
                                {/if}
                                
                            </div>
                            
                        </div>
                        
                        
                        <div id="gridType7">
                                                        
                            <div class="wrap clearFix">
                        
		                        {* zona 3 *}
		                           
		                            {if and( is_set( $zones[3].blocks ), $zones[3].blocks|count() )}
		                            <div class="columnType1 flt">
		                                {foreach $zones[3].blocks as $block}
		                                    {block_view_gui block=$block}
		                                {/foreach}
		                            </div>
		                            {/if}                         
		                        
		                        
		                        {* zona 4 *}
		                           
	                              {if and( is_set( $zones[4].blocks ), $zones[4].blocks|count() )}
	                              <div class="columnType2 frt">
	                                {foreach $zones[4].blocks as $block}
	                                    {block_view_gui block=$block}
	                                {/foreach}
	                              </div>
	                              {/if}                        
		                        
                            </div>
                        </div>
                    
                </div>
            </div>

            
                
