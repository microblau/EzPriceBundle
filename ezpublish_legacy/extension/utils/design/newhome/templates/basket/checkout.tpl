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

						
							<h1>Confirmación de compra de datos</h1>
                            
                            <div class="wrap clearFix curvaFondo">                    		
									<div class="description descriptionTypeB">
										<div id="confirmacion">
                                            
                                            <table cellspacing="0" width="675">
                                            	<colgroup>
                                                	<col width="400" />
                                                    <col width="55" />
                                                    <col width="85" />

                                                    <col width="25" />
                                                    <col width="110" />
                                                </colgroup>
                                                
                                                <thead>
                                                	<tr>
                                                    	<th class="producto">Producto</th>
                                                        <th class="unidades">Unidades</th>
                                                        <th class="price">Precio</th>

                                                        <th class="iva">IVA</th>
                                                        <th class="total">Total</th>
                                                    </tr>
                                                </thead>
                                                {def $basket = fetch( 'shop', 'basket')}                                               
                                                <tfoot>
													<tr class="totalNoIva">
														<th colspan="4">TOTAL (sin IVA)</th>

														<td>{$basket.total_ex_vat|l10n( 'clean_currency' )} €</td>
													</tr>
													<tr class="total">
														<th colspan="4">TOTAL</th>
														<td class="precio">{$basket.total_inc_vat|l10n( 'clean_currency' )} €</td>
													</tr>
												</tfoot>

                                                
                                                <tbody>
                                                	{foreach $basket.items as $index => $item }                                                	
                                                	<tr {if eq($index,0)}class="first"{/if}>
                                                    	<td class="producto">{$item.item_object.name}</td>
                                                        <td>{$item.item_count}</td>
                                                        <td colspan="2" class="price">{$item.total_price_ex_vat|l10n( clean_currency )} € <span class="iva">+ {$item.vat_value}%</span></td>
                                                        <td class="total">{$item.total_price_inc_vat|l10n( clean_currency )} €</td>

                                                    </tr>
                                                    {/foreach}                                                    
                                                </tbody>
                                            
                                            </table>
                                                									
										</div>
								
									</div>								                        											
							</div>							
							{def $order_info = fetch( 'basket', 'get_order_info', hash( 'order_id', $basket.id ))}
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosFacturacion">
                                            
                                            	<h2>Sus datos de facturación</h2>
                                                {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                               
                                                <dl class="datos">
                                                	<dt>Nombre:</dt>
                                                    <dd>{$order_info.nombre}</dd>
                                                    <dt>Apellidos:</dt>
                                                    <dd>{$order_info.apellido1} {$order_info.apellido2}</dd>
                                                    {if is_set( $order_info.empresa )}
                                                    <dt>Empresa:</dt>
                                                    <dd>Gestoría Gracia</dd>
                                                    {/if}
                                                    <dt>NIF /CIF:</dt>
                                                    <dd>{$order_info.nif}</dd>
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$order_info.telefono}</dd>
                                                    <dt>Email:</dt>

                                                    <dd>{$order_info.email}</dd>
                                                    {if $oder_info.fax|ne('')}
                                                    <dt>Fax:</dt>
                                                    <dd>{$order_info.fax}</dd>
                                                    {/if}
                                                    <dt>Dirección:</dt>
                                                    <dd>{$order_info.tipovia}/ {$order_info.dir1}, {$order_info.num}. {$order_info.complemento}</dd>
                                                    <dt>País:</dt>

                                                    <dd>{$countries[$order_info.pais]}</dd>
                                                    <dt>Provincia:</dt>
                                                    <dd>{$order_info.provincia}</dd>
                                                    <dt>Localidad:</dt>
                                                    <dd>{$order_info.localidad}</dd>
                                                    <dt>Código Postal:</dt>

                                                    <dd>{$order_info.cp}</dd>                                                    
                                                	
                                                </dl>
                                               
                                               <div class="clearFix">
                                               		{*<span class="volver"><a href="">Volver</a></span>*}
   	                                             	<span class="submit"><a href=""><img src={"btn_comprar.gif"|ezimage} alt="Comprar" /></a></span>
                                                
                                                </div>  
                                                    	                                                        
                                                									
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
