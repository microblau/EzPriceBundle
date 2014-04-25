{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 2 )}    
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}         
            
        
            <div id="gridWide">
                
                <div id="moduloDestacadoContenido" class="type1">                             
                    <h1>{$node.name}

                    <span class="subTit twoLines">{$node.data_map.subtitulo.content}</span></h1>
                    <div class="wrap">
                
                        <div class="inner">
                
                            <div class="wysiwyg">
                    
                                <div class="attribute-cuerpo clearFix">
								<div class="object-left column1">
								<div class="content-view-embed">
									{if $node.data_map.youtube_url.has_content}
										<div class="media"> 
											<div id="mediaspace">
												{eflyoutube( $node.data_map.youtube_url.content, 236, 213 )}
											</div>
										</div>
									{else}
										{if $node.data_map.video.has_content}
											{def $video = fetch( 'content', 'object', hash( 'object_id', $node.data_map.video.content.relation_browse.0.contentobject_id ))}                         
											<div class="media">
												{attribute_view_gui attribute=$video.data_map.video width=236 height=213 autostart=0}                       
											</div>
										{else}
											{if $node.data_map.imagen.has_content}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
												<div class="media">
													<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
												</div>
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
														<div class="class-image">
															<div class="attribute-image">                                 
																<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
															</div>                                                                                  
														</div>
											{/if}
										{/if}
									{/if}
								</div>
								</div>
									
                                	<div class="column2">
                                    	{$node.data_map.entradilla.content.output.output_text}
                                   		{if or(  $node.parent_node_id|eq(66), $node.parent_node_id|eq(1485), $node.parent_node_id|eq(69), $node.parent_node_id|eq(70) )|not }
	                                    <div class="clearFix linksModulo">
	                                        <span>¿Dónde reside el éxito de esta obra?</span>
	                                        <span class="verMas"><a href={"por-que-lefebvre/sistematica-memento"|ezurl}>Quiero saber más</a></span>                                        
	                                    </div>
	                                    {/if}
                                         <div class="clearFix linksModulo">
	                                        <span>Quiere probarlo gratis durante 15 días?</span>
	                                        <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Solicite una clave ahora</a></span>                                        
	                                    </div>
                                     </div>

                                    <div class="column3"> 
                                    	<a href={'basket/mementix'|ezurl} class="ejemplar"><img src={"botonconfiguracion.png"|ezimage} alt="Configúrelo aquí" /></a>
                                    	
                                    	{if $node.data_map.precio.content.has_discount}
 {def $discount_type = fetch( 'basket', 'get_discount_type', 
																                                                hash( 'user', fetch( 'user', 'current_user' ),
																                                                      'params', hash( 'contentclass_id', $node.object.contentclass_id,
																                                                                      'contentobject_id', $node.object.id,
																                                                                      'section_id', $node.object.section_id
																                                                       ) 
																                                                      
																                                                      ))}
                                         <div class="precioIva">
                                        {if $discount_type.id|eq(3)}
										    <p>{$node.object.data_map.texto_oferta.content}</p>
										{else}
										    <p>{$node.object.data_map.precio.content.discount_percent}% por {$discount_type.name}</p>
										{/if}
                                    	
