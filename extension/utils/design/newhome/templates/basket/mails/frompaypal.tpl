{*?template charset=utf8?*}
{def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $order.productcollection_id ))}
{def $training = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $order.productcollection_id ))}

<table bgcolor="#ffffff" width="100%">
    <tr>
        <td align="center">
        
            <table width="590" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="590" cellpadding="0" cellspacing="0" bgcolor="#00528d">
                            <tr>
                                <td colspan="5" height="20" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td width="189"><a href="http://{ezsys( 'hostname' )}{"/"|ezurl(no)}"><img  src="http://{ezsys( 'hostname' )}/{"mail/logo_efl.gif"|ezimage(no, true())}"  /></a></td>
                                <td width="14" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#88b5dd;">La Referencia en libros jurídicos</td>
                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" height="20" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" height="6" bgcolor="#4b90cc" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="590">
                        <table width="590" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">
                            <tr>
                                <td colspan="3" height="20" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td width="570" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;"><tr>
                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 1px; line-height: 1px;" width="10">&nbsp;</td>
                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: rgb(0, 0, 0);" width="570">
<p>El Pedido {$id} se ha realizado con éxito a fecha {currentdate()|datetime( 'custom', '%d/%m/%Y')}</p>

<p>Ha seleccionado como modo de pago PAYPAL.</p>

<p>Muchas gracias por confiar en nuestra documentación jurídica.</p>

</td>
                                <td style="font-family: Arial,Helvetica,sans-serif; font-size: 1px; line-height: 1px;" width="10">&nbsp;</td>
                            </tr>

