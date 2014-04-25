    
        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
                <ol id="pasosCompra">
                    <li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
                    <li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
                    <li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
                    <li class="reset"><img src={"txt_paso4-sel.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
                </ol>
                
                <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>Fin de proceso de compra</h1>
                            
                            <div class="wrap clearFix curvaFondo">                    		
									<div id="finProceso" class="description">
													
                                        		
										<ul>
											<li>Su pedido ha sido procesado. Su número de pedido lo recibirá por email una vez que su compra se haya tramitado con éxito. </li>
											<li>Si todo ha ido bien, en breves instantes <strong>recibirá un email</strong> con la información de dicho proceso. Si esto no ocurre en los próximos minutos póngase en contacto con nosotros.</li>

										</ul>
										
                                        
										
										
									</div>								                        											
							</div>	
                                   
                            </div>             
                            <div id="modType3">
						        <h2 class="title">Déjenos conocerle</h2>
                                <div class="wrap clearFix curvaFondo">                    		
							        <div class="description">
                            	        <div class="cont" style="padding:20px;">
                                            <form action={concat( "paypal/complete/", $id)|ezurl} method="post" id="finCompraForm" class="formulario conocer" name="finCompraForm">
                                                
                                               {include uri="design:basket/dejenosconocerle.tpl"}
                                               
                                               <div class="clearFix">
	                                                <!--span class="volver"><a href="">Volver</a></span-->
   	                                             <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="btnContinuar" /></span>

                                                
                                                </div>  
                                                    	                                                        
                                            </form>

                                         </div>

							</div>								                        											
						</div>
																				
					</div>
					
					
				</div>

                <div class="sideBar">
                    
                    <div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    
                </div>

                
            </div>
                
            
        
            
        
        </div>
