{ezpagedata_set( 'main_class', 'imemento')}
		{ezpagedata_set( 'bodyclass', 'fichas')}
{def $object = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'Object', 'imemento.ini' ) ))}
{def $tabla = fetch( 'content', 'object', hash( 'object_id', ezini( 'iMemento', 'Tabla', 'imemento.ini' ) ))}
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
						<p><strong>Obtenga importantes descuentos en función del número de Mementos que compre.</strong></p>
					</li>
				</ul>
				<ul class="boxes">
				{def $impar=1}
				{foreach $tabla.current.data_map.tabla_precios.content.rows.sequential as $index=>$rows}
					<li class="type1">
					
								{if eq($tabla.current.data_map.tabla_precios.content.rows.sequential|count,$index|inc)}<strong class="title">>={$index|inc} iMementos</strong>{else}<strong class="title">{$index|inc} iMemento{if gt($index,0)}s{/if}</strong>{/if}
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
<form action={"basket/addimemento"|ezurl} method="post" id="mementosForm" name="mementosForm">
<div id="gridTwoColumnsFichas" class="clearFix">
				<div class="columnType2 flt">
					<ul class="configMementos clearFix">
						<li class="sel"><a href="/basket/imemento">Configuración por tipo de memento</a></li>
						<li><a href="/basket/imementorama">Configuración por área jurídica</a></li>
					</ul>

                	<div class="modType4_2">						                    	                    	                    	
                		<div class="filter">
                			<a href="" class="filter-link">Filtre por rama del derecho</a>

                			<div class="filter-wrap">
	                			<span class="tit">Todas las ramas</span>
	                			<span class="filter-close"><a href="">Cerrar</a></span>
	                			<ul>
	                				<li><a href="">Derecho Tributario</a></li>
	                				<li><a href="">Derecho Laboral</a></li>
	                				<li><a href="">Derecho Mercantil</a></li>
	                				<li><a href="">Derecho Urbanístico - Inmobiliario</a></li>
	                				<li><a href="">Derecho Administrativo</a></li>
	                				<li><a href="">Derecho Procesal</a></li>
	                				<li><a href="">Derecho Civil</a></li>
	                				<li><a href="">Derecho Penal</a></li>
	                			</ul>
	                		</div>
                		</div>
						{def $mementos = $object.data_map.imemento_productos.content}
                    	<div class="listado" id="productlist">
                    		<h2 class="hide">Seleccione sus Mementos</h2>
                            <table class="imementos">
                            	<thead>
                            		<tr>
                            			<th class="name" ><span>Mementos disponibles</span></th>
                            			<th class="pvp">PVP</th>
                            			<th class="selection">Su selección</th>
                            		</tr>
                            	</thead>
								<tbody id="table-rows">
								{foreach $mementos.relation_browse as $el}
								{def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
									{if ne($memento.data_map.precio_imemento.content.price,0)}
										<tr>
											<td>
												<label for="memento_{$memento.id}">{if $memento.data_map.nombre_mementix.content|ne('')}{$memento.data_map.nombre_mementix.content}{else}{$memento.name}{/if}</label>
											</td>
											
											<td class="pvp">
												<strong>{$memento.data_map.precio_imemento.content.ex_vat_price|l10n('clean_currency')} € + IVA</strong>
											</td>
											<td class="selection">
												<span class="c_off">
													<input type="checkbox" id="memento_{$memento.id}" name="mementos[]" value="{$memento.id}" class="pretty" />
												</span>
											</td>
										</tr>
										<tr class="sep"><td colspan="3"></td></tr>
										
									{/if}	
									{undef $memento}
								{/foreach}
                            	</tbody>
                    		</table>

						</div>

                        <div class="pag">
                            <a href="http://eflfront/mementos/2/mas_mementos.html" class="next">Siguiente</a>
                        </div>

                        <div id="infscr-loading" style="text-align: center; display:none;">
							<img alt="Loading..." src={"ajax-loader.gif"|ezimage()}>
								<div>Loading the next set of posts...</div>
						</div>

                	</div>
            	</div>

				<div class="columnType1 frt">
						<div class="myIMemento clearFix" id="modMiImemento">
	                        <span class="tit"><img src={"logo_iMemento.png"|ezimage()} alt="iMemento" /></span>
	                        <div class="resume">
	                            <p class="clearFix"><strong><span class="flt">Has seleccionado:</span> <span class="cant" id="modMiImementoInt">0 Mementos</span></strong></p>
	                            <div class="basket">
									<p>Precio: <del><span id="partial"></span></del></p>
	                            	<p>Precio: <ins><span id="ptotal"></span></ins></p>
	                            	<p class="discount">Descuento: <span id="dtotal"></span></p>
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

{ezscript_require( array('imementocarta.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css', 'imemento.css') )}
