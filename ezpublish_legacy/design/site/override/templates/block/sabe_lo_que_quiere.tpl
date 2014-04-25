 {ezscript_require( array( 'ezjsc::jquery', 'js::catalogohome' ) ) }
 <h2>{$block.custom_attributes.titulo}</h2>
                    <div class="wrap clearFix">
                        <div id="modTambien">
                            <div id="modSoyAbonado" class="module">
                                <h3>Soy abonado</h3>
                                <p>Acceda a sus productos y servicios</p>
                                <span class="verMas"><a href={"acceso-abonados"|ezurl}>Portal Soluciones Memento</a></span>
								<span class="verMas"><a href={"RecursosPSM"|ezurl}>Recursos PSM</a></span>
                                <span class="verMas"><a href="http://www.individual.efl.es/ActumPublic/ActumG/actgrat-listado.jsp" target="_blank">Extras Mementos</a></span>
                            </div>
                            <div id="modSoyCliente" class="module">
                                <h3>Soy cliente</h3>
                                <p>Acceda y gestione sus facturas y pedidos</p>
                                <span class="verMas"><a href="http://espacioclientes.efl.es">Mi área privada</a></span>
                            </div>
                            <div id="modCatalogo" class="module">
                                 <h3>Áreas de interés</h3>
                                <ul>
                                    {def $areas = fetch( 'content', 'list', hash( 'parent_node_id', 143, 'sort_by', array( 'name', true() ),
                                                                                  'attribute_filter', array( array( 'area_interes/aparece_en_editorial', '=', 1 ) )  
                                     ))}
                                    {foreach $areas as $area}
                                        <li><a href={concat( "catalogo/area/", $area.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$area.name}</a></li>
                                    {/foreach}
                                    {undef $areas}                                    
                                </ul>
                            </div>
                            <div id="modAreas" class="module">
                                <h3>Nuestro catálogo</h3>
                                <form action={"buscador/catalogo"|ezurl} method="post">
                                    <label for="quieroVer">Quiero un ejemplar de</label>
                                    <select id="quieroVer" name="quieroVer">
                                        <option value="-1"></option>
                                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                                                        'class_filter_type', 'include', 
                                                                                        'class_filter_array', array( 'folder' ), 
                                                                                        'sort_by', array( 'name', true() ) ))}
                                            {foreach $folders as $folder}
                                                <option value="{$folder.node_id}">{$folder.name}</option>
                                            {/foreach}
                                         {undef $folders}
                                    </select>
                                </form>
                            </div>
                            <div id="modNecesitas" class="module">
                                <h3>¿Qué necesita?</h3>
                                <ul>
                                    <li><a href={$block.custom_attributes.enlace_1|ezurl()}>{$block.custom_attributes.texto_1}</a></li>
                                    <li><a href={$block.custom_attributes.enlace_2|ezurl()}>{$block.custom_attributes.texto_2}</a></li>
                                    <li><a href={$block.custom_attributes.enlace_3|ezurl()}>{$block.custom_attributes.texto_3}</a></li>
                                    <li><a href="http://solucionesmemento-indiv.efl.es/ActumPublic/ActumRss/suscripcion-email.jsp" target="_blank"> Necesito alertas jurídicas gratuitas</a></li>
                                </ul>
                            </div>
                            <div id="modColectivos" class="module reset">
                                <h3>Colectivos</h3>
                                <p>Acceda a contenidos exclusivos</p>
                                <span class="verMas"><a href={"catalogo/sector/colectivo-asociacion-profesional"|ezurl}>Entrar a mi área privada</a></span>
                                <span class="verMas"><a href={"colectivos/alta-colectivo"|ezurl}>¿Aún no se beneficia de estas ventajas?</a></span>
                            </div>
                        
                        </div>
