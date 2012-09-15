

		
			
		
			<div id="gridWide" class="consultenos">
								
				<h1>Consúltenos. Estamos deseando atenderle</h1>
			
				<div class="wrap clearFix">
				
					<div class="inner">
				
						<div class="wysiwyg clearFix">
					
							<h2>Elija la forma que prefiera y pónganse en contacto con nosotros.</h2>
                            <div class="consultenosMod">
                            	<div class="wrapConsulta">

                                	<div class="modConsulta">
                                    	<h3 class="title">¿Necesita una respuesta rápida?</h3>
                                        <ul>
										{*	<li class="chat"><a href="">Acceda a nuestro chat</a></li>
											<li class="videoc"><a href="">Acceda a nuestra videoconferencia</a></li>*}
										</ul>
                                    </div>

                                    <ul class="ventajas">
                                    	<li>Atendido por <strong>profesionales</strong></li>
                                        <li><strong>Respuesta inmediata</strong> sobre cualquier producto F.Lefebvre</li>
                                    </ul>
                                    
                                    
                                </div>
                            </div>

                            <div class="otherQuery">
                            	<h3 class="title2">Si lo prefiere también puede...</h3>
                            	<ul>
                                	<li class="personalizado">
                                    	<p><strong><a href={"formularios/necesitaria-mas-informacion"|ezurl}>Recibir trato personalizado</a></strong><span class="textColor"> <a href={"formularios/necesitaria-mas-informacion"|ezurl}>solicite una visita de uno de nuestro asesores</a></span></p>
                                    </li>
                                    <li class="escribenos">

                                    	<p><span class="textColor"><a href="mailto:clientes@efl.es">Escribirnos</a></span>, <strong>le respondemos en 24 horas</strong></p>
                                    </li>
                                    <li class="correo last">
                                    	<strong>Enviar cualquier consulta por correo postal a:</strong>
                                        <span class="address first">Ediciones Francis Lefebvre</span>
										<span class="address">c/ Santiago de Compostela,</span>

										<span class="address">100. 28035 Madrid</span>
                                    </li>
                                    <li class="telefono">
                                    	<strong>Llamar al 91 210 80 00</strong>, o si prefiere, <span class="textColor">le llamamos nosotros</span>
                                    </li>
                                    <li class="fax">
                                    	<strong>Enviar un fax al número<br /> 91 210 80 01</strong>

                                    </li>
                                    <li class="email last">
                                    	<strong>Solicitar asistencia técnica</strong> escribiendo a <a href="mailto:asistenciatecnica@efl.es">asistenciatecnica@efl.es</a>
                                    </li>
                                </ul>
                            </div>
						
					
						</div>

						
					</div>
				
				</div>
                
                <div class="wrap faq">
				
					<div class="inner">
				
						<div class="wysiwyg">
					
							<h2 class="title3">Preguntas frecuentes</h2>
                            <ul class="listFaq">
                            	{def $cats = fetch( 'content', 'list', hash( 'parent_node_id', 80,
                            												 'sort_by', array('priority', true())
                            	))}
                            	{foreach $cats as $cat sequence array( '', '', 'last' ) as $style}
                            	<li {if ne( $style, '')}class="{$style}"{/if}><a href={$cat.url_alias|ezurl()}>{$cat.name}</a></li>
								{/foreach}
                                
                            </ul>

						
					
						</div>
						
					</div>
				
				</div>
			
			
			</div>
				
			
		
			
		
		
