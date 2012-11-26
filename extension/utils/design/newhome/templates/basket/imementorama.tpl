{ezpagedata_set( 'main_class', 'imemento')}
		{ezpagedata_set( 'bodyclass', 'fichas')}
{def $object = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'Object', 'imemento.ini' ) ))}
			<div class="columnType1">
				<div class="confImemento">
					<h2 class="logo"><img src={"logo_iMemento.png"|ezimage} alt="iMemento"/></h2>
					<div class="entry">
						<h3>Configure su iMemento</h3>
					{$object.data_map.texto_configure_su_imemento.content.output.output_text}
					</div>
					<div class="sub_entry" id="tblint">
						<h4>Configuración de packs:</h4>
                 
						{$object.data_map.texto_configuracion_packs.content.output.output_text}
					</div>
					<ul class="tabs">
						<li><a href={"basket/imemento"|ezurl}>Descuentos disponibles</a></li>
						<li class="sel"><a href={"basket/imementorama"|ezurl}>Configuración a la carta rama del derecho</a></li>
					</ul>
					<div class="tabContent">
						<ul class="packs">
                            {foreach $object.data_map.packs.content.relation_browse as $packobject}
                            {def $pack = fetch( 'content', 'object', hash( 'object_id', $packobject.contentobject_id))}
							<li>
								<h5><a href="{$pack.main_node.url_alias|ezurl(no)}">{$pack.name}</a></h5>
								{$pack.data_map.entradilla.content.output.output_text}
								<a class="addCart" href={concat("basket/add/", $pack.id, '/1' )|ezurl}><img alt="Añadir a la cesta" src={"btn_aniadir-compra.gif"|ezimage} /></a>
								<div class="precio">
									<span class="pvp"><del>{$pack.data_map.precio.content.ex_vat_price|l10n('clean_currency)} € + IVA</del></span>
									{if eq($pack.data_map.oferta_qmementix.content.price,0)}
										<span class="pvp-offer"><ins>{$pack.data_map.precio_oferta.content.ex_vat_price|l10n('clean_currency)} € + IVA</ins></span>
									{/if}
								</div>
							</li>
                            {undef $pack}
                            {/foreach}
						</ul>
					</div>
				</div>
			</div>
			<div class="sidebar">
				<div class="help">
					<h2>¿Tiene alguna duda?</h2>
					<a href={"contacto"|ezurl}>Pulse aquí y contactaremos con usted</a>
					<p>O si lo prefiere llámenos al <strong>91 210 80 00</strong></p>
				</div>
			</div>


{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js', 'ui.core.js', 'ui.slider.js', 'imementocarta.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css', 'imemento.css') )}
