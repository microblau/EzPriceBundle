<div class="column1 opiniones">
      <div class="versiones">
      <h2>Opiniones más recientes</h2>
       <ul class="clearFix">
      {foreach $testimonios as $ultimas} 
                                            <li>
                                            	<div class="flt">
                                                	<p>"{$ultimas.comentario}"</p>
                                                    <span><span class="nombre">{$ultimas.nombre} {$ultimas.apellidos}. </span>{$ultimas.empresa}</span>
                                                </div>
                                                <div class="frt">
                                                    <div class="opinion">
                                                         <ul>
                                                           {def $im=concat("image_valoracion_",$ultimas.calidad, ".gif")}
                                                               <li><span>Calidad</span>
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                           {undef $im}
                                                               </li>
                                                          {def $im=concat("image_valoracion_",$ultimas.actualizaciones, ".gif")}
                                                               <li><span>Actualizaciones</span>
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                          {undef $im}
                                                               </li>
                                                               <li><span>Facilidad de consulta</span>
                                                               {def $im=concat("image_valoracion_",$ultimas.facilidad, ".gif")}
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                               {undef $im}</li>
                                                           </ul>
                                                    </div>
                                                </div>
                                            </li>
      
      {/foreach}
      </ul>
      <div class="clearFix">
              <span class="verMas frt"><a href={concat( $node.url_alias, "/(ver)/valoraciones")|ezroot()}>{$cuantas} valoraciones de usuarios</a></span>
      </div>
</div></div>

















<!--div class="column1 testimonio">
    <div class="versiones">
        <h2>Nuevas opiniones</h2>
        <ul class="clearFix">
           {$testimonios|attribute(show)}
           
           
            {def $cuantos=$testimonios|count|sub(1)}
      
            {foreach $testimonios as $index => $testimonio}
                <li {if eq($cuantos,$index)}class="reset"{/if}>
                    <div class="flt">
                        <p>{$testimonio.data_map.testimonio.content.output.output_text|strip_tags()}</p>
                        <span><span class="nombre">{$testimonio.data_map.nombre_persona.content}.</span>&nbsp;{$testimonio.data_map.empresa.content}</span>
                    </div>
                    
                    {if $testimono.data_map.foto_testimonio.has_content}
                    {def $foto_testimonio = fetch( 'content', 'object', hash( 'object_id', $testimonio.data_map.foto_testimonio.content.relation_browse.0.contentobject_id ))}                                      
                        <div class="frt">
                            <img src={$foto_testimonio.data_map.image.content.testimonio.url|ezroot()} alt="" />
                        </div>                
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>
</div-->    
