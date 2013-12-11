{def $object_ids = array()}
{foreach $basket.items as $item}
{set $object_ids = $object_ids|append( $item.item_object.contentobject.id)}
{/foreach}
{def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}

{def $training = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}

{def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}

{section name=Basket show=$basket.items}



		
			
		
			<div id="gridTwoColumnsTypeB" class="clearFix">
			
				<ol id="pasosCompra">
					<li><img src={"txt_paso1-sel.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
					<li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
					<li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
					<li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
				</ol>
			
				<div class="columnType1">
					<div id="cestaPaso1">

						<div id="modType2">
						
								<h1>Estos son los productos que va a comprar</h1>
							
								<div class="wrap clearFix">                    		
										<div class="description">
											<form action={"basket/basket"|ezurl} method="post" id="searchResultsForm" name="searchResultsForm" class="searchResultsForm">
												<label for="searchTerm">¿Tiene un código promocional? <input type="text" id="searchTerm" name="codigo" class="text" value="{$codigo}" /></label>
												<span class="submit"><input type="image" alt="aceptar" src={"btn_aceptar.gif"|ezimage} name="btnCodigo" /></span>
												<span class="verMas flotante"><a href={"basket/que-es-un-codigo-promocional"|ezurl}>¿Qué es un código promocional?</a></span>

											</form>
											<div id="cestaCompra">
												<form action={"basket/basket"|ezurl} method="post" id="cestaPaso1Form" name="cestaPaso1Form">
												<table cellspacing="0" summary="" width="704">
													<colgroup>
														<col width="24" />
														<col width="96" />
														<col width="204" />
														<col width="78" />

														<col width="63" />
														<col width="78" />
														<col width="78" />
														<col width="118" />
													</colgroup>
													<thead>
														<tr>
															<td>&nbsp;</td>
															<td>&nbsp;</td>

															<th>Producto</th>
															<th>Unidades</th>
															<td>&nbsp;</td>
															<th>Precio</th>
															<th>IVA</th>
															<th>Total</th>

														</tr>
													</thead>
													<tfoot>
														<tr class="totalNoIva">
															<th colspan="7">TOTAL (sin IVA)</th>
															<td>{$basket.total_ex_vat|l10n( clean_currency )} €</td>
														</tr>     
                                                                                                                {if is_set($gastos_envio)}
                                                                                                                <tr class="totalNoIva">

															<th colspan="7">TOTAL COMPRA</th>
															<td class="precio">{$basket.total_inc_vat|l10n( clean_currency ), $basket.total_inc_vat|l10n( clean_currency ))} €</td>
														</tr>
                                                                                                                <tr class="totalNoIva">
															<th colspan="7">Gastos de Envío</th>
															<td>{$gastos_envio|l10n( clean_currency )} €</td>
														</tr>
                                                                                                                <tr class="total">

															<th colspan="7">TOTAL</th>
															<td class="precio">{cond( is_set( $gastos_envio ), $basket.total_inc_vat|sum($gastos_envio)|l10n( clean_currency ), $basket.total_inc_vat|l10n( clean_currency ))} €</td>
														</tr>
                                                                                                                {else}
                                                                                                                   

                                                                                                                <tr class="totalNoIva">

															<th colspan="7">TOTAL COMPRA</th>
															<td class="precio">{$basket.total_inc_vat|l10n( clean_currency ), $basket.total_inc_vat|l10n( clean_currency ))} €</td>
														</tr>
                                                                                                                <tr class="totalNoIva">
															<th colspan="7">Gastos de Envío</th>
															<td style="font-size:10px; font-weight:normal"><a style="font-size:11px" class="ajax" href={"basket/gastosenvio"|ezurl}>Más información</a></td>
														</tr>
                                                                                                                <tr class="total">

															<th colspan="7">TOTAL PARCIAL</th>
															<td class="precio">{cond( is_set( $gastos_envio ), $basket.total_inc_vat|sum($gastos_envio)|l10n( clean_currency ), $basket.total_inc_vat|l10n( clean_currency ))} €</td>
														</tr>
                                                                                                                {/if}
														
													</tfoot>
													<tbody>
														
														{foreach $products|sortbasketitems() as $index => $product}				

							                   
														
														<tr>
															<td>
															<input type="hidden" name="ProductItemIDList[]" value="{$product.id}" />
															<input type="image" name="RemoveProductItemDeleteList_{$product.id}" value="{$product.id}" src={"ico_eliminar.png"|ezimage} alt="Eliminar de la cesta" title="Eliminar de la cesta"/></td>
															<td>
                                                                                                                            
                                                           {if $product.item_object.contentobject.contentclass_id|eq( ezini( 'iMemento', 'Class', 'imemento.ini') )}
 {elseif $product.item_object.contentobject.contentclass_id|eq(100)}
                                                                {if $product.item_object.contentobject.main_node.parent.data_map.imagen.has_content}
                                                            	{def $imagen = fetch( 'content', 'object', hash( 'object_id', $product.item_object.contentobject.main_node.parent.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                                            
															    <img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" />
															    {undef $imagen}
                                                                {else}
                                                                    {def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}
                                                            
															    <img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" />
															    {undef $imagen}
															    {/if}
                                                
                                                            {else}
															    {if $product.item_object.contentobject.data_map.imagen.has_content}
                                                            	{def $imagen = fetch( 'content', 'object', hash( 'object_id', $product.item_object.contentobject.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                                            
															    <img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" />
															    {undef $imagen}
                                                                 {else}
                                                                    {def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}
                                                            
															    <img src={$imagen.data_map.image.content.block_catalogos.url|ezroot()} width="{$imagen.data_map.image.content.block_catalogos.width}" height="{$imagen.data_map.image.content.block_catalogos.height}" />
															    {undef $imagen}
															    {/if}
															    {/if}
                                                            
															</td>
															
															<td>
																{if $product.item_object.contentobject.class_identifier|contains( 'curso')}
																	<a href={$product.item_object.contentobject.main_node.url_alias|ezurl_formacion()}>{$product.object_name}</a>
																{else}
{if $product.item_object.contentobject.contentclass_id|eq(48)}
<strong style="color:#00528d">{$product.object_name}</strong>
                                                                {elseif $product.item_object.contentobject.contentclass_id|eq(101)}
                                                                    <a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />                                      
                                                                    <span class="mementos">{$order_info.has_nautis4.mementos}. 
                                                                    <strong>{$order_info.has_nautis4.accesos}</strong></span>
                                                                 {elseif $product.item_object.contentobject.contentclass_id|eq(98)}
                                                                    <a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />                                      
                                                                    <span class="mementos">{$order_info.has_mementix.mementos}. 
                                                                    <strong>{$order_info.has_mementix.accesos}</strong></span>
                                                               {elseif $product.item_object.contentobject.contentclass_id|eq( ezini( 'iMemento', 'Class', 'imemento.ini' ) )}
                                                                    <a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />
                                                                    <span class="mementos">{$order_info.has_imemento.mementos}.
                                                                    </span>
																{elseif $product.item_object.contentobject.contentclass_id|eq( ezini( 'Qmementix', 'Class', 'qmementix.ini' ) )}
                                                                    <a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />
                                                                    <span class="mementos">{$order_info.has_imemento.mementos}.
                                                                    </span>
																
                                                                {elseif $product.item_object.contentobject.contentclass_id|eq(100)}
                                                                	<a href={$product.item_object.contentobject.main_node.parent.url_alias|ezurl}>{$product.object_name}</a>                                      {else}
																<a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a>{/if}
																{/if}
															</td>
															<td><input {if or( $product.item_object.contentobject.contentclass_id|eq(98), $product.item_object.contentobject.contentclass_id|eq(101) )}readonly="yes"{/if} type="text" name="ProductItemCountList[]" value="{$product.item_count}" size="5" /></td>
															<td>&nbsp;</td>
															
															<td colspan="2" class="precio">
																<div class="precioIva">{$product.total_price_ex_vat|l10n(clean_currency)} € <span class="iva">+ {$product.vat_value}%</span></div>
																{if $order_info.has_imemento.partial}
																	<div class="precioAnterior">
																		<s>{$order_info.has_imemento.partial|l10n(clean_currency)} €</s>
																	</div>
																{/if}
																{if gt($product.discount_percent,0)}
																<div class="precioAnterior">
																    {def $discount_type = fetch( 'basket', 'get_discount_type', 
																                                                hash( 'user', fetch( 'user', 'current_user' ),
																                                                      'params', hash( 'contentclass_id', $product.item_object.contentobject.contentclass_id,
																                                                                      'contentobject_id', $product.item_object.contentobject.id,
																                                                                      'section_id', $product.item_object.contentobject.section_id
																                                                       ) 
																                                                      
																                                                      ))}
																    {if is_set( $discount_type.id)|not}
																    {$product.item_object.discount}% por código promocional {$order_info.codigopromocional}
																    {elseif $discount_type.id|eq(82)}
																	{$product.item_object.contentobject.data_map.texto_oferta.content}
																	{else}
																	{$discount_type.name}
																	{/if}
																	<s>{$product.price_ex_vat|l10n(clean_currency)} €</s>
																	{undef $discount_type}
																</div>
																{/if}
															</td>
															<td class="precio">{$product.total_price_inc_vat|l10n(clean_currency)} €</td>

														</tr>
														{/foreach}
														
														{foreach $training|sortbasketitems() as $index => $product}
													
														
														<tr>
															<td>
															<input type="hidden" name="ProductItemIDList[]" value="{$product.id}" />
															<input type="image" name="RemoveProductItemDeleteList_{$product.id}" value="{$product.id}" src={"ico_eliminar.png"|ezimage} alt="Eliminar de la cesta" title="Eliminar de la cesta"/></td>
															<td>
															
                                                        
															<img src={$product.item_object.contentobject.main_node.parent.data_map.area.content.data_map.birrete.content.block_catalogos.url|ezroot()}  />
														
															
															</td>
															
															<td>
																{if $product.item_object.contentobject.class_identifier|contains( 'curso')}
																	<a href={$product.item_object.contentobject.main_node.url_alias|ezurl_formacion()}>{$product.object_name}</a>
																{else}
																<a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a>
																{/if}
															</td>
															<td><input type="text" name="ProductItemCountList[]" value="{$product.item_count}" size="5" /></td>
															<td>&nbsp;</td>
															
															<td colspan="2" class="precio"><div class="precioIva">{$product.total_price_ex_vat|l10n(clean_currency)} € <span class="iva">+ {$product.vat_value}%</span></div>
{if gt($product.discount_percent,0)}
																<div class="precioAnterior">
																    {def $discount_type = fetch( 'basket', 'get_discount_type', 
																                                                hash( 'user', fetch( 'user', 'current_user' ),
																                                                      'params', hash( 'contentclass_id', $product.item_object.contentobject.contentclass_id,
																                                                                      'contentobject_id', $product.item_object.contentobject.id,
																                                                                      'section_id', $product.item_object.contentobject.section_id
																                                                       ) 
																                                                      
																                                                      ))}
																    {if is_set( $discount_type.id)|not}
																    {$product.item_object.discount}% por código promocional {$order_info.codigopromocional}
																    {elseif $discount_type.id|eq(82)}
																	{$product.item_object.contentobject.data_map.texto_oferta.content}
																	{else}
																	{$discount_type.name}
																	{/if}
																	<s>{$product.price_ex_vat|l10n(clean_currency)} €</s>
																	{undef $discount_type}
																</div>
																{/if}</td>
															<td class="precio">{$product.total_price_inc_vat|l10n(clean_currency)} €</td>

														</tr>
														{/foreach}
														
													</tbody>
												</table>
												<div class="options clearFix">
													<input type="image" src={"seguir_comprando.gif"|ezimage} alt="Seguir comprando" style="float:left" name="ContinueShoppingButton" />
													<input type="image" src={"btn_comenzar.gif"|ezimage} alt="Comenzar" name="CheckoutButton" />												
													<input type="image" value="Actualizar" name="StoreChangesButton" src={"actualizar_cesta.gif"|ezimage} />													
												</div>
                                              
												
											</div>
								
										</div>								                        											
								</div>
						
						</div>
					
						
						{section-else}
						<div id="gridTwoColumnsTypeB" class="clearFix">
							<div class="columnType1">
				
					<span class="cestaVacia">Aún no ha añadido ningún producto a la cesta</span>
				
					<div id="modType2">
						
							<h1>{fetch( 'content', 'object', hash( 'object_id', 2047)).name}</h1>
                            
                     <div class="wrap clearFix curvaFondo">                    		
									<div id="ventajasCompra" class="description">
										{fetch( 'content', 'object', hash( 'object_id', 2047)).data_map.texto.content.output.output_text}
										
									</div>								                        											
							</div>																				
					
						
						{/section}
						<div id="gridType3">
														
									<div class="wrap clearFix">

										{*<div class="columnType1 flt">	
											<h2>El mejor precio si los compras juntos</h2>									
											<div class="wrapColumn">											
												<div class="inner clearFix">
                                                	
                                                    <ul>
                                                    	<li>
                                                            <div class="image">
                                                                <a href=""><img src="images/img_producto4.gif" alt="" /></a>
                                                                <img src="images/img_estrellas.gif" alt="valoración de los usuarios: 4" class="valoracion" />
                                                            </div>

                                                            <div class="description frt">
                                                                <h3><a href="">Memento fiscal 2009</a></h3>
                                                                <p>El acceso más rápido y directo a toda la información fiscal.</p>
                                                            
                                                                <div class="action"><span class="btnType2"><span><a href="">Lo quiero</a></span></span></div>
                                                            </div>
                                                        </li>
                                                        <li>

                                                            <div class="description sinImage">
                                                                <h3><a href="">Memento fiscal 2009</a></h3>
                                                                <p>El acceso más rápido y directo a toda la información fiscal.</p>
                                                            
                                                                <div class="action"><span class="btnType2"><span><a href="">Lo quiero</a></span></span></div>
                                                            </div>
                                                        </li>
                                                        <li>

												
                                                            <div class="image">
                                                                <a href=""><img src="images/img_producto4.gif" alt="" /></a>
                                                                <img src="images/img_estrellas.gif" alt="valoración de los usuarios: 4" class="valoracion" />
                                                            </div>
                                                            <div class="description frt">
                                                                <h3><a href="">Memento fiscal 2009</a></h3>
                                                                <p>El acceso más rápido y directo a toda la información fiscal.</p>
                                                            
                                                                <div class="action"><span class="btnType2"><span><a href="">Lo quiero</a></span></span></div>

                                                            </div>
                                                        </li>
													</ul>
																							
												</div>
											</div>
										</div>*}
										
										{def $related = fetch( 'basket', 'related_purchase', hash( 'contentobject_ids', $object_ids,
																								   'limit', 3		
										 ))}
										 {if $related|count|gt(0)}
										<div class="columnType2 ">	
											<h2>Los clientes que compran lo mismo también se interesan por...</h2>									
											<div class="wrapColumn">											
												<div class="inner">

													<ul class="clearFix">
														{foreach $related as $node}							
														<li>
                                                            {if $node.object.contentclass_id|eq(100)}
                                                                {if $node.parent.data_map.imagen.has_content}
				                                       			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.parent.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
				                                       
				                                            	<div class="image"> 
				                                            		
				                                                	<a href={$node.main_node.parent.url_alias|ezurl()}><img src={$imagen.data_map.image.content.related.url|ezroot()} width="{$imagen.data_map.image.content.related.width}" height="{$imagen.data_map.image.content.related.height}" /></a>
				                                                	
				                                                </div>
				                                                {undef $imagen}
                                                            {/if}
                                                            {else}
															    {if $node.data_map.imagen.has_content}
				                                           			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
				                                          
				                                                	<div class="image"> 
				                                                		{if $node.class_identifier|contains('curso_')}                                           	
				                                                    	<a href={$node.main_node.url_alias|ezurl_formacion()}<img src={$imagen.data_map.image.content.related.url|ezroot()} width="{$imagen.data_map.image.content.related.width}" height="{$imagen.data_map.image.content.related.height}" /></a>
				                                                    	{else}
				                                                    	<a href={$node.main_node.url_alias|ezurl()}><img src={$imagen.data_map.image.content.related.url|ezroot()} width="{$imagen.data_map.image.content.related.width}" height="{$imagen.data_map.image.content.related.height}" /></a>
				                                                    	{/if}
				                                                    </div>
				                                                    {undef $imagen}
                                               	 				{/if}
                                                            {/if}
                                                            
															<div class="description frt">
																{if $node.class_identifier|contains('curso_')}
																<h3><a href={$node.main_node.url_alias|ezurl_formacion()}>{$node.name}</a></h3>
																{else}
																<h3><a href={$node.main_node.url_alias|ezurl()}>{$node.name}</a></h3>
																{/if}
																{if $node.class_identifier|contains('curso_')}
																{$node.data_map.subtitulo.content.output.output_text}
																{else}
																<p>{$node.data_map.subtitulo.content}</p>
																{/if}
																{if $node.class_identifier|contains('curso_')|not}
																
                                                                
                                {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))} 
                                {if $cuantasvaloracionestotales|gt(0)}
                                              <span><a href={concat($node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span> 
								{/if}
                                 {undef $cuantasvaloracionestotales}         
                                                                
                                                                
                                                                
                                                                
																{/if}
													
																<div><a href={concat( "basket/add/", $node.main_node.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a></div>
															</div>
														</li>
														{/foreach}
														
													</ul>
												
												</div>
											</div>
										</div>
										{/if}
									</div>
							
								</div>
							
					</div>		
					
					
				</div>
				<div class="sideBar">
					<input type="image" src={"btn_comenzar-compra.gif"|ezimage} alt="comenzar el proceso de compra" name="CheckoutButton" />
					<div id="modVentajas">
						<h2>Disfrute de todas las ventajas de la compra online</h2>
						{fetch('content', 'node', hash('node_id', 1487)).data_map.texto.content.output.output_text}
					</div>

					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
					
					<div id="logohispassl">
					   <script type="text/javascript">TrustLogo("https://www.hispassl.com/entorno_seguro.gif", "HispS", "none");</script>
					</div>
				</div>
			</div>
				</form>
			
		
			
{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js',  'colorbox/jquery.colorbox-min.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css') )}
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
    $(".ajax").colorbox();
    });
    </script>
    <style>
       #colorbox{background-color:#fff; z-index:100000; border: 1px solid #000}
       #colorbox div {padding:0}
       #cboxClose {
position: absolute;
top: 0px;
right: 0px;
display: block;
background: url(/design/newhome/images/cerrar.png) no-repeat top center;
width: 32px;
height: 36px;
text-indent: -9999px;
border: none;
}
    </style>
{/literal}
		