</td>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td width="570">
                                    <table width="570" cellpadding="0" cellspacing="0">
                                        <tr><td height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                        <tr><td><img alt="" style="display:block; margin:0; padding:0;"  src="http://{ezsys( 'hostname' )}/{"mail/curve_top-principal.gif"|ezimage( no, true())}"/></td></tr>
                                        <tr>
                                            <td bgcolor="#c6e7ff">
                                                <table width="570" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                        <td width="550">
                                                            <table cellpadding="0" cellspacing="0">
                                                                <!--tabla superior con detalle de pedido-->
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0">
                                                                            <tr><td><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_top-table1.gif"|ezimage( no, true() )}"  /></td></tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0">
                                                                                        <tr>
                                                                                            <td width="2" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                            <td width="546">
                                                                                                <table width="546" cellpadding="6" cellspacing="0">
                                                                                                    <thead>
                                                                                                    <tr>
                                                                                                        <th width="276" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#3B74A5; font-weight:bold;">Productos</th>
                                                                                                        <th width="60" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#3B74A5; font-weight:bold;">Unidades</th>
                                                                                                        <th width="80" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#3B74A5; font-weight:bold;">Precio</th>
                                                                                                        <th width="50" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#3B74A5; font-weight:bold;">IVA</th>
                                                                                                        <th width="80" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#3B74A5; font-weight:bold;">Total</th>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                                    <!--tfoot>
                                                                                                        <tr><td colspan="5" height="24" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                                                                                        <tr><td colspan="5" height="2" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px; border-top:1px solid #C0C0C0">&nbsp;</td></tr>
                                                                                                        <tr>
                                                                                                            <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">TOTAL (sin IVA)</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333; font-weight:bold">1.920,00 €</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold;">TOTAL</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#00674E; font-weight:bold;">2.200,00 €</td>
                                                                                                        </tr>
                                                                                                    </tfoot-->
                                                                                                    <tbody>
                                                                                                    {foreach $products as $product}
                                                                                                    <tr>
                                                                                                        <td bgcolor="#ffffff" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00528D; font-weight:bold;">{if $product.item_object.contentobject.contentclass_id|eq(98)}
{$product.object_name}<br />
 <span style="font-size:11px; font-weight:normal">{$info.has_mementix.mementos}. 
  <strong>{$info.has_mementix.accesos}</strong></span>
 {elseif $product.item_object.contentobject.contentclass_id|eq(101)}
{$product.object_name}<br />
 <span style="font-size:11px; font-weight:normal">{$info.has_nautis4.mementos}. 
  <strong>{$info.has_nautis4.accesos}</strong></span>
 {elseif $product.item_object.contentobject.contentclass_id|eq(142)}
{$product.object_name}<br />
 <span style="font-size:11px; font-weight:normal">{$info.has_imemento.mementos}.</span> 
{elseif $product.item_object.contentobject.contentclass_id|eq(147)}
{$product.object_name}<br />
 <span style="font-size:11px; font-weight:normal">{$info.has_imemento.mementos}.</span>   
{else}
{$product.item_object.name}
{/if}</td>
                                                                                                        <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">{$product.item_count}</td>
                                                                                                        <td bgcolor="#ffffff" colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00674E; font-weight:bold">{$product.total_price_ex_vat|l10n(clean_currency)} € <span style="font-weight:normal">+ {$product.vat_value}%</span>
                                                                                                        {if gt($product.discount_percent,0)}
                                                                 <br><span style="color:#990000">
                                                                       
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
                                                                {/if}
                                                                                                        </td>
                                                                                                        <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00674E; font-weight:bold">{$product.total_price_inc_vat|l10n(clean_currency)} €</td>
                                                                                                    </tr>
                                                                                                    {/foreach}
                                                                                                    
                                                                                                     {foreach $training as $product}
                                                                                                    <tr>
                                                                                                        <td bgcolor="#ffffff" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00528D; font-weight:bold;">{$product.object_name}</td>
                                                                                                        <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">{$product.item_count}</td>
                                                                                                        <td bgcolor="#ffffff" colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00674E; font-weight:bold">{$product.total_price_ex_vat|l10n(clean_currency)} € <span style="font-weight:normal">+ {$product.vat_value}%</span>
                                                                                                        
                                                                                                        {if gt($product.discount_percent,0)}
                                                                <br><span style="color:#990000">
                                                                       
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
                                                                </span>
                                                                {/if}
                                                                                                        </td>
                                                                                                        <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#00674E; font-weight:bold">{$product.total_price_inc_vat|l10n(clean_currency)} €</td>
                                                                                                    </tr>
                                                                                                    {/foreach}                                                                                                   
                                                                                                    
                                                                                                    <tr><td colspan="5" height="24" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                                                                                        <tr><td colspan="5" height="2" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px; border-top:1px solid #C0C0C0">&nbsp;</td></tr>
                                                                                                        <tr>
                                                                                                            <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">TOTAL (sin IVA)</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#333333; font-weight:bold">{$order.total_ex_vat|l10n( clean_currency )} €</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; font-weight:bold;">TOTAL</td>
                                                                                                            <td colspan="2" bgcolor="#ffffff" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#00674E; font-weight:bold;">{$order.total_inc_vat|l10n( clean_currency )} €</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                    
                                                                                                </table>
                                                                                            </td>
                                                                                            <td width="2" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                            
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                
                                                                            </tr>
                                                                            <tr><td><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_bot-table1.gif"|ezimage( no, true() )}"  /></td></tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <tr><td height="20" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                                                <!--tabla central método de pago-->
                                                                {*
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;"  src="http://{ezsys( 'hostname' )}/{"mail/curve_top-table2.gif"|ezimage( no, true())}" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                <td width="530" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">El pago lo ha realizado mediante Pay-Pal. El pago lo ha realizado mediante Pay-Pal. El pago lo ha realizado mediante Pay-Pal. El pago lo ha realizado mediante Pay-Pal. El pago lo ha realizado mediante Pay-Pal.</td>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_bot-table1.gif"|ezimage(no, true())}"  /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                *}
                                                                
                                                                {if $info.aplazado|eq(1)}
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;"  src="http://{ezsys( 'hostname' )}/{"mail/curve_top-table2.gif"|ezimage( no, true())}" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                <td width="530" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">
                                                                                <p>
                                        También ha elegido pagar a plazos su compra. El primer pago lo deberá abonar en línea y el resto de plazos se abonará cada 30 días y con la misma forma de pago escogida.
                                        Si ha escogido tarjeta de crédito o PayPal, nos pondremos en contacto con usted para definir la forma de pago de los siguientes plazos.
                                    </p>
                                    <ul >
                                        
                                        <li>Importe total: {$info.total|l10n( clean_currency)} €</li>
                                        <li>1er plazo: {$info.total|div($info.plazos)|l10n( clean_currency)} €</li>
                                        <li>Resto de importe pendiente: {$info.total|sub( $info.total|div($info.plazos) )|l10n( clean_currency)} €</li>
                                        <li>Nº total de plazos: {$info.plazos}</li>
                                    </ul>
                                                                                </td>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_bot-table1.gif"|ezimage(no, true())}"  /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                {/if}
                                                                <tr><td height="20" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                                                <!--tabla inferior con datos de facturación-->
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_top-table2.gif"|ezimage( no, true() ) }" /></td>
                                                                            </tr>
                                                                           
                                                                            {if $info.tipo_usuario|eq(2)}
                                                                             <tr>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                <td width="530">
                                                                                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">DATOS DE FACTURACIÓN</p>   
                                                                                    
                                                                                    <table width="530" cellpadding="5" cellspacing="0">
                                                                                         {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.email}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre empresa:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.empresa}</td>
                                                                                        </tr>
<tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nombre}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellidos:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.apellido1} {$info.apellido2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">NIF/CIF:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.cif}</td>
                                                                                        </tr>                                                                         
                                                                                       
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono}</td>
                                                                                        </tr>
                                                                                        {if $info.telefono_empresa|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono de empresa:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono_empresa}</td>
                                                                                        </tr>
                                                                                        {/if}
                                                                                        {if $info.fax|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Fax:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.fax}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Dirección:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.tipovia}/ {$info.dir1}, {$info.num}. {$info.complemento}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">País:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$countries[$info.pais]}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Provincia:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.provincia}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Localidad:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.localidad}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Código Postal:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.cp}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    {def $c1 = $info.tipovia|ne($info.tipovia2)}
                                                                                    {def $c2 = $info.dir1|ne($info.dir12)}
                                                                                    {def $c5 = $info.num|ne($info.num2)}
                                                                                    {def $c3 = $info.complemento|ne($info.complemento)}
                                                                                    {def $c4 = $info.cp|ne($info.cp2)}
                                                                                    {if $info.datos_coinciden|eq('no')}
                                                                                     <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">DATOS DE ENVÍO</p>   
                                                                                    
                                                                                    <table width="530" cellpadding="5" cellspacing="0">
                                                                                         {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nombre2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellidos:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.apellido12} {$info.apellido22}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre empresa:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.empresa2}</td>
                                                                                        </tr> 
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono de contacto:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono2}</td>
                                                                                        </tr>
                                                                                        {if $info.movil2|ne('')}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Móvil de contacto:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.movil2}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        {if $info.fax2|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Fax:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.fax2}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Dirección:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.tipovia2}/ {$info.dir12}, {$info.num2}. {$info.complemento2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">País:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$countries[$info.pais]}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Provincia:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.provincia2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Localidad:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.localidad2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Código Postal:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.cp2}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    {/if}
                                                                                    {foreach $info.cursos as $curso}
                                                                                        {if $curso.id|eq('no')}
                                                                                        <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">Asistente al curso {$curso.nombre}</p>
                                                                                        <table width="530" cellpadding="5" cellspacing="0">
                                                                                        {if $curso.asistente.nombre|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.nombre}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if} 
                                                                                        {if $curso.asistente.apellido1|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellido 1:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.apellido1}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}    
                                                                                        {if $curso.asistente.apellido2|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellido 2:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.apellido2}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if} 
                                                                                        {if $curso.asistente.profesion|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Profesión:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.profesion}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.cargo|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Cargo:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.cargo}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.telefono|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.telefono}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.email|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.email}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}
                                                                                         {if $curso.asistente.fax|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.fax}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}                              
                                                                                                                
                                                                                         </table>                                                           
                                                                                        {/if}
                                                                                        {/foreach}
                                                                                </td>                                                   
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                            </tr>
                                                                            {elseif $info.tipo_usuario|eq(1)}
                                                                            <tr>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                <td width="530">
                                                                                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">DATOS DE FACTURACIÓN</p>   
                                                                                    
                                                                                    <table width="530" cellpadding="5" cellspacing="0">
                                                                                         {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nombre}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellidos:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.apellido1} {$info.apellido2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.email}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">NIF/CIF:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nif}</td>
                                                                                        </tr>                                                                         
                                                                                       
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono}</td>
                                                                                        </tr>
                                                                                        {if $info.movil|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Móvil:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.movil}</td>
                                                                                        </tr>
                                                                                        {/if}
                                                                                        {if $info.fax|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Fax:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.fax}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Dirección:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.tipovia}/ {$info.dir1}, {$info.num}. {$info.complemento}</td>
                                                                                        </tr>
                                                                                        {def $pais = $order_info.pais}
                                                                                        {if $pais|eq('')}
                                                                                        {set $pais = 'ES'}
                                                                                        {/if}
                                                   
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">País: </td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$countries[$pais]}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Provincia:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.provincia}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Localidad:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.localidad}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Código Postal:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.cp}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    {def $c1 = $info.tipovia|ne($info.tipovia2)}
                                                                                    {def $c2 = $info.dir1|ne($info.dir12)}
                                                                                    {def $c5 = $info.num|ne($info.num2)}
                                                                                    {def $c3 = $info.complemento|ne($info.complemento)}
                                                                                    {def $c4 = $info.cp|ne($info.cp2)}
                                                                                    {if $info.datos_coinciden|eq(no)}
                                                                                     <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">DATOS DE ENVÍO</p>   
                                                                                    
                                                                                    <table width="530" cellpadding="5" cellspacing="0">
                                                                                         {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nombre2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellidos:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.apellido12} {$info.apellido22}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre empresa:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.empresa2}</td>
                                                                                        </tr> 
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono2}</td>
                                                                                        </tr>
                                                                                        {if $info.movil2|ne('')}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Móvil:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.movil2}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        {if $info.fax2|ne('')}
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Fax:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.fax2}</td>
                                                                                        </tr>
                                                                                        {/if}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Dirección:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.tipovia2}/ {$info.dir12}, {$info.num2}. {$info.complemento2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">País:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$countries[$info.pais]}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Provincia:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.provincia2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Localidad:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.localidad2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Código Postal:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.cp2}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    {/if}
                                                                                    {foreach $info.cursos as $curso}
                                                                                        {if $curso.id|eq('no')}
                                                                                        <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">Asistente al curso {$curso.nombre}</p>
                                                                                        <table width="530" cellpadding="5" cellspacing="0">
                                                                                        {if $curso.asistente.nombre|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.nombre}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if} 
                                                                                        {if $curso.asistente.apellido1|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellido 1:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.apellido1}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}    
                                                                                        {if $curso.asistente.apellido2|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellido 2:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.apellido2}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if} 
                                                                                        {if $curso.asistente.profesion|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Profesión:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.profesion}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.cargo|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Cargo:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.cargo}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.telefono|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.telefono}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}  
                                                                                        {if $curso.asistente.email|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.email}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}
                                                                                         {if $curso.asistente.fax|ne('')}                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$curso.asistente.fax}</td>
                                                                                        </tr>                                                                                       
                                                                                        {/if}                              
                                                                                                                
                                                                                         </table>                                                           
                                                                                        {/if}
                                                                                        {/foreach}
                                                                                </td>                                                   
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                            </tr>
                                                                            {else}
                                                                             <tr>
                                                                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                                <td width="530">
                                                                                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;font-weight:bold;">DATOS DE FACTURACIÓN</p>   
                                                                                    
                                                                                    <table width="530" cellpadding="5" cellspacing="0">
                                                                                         {def $countries=ezini( 'CountryNames', 'Countries', 'basket.ini' )}
                                                                                         <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Nombre:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.nombre}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Apellidos:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.apellido1} {$info.apellido2}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Email:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.email}</td>
                                                                                        </tr>
                                                                                        
                                                                                        
                                                                                        
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Teléfono:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.telefono}</td>
                                                                                        </tr>
                                                                                                                                                                           
                                                                                        
                                                                                        {def $pais = $order_info.pais}
                                                                                        {if $pais|eq('')}
                                                                                        {set $pais = 'ES'}
                                                                                        {/if}
                                                   
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">País: </td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$countries[$pais]}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="250" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000">Observaciones:</td>
                                                                                            <td width="280" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;">{$info.observaciones}</td>
                                                                                        </tr>
                                                                                     </table>
                                                                                  </td>
                                                                                </tr>
                                                                              {/if}
                                                                            
                                                                            
                                                                            <tr>
                                                                                <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="fhttp://{ezsys( 'hostname' )}/{"mail/curve_bot-table1.gif"|ezimage(no, true())}"  /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td><img alt="" style="display:block; margin:0; padding:0;"  src="http://{ezsys( 'hostname' )}/{"mail/curve_bot-principal.gif"|ezimage( no, true())}" /></td></tr>
                                        <tr><td height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                    </table>
                                </td>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td width="570" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">
                                <p><strong>Condiciones de pago:</strong> a los precios que figuran en esta Web hay que sumarles el IVA. Incluyen gastos de envío, así como el embalaje. El pago se efectuará al contado en el momento de realizar el pedido salvo que la editorial haya permitido de forma explicita su fraccionamiento. La falta de pago implicará una penalización equivalente a una vez y media el tipo de interés legal en vigor más todos los gastos bancarios ocasionados por la devolución de su forma de pago (talón, domiciliación bancaria o pagaré). Las penalizaciones serán exigibles únicamente en el caso de que la Editorial hubiera comunicado al cliente, mediante carta certificada con acuse de recibo, su situación de impago. Todo pago recibido será imputado inmediatamente a la extinción de la deuda más antigua.</p>

