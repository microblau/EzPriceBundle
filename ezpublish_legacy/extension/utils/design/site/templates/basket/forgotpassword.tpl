
        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
               
                
                <div class="columnType1">
                    <div id="modType2">

                            <form action="{"basket/forgotpassword"|ezurl} method="post">
                            <h1>Olvido de contraseña</h1>
                            
                            <div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosFacturacion">
										{if and(is_set($emailvalido), $emailvalido|eq(1) )}
											<div class="msgError">
												<ul>
													Las instrucciones para generar una nueva contraseña han sido enviadas a su e-mail
												</ul>
											</div>
										{else}
											{if is_set( $errors )}
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			{foreach $errors as $key => $error }
                                        				<li>{$error}</li>
                                        			{/foreach}
                                        			</ul>
                                        		</div>
                                        	{/if}		
                                        		
										<ul class="datos">
											<li>
                                              <span class="etiqueta">Escriba la cuenta de correo electrónico con la que se dio de alta y le enviaremos a ella su nueva contraseña.</span>
                                            </li>
											<li>
                                              <span class="etiqueta">E-mail:</span>
                                              <span class="valor"><input type="text" id="email" name="email" class="text" value=""/></span>
                                            </li>
											

										</ul>
										<div class="clearFix">
	                                              
   	                                                <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="BtnPasswordRecover" /></span>
                                                
                                                </div>  
                                                	{/if}
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
                    
                    <div id="logohispassl">
                       {include uri="design:shop/logo.tpl"}
                    </div>
                    
                </div>

                
            </div>
                
            
        
            
        
    
