{def $products = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $training = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '{/literal}{$id_pedido_lfbv}{literal}',           // order ID - required
    'Ediciones Francis Lefebvre',  // affiliation or store name
    '{/literal}{$basket.price_ex_vat|explode(',')|implode('.')}{literal}',          // total - required
    '{/literal}{$basket.price_inc_vat|dec( $basket.price_ex_vat )|explode(',')|implode('.')}{literal}',           // tax
    '0',              // shipping
    'Madrid',       // city
    'Madrid',     // state or province
    'Spain'             // country
  ]);
{/literal}
    {foreach $products as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id_pedido_lfbv}{literal}',           // order ID - required
    '{/literal}{$product.contentobject.data_map.referencia.content}{literal}',           // SKU/code - required
    '{$product.name}',        // product name
    '',   // category or variation
    '{/literal}{$product.price_ex_vat|explode(',')|implode('.')}{literal}',          // unit price - required
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
              
<!-- Google Code for Venta Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "es";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "cKHcCIPSiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1053841085/?label=cKHcCIPSiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- Google Code for Home Page Remarketing List -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "666666";
var google_conversion_label = "_xsRCIvRiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?label=_xsRCIvRiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>        
            
        
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
											<li>Muchas gracias por su colaboración.</li>
                                            <li>Pulse <a href={"/"|ezurl}>aquí</a> para volver a nuestra página principal</li>

										</ul>
										
                                        
										
										
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