<p><strong>Reclamaciones:</strong> el cliente dispone de dos meses a partir de la recepción del producto, para presentar, por escrito, cualquier reclamación a Ediciones Francis Lefebvre. Una vez transcurrido este plazo, los productos entregados serán considerados como aceptados por el cliente, en cantidad y calidad. En el caso de que el cliente no hubiera recibido la mercancía, el plazo de dos meses comenzará a contar desde el momento en que se procesó su pedido en la Editorial.</p>

<p><strong>Cláusula de Jurisdicción:</strong> El presente acuerdo se regirá conforme con las leyes de España, en caso de que surjan dudas y/o divergencias en cuanto a su interpretación y/o defectos, únicamente serán competentes los Tribunales de Madrid, renunciando las partes a cualquier otro fuero que pudiera corresponderles.</p>

<p><strong>Protección de los datos personales del cliente:</strong> Con arreglo a lo dispuesto en la Ley Orgánica 15/1999, de 13 de diciembre, informamos a los usuarios de la página Web de Ediciones Francis Lefebvre que los datos personales que introduzcan en esta página van a ser incluidos en ficheros titularidad de Ediciones Francis Lefebvre, S.A., ubicados en la calle de los Monasterios de Suso y Yuso, 34; 28049 Madrid, con la finalidad de gestionar los pedidos y suscripciones de nuestros clientes y las acciones comerciales de la Compañía, pudiéndole remitirle información sobre los nuevos productos y servicios de la editorial. Asimismo, salvo que el usuario nos indique expresamente su oposición en los distintos formularios habilitados en la página Web de obtención de datos, podremos comunicar sus datos a otras empresas del grupo cuya actividad es la prestación de servicios de formación jurídica y desarrollo de software de gestión empresarial, con el fin de que puedan ofrecerle otros productos de su interés. El usuario tiene derecho a acceder a la información que le concierne, recopilada en nuestro fichero, rectificarla de ser errónea o cancelarla, así como oponerse a su tratamiento mediante comunicación escrita dirigida al domicilio referenciado anteriormente o remitiendo un mensaje de correo electrónico a la dirección marcitllach@efl.es.</p>
                                
                                </td>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="590">
                        <table width="590" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">
                            <tr>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                <td width="570">
                                    &nbsp;
                                    <table width="570" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys( 'hostname' )}/{"mail/curve_top-footer.gif"|ezimage( no, true())}" /></td>
                                        </tr>
                                        <tr>
                                            <td width="1" bgcolor="#d3d3d3" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                            <td width="568">
                                                <table width="568" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <table cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                                                <tr>
                                                                    <td colspan="5" height="5" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                    <td width="200">
                                                                        <img alt="" style="display:block; margin:0; padding:0;" usemap="#contacto" border="0"  src="http://{ezsys( 'hostname' )}/{"mail/contacta.png"|ezimage( no, true())}" />
                                                                        <map id="contacto" name="contacto">
                                                                            <area shape="rect" coords="108,16,200,24" href="mailto:clientes@efl.es" alt="" />
                                                                        </map>

                                                                    </td>
                                                                    <td width="88" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                    <td width="260">
                                                                        <img alt="" style="display:block; margin:0; padding:0;" usemap="#alta" border="0" src="http://{ezsys( 'hostname' )}/{"mail/alta.png"|ezimage(no, true())}"  />
                                                                        <map id="alta" name="alta">
                                                                           
                                                                            <area shape="rect" coords="33,14,116,21" href="http://www.efl.es/formularios/suscribase-a-nuestro-boletin-de-novedades" alt="" />
                                                                        </map>
                                                                    </td>
                                                                    <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" height="1" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;" bgcolor="#d3d3d3">&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="568" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                    <td width="548" align="left">
                                                                        <table width="548" cellpadding="2" cellspacing="0">
                                                                            <tr><td height="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td></tr>
                                                                            <tr>
                                                                                <th width="137" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; font-weight:bold; text-align:left">Catálogo</th>
                                                                                <th width="137" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; font-weight:bold; text-align:left">Formación</th>
                                                                                <th width="137" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; font-weight:bold; text-align:left">Por qué Lefebvre</th>
                                                                                <th width="137" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666; font-weight:bold; text-align:left">Quiénes somos</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo" style="color:#878787; text-decoration:none;">Todas las obras</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Cursos presenciales</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/por-que-lefebvre/valores" style="color:#878787; text-decoration:none;">Valores</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/quienes-somos/grupo-francis-lefebvre" style="color:#878787; text-decoration:none;">Grupo Francis Lefebvre</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo/por-area" style="color:#878787; text-decoration:none;">Por área</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Cursos a distancia</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/por-que-lefebvre/trayectoria" style="color:#878787; text-decoration:none;">Trayectoria</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Francis Lefebvre en España</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo/por-formato" style="color:#878787; text-decoration:none;">Por formato</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Cursos a medida</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/por-que-lefebvre/clientes" style="color:#878787; text-decoration:none;">Clientes</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">RRHH</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo/por-sector" style="color:#878787; text-decoration:none;">Por sector profesional</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Masters</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">Notas de prensa</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo/novedades" style="color:#878787; text-decoration:none;">Novedades</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="#" style="color:#878787; text-decoration:none;">¿Por qué elegirnos?</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;"><a href="http://{ezsys( 'hostname' )}/catalogo/ofertas" style="color:#878787; text-decoration:none;">Ofertas</a></td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#878787;">&nbsp;</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="1" bgcolor="#d3d3d3" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><img alt="" style="display:block; margin:0; padding:0;" src="http://{ezsys('hostname')}/{"mail/curve_bot-footer.gif"|ezimage( no, true() )}"  /></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="10" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
            </table>
        </td>
    </tr>
                            
</table>
