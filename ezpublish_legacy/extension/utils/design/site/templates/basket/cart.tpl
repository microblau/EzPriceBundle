						{def $basket = fetch( 'shop', 'basket')}                          		
                    	<h2>Estoy comprando...</h2>
                        <ul>
							{foreach $basket.items|sortbasketitems() as $index => $item}
				
							{if $item.item_object.contentobject.class_identifier|contains( 'curso_')}
							<li {if eq($index, $basket.items|count|sub(1))}class="reset"{/if}><span class="producto">{$item.item_count} x <a href={$item.item_object.contentobject.main_node.url_alias|ezurl_formacion()}>{$item.item_object.name}</a></span><span class="precio">{$item.total_price_ex_vat|l10n(clean_currency)} €</span></li>
							{else}
                        	<li {if eq($index, $basket.items|count|sub(1))}class="reset"{/if}><span class="producto">{$item.item_count} x <a href={$item.item_object.contentobject.main_node.url_alias|ezurl()}>{$item.item_object.name}</a></span><span class="precio">{$item.total_price_ex_vat|l10n(clean_currency)} €</span></li>
                        	{/if}
                        	{/foreach}                            
                            <li class="total"><span class="productoTotal">TOTAL</span><span class="precioTotal">{$basket.total_ex_vat|l10n( clean_currency )} €</span></li>
                        </ul>