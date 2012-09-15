

        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
               
                
                <div class="columnType1">
                    <div id="modType2">

                            <form action="{"basket/forgotpassword"|ezurl} method="post">
                            <h1>Olvido de contraseña</h1>
                            
                            <div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosFacturacion">
										{if and(is_set($ok), $ok|eq(1) )}
											<div class="msgError">
												<ul>
													Le hemos enviado su nueva contraseña por email. Úsela para entrar en su zona de usuario y, si lo desea, 
													cambiela por otra que usted prefiera.
												</ul>
											</div>
										{else}
											
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se ha producido algún error en el proceso. Inténtelo de nuevo.</span>
                                        			
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
					   <script type="text/javascript">TrustLogo("https://www.hispassl.com/entorno_seguro.gif", "HispS", "none");</script>
					</div>
                    
                </div>

                
            </div>
                
            
        
            
        
        
