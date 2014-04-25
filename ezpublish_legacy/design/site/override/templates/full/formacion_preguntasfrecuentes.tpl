{ezscript_require( array( 'alberto.js' ) )}
{ezpagedata_set( 'menuoption', 3 )}  

    <div id="commonGrid" class="clearFix">
    
        <div id="subNavBar">
            {if $node.parent.node_id|eq(87)}
                <div class="currentSection"><a href={$node.parent.url_alias|ezurl()}><span>{$node.parent.parent.name}</span></a></div>
                <ul>
                    {include uri='design:formacion/menu.tpl' check=$node.parent.parent actual=$node.parent.name|normalize_path()|explode('_')|implode('-')}
                </ul>
            {else}
            <div class="currentSection"><a href={$node.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
            <ul>
                {include uri='design:formacion/menu.tpl' check=$node.parent actual=$node.name|normalize_path()|explode('_')|implode('-')}
            </ul>
            {/if}
        </div>
    
        
        <div id="content" class="valores">
            <div id="modType2">
                <h1>Preguntas Frecuentes</h1>
                    
                    <div class="wrap2 clearFix">                            
                            <div class="description">
                                <div class="busFaq">
                                
                                {def $listado_tipos_faq=fetch( 'content', 'list', hash( 'parent_node_id', 87, 'sort_by', $node.sort_array ))}
                                    
                                    <form action="" method="post" id="faqForm" name="faqForm">
                                        <ul>
                                            <li>
                                                <label for="tipoPregunta">Seleccione el tipo de preguntas que desea consultar:</label>
                                                
                                                <select id="tipoPregunta" name="tipoPregunta" onchange="ActualizaFAQS(document.faqForm.tipoPregunta.value)">
                                                    <option value=0 selected="selected">---</option>    
                                                    {foreach $listado_tipos_faq as $tipo_faq}
                                                        <option value={concat( 'http://', ezsys( 'hostname' ), $tipo_faq.url_alias|ezurl( 'no') )}>{$tipo_faq.name}</option>
                                                    {/foreach}
                                                </select>
                                                
                                            </li>
                                        </ul>                                                           
                                    </form>     
                                    
                                {undef $listado_tipos_faq}
                                
                                </div>
                                
                            {if eq($node.node_id,87)|not}
                            
                                <div id="faq">
                                    <h2>{$node.name}</h2>
                                    
                                    {def $listado_preguntas=fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id, 'sort_by', $node.sort_array ))}
                                    
                                    <div class="preguntas">
                                        <ul>
                                            
                                            {foreach $listado_preguntas as $pregunta}
                                                <li><a href="#p_{$pregunta.node_id}">{$pregunta.data_map.texto_pregunta.content.output.output_text}</a></li>
                                            {/foreach}
                                            
                                        </ul>
                                    </div>
                                    
                                    <div class="respuestas">
                                        <ul>
                                        
                                            {foreach $listado_preguntas as $pregunta}
                                                <li>
                                                    <h3><a name="p_{$pregunta.node_id}">{$pregunta.data_map.texto_pregunta.content.output.output_text}</a></h3>
                                                    <div class="wysiwyg">
                                                        <p>{$pregunta.data_map.texto_respuesta.content.output.output_text}</p>
                                                    </div>
                                                    <span class="ancla"><a href="#wrapper">Subir</a></span>
                                                </li>
                                            {/foreach}
                                            
                                        </ul>
                                    </div>
                                </div>
                                
                            {/if}
                            {undef $listado_preguntas}
                                
                            </div>                                                                                                  
                        </div>
            </div>
        </div>
    </div>