<div><div class="precioAnterior"><span><s>{$node.data_map.precio.content.price|l10n(clean_currency)} €</s></span></div> <div>{$node.data_map.precio_oferta.content.price|l10n(clean_currency)} €</div></div></div>
                                        {else}
                                             <div class="precioIva"><div><div class="precioAnterior"><span>{$node.data_map.precio.content.price|l10n(clean_currency)} €</span></div> </div></div>
                                    	{/if}
										{if or( $node.parent_node_id|eq(1485), $node.parent_node_id|eq(69), $node.parent_node_id|eq(70) ) }
                                        <div id="modInformacion">
                                            <h2><img src={"bck_modInformacionTit.gif"|ezimage()} alt="¿Necesita información?" /></h2>
                                            <div>
                                                <span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1455)).url_alias|ezurl()}>Nosotros nos ponemos en contacto con usted</a></span>
                                            </div>
                                        </div>
                                        {/if}
                                        {if $node.parent_node_id|eq(66) }
                                        <div class="modConvencerse">
                                            <h2><img src={"bck_modConvencerseTit.gif"|ezimage()} alt="¿Necesita convencerse?" /></h2>

                                            <div>
                                                <span class="verMas"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl()}>Pruebe GRATIS actum durante 1 mes</a></span>
                                            </div>
                                        </div>
                                        {/if}	
                                    	
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
                
            <div id="gridTwoColumnsFichas" class="clearFix">

            
                <div class="columnType1 flt">
                    <div id="modFichasPrecio">
                        <h2>
                        	<p><span>Precio: Desde {if $node.data_map.precio.content.has_discount}<s>{/if}{$node.data_map.precio.content.price|l10n(clean_currency)} €{if $node.data_map.precio.content.has_discount}</s>{/if}</span> + IVA</p>
                        	{if $node.data_map.precio.content.has_discount}
                        	<p class="preciooferta"><span>Oferta: {$node.data_map.precio_oferta.content.price|l10n(clean_currency)} €</span> + IVA</p>
                        	{/if}
                        </h2>
                        <div class="wrap">
                            <ul>
                                {if $node.data_map.edicion.has_content}
                                <li>Editción: {$node.data_map.edicion.content}</li>
                                {/if}
                                {*if $node.data_map.fecha_aparicion.has_content}
                                <li>Aparición: {$node.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%d/%m/%Y')}</li>
                                {/if*}
                                {if $node.data_map.paginas.has_content}
                                <li>Páginas: {$node.data_map.paginas.content}</li>
                                {/if}
                                <li>Disponible en librerías: {cond( $node.data_map.disp_librerias.content|eq( 1 ), 'Sí', $node.data_map.disp_librerias.content|ne( 1 ), 'No' )}</li>
                                {if $node.data_map.isbn.has_content}
                                <li>ISBN: {$node.data_map.isbn.content.value}</li>
                                {/if}
                                {if $node.data_map.issn.has_content}
                                <li>ISSN: {$node.data_map.issn.content}</li>
                                {/if}
                            </ul>
                            <div class="info">
                            	<div class="inner">
	                                <ul>
                                        <li class="demo"><a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl}>Pruébelo gratis</a></li>
	                        
	                                    {if $node.data_map.pdf_10pags.has_content}
	                                    {def $pdf = fetch( 'content', 'object', hash( 'object_id', $node.data_map.pdf_10pags.content.relation_browse.0.contentobject_id ))}                                   
	                                    <li class="paginas"><a href={concat( 'content/download/', $pdf.data_map.file.contentobject_id, '/', $pdf.data_map.file.id,'/version/', $pdf.data_map.file.version , '/file/', $pdf.data_map.file.content.original_filename|urlencode )|ezurl}>Leer las 10 primeras páginas</a></li>
	                                    {undef $pdf}
                                        {/if}
                                        {if $node.data_map.pdf_sumario.has_content}
                                        {def $pdf_sumario = fetch( 'content', 'object', hash( 'object_id', $node.data_map.pdf_sumario.content.relation_browse.0.contentobject_id ))}
	                                    <li class="sumario"><a href={concat( 'content/download/', $pdf_sumario.data_map.file.contentobject_id, '/', $pdf_sumario.data_map.file.id,'/version/', $pdf_sumario.data_map.file.version , '/file/', $pdf_sumario.data_map.file.content.original_filename|urlencode )|ezurl}>Ver el sumario</a></li>
                                        {undef $pdf_sumario}
                                        {/if}
	                                    <li class="compartelo"><a href="#bmarks-10"  class="bmarks-btn">Compartir</a>
	                                    <div id="bmarks-10" class="bmarks">
											<div class="inner">
												<ul class="clear">
													{def $links = ezini( 'ShareIt', 'AvailableSites', 'shareit.ini')}
													{def $array_search = array( '<urlalias>', '<title>' )}
													{def $array_replace = array( concat( 'http://', ezsys( 'hostname' ), $node.url_alias|ezurl( 'no') ), $node.name )}
													{foreach $links as $link}
														{def $url = ''}
														{set $url = concat( $url, ezini($link, 'URL', 'shareit.ini'), '?')}														
														{foreach ezini( $link, 'Params', 'shareit.ini') as $index => $param}
															{set $url = concat( $url, $index, '=', shareit_replace( $array_search, $array_replace, $param ), '&' )}																														
														{/foreach}
														<li><a href="{$url}" title="{ezini($link, 'Name', 'shareit.ini')}"><img src={ezini($link, 'Icon', 'shareit.ini')|ezimage()} alt="{ezini($link, 'Name', 'shareit.ini')}" />{ezini($link, 'Name', 'shareit.ini')}</a></li>
														{undef $url}
													{/foreach}
													{undef $links $array_search $array_replace}													
												</ul>												
											</div>
										</div>										
	                                    </li>
	                                    <li class="imprimir"><a href="#" onclick="window.print()">Imprimir</a></li>
	                                </ul>
                                </div>                                
                            </div>
                            <div class="dudas">
                            	<h3>¿Tiene dudas?</h3>
                                <ul>
                                	{*<li class="chat"><a href="">Accede a nuestro chat</a></li>*}
                                    <li class="contacto"><a href={"contacto"|ezurl}>Otras formas de contacto</a></li>
                                </ul>

                            </div>
                            <div class="opinion">
                            	<h3>Los usuarios opinan:</h3>
                                <ul>
                                	<li class="clear"><span class="flt">Facilidad de consulta</span>{attribute_view_gui attribute=$node.data_map.calidad_rate}</li>
                                    <li><span>Profundidad de estudio</span>{attribute_view_gui attribute=$node.data_map.actualizaciones_rate}</li>
                                    <li><span>Calidad Global</span>{attribute_view_gui attribute=$node.data_map.facilidad_rate}</li>

                                </ul>
                            </div>                            
                         </div>
                    </div>
                
                </div>
                
                <div class="columnType2 frt">
                    <div class="modType4">
                    	{def $testimonios = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id, 
																						'class_filter_type', 'include',
																						'class_filter_array', array( 'testimonio' ),
																						'sort_by', $node.sort_array
								))}
						
						{def $tabscount = 1}
						{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.contenido.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.novedades.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.testimonios|count}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}                  
                       
                        <div class="descripcion" id="producttext">
                        	<div class="clear">
                        	  <span class="volver {if eq($tabscount,6)}addmargin{/if}"><a href={$node.parent.url_alias|ezurl}
