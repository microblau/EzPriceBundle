
{ezpagedata_set( 'bodyclass', 'homeMementos' )}

		{def $zones = $node.data_map.bloques.content.zones}
<div id="address-{$zones[0].blocks[0].zone_id}-{$zones[0].blocks[0].id}">
        {block_view_gui block=$zones[0].blocks[0] zone=$zones[0] attribute=$attribute}
    </div>
			<div id="areaAbonados">
			
				<h2>Área de abonados</h2>
				<div class="wrap">
					<div class="curveSup clearFix">
						<div class="columnType1">
                        	{$node.data_map.otros_enlaces.content.output.output_text}
						</div>
                        <div class="columnType2">
                        	
                            {$node.data_map.texto.content.output.output_text}

                           
                        </div>
                    </div>
				
				</div>
			
			</div>
		
			<div id="gridHome1" class="clearFix">

				
                <div id="address-{$zones[1].blocks[0].zone_id}-{$zones[1].blocks[0].id}">
        {block_view_gui block=$zones[1].blocks[0] zone=$zones[1] attribute=$attribute}
    </div>
				<div class="columnType2">
					<h2>¿Conoce nuestros cursos?</h2>
					<div class="wrap clearFix">
						<div id="modTambien">
							{$node.data_map.texto2.content.output.output_text}
						
						</div>
					
					</div>
				</div>
			</div>
			{*	
			<div id="gridHome2" class="clearFix">
				
                <div class="modPago">

                	<div class="wrap">
                        <ul>
                            <li class="first">
                                <h2>Pago seguro</h2>
                                <p>Suspendisse potenti. Praesent commodo, justo ut dignissim tincidunt, arcu eros iaculis tortor, ut volutpat metus vel dolor. Mauris egestas orci non tortor blandit varius.</p>
                            </li>
                            <li>
                                <h2>Sistemas de pago admitidos</h2>

                                <p>Suspendisse potenti. Praesent commodo, justo ut dignissim tincidunt.</p>
                                <ul class="listPagos">
                                	<li><img src="images/ico_visa-big.png" alt="Visa" /></li>
                                    <li><img src="images/ico_visa-big.png" alt="Visa" /></li>
                                    <li><img src="images/ico_visa-big.png" alt="Visa" /></li>
                                    <li><img src="images/ico_visa-big.png" alt="Visa" /></li>
                                    <li><img src="images/ico_visa-big.png" alt="Visa" /></li>
                                    <li><img src="images/ico_visa-big.png" alt="Visa" /></li>

                                </ul>    
                            </li>
                            <li>
                                <h2>Envíos y devoluciones</h2>
                                <p>Suspendisse potenti. Praesent commodo, justo ut dignissim tincidunt, arcu eros iaculis tortor, ut volutpat metus vel dolor. Mauris egestas orci non tortor blandit varius.</p>
                                <span class="verMas"><a href="">Contacta con nosotros</a></span>
                                <span class="verMas"><a href="">Preguntas frecuentes</a></span>

                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="modTwitter">
                	<div class="wrap">
                    	<div class="inner">
                    		<h2><img src="images/img_siguenos.gif" alt="Síguenos en twitter" /></h2> 
                        </div>

                    </div>
                </div>
                
                				
			</div>		
            *}
		


