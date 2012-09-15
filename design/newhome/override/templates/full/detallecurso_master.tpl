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
                            <ul class="tabs">
                          
                                
                                {if or($node.data_map.presentacion.has_content, $node.data_map.objetivos.has_content, $node.data_map.destinatarios.has_content)}
                                <li {if or(is_set( $view_parameters.info)|not, $view_parameters.info|eq('presentacion') )}class="sel"{/if}>
                                    {if or(is_set( $view_parameters.info)|not, $view_parameters.info|eq('presentacion') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/presentacion')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Presentación{if or( is_set($view_parameters.info)|not, $view_parameters.info|eq('presentacion') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                
                                {if $node.data_map.asignaturas_profesorado.has_content}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('asignaturas') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('asignaturas') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/asignaturas')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Asignaturas y profesorado{if and( is_set($view_parameters.info, $view_parameters.info|eq('asignaturas') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.metodologia.has_content}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('metodologia') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('metodologia') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/metodologia')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Metodologia{if and( is_set($view_parameters.info, $view_parameters.info|eq('metodologia') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if or($node.data_map.titulacion.has_content, $node.data_map.valor.has_content)}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('titulacion') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('titulacion') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/titulacion')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Titulación{if and( is_set($view_parameters.info, $view_parameters.info|eq('titulacion') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                
                                {if or($node.data_map.precio.has_content, $node.data_map.becas.has_content)}
                                <li {if and(is_set( $view_parameters.info), $view_parameters.info|eq('precio') )}class="sel"{/if}>
                                    {if and(is_set( $view_parameters.info), $view_parameters.info|eq('precio') )}<h2>{else}<a href="{concat($node.url_alias, '/(info)/precio')|ezurl(no)}{if is_set($view_parameters.cursos)}/(cursos)/{$view_parameters.cursos}{/if}#cursoDetalle">{/if}Precio{if and( is_set($view_parameters.info, $view_parameters.info|eq('precio') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                
                            </ul>
                            </div>
                            <div class="cont cursoDet clearFix">
                                
                                <div class="column1">
                                    {if or(is_set($view_parameters.info)|not, $view_parameters.info|eq('presentacion'))}
                                        {if $node.data_map.presentacion.has_content}
                                            {*<h2>Presentacion</h2>*}
                                            {$node.data_map.presentacion.content.output.output_text}
                                        {/if}
                                        {if $node.data_map.objetivos.has_content}
                                            {*<h2>Objetivos del curso</h2>*}
                                            {$node.data_map.objetivos.content.output.output_text}
                                        {/if}
                                        {if $node.data_map.destinatarios.has_content}
                                            {*<h2>Destinatarios</h2>*}
                                            {$node.data_map.destinatarios.content.output.output_text}
                                        {/if}
                                    {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('asignaturas'))}
                                        {if $node.data_map.asignaturas_profesorado.has_content}
                                            {*<h2>Asignaturas y profesorado</h2>*}
                                            {$node.data_map.asignaturas_profesorado.content.output.output_text}
                                        {/if}
                                    {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('metodologia'))}
                                        {if $node.data_map.metodologia.has_content}
                                            {*<h2>Metodología</h2>*}
                                            {$node.data_map.metodologia.content.output.output_text}
                                        {/if}
                                        {if $node.data_map.horarios.has_content}
                                            {*<h2>Horarios</h2>*}
                                            {$node.data_map.horarios.content.output.output_text}
                                        {/if}
                                    {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('titulacion'))}
                                        {if $node.data_map.titulacion.has_content}
                                            {*<h2>Titulación</h2>*}
                                            {$node.data_map.titulacion.content.output.output_text}
                                        {/if}
                                        {if $node.data_map.valor.has_content}
                                            {*<h2>Valor añadido</h2>*}
                                            {$node.data_map.valor.content.output.output_text}
                                        {/if}
                                    {elseif and(is_set($view_parameters.info), $view_parameters.info|eq('precio'))}
                                       {*<h2>Precio y forma de pago</h2>*}
                                       Precio:{$node.data_map.precio.content.price|l10n(clean_currency)}<br /> 
                                       Precio aplazado:
                                       {foreach $node.data_map.precio_aplazado.content.price_list as $index => $precio}
                                            {$precio.value|l10n(clean_currency)}<br /> 
                                       {/foreach}
                                       
                                       {if $node.data_map.becas.has_content}
                                           {*<h2>Becas</h2>*}
                                           {$node.data_map.becas.content.output.output_text}
                                       {/if}
                                    
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

            

        
