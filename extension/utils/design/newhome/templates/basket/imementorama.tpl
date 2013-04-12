{ezpagedata_set( 'main_class', 'imemento')}
		{ezpagedata_set( 'bodyclass', 'fichas')}
{def $object = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'Object', 'imemento.ini' ) ))}
{def $tabla = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'TablaJuridica', 'imemento.ini' ) ))}
{def $node=fetch('content','node',hash('node_id',$object.main_node_id))}
<div id="iMementoDest" class="clearFix">
	<div class="clearFix">
		<h2 class="logo"><img src={"logo_iMemento.png"|ezimage} alt="iMemento"/></h2>
			<div class="resume">
				<ul class="features">
					<li>
						<p>iMemento le permite consultar varios Mementos de un área o de distintas áreas jurídicasen
la misma aplicación, como si fuera una biblioteca que configura usted mismo.</p>
					</li>
					<li>
						<p><strong>Adquiera con importantes descuentos sus Mementos en formato Pack por área jurídica.</strong></p>
					</li>
				</ul>
				<ul class="boxes">
				{def $impar=1}
				{def $par=0}
				{foreach $tabla.current.data_map.tabla_precios.content.rows.sequential as $index=>$rows}
					<li class="type2">
								<strong class="title">{$tabla.current.data_map.tabla_precios.content.matrix.cells[$index|sum($par)]}</strong>
								{set $par = $par|sum(1)}
								<span class="desc">
									<strong class="percent">
									{$tabla.current.data_map.tabla_precios.content.matrix.cells[$index|sum($impar)]}
									{set $impar = $impar|sum(1)}
									%</strong>
									<span class="text">de descuento</span>
								</span>
							</li>
				{/foreach}			

						</ul>
					</div>
					
					<div class="infoDest">
						<div class="contact">
							<p class="tit">¿Tiene alguna pregunta?</p>
							<span class="link"><a href={"contacto"|ezurl()}>Pulse aquí y contactaremos con usted</a></span>
							<p class="subtit">O si lo prefiere llámenos al <span class="tel">91 210 80 00</span></p>
						</div>

						<div class="contact">
							<p class="tit">¿Ha utilizado ya iMemento?</p>
							{def $current_user=fetch( 'user', 'current_user' )}  
							{def $user_id=$current_user.contentobject_id}
							{def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.node_id , 'usuario',$user_id ))} 
							{if $current_user.is_logged_in}
								{if $havotado|gt(0)}
									<span class="link"><a href="/producto/opinion?n=already" id="formOpinion">Envíenos su opinión</a></span>
								{else}
									<span class="link"><a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion">Envíenos su opinión</a></span>
								{/if}
							{else}
								<span class="link"><a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion">Envíenos su opinión</a></span>
							{/if}
							
							{undef $user_id}
							{undef $current_user}
							
						</div>

					</div>
				</div>
</div>

