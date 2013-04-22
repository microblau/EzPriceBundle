{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 2 )}     
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}     			
{*analytics de ficha de producto categorías*}
<script type="text/javascript">
{foreach $node.data_map.area.content.relation_list as $k=>$area}
	{def $areas=fetch(content,object, hash(object_id, $area.contentobject_id))}
		{literal}
		_gaq.push(['_setCustomVar',1,'categoria','{/literal}{$areas.name}{literal}',3]);
		{/literal}
	{undef $areas}
{/foreach}
	{literal}		
		_gaq.push(['_trackEvent', 'PhantomEvent', 'GO', '-', 0, true]); //  este evento es el encargado de asegurar el envío de la variable personalizada
	{/literal}
</script>   

{*fin analytics*}		
			<div id="gridWide">
            	
                <div id="moduloDestacadoContenido" class="type1">								
					<h1>{$node.name}<span class="subTit twoLines">{$node.data_map.subtitulo.content}</span></h1>
					
					<div class="wrap">
				
						<div class="inner">
				
							<div class="wysiwyg">
					
								<div class="attribute-cuerpo clearFix">
								<div class="object-left column1">
                                      <div class="content-view-embed">
                                            <div class="class-image">
                                                <div class="attribute-image">                                 
                                             {if $node.data_map.imagen.has_content}
												     {def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
												<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
												<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
											{/if}
                                            </div>																					
                                            </div>
                                        </div>
                                        <div class="infoFichaTop">
                                            <div class="info">
                                                <ul>
                                           {if or($node.data_map.youtube_url.has_content,$node.data_map.video.has_content)}          
                                              <li class="video"><a href="{concat('/producto/vervideo?n=', $node.node_id)}" id="video">Mire el vídeo de esta publicación</a></li>                                    {/if}
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>
                                
                                
                                
									
                                	<div class="column2">
                                       {$node.data_map.entradilla.content.output.output_text}
                                        <div class="clearFix">

                                        	<span class="oferta">{$node.data_map.texto_oferta.content}</span>
                                        </div>
                                    </div>
                                    <div class="column3">  
                                     <div class="nuevaFicha">
                                    
                                            {if $node.data_map.clicktocall.has_content}
                                      <div class="llamamos">
                                                <span>¿Necesita realizar alguna consulta?</span>
                                                <a href="{$node.data_map.clicktocall.content}" target="_blank"><img src={"btn_lellamamos.gif"|ezimage()} alt="Le llamamos" /></a>
                                     </div>
                                     {/if}                                    
                                  
                                    	<div id="modInformacion2">
											<div style="padding: 75px 0px 0px 13px">
                                                <span class="verMas">
													<a href={"formularios/pruebe-nuestros-productos-electronicos-15-dias-sin-compromiso"|ezurl}>Quiero probar este producto 15 días gratis</a>
												</span>
                                            </div>
                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>
				</div></div>

                
			
			</div>
            <!--fin gridWide-->
            
            <div class="clearFix mementix" id="gridTwoColumnsTypeB">
				<div id="modType4b" class="columnType1">
					<div class="modType4">
					    <div class="clearFix">
                            <span class="volver frt"><a href={$node.parent.url_alias|ezurl}>Volver al listado</a></span>
                        </div>
                        
                    	<div class="descripcion">
                    	        <ul class="tabs" style="float:none">
                                
                                <li {if array( 'producto_nautis4' )|contains( $clase )}class="sel"{/if}>
                                {if array( 'producto_nautis4' )|contains( $clase )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}">{/if}Descripción{if array( 'producto_nautis4' )|contains( $clase )}</h2>{else}</a>{/if}
                                </li>
                               
                                {if $node.data_map.condiciones.has_content}
                                <li {if $clase|eq('condiciones_producto')}class="sel"{/if}>
                                {if $clase|eq('condiciones_producto')}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/condiciones')|ezurl(no)}#producttext">{/if}Condiciones{if $clase|eq('condiciones_producto') }</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                 {if $node.data_map.notas_relacionadas.has_content}
                                <li {if $clase|eq('notas_relacionadas_producto') }class="sel"{/if}>
                                	{if $clase|eq('notas_relacionadas_producto') }<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'notas_relacionadas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Últimas noticias{if $clase|eq('notas_relacionadas_producto') }</h2>{else}</a>{/if}
                                </li>                           
                                {/if}                                
                                {if $node.data_map.faqs_producto.has_content}
                                <li {if $clase|eq('faqs_producto')}class="sel"{/if}>
                                	{if $clase|eq( 'faqs_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'faqs_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Preguntas frecuentes{if $clase|eq( 'faqs_producto' )}</h2>{else}</a>{/if}
                                </li>                           
                                {/if} 
                            </ul>
                            
							<div class="cont">
							
							<h1>{$node.name}</h1>
						

                            <ul class="tools">
                            	<li class="demo"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></li>
                                <li class="print"><a href="#">Imprimir</a></li>
                            </ul>
                            <div class="clearFix">
                                {if array( 'producto_nautis4' )|contains( $clase )}
                            	<div class="column1">
                                	{$node.data_map.descripcion.content.output.output_text}
                                    <ul class="mementos clearFix">
                                    	<li>
                                        	<span>1 Memento</span>
                                            <div class="precios">
                                            	<div class="descuentoType1">
                                                	<span class="descuento">&nbsp;</span>{$node.data_map.precio.content.price|l10n(clean_currency)}€ <span class="iva">+ IVA</span></div>

                                        	</div>
                                        </li>
                                        <li>
                                        	<span>2 Mementos</span>
                                            <div class="precios">
                                            	<div class="descuentoType1">
                                                	{def $prices = fetch( 'basket', 'nautis4_price', hash( 'product_id', $node.object.id, 'mementos', 2 ))}
                                                	<span class="descuento">{$prices.discount}% de descuento</span>{$prices.total|l10n(clean_currency)}€ <span class="iva">+ IVA</span></div>
                                                    {undef $prices}

                                        	</div>
                                        </li>
                                        <li>
                                        	<span>3 Mementos</span>
                                            <div class="precios">
                                            	<div class="descuentoType1">
                                                    {def $prices = fetch( 'basket', 'nautis4_price', hash( 'product_id', $node.object.id, 'mementos', 3 ))}
                                                	<span class="descuento">{$prices.discount}% de descuento</span>{$prices.total|l10n(clean_currency)}€ <span class="iva">+ IVA</span></div>
                                                    {undef $prices}

                                        	</div>
                                        </li>
                                        <li class="reset">
                                        	<span>4 Mementos</span>
                                            <div class="precios">
                                            	<div class="descuentoType1">
                                                	{def $prices = fetch( 'basket', 'nautis4_price', hash( 'product_id', $node.object.id, 'mementos', 4 ))}
                                                	<span class="descuento">{$prices.discount}% de descuento</span>{$prices.total|l10n(clean_currency)}€ <span class="iva">+ IVA</span></div>
                                                    {undef $prices}

                                        	</div>
                                        </li>
                                    </ul>
                                </div>
                                {elseif $clase|eq('condiciones_producto')}
                                    
                                    <div class="column1">
                                    {$node.data_map.condiciones.content.output.output_text}
                                    </div>
                                     {elseif $clase|eq('faqs_producto')}

                                    <div id="faq" class="column1">
                                           <h2>Preguntas Frecuentes</h2>
                                           <div class="preguntas clearFix">
                                               <div>
                                                   <div>
                                                       <ul>
                                                           {foreach $node.data_map.faqs_producto.content.relation_browse as $index => $faq}
                                                               {let $nodo = fetch( 'content', 'node', hash('node_id', $faq.node_id ) )}
                                                               <li>
                                                                   <a href="{concat( $node.url_alias, '/(ver)/faqs')|ezurl(no)}#p_{$nodo.node_id}">
                                                                       {$nodo.data_map.texto_pregunta.content.output.output_text|strip_tags()}
                                                                   </a>
                                                               </li>
                                                               {/let}
                                                           {/foreach}
                                                           
                                                       </ul>              
                                                   </div>
                                                     <div class="respuestas clr">
                                                <ul>
                                                    {foreach $node.data_map.faqs_producto.content.relation_browse as $index => $faq}
                                                       {let $nodo = fetch( 'content', 'node', hash('node_id', $faq.node_id ) )}
                                                       <li id="p_{$nodo.node_id}">
                                                            <h3>
                                                                <a name="faq{$index}">
                                                                    {$nodo.data_map.texto_pregunta.content.output.output_text|strip_tags()}
                                                                </a>
                                                            </h3>
                                                            <div class="wysiwyg">
                                                                {$nodo.data_map.texto_respuesta.content.output.output_text}
                                                            </div>
                                                            <span class="ancla"><a href="#faq">Subir</a></span>
                                                       </li>
                                                       {/let}
                                                    {/foreach}
                                                
                                                </ul>
                                            </div>
                                               </div>
                                                
                                              </div>
                                           </div>
                                {/if}
                               
                                 {include uri="design:common/ficha/modVentajas.tpl"}
                                 
                                
                            </div>
                            
                            
							<form name="mementosForm" id="mementosForm" method="post" action={"basket/addnautis4"|ezurl}>
								<div class="numAccesos clearFix">
                                	<h2 class="title">Seleccione la opción que desee</h2>
                                    <span class="verMas flotante"><a href={"basket/que-es-un-acceso-nautis4"|ezurl}>¿Qué opciones tengo?</a></span>
                                    <div class="slider">

                                    	<div class="sliderChart">
                                        	<div class="chart">
                                            	<span id="item1" class="slider-lb first sel">Individual</span>
                                                <span id="item2" class="slider-lb">2 accesos</span>
                                                <span id="item3" class="slider-lb">3 accesos</span>
                                                <span id="item4" class="slider-lb">4 accesos</span>
                                                <span id="item5" class="slider-lb">5 accesos</span>

                                                <span id="item6" class="slider-lb last">6 accesos o más</span>
                                            </div> 
                                        </div>
                                    </div>
                                    <input type="hidden" value="1" id="valor" name="accesos" />
                                        
                               	</div>
                                <div class="clearFix">
                                <div id="accesoMementos" class="flt">
                                	<h2 class="title">Combine los Mementos que desee agregar</h2>

									<fieldset>				
                                        <ul>
                                             
                                              {def $mementos = $node.data_map.mementos_mementix.content}
                                                        {foreach $mementos.relation_browse as $el}
                                                            {def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
                                                                <li>
															<input type="checkbox" id="memento_{$memento.id}" name="mementos[]" value="{$memento.id}" />
															<label for="memento_{$memento.id}">{$memento.data_map.nombre_mementix.content}</label>

														</li>
                                                            {undef $memento}
                                                        {/foreach}					
                                        </ul>															
									</fieldset>
                                                
								</div>
                                <div class="paqPromocion flt">
                                	<h2 class="title">Base jurídica</h2>
                                	{$node.data_map.base_juridica.content.output.output_text}
                                </div>
                                </div>

								
									
							
                        </div>
                      	</div>
					</div>
				</div>
				<div class="sideBar">
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>
                    
                    <div id="modMiMementix">
                    	<h2>Mi Nautis 4</h2>
                        <ul>
                        	<li class="listaAccesos"><span class="listaMem">2 accesos</span></li>
                            <li class="listMem"><span class="listaMem">0 Mementos</span></li>

                        	<li class="total"><span class="precio" id="partial">{$node.data_map.precio.content.price|l10n(clean_currency)} €</span></li>
                            <li><span class="descuento"><span id="discount">0%</span> descuento</span></li>
                            <li class="total"><span class="productoTotal">TOTAL</span><span class="precioTotal" id="ptotal">{$node.data_map.precio.content.price|l10n(clean_currency)} €</span></li>
                            <li class="reset"><input type="image" alt="Añadir a la cesta" src={"btn_aniadir-compra.gif"|ezimage} /></a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="partial" id="partialfield" value="" />
                    <input type="hidden" name="discount" id="discountfield" value="" />
                    <input type="hidden" name="total" id="totalfield" value="" />
                    <input type="hidden" name="object" id="object" value="{$node.object.id}" />
</form>
				</div>
			</div>
            
            
            <div id="gridType3" class="wide">
                                                    
                        <div class="wrap clearFix">
                           {if $node.data_map.productos_relacionados_online.has_content}
                            <div class="columnType1 flt">	
                                <h2>Otros productos online</h2>									
                                <div class="wrapColumn">																						
                                    <div class="inner">
                                        <ul class="clearFix reset">
                                            {for 0 to min( 6, $node.data_map.productos_relacionados_online.content.relation_browse|count())|sub(1) as $i  }
                                            <li>
                                            {def $item = fetch( 'content', 'node', hash( 'node_id', $node.data_map.productos_relacionados_online.content.relation_browse[$i].node_id )) }
                                            	{node_view_gui content_node=$item view=relacionado}
                                            {undef $item}                                            
                                            </li>
                                            {/for}
                                            
                                        </ul>

                                    </div>
                                    
                                </div>                               
                                
                            </div>
                            {/if}
                            {if $node.data_map.relacionados_especializados.has_content}
                           
                            <div class="columnType2 frt" id="software">	
                                <h2>Software especializado</h2>									
                                <div class="wrapColumn">											
                                    <div class="inner clearFix">
                                    	<ul>
                                        
                                        	{for 0 to min( 2, $node.data_map.relacionados_especializados.content.relation_browse|count())|sub(1) as $i  }
                                            <li>
                                                {def $item = fetch( 'content', 'node', hash( 'node_id', $node.data_map.relacionados_especializados.content.relation_browse[$i].node_id )) }
                                            		{node_view_gui content_node=$item view=relacionadoonline}
                                           		{undef $item}     
                                            </li>                                            
                                            {/for}
                                        </ul>                                    
                                    </div>

                                </div>
                            </div>
                             {/if}
                        </div>
                        
                    </div>
            
            <div class="cursosRel wide">
                	<h2>Cursos relacionados</h2>
                    <div class="wrap">
                    	<div class="description">

                        	<ul>
                            	{for 0 to min( 3, $node.data_map.cursos.content.relation_browse|count())|sub(1) as $i}
                                	{def $item = fetch( 'content', 'node', hash( 'node_id', $node.data_map.cursos.content.relation_browse[$i].node_id )) }	
                                    <li>
                                        <h3><a href={$item.url_alias|ezurl_formacion()}>{$item.name}</a></h3>
                                        <span>
                                        	{$item.data_map.fecha_inicio.content.timestamp|datetime( 'custom', '%d/%m/%y')}
                                        	{if $item.data_mapa.fecha_fin.has_content}
                                        	- {$item.data_map.fecha_fin.content.timestamp|datetime( 'custom', '%d/%m/%y')}
                                        	{/if}
                                        
                                        </span>

                                    </li>
                                    {/for}
                            </ul>
                            
                        </div>
                    </div>
                </div>
{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js', 'ui.core.js', 'ui.slider.js', 'mementix.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css') )}
{literal}<script type="text/javascript">

	$("#video").fancybox({
			'width':624, 
			'height':453,
			'padding':0,
			'type':'iframe'
	});
	
</script>{/literal}
