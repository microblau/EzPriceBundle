{ezpagedata_set( 'main_class', 'imemento')}
		{ezpagedata_set( 'bodyclass', 'fichas')}
{def $object = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'Object', 'imemento.ini' ) ))}
			<div class="columnType1">
                <form action={"basket/addimemento"|ezurl} method="post" id="mementosForm" name="mementosForm">
				<div class="confImemento">
					<h2 class="logo"><img src={"logo_iMemento.png"|ezimage} alt="iMemento"/></h2>
					<div class="entry">
						<h3>Configure su iMemento</h3>
												{$object.data_map.texto_configure_su_imemento.content.output.output_text}
					</div>
					<div class="sub_entry">
						<h4>Configuración a la carta:</h4>
						{$object.data_map.texto_configuracion_a_la_carta.content.output.output_text}
					</div>
					<ul class="tabs">
						<li class="sel"><a href={"basket/imemento"|ezurl}>Configuración a la carta</a></li>
						<li><a href={"basket/imementorama"|ezurl}>Configuración a la carta rama del derecho</a></li>
					</ul>
					<div class="tabContent" id="accesoMementos">
						<fieldset>
							<ul>
								{def $mementos = $object.data_map.imemento_productos.content}
                                                             
                                                        {foreach $mementos.relation_browse as $el}
                                                            {def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
                                                                <li>
															<input type="checkbox" id="memento_{$memento.id}" name="mementos[]" value="{$memento.id}" />
															<label for="memento_{$memento.id}">{if $emmento.data_map.nombre_mementix.content|ne('')}{$memento.data_map.nombre_mementix.content}{else}{$memento.name}{/if}</label>

														</li>
                                                            {undef $memento}
                                                        {/foreach}														
							</ul>
						</fieldset>
					</div>
				</div>
			</div>
			<div class="sidebar">
				<div class="miImemento" id="modMiImemento">
					<h2>Mi iMemento</h2>
					<ul class="cesta">
						<li class="listMem"><span class="listaMem">0 Mementos</span></li>
						<li class="total"><span class="precio" id="partial"{$object.data_map.precio.content.ex_vat_price|l10n('clean_currency)} €</span></li>
						<li class="descuento"><span><span id="discount">0%</span> descuento</span></li>
						<li class="total"><span class="productoTotal">TOTAL</span><span class="precioTotal" id="ptotal">0 €</span></li>
						<li class="reset"><input type="image" id ="addToBasket" src={"btn_aniadir-compra.gif"|ezimage} alt="Añadir a la cesta" name="AddToBasket" /></li>
					</ul>
				</div>
				<div class="help">
					<h2>¿Tiene alguna duda?</h2>
					<a href={"contacto"|ezurl}>Pulse aquí y contactaremos con usted</a>
					<p>O si lo prefiere llámenos al <strong>91 210 80 00</strong></p>
				</div>
			</div>
         <input type="hidden" name="partial" id="partialfield" value="" />
                    <input type="hidden" name="discount" id="discountfield" value="" />
                    <input type="hidden" name="total" id="totalfield" value="" />
                    <input type="hidden" name="object" id="object" value="{ezini( 'iMemento', 'Object', 'imemento.ini' )}" />
</form>

{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js', 'ui.core.js', 'ui.slider.js', 'imementocarta.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css', 'imemento.css') )}