<form action={"basket/basket"|ezurl} method="post" id="mementosForm" name="mementosForm">
<div id="gridTwoColumnsFichas" class="clearFix">
				<div class="columnType2 flt">
					<ul class="configMementos clearFix">
						<li><a href="/basket/imemento">Configuración por tipo de memento</a></li>
						<li class="sel"><a href="/basket/imementorama">Configuración por área jurídica</a></li>
					</ul>

                	<div class="modType4_2">						                    	                    	                    	
                		{def $mementos = $object.data_map.imemento_productos.content}
                    	<div class="listado" id="productlist">
                    		<h2 class="hide">Seleccione sus Packs</h2>
                            <table class="imementos juridica">
                            	<thead>
                            		<tr>
                            			<th class="name" ><span>Packs disponibles</span></th>
                            			<th class="pvp">PVP</th>
                            			<th class="selection">Su selección</th>
                            		</tr>
                            	</thead>
								<tbody id="table-rows">
								{foreach $object.data_map.packs.content.relation_browse as $index => $packobject}
								{def $pack = fetch( 'content', 'object', hash( 'object_id', $packobject.contentobject_id))}
										<tr {if eq($index,0)} id="iMBase" {/if}>
										
										<td>
                            				
                            					<label for="memento_{$pack.id}">{$pack.name}</label>
                            					<div class="desc">
                            						{$pack.data_map.entradilla.content.output.output_text}
													{if $pack.data_map.descuento_pack.has_content}	
														<p class="discount">Descuento:{$pack.data_map.descuento_pack.data_text}%</p>
													{/if}
                            					</div>
                            				
                            			</td>
                            			
                            			<td class="pvp">
												{if eq($pack.data_map.oferta_qmementix.content.price,0)}
													<del>{$pack.data_map.precio.content.ex_vat_price|l10n('clean_currency')} € + IVA</del>
													<ins>{$pack.data_map.precio_oferta.content.ex_vat_price|l10n('clean_currency')} € + IVA</ins>
												{else}	
													<ins>{$pack.data_map.precio.content.ex_vat_price|l10n('clean_currency')} € + IVA</ins>
												{/if}
                            				
                            			</td>
                            			<td class="selection">
											{if eq($pack.id,$content[$pack.id])}
												<span class="input c_on">
													<input type="checkbox" id="memento_{$pack.id}" name="mementos[]" value="{$pack.id}" class="pretty" checked="checked" />
													<input type="hidden" id="ProductItemIDList_{$pack.id}" name="ProductItemIDList_{$pack.id}" value="{$removeitem[$pack.id]}"  />
                            					</span>
											{else}
												<span class="input c_off">
													<input type="checkbox" id="memento_{$pack.id}" name="mementos[]" value="{$pack.id}" class="pretty" />
													<input type="hidden" id="ProductItemIDList_{$pack.id}" name="ProductItemIDList_{$pack.id}" value=""  />
                            					</span>
											{/if}	
                            				
                            			</td>	
										
										</tr>
										<tr class="sep"><td colspan="3"></td></tr>
									{undef $pack}
								{/foreach}
                            	</tbody>
                    		</table>

						</div>
						
					</div>

                	</div>
					
	
	<div class="columnType1 frt">
						<div class="myIMemento clearFix" id="modMiImemento">
	                        <span class="tit"><img src={"logo_iMemento.png"|ezimage()} alt="iMemento" /></span>
	                        <div class="resume">
	                            <p class="clearFix"><strong><span class="flt">Has seleccionado:</span> <span class="cant" id="modMiImementoInt">{$productos|count} Pack{if ne($productos|count,1)}s{/if}</span></strong></p>
	                            <div class="basketrama" id="basketAdd">
								
								{foreach $productos as $index => $producto}
									<p>Nombre: {$producto.name}</p>
									<p>Precio: <del><span id="partial">{$producto.precio}</span></del></p>
	                            	<p>Precio: <ins><span id="ptotal">{$producto.total}</span></ins></p>
	                            	<p class="discount">Descuento: <span id="dtotal">{$producto.discountpercent}%</span></p>
									{*if ge($index,1)*}<div class="sepBasket"></div>{*/if*}
								{/foreach}
									
								</div>
								<img src={"ajax-loader.gif"|ezimage} id="preload" style="display: none;"/>
								<input type="image" id="addToBasket" src={"btn_aniadir-compra.gif"|ezimage} alt="Añadir a la cesta" name="AddToBasket">
							</div>
						</div>
						<input type="hidden" name="partial" id="partialfield" value="" />
						<input type="hidden" name="discount" id="discountfield" value="" />
						<input type="hidden" name="total" id="totalfield" value="" />
						<input type="hidden" name="object" id="object" value="{ezini( 'iMemento', 'Object', 'imemento.ini' )}" />
				</div>
				
             </form>   					
					
</div>
				
			

{ezscript_require( array('imementoramacarta.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css', 'imemento.css') )}