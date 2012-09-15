{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 2 )}        
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}                 
			
		
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
											
													<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" alt="{$image.data_map.image.content.alternative_text}" />
											
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
																<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" alt="{$image.data_map.image.content.alternative_text}" />
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

                
                
                
                <div class="modType4">
                    
                    	<div class="clearFix">
                    		<span class="volver frt"><a href={$node.parent.url_alias|ezurl}>Volver al listado</a></span>
                        </div>
                        
                    	<div class="descripcion">
                            <ul class="tabs" style="float:none">
                                
                               <li {if array( 'producto_nautis' )|contains( $clase )}class="sel"{/if}>
                                {if array( 'producto_nautis' )|contains( $clase )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}">{/if}Versiones{if array( 'producto_nautis' )|contains( $clase )}</h2>{else}</a>{/if}
                                </li>
                                {if $node.data_map.ventajas.has_content}
                               <li {if $clase|eq('ventajas_producto') }class="sel"{/if}>
                                {if $clase|eq('ventajas_producto') }<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'ventajas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Ventajas{if $clase|eq('ventajas_producto') }</h2>{else}</a>{/if}
                                </li>
                                 {/if}
                                {if $node.data_map.contenido.has_content}
                                <li {if $clase|eq('bases_producto')}class="sel"{/if}>
                               {if $clase|eq('bases_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'bases_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Contenido base jurídica{if $clase|eq('bases_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                {if $node.data_map.condiciones.has_content}
                                <li {if $clase|eq('condiciones_producto') }class="sel"{/if}>
                                {if $clase|eq('condiciones_producto') }<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'condiciones_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Condiciones{if $clase|eq('condiciones_producto') }</h2>{else}</a>{/if}
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
                            
                            <div class="cont fichaVar1 clearFix {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq( 'ventajas') )}listType02{/if}" id="producttext">
                                {if $clase|eq( 'producto_nautis' )}
                            	<div class="boxProduct flt type1">
                                {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}
                               
                            	   
                                    {if $versiones.0}
                                	<h3 class="title">{$versiones.0.name}{if $versiones.0.data_map.subtitulo.has_content}: <span>{$versiones.0.data_map.subtitulo.content}</span>{/if}</h3>
                                    <div class="wrapCont">
                                        <div class="cont">
                                            <div class="packages">
                                                {if $versiones.0.data_map.info1.has_content}
                                            	<div class="package col1">
                                                <h4 class="title">Información Analítica</h4>
                                            	{$versiones.0.data_map.info1.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.0.data_map.base.has_content}
                                                <div class="package col2 reset">
                                                <h4 class="title">Base jurídica</h4>
                                                <ul>
                                                	{$versiones.0.data_map.base.content.output.output_text}
                                                </ul>
                                                </div>
                                                {/if}
                                                
                                            </div>
                                            <div class="offers">

                                            	<span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>

                                            	<div class="descuentoType1"><strong>Ahora</strong><strong>{if $versiones.0.data_map.precio.content.has_discount}{$versiones.0.data_map.precio.content.discount_price_ex_vat|round()}{else}{$versiones.0.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>

                                                <div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $versiones.0.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            	</div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>  
                                {/if}                              
                                <div id="modVentajas" class="frt">
                                	{include uri="design:common/ficha/modVentajas_nautis.tpl"}               
                               
                                {if $versiones.1}
                                <div class="boxProduct flt type2">
                                	<h3 class="title">{$versiones.1.name}{if $versiones.1.data_map.subtitulo.has_content}: <span>{$versiones.1.data_map.subtitulo.content}</span>{/if}</h3>
                                    <div class="wrapCont">

                                        <div class="cont">
                                            <div class="packages">
                                                {if $versiones.1.data_map.info1.has_content}
                                            	<div class="package col1">
                                                <h4 class="title">Información Analítica</h4>
                                            	{$versiones.1.data_map.info1.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.1.data_map.info2.has_content}
                                                <div class="package col3">
                                                <h4 class="title">Información Analítica II</h4>
                                                {$versiones.1.data_map.info2.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.1.data_map.base.has_content}
                                                <div class="package col2 reset">

                                                <h4 class="title">Base jurídica</h4>
                                               {$versiones.1.data_map.base.content.output.output_text}
                                                </div>
                                                {/if}
                                                
                                            </div>
                                            <div class="offers">
                                            	<span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            	<div class="descuentoType1"><strong>Ahora</strong><strong>{if $versiones.1.data_map.precio.content.has_discount}{$versiones.1.data_map.precio.content.discount_price_ex_vat|round()}{else}
{$versiones.1.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                <div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $versiones.1.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            	</div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                 {/if} 
                                {if $versiones.2}
                                <div class="boxProduct flt type3">
                                	<h3 class="title">{$versiones.2.name}{if $versiones.2.data_map.subtitulo.has_content}: <span>{$versiones.2.data_map.subtitulo.content}</span>{/if}</h3>
                                    <div class="wrapCont">
                                        <div class="cont">

                                            <div class="packages">
                                            	<div class="package col1">
                                            	{if $versiones.2.data_map.info1.has_content}
                                                <h4 class="title">Información Analítica</h4>
                                            	{$versiones.2.data_map.info1.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.2.data_map.info2.has_content}
                                                <div class="package col3">

                                                <h4 class="title">Información Analítica II</h4>
                                                {$versiones.2.data_map.info2.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.2.data_map.info3.has_content}
                                                <div class="package col4">
                                                <h4 class="title">Información Analítica III</h4>

                                                {$versiones.2.data_map.info3.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones.2.data_map.base.has_content}
                                                <div class="package col2 reset">
                                                <h4 class="title">Base jurídica</h4>

                                                {$versiones.2.data_map.base.content.output.output_text}
                                                </div>
                                                {/if}
                                                
                                            </div>
                                            <div class="offers">
                                            	<span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            	<div class="descuentoType1"><strong>Ahora</strong><strong>{if $versiones.2.data_map.precio.content.has_discount}{$versiones.2.data_map.precio.content.discount_price_ex_vat|round()}{else}{$versiones.2.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                <div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $versiones.2.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            	</div>
                                            </div>

                                        </div>
                                    </div>
                                  
                                </div>  
                                    {/if}  
                                {if $versiones|count|gt(2)}
                                {for 3 to $versiones|count|sub(1) as $counter}
                                     {if $versiones[$counter]}
                                       <div class="boxProduct flt type3">
                                	<h3 class="title">{$versiones[$counter].name}{if $versiones[$counter].data_map.subtitulo.has_content}: <span>{$versiones[$counter].data_map.subtitulo.content}</span>{/if}</h3>
                                    <div class="wrapCont">
                                        <div class="cont">

                                            <div class="packages">
                                            	<div class="package col1">
                                            	{if $versiones[$counter].data_map.info1.has_content}
                                                <h4 class="title">Información Analítica</h4>
                                            	{$versiones[$counter].data_map.info1.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones[$counter].data_map.info2.has_content}
                                                <div class="package col3">

                                                <h4 class="title">Información Analítica II</h4>
                                                {$versiones[$counter].data_map.info2.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones[$counter].data_map.info3.has_content}
                                                <div class="package col4">
                                                <h4 class="title">Información Analítica III</h4>

                                                {$versiones[$counter].data_map.info3.content.output.output_text}
                                                </div>
                                                {/if}
                                                {if $versiones[$counter].data_map.base.has_content}
                                                <div class="package col2 reset">
                                                <h4 class="title">Base jurídica</h4>

                                                {$versiones[$counter].data_map.base.content.output.output_text}
                                                </div>
                                                {/if}
                                                
                                            </div>
                                            <div class="offers">
                                            	<span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            	<div class="descuentoType1"><strong>Ahora</strong><strong>{if $versiones[$counter].data_map.precio.content.has_discount}{$versiones[$counter].data_map.precio.content.discount_price_ex_vat|round()}{else}{$versiones[$counter].data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                <div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $versiones[$counter].object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                            	</div>
                                            </div>

                                        </div>
                                    </div>
                                  
                                </div>
                                     {/if}
 
                                {/for}{/if}

                                  
                                {elseif $clase|eq('ventajas_producto')}
                                    <div class="clearFix">
                            
                                	{$node.data_map.ventajas.content.output.output_text}
                            
                                <ul class="productos clearFix flt">
                                    {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}
                                    {foreach $versiones as $version}
                                	<li>
                                    	<div class="boxProduct">
                                        	<h3 class="title">{$version.name}{if $version.0.data_map.subtitulo.has_content}: <span>$versiones.0.data_map.subtitulo.content</span>{/if}</h3>
                                            <div class="wrapCont">
                                        	<div class="cont">
                                            	<div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $version.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                </div>
                                                <div style="text-align:center">
                                                <div class="descuentoType1"><strong>Ahora</strong><strong>{if $version.data_map.precio.content.has_discount}{$version.data_map.precio.content.discount_price_ex_vat|round()}{else}{$version.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                </div>                
                                                <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            </div>
                                            </div>
                                        </div>

                                    </li>
                                    {/foreach}
                                    
                                </ul>
                                 <div id="modVentajas" class="frt">
                                	{include uri="design:common/ficha/modVentajas_nautis.tpl"}        
                                </div>
                                 {elseif $clase|eq('bases_producto')}
                                    <div class="clearFix">
                                    <div style="margin-bottom: 15px">
                                	{$node.data_map.contenido.content.output.output_text}
                                    </div>
                            
                                <ul class="productos clearFix flt">
                                    {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}
                                	 {foreach $versiones as $version}
                                	<li>
                                    	<div class="boxProduct">
                                        	<h3 class="title">{$version.name}{if $version.0.data_map.subtitulo.has_content}: <span>$versiones.0.data_map.subtitulo.content</span>{/if}</h3>
                                            <div class="wrapCont">
                                        	<div class="cont">
                                            	<div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $version.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                </div>
                                                <div style="text-align:center">
                                                <div class="descuentoType1"><strong>Ahora</strong><strong>{if $version.data_map.precio.content.has_discount}{$version.data_map.precio.content.discount_price_ex_vat|round()}{else}{$version.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                </div>                
                                                <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            </div>
                                            </div>
                                        </div>

                                    </li>
                                    {/foreach}
                                   
                                </ul>
                                 <div id="modVentajas" class="frt">
                                	{include uri="design:common/ficha/modVentajas_nautis.tpl"}        
                                </div>
                                {elseif $clase|eq('condiciones_producto')}
                                    <div class="clearFix">
                                    <div style="margin-bottom: 15px">
                                	{$node.data_map.condiciones.content.output.output_text}
                                    </div>
                            
                                <ul class="productos clearFix flt">
                                     {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}
                                	 {foreach $versiones as $version}
                                	<li>
                                    	<div class="boxProduct">
                                        	<h3 class="title">{$version.name}{if $version.0.data_map.subtitulo.has_content}: <span>$versiones.0.data_map.subtitulo.content</span>{/if}</h3>
                                            <div class="wrapCont">
                                        	<div class="cont">
                                            	<div class="boxBtn clr">
                                                	<a href={concat( 'basket/add/', $version.object.id, '/1')|ezurl}><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                                </div>
                                                <div style="text-align:center">
                                                <div class="descuentoType1"><strong>Ahora</strong><strong>{if $version.data_map.precio.content.has_discount}{$version.data_map.precio.content.discount_price_ex_vat|round()}{else}{$version.data_map.precio.content.ex_vat_price|round()}{/if} euros</strong> + IVA</div>
                                                </div>                
                                                <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></span>
                                            </div>
                                            </div>
                                        </div>

                                    </li>
                                    {/foreach}
                                   
                                </ul>
                                 <div id="modVentajas" class="frt">
                                	{include uri="design:common/ficha/modVentajas_nautis.tpl"}        
                                </div>
                                {elseif $clase|eq('notas_relacionadas_producto') }

                                    <div id="faq">
                            	           <h2>Últimas noticias</h2>
                            	           <div class="preguntas clearFix">
                            	               <div class="flt">
                            	                   <div>
                            	                       <ul>
                            	                           {foreach $node.data_map.notas_relacionadas.content.relation_browse as $index => $nota}
                            	                               {let $nodo = fetch( 'content', 'node', hash('node_id', $nota.node_id ) )}
                            	                               <li>
                            	                                   <a href="{$nodo.url_alias|ezurl(no)}">
                            	                                       {$nodo.name|strip_tags()}
                            	                                   </a>
                            	                               </li>
                            	                               {/let}
                            	                           {/foreach}
                            	                           
                            	                       </ul>              
                            	                   </div>
                            	               </div>
                            	               <div id="modVentajas" class="frt">
                            	                {include uri="design:common/ficha/modVentajas_nautis.tpl"}
                            	               </div>
                            	           </div>

                                {elseif $clase|eq('faqs_producto')}

                                    <div id="faq">
                            	           <h2>Preguntas Frecuentes</h2>
                            	           <div class="preguntas clearFix">
                            	               <div class="flt" style="width:620px">
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
                                                
                            	               <div id="modVentajas" class="frt">
                            	                {include uri="design:common/ficha/modVentajas_nautis.tpl"}
                            	               </div>
                            	           </div>
                                {/if} 
                            </div>
                        
           		</div>
                
			
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
                                            {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.productos_relacionados_online.content.relation_browse[$i].contentobject_id )) }
                                               
                                            	{node_view_gui content_node=$item.main_node view=relacionado}
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

                                        	{for 0 to min( 2, $node.data_map.relacionados_especializados.content.relation_browse|count())|sub(1) as $i}
                                            <li>
                                                {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.relacionados_especializados.content.relation_browse[$i].contentobject_id )) }
                                            		{node_view_gui content_node=$item.main_node view=relacionadoonline}
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
                        
                        {if $node.data_map.cursos.has_content}
                            <div class="columnType2 frt" id="software"> 
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
                
                {/if}
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
