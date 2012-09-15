                  {ezscript_require( array( 'ezjsc::jquery', 'buscadorhome.js' ) ) }
                  <h2>{$block.custom_attributes.titulo}</h2>
                    <div class="wrap modNovedades clearFix">
                        <div id="modResultados">
                            <form action={"buscador/resultados"|ezurl} method="post" class="clearFix" id="formhome">
                                <ul>
                                    <li class="uno">
                                        <label for="quienEres">{$block.custom_attributes.combo1}</label>
                                        <select id="quienEres" name="quienEres">
                                            <option value="0">Todos</option>
                                            {def $sectores = fetch( 'content', 'list', hash( 'parent_node_id', 157, 'sort_by', array( 'name', true() ) ))}
                                            {foreach $sectores as $sector}
                                                <option value="{$sector.object.id}">{$sector.name}</option>
                                            {/foreach}
                                            {undef $sector}
                                        </select>
                                    </li>
                                    <li class="dos">
                                        <label for="area">{$block.custom_attributes.combo2}</label>
                                        <select id="area" name="area">
                                            <option selected="selected" value="0">Seleccione un área</option>
                                            {def $areas = fetch( 'content', 'list', hash( 'parent_node_id', 143, 'sort_by', array( 'name', true() ) ))}
                                            {foreach $areas as $area}
                                                <option value="{$area.object.id}">{$area.name}</option>
                                            {/foreach}
                                            {undef $areas}
                                        </select>
                                    </li>
                                    <li class="tres">
                                        <label for="formato">{$block.custom_attributes.combo3}</label>
                                        <select id="formato" name="formato">
                                            <option selected="selected" value="0">Todos</option>
                                            {def $formatos = fetch( 'content', 'list', hash( 'parent_node_id', 156, 'sort_by', array( 'name', true() ) ))}
                                            {foreach $formatos as $formato}
                                                <option value="{$formato.object.id}">{$formato.name}</option>
                                            {/foreach}
                                            {undef $formato}
                                        </select>
                                    </li>
                                </ul>
                                <button type="submit" class="frt" id="btnresultados"><span>Ver resultados</span></button>
                            </form>
                        