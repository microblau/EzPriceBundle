		
			
		    {def $object = fetch( 'content', 'object', hash( 'object_id', '1604' ))}
			<div id="gridTwoColumnsTypeB" class="clearFix mementix">
				<div class="columnType1">
					<div id="modType2">
						
							<h1>Mementix</h1>
                            
                            <p class="subtitle">Antes de añadir Mementix a su cesta de compra, es necesario que <strong>seleccione la opción que desea solicitar</strong> y los <strong>ejemplares de Mementos</strong> que desea incluir en el mismo.</p>

							<form action={"basket/addmementix"|ezurl} method="post" id="mementosForm" name="mementosForm">
							<div class="wrap clearFix curvaFondo">                    		
                                <div class="description">
                                    
                                    <div class="numAccesos clearFix">
                                    	<h2>Seleccione la opción que desee</h2>
                                        <span class="verMas flotante"><a href={"basket/que-es-un-acceso-mementix"|ezurl}>¿Qué opciones tengo?</a></span>
                                        <div class="slider">
                                            <div class="sliderChart">

                                            	<div class="chart">
                                                	<span id="item1" class="slider-lb first sel">Individual</span>
                                                    <span id="item2" class="slider-lb">2 accesos</span>
                                                    <span id="item3" class="slider-lb">3 accesos</span>
                                                    <span id="item4" class="slider-lb">4 accesos</span>
                                                    <span id="item5" class="slider-lb">5 accesos</span>

                                                	<span id="item6" class="slider-lb last">6 accesos o más</span>
                                                </div> 
                                            </div>
                                        </div>
                                        <input id="valor" type="hidden" value="1" name="accesos" /> 
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="wrap clearFix">

                            	<div class="description">
										<div id="accesoMementos">
                                        	<h2>Seleccione los mementos</h2>
												<fieldset>				
													<ul>
                                                        
                                                        {def $mementos = $object.data_map.mementos_mementix.content}
                                                        {foreach $mementos.relation_browse as $el}
                                                            {def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
                                                                <li>
															<input type="checkbox" id="memento_{$memento.id}" name="mementos[]" value="{$memento.id}" />
															<label for="memento_{$memento.id}">{$memento.data_map.nombre_mementix.content}</label>

														</li>
                                                            {undef $memento}
                                                        {/foreach}														
														
														
													</ul>															
												</fieldset>
											
											
										
										</div>
								
									</div>								                        											
							</div>

						
					</div>
				</div>
				<div class="sideBar">
                
                	<div id="modMiMementix">
                    	<h2>Mi Mementix</h2>
                        <ul>
                          
                        	<li class="listaAccesos"><span class="listaMem">3 accesos</span></li>
                            
                            <li class="listMem"><span class="listaMem">0 Mementos</span></li>
                        	<li class="total"><span class="precio" id="partial">{$object.data_map.precio.content.ex_vat_price|l10n('clean_currency)} €</span></li>
                            <li><span class="descuento"><span id="discount">0%</span> descuento</span></li>
                            <li class="total"><span class="productoTotal">TOTAL</span><span class="precioTotal" id="ptotal">{$object.data_map.precio.content.ex_vat_price|l10n('clean_currency)} €</span></li>
                            <li class="reset"><input type="image" id ="addToBasket" src={"btn_aniadir-compra.gif"|ezimage} alt="Añadir a la cesta" name="AddToBasket" /></li>

                        </ul>
                    </div>
                
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    <input type="hidden" name="partial" id="partialfield" value="" />
                    <input type="hidden" name="discount" id="discountfield" value="" />
                    <input type="hidden" name="total" id="totalfield" value="" />
                    <input type="hidden" name="object" id="object" value="1604" />
                    </form>
				</div>
			</div>

{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js', 'ui.core.js', 'ui.slider.js', 'mementix.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css') )}
