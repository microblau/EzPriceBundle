						{def $basket = fetch( 'shop', 'basket')}
						{def $order_info = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}			
                                                {def $gastos_envio = fetch( 'basket', 'gastos_envio', hash())}			

						
                    	<h2>Estoy comprando...</h2>
                        <ul>
							{foreach $basket.items|sortbasketitems() as $index => $item}
				
							{if $item.item_object.contentobject.class_identifier|contains( 'curso_')}
							<li {if eq($index, $basket.items|count|sub(1))}class="reset"{/if}><span class="producto">{$item.item_count} x <a href={$item.item_object.contentobject.main_node.url_alias|ezurl_formacion()}>{$item.item_object.name}</a></span><span class="precio">{$item.total_price_ex_vat|l10n(clean_currency)} €</span></li>
							{else}
							<li {if eq($index, $basket.items|count|sub(1))}class="reset"{/if}><span class="producto">{$item.item_count} x <a href={$item.item_object.contentobject.main_node.url_alias|ezurl()}>{$item.item_object.name}</a></span><span class="mementos">{$order_info.has_imemento.mementos}.</span><span class="precio">{$item.total_price_ex_vat|l10n(clean_currency)} €</span>
							</li>		
							{/if}
                        	{/foreach}                            
                            <li class="total"><span class="productoTotal">TOTAL</span><span class="precioTotal">{$basket.total_ex_vat|l10n( clean_currency )} €</span></li>
                            {if $gastos_envio|gt(0)}
                            <li class="total"><span class="productoTotal">Envío</span><span class="precioTotal">{$gastos_envio|l10n( clean_currency )} €</span><br/>
                            <span style="display:block; text-align:right"><a class="ajax" href={"basket/gastosenvio"|ezurl}>Más información</a></span></li>
                            {else}
                            <li class="total"><span class="productoTotal">Envío</span><span class="precioTotal" style="font-size: 11px">No se aplican</span><br/>
                            <span style="display:block; text-align:right"><a class="ajax" href={"basket/gastosenvio"|ezurl}>Más información</a></span></li>
                            {/if}
                        </ul>
						{undef $order_info}
                                                
{ezscript_require( array(  'colorbox/jquery.colorbox-min.js') )}
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