>Volver al listado</a></span>
                            <ul class="tabs">
                 				<li {if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('ventajas') )}class="sel"{/if}>
                                {if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('ventajas') )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}#producttext">{/if}Ventajas{if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('ventajas') )}</h2>{else}</a>{/if}
                                </li>
                                <li><a href={"basket/mementix"|ezurl}>Mementos disponibles</a></li>
                                {*
                                {if $node.data_map.sumario.has_content}
                                <li {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('sumario') )}class="sel"{/if}>
                                	{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('sumario') )}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/sumario')|ezurl(no)}#producttext">{/if}Sumario{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('sumario') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                *}
                                {if $node.data_map.contenido.has_content}
                                <li {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('contenido') )}class="sel"{/if}>
                                	{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('contenido') )}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/contenido')|ezurl(no)}#producttext">{/if}{cond( $node.parent_node_id|eq( 1485 ),  'Contenido', 'Condiciones' )}{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('contenido') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.novedades.has_content}
                                <li {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('novedades') )}class="sel"{/if}>
                                	{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('novedades') )}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/novedades')|ezurl(no)}#producttext">{/if}Novedades{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('novedades') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $testimonios|count|gt( 0 )}
                                <li {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('testimonios') )}class="sel"{/if}>
                                	{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('testimonios') )}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/testimonios')|ezurl(no)}#producttext">{/if}Testimonios{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('novedades') )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.faqs_producto.has_content}
                                <li {if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('faqs') )}class="sel"{/if}>
                                	{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('faqs') )}<h2>{else}<a href="{concat( $node.url_alias, '/(ver)/faqs')|ezurl(no)}#producttext">{/if}Preguntas frecuentes{if and( is_set( $view_parameters.ver ), $view_parameters.ver|eq('faqs') )}</h2>{else}</a>{/if}
                                </li>                           
                                {/if}     
                            </ul>
                          
                            </div>
                            
                            <div class="cont cursoDet clearFix">
                            	{*si es testimonios no podemos pintar la columna de la derecha*}
                            	{if and( is_set( $view_parameters.ver), $view_parameters.ver|eq( 'testimonios'))}
                            		{*llamamos a una plantilla aparte *}
                            		{include uri="design:common/ficha/testimonios.tpl" testimonios=$testimonios}
                            	{elseif and( is_set( $view_parameters.ver), $view_parameters.ver|eq( 'faqs'))}
                            	   {*llamamos a una plantilla aparte *}
                            	   {*include uri="design:common/ficha/faqs.tpl"*} 
                            	   <div class="column1 colUnica">
                            	       <div id="faq">
                            	           <h2>Preguntas Frecuentes</h2>
                            	           <div class="preguntas clearFix">
                            	               <div class="flt">
                            	                   <div>
                            	                       <ul>
                            	                           {foreach $node.data_map.faqs_producto.content.relation_browse as $index => $faq}
                            	                               {let $nodo = fetch( 'content', 'node', hash('node_id', $faq.node_id ) )}
                            	                               <li>
                            	                                   <a href="#faq{$index}">
                            	                                       {$nodo.data_map.texto_pregunta.content.output.output_text|strip_tags()}
                            	                                   </a>
                            	                               </li>
                            	                               {/let}
                            	                           {/foreach}
                            	                           
                            	                       </ul>              
                            	                   </div>
                            	               </div>
                            	               
                            	                {include uri="design:common/ficha/modVentajas.tpl"}
                            	               
                            	           </div>
                            	           
                            	       
                            	           
                            	           
                            	            <div class="respuestas clr">
                                                <ul>
                                                    {foreach $node.data_map.faqs_producto.content.relation_browse as $index => $faq}
                                                       {let $nodo = fetch( 'content', 'node', hash('node_id', $faq.node_id ) )}
                                                       <li>
                                                            <h3>
                                                                <a name="faq{$index}">
                                                                    {$nodo.data_map.texto_pregunta.content.output.output_text|strip_tags()}
                                                                </a>
                                                            </h3>
                                                            <div class="wysiwyg">
                                                                {$nodo.data_map.texto_respuesta.content.output.output_text}
                                                            </div>
                                                            <span class="ancla"><a href="#gridTwoColumnsFichas">Subir</a></span>
                                                       </li>
                                                       {/let}
                                                    {/foreach}
                                                
                                                </ul>
                                            </div>
                            	       </div>
                            	   </div>
                            	   
                            	{else}
                                <div class="column1">
									{if or( is_set( $view_parameters.ver )|not, $view_parameters.ver|eq('ventajas') )}
                                    <h2>Ventajas de tenerlo</h2>
                                    {$node.data_map.ventajas.content.output.output_text}
                                    
                                    {*<span class="verMas"><a href="">Ver más ventajas para comprarlo</a></span>*}
                                    
                                    <div class="testimonio clearFix">
									
									{if $testimonios|count|gt(0)}
                                        <h3>Profesionales que ya conocen sus ventajas...</h3>  
                                    	{if $testimonios.0.data_map.foto_testimonio.has_content}
                                    	{def $foto_testimonio = fetch( 'content', 'object', hash( 'object_id', $testimonios.0.data_map.foto_testimonio.content.relation_browse.0.contentobject_id ))}                                      
                                        <img src={$foto_testimonio.data_map.image.content.testimonio.url|ezroot()} alt="" class="flt" />
                                        {/if}
                                        <q>"{$testimonios.0.data_map.testimonio.content.output.output_text|strip_tags()}"</q>
                                        <span><span class="nombre">{$testimonios.0.data_map.nombre_persona.content}. </span>{$testimonios.0.data_map.empresa.content}</span>
                                    
                                        <div class="botonTestimonio">
                                            <span class="left"><img src={"btn_testimonioDisabled-lf.gif"|ezimage()} alt="" /></span>
                                            <span class="mas">Más testimonios</span>

                                            <span class="right"><a href=""><img src={"btn_testimonioDisabled-rg.gif"|ezimage()} alt="" /></a></span>
                                        </div>
                                        {/if}
                                    {undef $testimonios}
                                    </div>
                                    {else}
                                    	{switch match=$view_parameters.ver}
                                    		{case match='sumario'}
                                    			{$node.data_map.sumario.content.output.output_text}
                                    		{/case}
                                    		{case match='contenido'}
                                    			{$node.data_map.contenido.content.output.output_text}
                                    		{/case}
                                    		{case match='novedades'}
                                    			{$node.data_map.novedades.content.output.output_text}
                                    		{/case}
                                    	{/switch}
                                    {/if}                                    
                                </div>
                                {*inluimos el template del modulo de Ventajas*}
                                {include uri="design:common/ficha/modVentajas.tpl"}
                                
                                {/if}
                                
                            </div>
                        </div>                        
                        
                    </div>
                    {if or( $node.data_map.productos_relacionados_por_area.has_content, $node.data_map.productos_relacionados_online.has_content, $node.data_map.relacionados_especializados.has_content )}                    
                    <div id="gridType3">
                        {if $node.data_map.productos_relacionados_por_area.has_content}                            
                        <div class="wrap clearFix">
                            <div class="columnType1 flt">   
                                {if $node.parent_node_id|eq( 1485 )}
                                    <h2>Otros productos online</h2>
                                {else}
                                <h2>Otros Mementos para el Area {fetch( 'content', 'object',  hash( 'object_id',
 $node.data_map.area.content.relation_list.0.contentobject_id)).name}</h2>                                 
                                {/if}
                                <div class="wrapColumn">                                                                                        
                                    <div class="inner">

                                        <ul class="clearFix">
                                        	{for 0 to min( 2, $node.data_map.productos_relacionados_por_area.content.relation_browse|count())|sub(1) as $i  }
                                            <li {if 0|eq( min( 2, $node.data_map.productos_relacionados_por_area.content.relation_browse|count())|sub(1) ) }class="reset"{/if}>
                                            {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.productos_relacionados_por_area.content.relation_browse[$i].contentobject_id )) }
                                            	{node_view_gui content_node=$item.main_node view=relacionado}
                                            {undef $item}                                            
                                            </li>
                                            {/for}
                                         </ul>   
                                         <span class="verMas"><a href={concat("catalogo/area/", fetch( 'content', 'object',  hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id)).name|normalize_path()|explode('_')|implode('-') )|ezurl}>Ver todos los Mementos para el Area {fetch( 'content', 'object',  hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id)).name|downcase}</a></span>

                                    </div>
                                    
                                </div>
                                {/if}
                                {if $node.data_map.relacionados_especializados.has_content}
                                <h2>Si necesita algo más especializado...</h2> 
                                <div class="wrapColumn">                                                                                        
                                    <div class="inner">
                                        <ul class="clearFix reset">
                                            {for 0 to min( 2, $node.data_map.relacionados_especializados.content.relation_browse|count())|sub(1) as $i  }
                                            <li {if 0|eq( min( 2, $node.data_map.relacionados_especializados.content.relation_browse|count())|sub(1) ) }class="reset"{/if}>
                                            {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.relacionados_especializados.content.relation_browse[$i].contentobject_id )) }
                                            	{node_view_gui content_node=$item.main_node view=relacionado}
                                            {undef $item}                                            
                                            </li>
                                            {/for}
                                        </ul>                                    
                                    </div>                                    
                                </div>
                                {/if}
                                
                            </div>
                             {if $node.data_map.productos_relacionados_online.has_content}
                            <div class="columnType2 frt"> 
                                 {if $node.parent_node_id|eq( 1485 )}
                                    <h2>Software especializado</h2>
                                 {else}
                                <h2>¿Prefiere trabajar online?</h2>                                    
                                  {/if}
                                <div class="wrapColumn">                                            
                                    <div class="inner clearFix">

                                        <ul>
                                        	{for 0 to min( 2, $node.data_map.productos_relacionados_online.content.relation_browse|count())|sub(1) as $i  }
                                            <li>
                                                {def $item = fetch( 'content', 'object', hash( 'node_id', $node.data_map.productos_relacionados_online.content.relation_browse[$i].contentobject_id )) }
                                            		{node_view_gui content_node=$item.main_node view=relacionadoonline}
                                           		{undef $item}     
                                            </li>                                            
                                            {/for}
                                        </ul>                                    
                                    </div>
                                </div>
                                {/if}
                            </div>
                        </div>
                        
                    </div>
                    {/if}
                    {if $node.data_map.cursos.has_content}                               
                    <div class="cursosRel">

                        <h2>Cursos relacionados</h2>
                        <div class="wrap">
                            <div class="description">
                                <ul>
                                	{for 0 to min( 3, $node.data_map.cursos.content.relation_browse|count())|sub(1) as $i}
                                	{def $item = fetch( 'content', 'node', hash( 'node_id', $node.data_map.cursos.content.relation_browse[$i].node_id )) }	
                                    <li>
                                        <h3><a href={$item.url_alias|ezurl()}>{$item.name}</a></h3>
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
                    {/if}
                                   
                </div>

</div>
        
            
        


