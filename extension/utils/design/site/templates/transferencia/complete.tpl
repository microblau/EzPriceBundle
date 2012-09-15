{def $products_ua = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $training_ua = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $order_info_ua = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '{/literal}{$id}{literal}',           // order ID - required
    'Ediciones Francis Lefebvre',  // affiliation or store name
    '{/literal}{$basket.total_ex_vat}{literal}',          // total - required
    '{/literal}{$basket.total_inc_vat|sub( $basket.total_ex_vat )}{literal}',           // tax
    '0',              // shipping
    'Madrid',       // city
    'Madrid',     // state or province
    'Spain'             // country
  ]);
{/literal}
    {foreach $products_ua as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id}{literal}',           // order ID - required
    '{/literal}{$product.item_object.contentobject.data_map.referencia.content}{literal}',           // SKU/code - required
    '{/literal}{$product.object_name}{/literal}',        // product name
{/literal}
{def $formato = $product.item_object.contentobject.data_map.formato.content.relation_list.0}

{def $formatoobject= fetch('content', 'object', hash( 'object_id', $formato.contentobject_id))}

{literal}
    '{/literal}{$formatoobject.name}{literal}',   // category or variation
{/literal}
{undef $formato $formatoobject}
{literal}
    '{/literal}{$product.total_price_ex_vat}{literal}',          // unit price - required
    '{/literal}{$product.item_count}{literal}'               // quantity - required
  ]);
{/literal}
{/foreach}
{foreach $training_ua as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id}{literal}',           // order ID - required
    '{/literal}{literal}',           // SKU/code - required
    '{/literal}{$product.object_name}{/literal}',        // product name
{/literal}
{def $formato = $product.item_object.contentobject.data_map.formato.content.relation_list.0}

{def $formatoobject= fetch('content', 'object', hash( 'object_id', $formato.contentobject_id))}

{literal}
    '{/literal}''{literal}',   // category or variation
{/literal}
{undef $formato $formatoobject}
{literal}
    '{/literal}{$product.total_price_ex_vat}{literal}',          // unit price - required
    '{/literal}{$product.item_count}{literal}'               // quantity - required
  ]);
{/literal}
{/foreach}
{literal}
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
{/literal}
</script>                                
        
            
        
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
                                            <li>El pedido <strong>Nº {$id}</strong> se ha procesado con éxito.</li>
                                            <li>En breves instantes <strong>recibirá un email</strong> con la información de dicho proceso. Si esto no ocurre en los próximos minutos póngase en contacto con nosotros.</li>

                                        </ul>
                                        
                                        <div class="instruccionesTransferencia">
                                        
                                        <h2>Instrucciones de pago por transferencia</h2>
                                        <ol>
                                            <li><span>Haga su transferencia antes de 72 horas* en el siguiente número de <abbr ttile="Cuenta Corriente">C/C</abbr>: {ezini( 'Infocompras', 'CC', 'basket.ini')}.</span></li>
                                            <li><span>Envíenos el justificante bancario de su transferencia a la dirección de email <a href="mailto:{ezini( 'Infocompras', 'Mail', 'basket.ini')}">{ezini( 'Infocompras', 'Mail', 'basket.ini')}</a> o por fax al número  {ezini( 'Infocompras', 'Fax', 'basket.ini')}.</li>
                                            <li><span>¡Importante!. Indique el siguiente número de pedido <strong>{$id}</strong> en las observaciones de su transferencia.</span></li>
                                        </ol>
                                        
                                        <p>Muchas gracias por confiar en nuestra documentación jurídica</p>
                                        
                                        <p class="note">* Condición indispensable para el envío de las obras exceptuando aquellas que se encuentran en prepublicación. </p>
                                        
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                    </div>                                                                                                  
                            </div>  
                                   
                            </div>             
                            <div id="modType3">
                                <h2 class="title">Déjenos conocerle</h2>
                                <div class="wrap clearFix curvaFondo">                          
                                    <div class="description">
                                        <div class="cont" style="padding:20px;">
                                            <form action={concat( "transferencia/complete/", $id)|ezurl} method="post" id="finCompraForm" class="formulario conocer" name="finCompraForm">
                                                
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
                
            
        
            
        

