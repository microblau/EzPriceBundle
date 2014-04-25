{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 3 )}    

{include uri="design:common/ficha_formacion/destacado_principal.tpl"}


</div>
</div>

            <div id="gridTwoColumnsTypeC" class="clearFix">
                
                
                <div id="cursoDetalle" class="columnType1 flt clearFix">
                    <div class="modType4">
                        <div class="descripcion">
                            <div class="clear">
                        	  <span class="volver {if eq($tabscount,6)}addmargin{/if}"><a href={$node.parent.url_alias|ezurl}
>Volver al listado</a></span>
                            <ul class="tabs ">
                                <li {if or( is_set( $view_parameters.info )|not, $view_parameters.info|eq('objetivos'))}class="sel"{/if}>
                                {if or( is_set( $view_parameters.info )|not, $view_parameters.info|eq('objetivos') )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Objetivos{if or( is_set( $view_parameters.info )|not, $view_parameters.info|eq('objetivos') )}</h2>{else}</a>{/if}
                                </li>
                                
                                {if $node.data_map.temario.has_content}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('temario') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('temario') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/temario')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}{if $node.data_map.curso_medida.content|eq('0')}Temario{else}Programa{/if}{if and(is_set( $view_parameters.info), $view_parameters.info|eq('temario') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                                                
                                {if $node.data_map.ponentes.has_content}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('ponentes') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('ponentes') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/ponentes')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Ponentes{if and(is_set( $view_parameters.info), $view_parameters.info|eq('ponentes') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if or( $node.data_map.lugar.has_content, $node.data_map.horario.has_content )}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('fechas') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('fechas') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/fechas')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Fechas y lugar de celebración{if and(is_set( $view_parameters.info), $view_parameters.info|eq('fechas') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                            </ul>
                            </div>
                            <div class="cont cursoDet clearFix">
                            
                                {if and(is_set($view_parameters.info), $view_parameters.info|eq('ponentes'))}
                                <div class="column1 testimonio">
                                  {*<h2>Ponentes</h2>*}
                                   <ul class="clearFix">
                                   {foreach $node.data_map.ponentes.content.relation_browse as $index => $ponente}
                                       {let $pon = fetch('content','node',hash('node_id',$ponente.node_id))}
                                       <li>
                                          <div class="flt">
                                            <span><span class="nombre">{$pon.data_map.nombre.content}.</span> {$pon.data_map.cargo.content} {$pon.data_map.empresa.content}</span>
                                            <p>{$pon.data_map.informacion_ponente.content.output.output_text|strip_tags()}</p>
                                          </div>
                                          {*
                                          {if $pon.data_map.foto_ponente.has_content}
                                               <div class="frt">
                                                   {def $foto_ponente = fetch( 'content', 'object', hash( 'object_id', $pon.data_map.foto_ponente.content.relation_browse.0.contentobject_id ))}
                                                   <img src={$foto_ponente.data_map.image.content.testimonio.url|ezroot()} alt=""/>
                                                   {/undef $foto_ponente}
                                               </div>
                                          {/if}
                                           *}
                                       </li>
                                       {/let}
                                   {/foreach}
                                   </ul>
                                </div>
                                {else}
                                
                                <div class="column1">
	                                {if or(is_set($view_parameters.info)|not, $view_parameters.info|eq('objetivos'))}
	                                    <h2>Objetivos del curso</h2>
	                                    {$node.data_map.objetivos.content.output.output_text}
	                                {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('temario'))}
	                                   {*<h2>{if $node.data_map.curso_medida.content|eq('0')}Temario{else}Programa{/if}</h2>*}
	                                    {$node.data_map.temario.content.output.output_text}
	                                {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('fechas'))}
	                                 {*  <h2>Fecha y lugar de celebración</h2>*}
                                        <div class="spInf">
                                        {$node.data_map.horario.content.output.output_text}
	                                  
                                        </div>
                                        {$node.data_map.lugar.content.output.output_text}
	                                {/if}
                                </div>
                                {/if}
                                
                                {if and(is_set($view_parameters.info), $view_parameters.info|eq('ponentes'))|not}
                                {include uri="design:common/ficha_formacion/testimonios.tpl"}
                                {/if}
                            </div>
                        </div>
                    </div>
                    
                    {include uri="design:common/ficha_formacion/cursos_relacionados.tpl"} 
                    
                    {include uri="design:common/ficha_formacion/prod_relacionados.tpl"}
                                 
                </div>      
                    
                <div class="sideBar frt">

                    {include uri='design:common/facilitadores.tpl'}
                    
                    {include uri='design:common/ficha/modVentajas.tpl'}
                    
                    {include uri='design:common/ficha_formacion/faqs.tpl'}
                </div>
                            
            </div>

            

        
