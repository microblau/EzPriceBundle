<div id="bodyContent">

        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
                <ol id="pasosCompra">
                    <li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
                    <li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
                    <li><img src={"txt_paso3-sel.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
                    <li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
                </ol>
                
                <div class="columnType1">
                    <div id="modType2">

                            <form action="{$datos.action}" method="post">
                            <h1>Confirmación de compra de datos</h1>
                            
                            <div class="wrap clearFix curvaFondo">                    		
									<div id="finProceso" class="description">
										<div class="msgError">
                                        			<span>Lo sentimos, pero su pago no ha sido procesado</span> 
                                        			
                                        		
										<ul>
											<li>Puede intentarlo más tarde o si lo prefirere, <a href={"basket/payment"|ezurl}>seleccionar otra forma de pago</a></li>
											

										</ul>
										</div>
										
									</div>								                        											
							</div>	
                        </form>
                    </div>
                </div>
                <div class="sideBar">
                    
                    <div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    
                </div>

                
            </div>
                
            
        
            
        
        </div>
