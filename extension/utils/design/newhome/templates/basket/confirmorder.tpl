

        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
                <ol id="pasosCompra">
                    <li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
                    <li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
                    <li><img src={"txt_paso3-sel.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
                    <li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
                </ol>
                
                <div class="columnType1">
                    <div id="modType2" class="entryConfirmacion">

                            <form action="{$datos.action}" method="post">
                            <h1>Confirmación de compra y datos</h1>
                            {if or( ezhttp( 'formPago', 'post')|eq(1), ezhttp( 'formPago', 'post')|eq(2), ezhttp( 'formPago', 'post')|eq(3), ezhttp( 'formPago', 'post')|eq(4) )}
                            <div class="wysiwyg"><p>Antes de finalizar el proceso de compra confirme que los productos de la cesta y sus datos personales son correctos.</p></div>
                            {/if}
                            
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
												
                                                 {def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
												 {def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
												<td>
												{if $product.item_object.contentobject.contentclass_id|eq( ezini( 'iMemento', 'Class', 'imemento.ini' ) )}
													<a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />
                                                    <span class="mementos">{$order_info.has_imemento.mementos}.
                                                    </span>
												{elseif $product.item_object.contentobject.contentclass_id|eq( ezini( 'Qmementix', 'Class', 'qmementix.ini' ) )}
													<a href={$product.item_object.contentobject.main_node.url_alias|ezurl}>{$product.object_name}</a><br />
                                                    <span class="mementos">{$order_info.has_imemento.mementos}.
                                                    </span>
												{/if}
												
												</td>
												{undef $products $order_info}
												
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
                                                    {def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $training = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
                                                
                                                    {foreach $products|sortbasketitems() as $index => $item}             
                                                    <tr {if eq($index,0)}class="first"{/if}>
                                                        <td class="producto">
{if $item.item_object.contentobject.contentclass_id|eq(98)}
{$item.object_name}<br />
 <span class="mementos">{$order_info.has_mementix.mementos}. 
  <strong>{$order_info.has_mementix.accesos}</strong></span>
 {elseif $item.item_object.contentobject.contentclass_id|eq(101)}
{$item.object_name}<br />
 <span class="mementos">{$order_info.has_nautis4.mementos}. 
  <strong>{$order_info.has_nautis4.accesos}</strong></span>
{else}
{$item.item_object.name}
{/if}

</td>
                                                        <td>{$item.item_count}</td>
                                                        <td colspan="2" class="price">


                                                            {$item.total_price_ex_vat|div($item.item_count)|l10n(clean_currency)} € <span class="iva">+ {$item.vat_value}%</span>
																{if gt($item.discount_percent,0)}
															    <div style="text-align:center; font-size: 10px; font-weight:normal; color:#900">
                                                                            {def $discount_type = fetch( 'basket', 'get_discount_type', 
                                                                                                                hash( 'user', fetch( 'user', 'current_user' ),
                                                                                                                      'params', hash( 'contentclass_id', $item.item_object.contentobject.contentclass_id,
                                                                                                                                      'contentobject_id', $item.item_object.contentobject.id,
                                                                                                                                      'section_id', $item.item_object.contentobject.section_id
                                                                                                                       ) 
                                                                                                                      
                                                                                                                      ))}
                                                                    {if is_set( $discount_type.id)|not}
                                                                    {$item.item_object.discount}% por código promocional {$order_info.codigopromocional}
                                                                    {elseif $discount_type.id|eq(3)}
                                                                    {$item.item_object.contentobject.data_map.texto_oferta.content}
                                                                    {else}
                                                                    {$discount_type.name}
                                                                    {/if}
                                                                    <s>{$item.price_ex_vat|l10n(clean_currency)} €</s>
                                                                    {undef $discount_type}
																    </div>
																{/if}</td>
                                                        <td class="total">{$item.total_price_inc_vat|l10n( clean_currency )} €</td>

                                                    </tr>
                                                    {/foreach}         
                                                    {foreach $training|sortbasketitems() as $index => $item}             
                                                    <tr {if eq($index,0)}class="first"{/if}>
                                                        <td class="producto">{$item.item_object.name}</td>
                                                        <td>{$item.item_count}</td>
                                                        <td colspan="2" class="price">


                                                            {$item.total_price_ex_vat|div($item.item_count)|l10n(clean_currency)} € <span class="iva">+ {$item.vat_value}%</span>
																{if gt($item.discount_percent,0)}
															    <div style="text-align:center; font-size: 10px; font-weight:normal; color:#900">
                                                                          {def $discount_type = fetch( 'basket', 'get_discount_type', 
																                                                hash( 'user', fetch( 'user', 'current_user' ),
																                                                      'params', hash( 'contentclass_id', $item.item_object.contentobject.contentclass_id,
																                                                                      'contentobject_id', $item.item_object.contentobject.id,
																                                                                      'section_id', $item.item_object.contentobject.section_id
																                                                       ) 
																                                                      
																                                                      ))}
																    {if is_set( $discount_type.id)|not}
																    {$item.item_object.discount}% por código promocional {$order_info.codigopromocional}
																    {elseif $discount_type.id|eq(3)}
																	{$item.item_object.contentobject.data_map.texto_oferta.content}
																	{else}
																	{$discount_type.name}
																	{/if}
																	<s>{$item.price_ex_vat|l10n(clean_currency)} €</s>
																	{undef $discount_type}
																    </div>
																{/if}</td>
                                                        <td class="total">{$item.total_price_inc_vat|l10n( clean_currency )} €</td>

                                                    </tr>
                                                    {/foreach}                                                  
                                                </tbody>
                                            
                                            </table>
                                                                                    
                                        </div>
                                
                                    </div>                                                                                                  
                            </div>                          
                            
                            
                            <div class="wrap clearFix">                         
                                    <div class="description">
                                        <div id="datosFacturacion">
                                                
                                                {if $order_info.tipo_usuario|eq(2)}
                                                <h2>Sus datos de facturación</h2>
                                                {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                               
                                                <dl class="datos">
                                                   
                                                    <dt>Email:</dt>
                                                    <dd>{$order_info.email}</dd>
                                                    
                                                    <dt>Nombre de empresa:</dt>
                                                    <dd>{$order_info.empresa}</dd>
                                                    
                                                    <dt>NIF /CIF:</dt>
                                                    <dd>{cond( is_set( $order_info.nif ), $order_info.nif, $order_info.cif )}</dd>
                                                    {if $order_info.telefono|trim|ne('')}
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$order_info.telefono}</dd>
                                                    {/if}
                                                    
                                                    {if is_set( $order_info.telefono_empresa)}
                                                    <dt>Teléfono de empresa:</dt>
                                                    <dd>{$order_info.telefono_empresa}</dd>
                                                    {/if}
                                                    
                                                    {if $order_info.movil|trim|ne('')}
                                                    <dt>Móvil:</dt>
                                                    <dd>{$order_info.movil}</dd>
                                                    {/if}
                                                    
                                                    {if $oder_info.fax|trim|ne('')}
                                                    <dt>Fax:</dt>
                                                    <dd>{$order_info.fax}</dd>
                                                    {/if}
                                                    
                                                    <dt>Dirección:</dt>
                                                    <dd>{$order_info.tipovia}/ {$order_info.dir1}, {$order_info.num}. {$order_info.complemento}</dd>
                                                    {def $pais = $order_info.pais}
                                                    {if $pais|eq('')}
                                                    {set $pais = 'ES'}
                                                    {/if}
                                                    <dt>País:</dt>
                                                    <dd>{$countries[$pais]}</dd>
                                                    
                                                    <dt>Provincia:</dt>
                                                    <dd>{$order_info.provincia}</dd>
                                                    <dt>Localidad:</dt>
                                                    <dd>{$order_info.localidad}</dd>
                                                    <dt>Código Postal:</dt>

                                                    <dd>{$order_info.cp}</dd>      
                                                   
                                                    
                                                   
                                                   
                                                    
                                                                                                  
                                                    
                                                </dl>
                                                {undef $countries}
                                                    {if $order_info.datos_coinciden|eq('no')}
                                                    <h2>Sus datos de envío</h2>
                                                    {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                   
                                                    <dl class="datos">
                                                     
                                                        <dt>Nombre:</dt>
                                                        <dd>{$order_info.nombre2}</dd>
                                                        <dt>Apellidos:</dt>
                                                        <dd>{$order_info.apellido12} {$order_info.apellido22}</dd>
                                                     
                                                        {if $order_info.empresa2|trim|ne('')}
                                                        <dt>Nombre empresa:</dt>
                                                        <dd>{$order_info.empresa2}</dd>
                                                        {/if}
                                                        {if $order_info.movil2|trim|ne('')}
                                                        <dt>Teléfono de contacto:</dt>
                                                        <dd>{$order_info.telefono2}</dd>
                                                        {/if}
                                                        
                                                        {if $order_info.movil2|trim|ne('')}
                                                        <dt>Móvil de contacto:</dt>
                                                        <dd>{$order_info.movil2}</dd>
                                                        {/if}
                                                        
                                                       {if $order_info.email2|ne('')}
                                                    <dt>Email:</dt>
                                                    <dd>{$order_info.email2}</dd>
                                                    {/if}
                                                        
                                                        {if $oder_info.fax2|trim|ne('')}
                                                        <dt>Fax:</dt>
                                                        <dd>{$order_info.fax2}</dd>
                                                        {/if}
                                                        
                                                        <dt>Dirección:</dt>
                                                        <dd>{$order_info.tipovia2}/ {$order_info.dir12}, {$order_info.num2}. {$order_info.complemento2}</dd>
                                                        
                                                        {def $pais2 = $order_info.pais}
                                                        {if $pais2|eq('')}
                                                        {set $pais2 = 'ES'}
                                                        {/if}
                                                        
                                                        <dt>País:</dt>
                                                        <dd>{$countries[$pais2]}</dd>
                                                        
                                                        <dt>Provincia:</dt>
                                                        <dd>{$order_info.provincia2}</dd>
                                                        <dt>Localidad:</dt>
                                                        <dd>{$order_info.localidad2}</dd>
                                                        
                                                        <dt>Código Postal:</dt>
                                                        <dd>{$order_info.cp2}</dd>                                                    
                                                        
                                                    </dl>
                                                    {/if}
                                                {elseif $order_info.tipo_usuario|eq(1)}
                                                
                                                 <h2>Sus datos de facturación</h2>
                                                {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                               
                                                <dl class="datos">
                                                    <dt>Nombre:</dt>
                                                    <dd>{$order_info.nombre}</dd>
                                                    
                                                    <dt>Apellidos:</dt>
                                                    <dd>{$order_info.apellido1} {$order_info.apellido2}</dd>
                                                    
                                                    <dt>Email:</dt>
                                                    <dd>{$order_info.email}</dd>
                                                    
                                                    <dt>NIF:</dt>
                                                    <dd>{cond( is_set( $order_info.nif ), $order_info.nif, $order_info.cif )}</dd>
                                                    
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$order_info.telefono}</dd>                                                    
                                                                                                       
                                                    {if $order_info.movil|ne('')}
                                                    <dt>Móvil:</dt>
                                                    <dd>{$order_info.movil}</dd>
                                                    {/if}
                                                    
                                                    {if $order_info.fax|ne('')}
                                                    <dt>Fax:</dt>
                                                    <dd>{$order_info.fax}</dd>
                                                    {/if}
                                                    
                                                    <dt>Dirección:</dt>
                                                    <dd>{$order_info.tipovia}/ {$order_info.dir1}, {$order_info.num}. {$order_info.complemento}</dd>
                                                    {def $pais = $order_info.pais}
                                                    {if $pais|eq('')}
                                                    {set $pais = 'ES'}
                                                    {/if}
                                                    <dt>País:</dt>
                                                    <dd>{$countries[$pais]}</dd>
                                                    
                                                    <dt>Provincia:</dt>
                                                    <dd>{$order_info.provincia}</dd>
                                                    
                                                    <dt>Localidad:</dt>
                                                    <dd>{$order_info.localidad}</dd>
                                                    
                                                    <dt>Código Postal:</dt>
                                                    <dd>{$order_info.cp}</dd>    
                                                </dl>
                                                {undef $countries}
                                                {if $order_info.datos_coinciden|eq('no')}
                                                <h2>Sus datos de envío</h2>
                                                {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                               
                                                <dl class="datos">
                                                 
                                                    <dt>Nombre:</dt>
                                                    <dd>{$order_info.nombre2}</dd>
                                                    <dt>Apellidos:</dt>
                                                    <dd>{$order_info.apellido12} {$order_info.apellido22}</dd>
                                                 
                                                    {if $order_info.empresa2|ne('')}
                                                    <dt>Nombre empresa:</dt>
                                                    <dd>{$order_info.empresa2}</dd>
                                                    {/if}
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$order_info.telefono2}</dd>
                                                    
                                                    {if $order_info.movil2|ne('')}
                                                    <dt>Móvil:</dt>
                                                    <dd>{$order_info.movil2}</dd>
                                                    {/if}
                                                    
                                                    {if $order_info.email2|ne('')}
                                                    <dt>Email:</dt>
                                                    <dd>{$order_info.email2}</dd>
                                                    {/if}
                                                    
                                                    {if $oder_info.fax2|ne('')}
                                                    <dt>Fax:</dt>
                                                    <dd>{$order_info.fax2}</dd>
                                                    {/if}
                                                    
                                                    <dt>Dirección:</dt>
                                                    <dd>{$order_info.tipovia2}/ {$order_info.dir12}, {$order_info.num2}. {$order_info.complemento2}</dd>
                                                    
                                                    {def $pais2 = $order_info.pais}
                                                    {if $pais2|eq('')}
                                                    {set $pais2 = 'ES'}
                                                    {/if}
                                                    
                                                    <dt>País:</dt>
                                                    <dd>{$countries[$pais2]}</dd>
                                                    
                                                    <dt>Provincia:</dt>
                                                    <dd>{$order_info.provincia2}</dd>
                                                    <dt>Localidad:</dt>
                                                    <dd>{$order_info.localidad2}</dd>
                                                    
                                                    <dt>Código Postal:</dt>
                                                    <dd>{$order_info.cp2}</dd>                                                    
                                                    
                                                </dl>
                                                {/if}
                                                {else}
                                                 <h2>Sus datos de facturación</h2>
                                                {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                               
                                                <dl class="datos">
                                                    <dt>Nombre:</dt>
                                                    <dd>{$order_info.nombre}</dd>
                                                    
                                                    <dt>Apellidos:</dt>
                                                    <dd>{$order_info.apellido1} {$order_info.apellido2}</dd>
                                                    
                                                    <dt>Email:</dt>
                                                    <dd>{$order_info.email}</dd>
                                                    
                                                    
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$order_info.telefono}</dd>                               
                                                                                                       
                                                    
                                                    {def $pais = $order_info.pais}
                                                    {if $pais|eq('')}
                                                    {set $pais = 'ES'}
                                                    {/if}
                                                    <dt>País:</dt>
                                                    <dd>{$countries[$pais]}</dd>
                                                    
                                                    {if $order_info.observaciones|attribute(show)}
                                                    <dt>Observaciones:</dt>
                                                    <dd>{$order_info.observaciones}</dd>
                                                    {/if}
                                                    
                                                    
                                                    
                                                </dl>
                                                {undef $countries}
                                                {/if}
                                                
                                                {if $order_info.cursos|count|gt(0)}
                                                {foreach $order_info.cursos as $curso}
                                                
                                                {if eq( $curso.id, 'no')}
                                                <h2>Asistente al curso {$curso.nombre}</h2>
                                                
                                                <dl class="datos">
                                                 
                                                    <dt>Nombre:</dt>
                                                    <dd>{$curso.asistente.nombre}</dd>
                                                    <dt>Apellidos:</dt>
                                                    <dd>{$curso.asistente.apellido1} {$curso.asistente.apellido2}</dd>
                                                    {if $curso.asistente.profesion|ne('')}
                                                    <dt>Profesión:</dt>
                                                    <dd>{$curso.asistente.profesion} </dd>
                                                    {/if}
                                                    
                                                     {if $curso.asistente.cargo|ne('')}
                                                    <dt>Cargo:</dt>
                                                    <dd>{$curso.asistente.cargo} </dd>
                                                    {/if}
                                                    
                                                    {if $curso.asistente.telefono|ne('')}
                                                    <dt>Teléfono:</dt>
                                                    <dd>{$curso.asistente.telefono} </dd>
                                                    {/if}
                                                    
                                                    {if $curso.asistente.email|ne('')}
                                                    <dt>Email:</dt>
                                                    <dd>{$curso.asistente.email} </dd>
                                                    {/if}
                                                    
                                                    {if $curso.asistente.fax|ne('')}
                                                    <dt>Fax:</dt>
                                                    <dd>{$curso.asistente.fax} </dd>
                                                    {/if}
                                             
                                                </dl>
                                                {/if}
                                                {/foreach}
                                                {/if}
                                                {if ezhttp( 'formPago', 'post')|eq(1)}
                                                <div>
                                    <p class="modoPago">Ha seleccionado como modo de pago <strong>TRANSFERENCIA BANCARIA</strong>. Para tramitar con agilidad su pedido, por favor, siga las siguientes instrucciones:</p>
                                    <div class="instruccionesTransferencia">
                                        
                                        <h2>Instrucciones de pago por transferencia</h2>
                                        <ol>
                                            <li><span>Haga su transferencia antes de 72 horas* en el siguiente número de <abbr ttile="Cuenta Corriente">C/C</abbr>: {ezini( 'Infocompras', 'CC', 'basket.ini')}.</span></li>
                                            <li><span>Envíenos el justificante bancario de su transferencia a la dirección de email <a href="mailto:{ezini( 'Infocompras', 'Mail', 'basket.ini')}">{ezini( 'Infocompras', 'Mail', 'basket.ini')}</a> o por fax al número  {ezini( 'Infocompras', 'Fax', 'basket.ini')}.</li>
                                            <li><span>¡Importante!. Indique el siguiente número de pedido <strong>{$id}</strong> en las observaciones de su transferencia.</span></li>
                                        </ol>
                                        
                                       
                                        
                                        <p class="note">* Condición indispensable para el envío de las obras exceptuando aquellas que se encuentran en prepublicación. </p>
                                        
                                        </div>
                                </div>
                                            {/if}    
                                                
                                                 {if ezhttp( 'formPago', 'post')|eq(3)}
                                <div>
                                    <p class="modoPago">Ha seleccionado como modo de pago <strong>PAYPAL</strong>. Una vez haya confirmado sus datos y el pedido accederá a PayPal donde, introduciendo 
                                    su usuario y contraseña de PayPal podrá realizar el pago.</p>
                                    
                                    
                                </div>
                                {/if} 
                                
                                {if ezhttp( 'formPago', 'post')|eq(4)}
                                <div>
                                    <p class="modoPago">Ha seleccionado como modo de pago <strong>DOMICILIACIÓN BANCARIA</strong>, en la cuenta
                                    {$order_info.banco} {$order_info.sucursal} {$order_info.control} {$order_info.ncuenta} cuyo titular es <strong>{$order_info.titular_cuenta}</strong>.  
                                    </p>
                                    
                                    
                                </div>
                                {/if}     
                                
                                     {if eq( $order_info.aplazado, 1)}
                                    <div>
                                    <p class="modoPago">
                                        También ha elegido pagar a plazos su compra. El primer pago lo deberá abonar en línea y el resto de plazos se abonará cada 30 días y con la misma forma de pago escogida.
                                        Si ha escogido tarjeta de crédito o PayPal, nos pondremos en contacto con usted para definir la forma de pago de los siguientes plazos.
                                    </p>
                                    <ul class="modoPago">
                                        
                                        <li>Importe total: {ezhttp( 'total', 'post')|l10n( clean_currency)} €</li>
                                        <li>1er plazo: {ezhttp( 'importe', 'post')|l10n( clean_currency)} €</li>
                                        <li>Resto de importe pendiente: {ezhttp( 'total', 'post')|sub( ezhttp( 'importe', 'post') )|l10n( clean_currency)} €</li>
                                        <li>Nº total de plazos: {ezhttp( 'plazos', 'post')}</li>
                                    </ul>
                                    </div>
                                    {/if}  
                                    <div>
                                        <p class="modoPago">Muchas gracias por confiar en nuestra documentación jurídica</p>
                                    </div>     
                                               <div class="clearFix">
                                                   {* <span class="volver"><a href="">Volver</a></span>*}
                                                   {$id}
                                                    <span class="submit"><input type="image" src={"btn_comprar.gif"|ezimage} alt="Comprar" name="Btn_{concat( 'cesta', $basket.order_id )|md5}" /></span>
                                                
                                                </div>  
                                                                                                                
                                                                                    
                                        </div>
                                
                                    </div> 
                                    
                                    
                                                                                                                           
                            </div>
                            {foreach $datos.fields as $field}
                            <input type="hidden" name="{$field.name}" value="{$field.value}" />
                            {/foreach}
                            
                                                   
                            
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
                
            
        
            
        
        
        

        
