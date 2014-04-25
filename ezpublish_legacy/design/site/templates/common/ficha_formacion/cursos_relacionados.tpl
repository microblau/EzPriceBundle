{if or($node.data_map.cursos_relacionados.has_content, $node.data_map.cursos_medida_relacionados.has_content)}
                    <div class="modType4 type2 cursos clearFix">
                        <div class="descripcion">
                            <ul class="tabs">
                                {if $node.data_map.cursos_relacionados.has_content}
                                    <li {if or(is_set($view_parameters.cursos)|not, $view_parameters.cursos|eq('cursos_relacionados'))}class="sel"{/if}>
                                        {if or(is_set($view_parameters.cursos)|not, $view_parameters.cursos|eq('cursos_relacionados'))}<h2>{else}<a href="{concat($node.url_alias, '/(cursos)/cursos_relacionados')|ezurl(no)}{if is_set($view_parameters.ver)}/(ver)/{$view_parameters.ver}{/if}#cursoDetalle">{/if}Cursos relacionados{if or(is_set($view_parameters.cursos)|not, $view_parameters.cursos|eq('cursos_relacionados'))}</h2>{else}</a>{/if}
                                    </li>
                                {/if}
                                    {if $node.data_map.cursos_medida_relacionados.has_content}
                                    <li {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('cursos_personalizados'))}class="sel"{/if}>
                                        {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('cursos_personalizados'))}<h2>{else}<a href="{concat($node.url_alias, '/(cursos)/cursos_personalizados')|ezurl(no)}{if is_set($view_parameters.ver)}/(ver)/{$view_parameters.ver}{/if}#cursoDetalle">{/if}Cursos personalizados{if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('cursos_personalizados'))}</h2>{else}</a>{/if}
                                    </li>
                                {/if}
                                {if $node.data_map.econferencias_relacionadas.has_content}
                                    <li {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('econference'))}class="sel"{/if}>
                                        {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('econference'))}<h2>{else}<a href="{concat($node.url_alias, '/(cursos)/econference')|ezurl(no)}{if is_set($view_parameters.ver)}/(ver)/{$view_parameters.ver}{/if}#cursoDetalle">{/if}eConferencias{if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('econference'))}</h2>{else}</a>{/if}
                                    </li>
                                {/if}
                            </ul>
                            
                            <div class="cont">
                                <ul>
                                {if or(is_set($view_parameters.cursos)|not, $view_parameters.cursos|eq('cursos_relacionados'))}
                                    {foreach $node.data_map.cursos_relacionados.content.relation_browse as $index => $cursos}
                                        {let $curso = fetch('content','node',hash('node_id',$cursos.node_id))}
                                        {if and(not($curso.is_hidden),not($curso.is_invisible))}
                                           <li>
                                                <a href="{$curso.url_alias|ezurl(no)}">{$curso.data_map.nombre.content}</a>
                                                    {if $curso.data_map.fecha_inicio.has_content}
                                                <span class="date">{$curso.data_map.fecha_inicio.data_int|l10n('shortdate')}</span>
                                                {/if}
                                           
                                           </li>
                                         {/if}
                                         {/let}
                                    {/foreach}
                                {/if}
                                
                                {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('cursos_personalizados'))}
                                    {foreach $node.data_map.cursos_medida_relacionados.content.relation_browse as $index => $cursos}
                                        {let $curso = fetch('content','node',hash('node_id',$cursos.node_id))}
                                        {if and(not($curso.is_hidden),not($curso.is_invisible))}
                                           <li>
                                                <a href="{$curso.url_alias|ezurl(no)}">{$curso.data_map.nombre.content}</a>
      {if $curso.data_map.fecha_inicio.has_content}
                                                <span class="date">{$curso.data_map.fecha_inicio.data_int|l10n('shortdate')}</span>
{/if}
                                           </li>
                                        {/if}
                                        {/let}
                                    {/foreach}
                                {/if}
                                
                                {if and(is_set($view_parameters.cursos), $view_parameters.cursos|eq('econference'))}
                                    {foreach $node.data_map.econferencias_relacionadas.content.relation_browse as $index => $cursos}
                                        {let $curso = fetch('content','node',hash('node_id',$cursos.node_id))}
                                        {if and(not($curso.is_hidden),not($curso.is_invisible))}
                                           <li>
                                                <a href="{$curso.url_alias|ezurl(no)}">{$curso.data_map.nombre.content}</a>
      {if $curso.data_map.fecha_inicio.has_content}
                                                <span class="date">{$curso.data_map.fecha_inicio.data_int|l10n('shortdate')}</span>
{/if}
                                           </li>
                                        {/if}
                                        {/let}
                                    {/foreach}
                                {/if}
                                
                                </ul>
                            </div>
                        </div>

                    </div>
                    {/if}  
