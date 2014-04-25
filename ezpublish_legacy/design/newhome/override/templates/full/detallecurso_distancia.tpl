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
                                <li {if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('objetivos'))}class="sel"{/if}>
                                {if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('objetivos') )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Objetivos{if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('objetivos') )}</h2>{else}</a>{/if}
                                </li>
                                
                                {if $node.data_map.programa.has_content}
                                <li {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('programa') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('programa') )}<h2>{else}<a href="{concat($node.url_alias, '/(ver)/programa')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Programa{if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('programa') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                                                
                                {if $node.data_map.metodologia.has_content}
                                <li {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('metodologia') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('metodologia') )}<h2>{else}<a href="{concat($node.url_alias, '/(ver)/metodologia')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Metodología{if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('metodologia') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.tutorias.has_content}
                                <li {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('tutorias') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('tutorias') )}<h2>{else}<a href="{concat($node.url_alias, '/(ver)/tutorias')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Tutorías{if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('tutorias') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.materiales.has_content}
                                <li {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('materiales') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('materiales') )}<h2>{else}<a href="{concat($node.url_alias, '/(ver)/materiales')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Materiales{if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('materiales') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.duracion.has_content}
                                <li {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('duracion') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('duracion') )}<h2>{else}<a href="{concat($node.url_alias, '/(ver)/duracion')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Duración{if and(is_set( $view_parameters.ver), $view_parameters.ver|eq('duracion') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                            </ul>
                            </div>
                            <div class="cont cursoDet clearFix">
                                
                                <div class="column1">
                                    {if or(is_set($view_parameters.ver)|not, $view_parameters.ver|eq('objetivos'))}
                                        <h2>Objetivos del curso</h2>
                                        {$node.data_map.objetivos.content.output.output_text}
                                    {elseif and(is_set($view_parameters.ver), $view_parameters.ver|eq('programa'))}
                                       {*<h2>Programa</h2>*}
                                        {$node.data_map.programa.content.output.output_text}
                                    {elseif and(is_set($view_parameters.ver), $view_parameters.ver|eq('metodologia'))}
                                       {*<h2>Metodología</h2>*}
                                       {$node.data_map.metodologia.content.output.output_text}
                                    {elseif and(is_set($view_parameters.ver), $view_parameters.ver|eq('tutorias'))}
                                       {*<h2>Tutorías</h2>*}
                                       {$node.data_map.tutorias.content.output.output_text}
                                    {elseif and(is_set($view_parameters.ver), $view_parameters.ver|eq('materiales'))}
                                       {*<h2>Materiales</h2>*}
                                       {$node.data_map.materiales.content.output.output_text}
                                    {elseif and(is_set($view_parameters.ver), $view_parameters.ver|eq('duracion'))}
                                       {*<h2>Duración</h2>*}
                                       {$node.data_map.duracion.content.output.output_text}
                                    {/if}
                                </div>
                                
                                {include uri="design:common/ficha_formacion/testimonios.tpl"}
                                
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

            

        
