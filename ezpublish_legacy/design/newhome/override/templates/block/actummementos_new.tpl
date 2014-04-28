                {ezcss_require( array( 'css::tabscss' ) ) }
                <div id="modActum">
                    <h2>{$block.custom_attributes.titulo}</h2>
                    <div id="categoriesTabs">
                        <ul class="tabs clearFix">
                            {def $canales = fetch('content', 'list', hash('parent_node_id', 554,
                                                                          'sort_by', array( 'priority', true() )
                            ))}
                            {foreach $canales as $index => $canal }
                            <li class="cat{$index|sum(1)}{if eq( $index, 0)} sel{/if}"><a href={concat( 'ezjscore/call/portadas::mementum::', $canal.node_id)|ezurl}>{if eq( $index, 0)}<strong>{/if}{$canal.name}{if eq($index,0)}</strong>{/if}</a></li>
                            {/foreach}                                                       
                        </ul>
                        <div class="wrap">  
                            <ul class="wrapAjaxContent">
                                {def $items = fetch('content', 'list', hash('parent_node_id', $canales[0].node_id,
                                                                          'sort_by', array( 'published', false() ),
                                                                           'limit', 5
                            ))}
                                {foreach $items as $item}                                
                                <li><a target="_blank" href="{$item.data_map.url.content|wash( xhtml )}">{$item.name} - {$item.object.published|datetime('custom', '%d/%m/%Y')}</a></li>
                                {/foreach}
                                <li style="font-size:10px"><a target="_blank" href="{$items.0.parent.data_map.origen.content}">ver más noticias</a></li>
                                  </ul>                        
                           
                        </div>
                        
                    </div>
                    					<div id="modMemGrat">
						<a href="http://blog.efl.es" target="_blank"><img src={"btn_blogAct.gif"|ezimage} alt="¿Conoce nuestro blog ACTUM?" /></a>
						<div class="inner">
						
							<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow">
								<h3>Suscríbase GRATIS a las alertas jurídicas</h3>
								<ul>
									<li>

										<label for="em">Email*:</label>
										<input type="text" id="em" name="email" class="text" />
									</li>
									<li>
										<label for="tem">Tema de la alerta:*</label>
										<select id="tem" name="tem">
											              <option value="-1"></option>
                                            <option value="0">Actualidad jurídica</option>
                                            <option value="1">Artículos doctrinales</option>

										</select>
									</li>
                                                                        <li>
                                                                            <label class="check" for="juridicas_legal"> <input type="checkbox" id="juridicas_legal" name="ContentObjectAttribute_data_boolean_243194" /> He leído y acepto las condiciones de la <a class="lb" style="white-space: normal" id="politicaligthBox" href={'lightbox/ver/19526'|ezurl}>Política de Privacidad</a> y el <a class="lb" id="avisoLightbox" href={'lightbox/ver/292'|ezurl}>Aviso Legal</a></label>
                                                                        </li>
								</ul>
                                   <input type="hidden" value="" name="uri"  id="uri"/>
                                <input type="hidden" name="loc" value="es_ES"/>
								<span class="submit"><input type="image" src={"btn_enviar-solicitud.png"|ezimage} alt="enviar solicitud" /></span>
							</form> 
						
						
						</div>
					
					</div>

                </div>              
