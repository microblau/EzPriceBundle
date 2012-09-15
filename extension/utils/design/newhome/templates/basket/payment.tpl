		

		{def $importe = fetch( 'shop', 'basket').total_inc_vat|l10n('clean_currency')}
			
		
			<div id="gridTwoColumnsTypeB" class="clearFix">
            	
                <ol id="pasosCompra">
					<li><img src={"txt_paso1.png"|ezimage()} alt="Cesta de la compra" height="57" width="234" /></li>
					<li><img src={"txt_paso2-sel.png"|ezimage()} alt="Datos personales y pago" height="57" width="234" /></li>
					<li><img src={"txt_paso3.png"|ezimage()} alt="Confirmación de datos" height="57" width="234" /></li>
					<li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
				</ol>
                
				<div class="columnType1">
					<div id="modType2">

						
							<h1>Datos de pago</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosPago">											
                                        	
                                            <form action={"basket/confirmorder"|ezurl} method="post" id="datosPagoForm" name="datosPagoForm" class="formulario">
                                            <span class="camposObligatorios">* Datos obligatorios</span>
                                            	<h2>Datos de pago</h2>
                                                
                                            		<fieldset>

                                            			<legend><span>Seleccione una forma de pago *</span></legend>
                                                	<ul class="datos">
                                                		<li>
                                                			<input type="radio" id="transferencia" name="formPago" value="1" />
                                                    		<label for="transferencia"><strong>Transferencia</strong>. Si no quiere pagar con tarjeta, ésta es la opción más cómoda. Una vez finalizado el proceso de compra le indicaremos las instrucciones necesarias para realizar la transferencia.</label>                                                        	
                                                    	</li>
                                                    	<li>
                                                    		<input type="radio" id="credito" name="formPago" value="2" />

                                                    		<label for="credito"> <strong>Tarjeta de crédito</strong>. Una vez que haya confirmado sus datos personales y los productos que ha añadido en la cesta, acceda a nuestro TPV, y facilítenos los datos de su tarjeta. ¡Rápido, seguro y cómodo!</label>                                                        	
                                                    	</li>
                                                    	
                                                    	<li id="paypalitem">
                                                    		<input type="radio" id="paypal" name="formPago" value="3" />

                                                    		<label for="paypal" class="clear"> 
                                                    		  <span id="logopaypal"><img src={"paypal.gif"|ezimage} /></span> 
                                                    		  <span id="textpaypal"><strong>Paypal</strong>. Si es usuario de PayPal, ésta es la forma más cómoda de realizar pagos en Internet.</span>
                                                    		  
                                                    		</label>                                                        	
                                                    	</li>
                                                    	{if $confianza_pago|eq(1)}
                                                    	<li>
                                                    	<input type="radio" id="domiciliacion" name="formPago" value="4" />
                                                    		<label for="domiciliacion"><strong>Domiciliación bancaria</strong>. Domicilie sus pagos de forma rápida y sencilla. Introduzca los datos de su cuenta bancaria y el titular de la cuenta. ¡Una opción sólo para nuestros mejores clientes!</label>
                                                    		
                                                    		<ul class="datos hide">
                                                    			<li>

                                                    				<label for="titular">Titular *</label>
                                                    				<input type="text" id="titular" name="titular" class="text" />
                                                    			</li>               
                                                    			<li class="numCuenta">
                                                    			<fieldset>
                                                    				<legend><span>Nº de cuenta *</span></legend>
                                                    				
                                                    				<input type="text" id="banco" name="banco" class="text" maxlength="4" />
                                                    				<input type="text" id="sucursal" name="sucursal" class="text" maxlength="4" />

                                                    				
                                                    				<input type="text" id="control" name="control" class="text" maxlength="2" />
                                                    				<input type="text" id="cuenta" name="cuenta" class="text" maxlength="10" />
                                                    				</fieldset>
                                                    				
                                                    			</li>
                                                    			
                                                    		</ul>
                                                    		                   	
                                                    	</li>
                                                    	{/if}
                                                    	{*
                                                    	<li>
                                                    	<input type="radio" id="contrarrembolso" name="formPago" />
                                                    		<label for="contrarrembolso"><strong>Contrarrembolso</strong></label>                                                        	
                                                    	</li>
                                                    	*}

                                                	</ul>
                                                </fieldset> 
                                                {if and( $aplazado|eq(1), $plazos|count|gt( 0 ) )}
                                                <fieldset>
                                            			<legend><span>Modalidad de pago *</span></legend>
                                                	    <ul class="datos" id="modopagos">
                                                	    
                                                    	<li>
	                                                    	<input type="radio" id="unico" name="modPago" checked="checked" value="0" />
                                                    		<label for="unico"> <strong>Pago único</strong>. Pague todo de una sola vez.</label>                                                        	
                                                    	</li>
														
														<li>
	                                                    	<input type="radio" id="aplazado" name="modPago" value="1" />
                                                    		<label for="aplazado"> <strong>Pago fraccionado</strong>. Pague  su compra en cómodos plazos sin recargos ni intereses adicionales. Para acogerse a esta opción deberá pagar ahora en línea el  primer plazo y el resto se abonarán cada 30 días con la misma forma de pago escogida. Si ha escogido tarjeta de crédito o PayPal para pagar el primer plazo, nos pondremos en contacto con Usted para definir la forma de pago de los siguientes plazos.</label>                                                        	
                                                    	</li>                                                    	
                                                    	    	
                                                    	</li>
                                                    	
                                                	</ul>
                                                </fieldset>
                                                {else}
                                                    <fieldset>
                                                        <input type="hidden" name="modPago" value="0" />
                                                    </fieldset> 
                                                {/if}
                                               
                                               <div class="clearFix">
	                                                {*<span class="volver"><a href="">Volver</a></span>*}

   	                                             <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" /></span>
                                                
                                                </div>  
                                                {def $value = $importe|explode(',')}
                                      
                                                {def $number = $value.0|explode('.')|implode('')}
                                               
                                                {def $imp = array( $number, $value.1)|implode('.')}
                                               
                                                <input type="hidden" name="importe" value="{$imp}" id="amounttopay" />  
                                                <input type="hidden" name="total" value="{$imp}"/>   
                                                <input type="hidden" name="plazos" value="0" id="plazos"/>  	                                                        
                                            </form>
                                                									
										</div>
								
									</div>								                        											
							</div>
						
					</div>
				</div>
				<div class="sideBar">
                
                	<div id="modComprando">

                    	{include uri="design:basket/cart.tpl"}
                    </div>
                    
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>

                    <div id="logohispassl">
					   <script type="text/javascript">TrustLogo("https://www.hispassl.com/entorno_seguro.gif", "HispS", "none");</script>
					</div>
                    
				</div>
                
			</div>
				
			
		{ezscript_require( array( 'pagos.js' ) )}
			
		
		
