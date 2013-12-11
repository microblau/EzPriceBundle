{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 2 )}    
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}     

{ezcss_require( 'styles.css')}
{ezcss_require( 'jquery.fancybox-1.3.0.css')}
{ezscript_require('jquery.jcarousel.js')}  
{ezscript_require('jquery.fancybox-1.3.0.pack.js')}  
{ezscript_require('ui.core.js')}  
{ezscript_require('ui.slider.js')}  
{ezscript_require('langEs.js')}  
{ezscript_require('common.js')}  
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

{def $limite=6}
{def $offset=0}
{def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))} 

{if $view_parameters.offset|ne('')}
	{set $offset=$view_parameters.offset}
{/if}

{def $condicion=''}

{if $view_parameters.valor|ne('')}
	{switch match=$view_parameters.valor}
		{case match='facilidad'} 
			{set $condicion=$condicion|append('facilidad=')}
        {/case}
		{case match='actual'} 
			{set $condicion=$condicion|append('actualizaciones=')}
        {/case}
   		{case match='calidad'} 
			{set $condicion=$condicion|append('calidad=')}
        {/case}
		{case}
        	{set $condicion=''}
        {/case}
        
	{/switch}
{/if}
{if $view_parameters.estrellas|ne('')}
	{set $condicion=$condicion|append($view_parameters.estrellas)}
{/if}



{def $muestratodas = fetch('producto','muestratodas' , hash( 'node_id', $node.node_id ,'limite' ,$limite, 'offset', $offset , 'condicion' ,$condicion))} 

{def $cuantasvaloraciones2=fetch('producto','muestratodas' , hash( 'node_id', $node.node_id ,'limite' ,0 , 'offset', 0 , 'condicion' ,$condicion))} 
    {def $cuantasvaloraciones=$cuantasvaloraciones2|count()}
{if $cuantasvaloraciones|gt($limite)}
	{def $cuantaspaginas=div($cuantasvaloraciones,$limite)|round()}

{/if}   


{def $mediacalidad = fetch('producto','mediacalidad' , hash( 'node_id', $node.node_id ))} 
{def $mediaactualizaciones = fetch('producto','mediaactualizaciones' , hash( 'node_id', $node.node_id ))} 
{def $mediafacilidad = fetch('producto','mediafacilidad' , hash( 'node_id', $node.node_id ))} 

{def $muestraultimas = fetch('producto','muestraultimas' , hash( 'node_id', $node.node_id ))} 
{def $muestraaleatorio=fetch('producto','muestraaleatorio' , hash( 'node_id', $node.node_id ))} 
{def $calculaestrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,5 ))} 

            <div id="gridWide">
                
                <div id="moduloDestacadoContenido" class="type1">                             
                    <h1 itemprop="name">{$node.name}

                    <span class="subTit twoLines">{$node.data_map.subtitulo.content}</span></h1>
                    <div class="wrap">
                
                        <div class="inner">
                
                            <div class="wysiwyg">
                    
                                <div class="attribute-cuerpo clearFix">
                            <div class="object-left column1">
								<div class="content-view-embed">
									<div class="class-image">
                                               {if $node.data_map.imagen.has_content}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
										<div class="attribute-image">  
                                         <img itemprop="image thumbnailUrl" src={$imagen.data_map.image.content.fichaproducto.url|ezroot()}
    alt="{$imagen.data_map.image.content.fichaproducto.alternative_text}"
 width="{$imagen.data_map.image.content.fichaproducto.width}"  height="{$imagen.data_map.image.content.fichaproducto.height}" />
										</div>
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
														
															<div class="attribute-image">                                 
																<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} alt="{$imagen.data_map.image.content.alternative_text}" width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" />
															</div>                                                                                  
														
											{/if}																					
                                     </div>
                       			</div>
                                <div class="infoFichaTop">
                                            <div class="info">
                                                <ul>
                         	
                {if or($node.data_map.youtube_url.has_content,$node.data_map.video.has_content)}          
                                                    <li class="video"><a href="{concat('/producto/vervideo?n=', $node.node_id)}" id="video">Mire el vídeo de esta publicación</a></li>
                                                    {/if}
                                                    
                                                    
                                                    
                                                    {if $node.data_map.pdf_sumario.has_content}
    {def $pdf_sumario = fetch( 'content', 'object', hash( 'object_id', $node.data_map.pdf_sumario.content.relation_browse.0.contentobject_id ))}
	<li class="sumario">
    	<a href={concat( 'content/download/', $pdf_sumario.data_map.file.contentobject_id, '/', $pdf_sumario.data_map.file.id,'/version/', $pdf_sumario.data_map.file.version , '/file/', $pdf_sumario.data_map.file.content.original_filename|urlencode )|ezurl}>
        Ver el sumario
        </a>
    </li>
    {undef $pdf_sumario}
    {/if}
                                                    {if $node.data_map.pdf_10pags.has_content}
													{def $pdf = fetch( 'content', 'object', hash( 'object_id', $node.data_map.pdf_10pags.content.relation_browse.0.contentobject_id ))}    <li class="paginas">
    	<a href={concat( 'content/download/', $pdf.data_map.file.contentobject_id, '/', $pdf.data_map.file.id,'/version/', $pdf.data_map.file.version , '/file/', $pdf.data_map.file.content.original_filename|urlencode )|ezurl}>
        Leer las 10 primeras páginas </a></li>
                                                    {undef $pdf}
                                                    {/if}
                                                    <li class="imprimir"><a href="#" onclick="window.print()">Imprimir ficha</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                
                                
								</div>
								
                                	<div class="column2" itemprop="about">
                                    	{$node.data_map.entradilla.content.output.output_text}
                                   		{if or(  $node.parent_node_id|eq(66), $node.parent_node_id|eq(1485), $node.parent_node_id|eq(69), $node.parent_node_id|eq(70), $node.parent_node_id|eq(4058), $node.parent_node_id|eq(7343), $node.parent_node_id|eq(71) )|not }
	                                    <div class="clearFix linksModulo">
	                                        <span>¿Dónde reside el éxito de esta obra?</span>
	                                        <span class="verMas"><a href={"por-que-lefebvre/sistematica-memento"|ezurl}>Quiero saber más</a></span>                                        
	                                    </div>
	                                    {/if}
										{if $node.parent_node_id|eq(71)}
										 <div class="clearFix linksModulo">
	                                        <span>¿Quiere probarlo gratis durante 15 días?</span>
	                                        <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Solicite una clave ahora</a></span>                                        
	                                    </div>
										{/if}
                                     </div>

                                    <div class="column3">
                                  	  <div class="nuevaFicha" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                      {if $node.data_map.clicktocall.has_content}
                                      <div class="llamamos">
                                                <span>¿Necesita realizar alguna consulta?</span>
                                                <a href="{$node.data_map.clicktocall.content}" target="_blank"><img src={"btn_lellamamos.gif"|ezimage()} alt="Le llamamos" /></a>
                                     </div>
                                     {/if}
                                     <a href={concat( "basket/add/", $node.object.id, '/1')|ezurl} class="ejemplar">
                                     	<img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" />
                                     </a>
{if $node.data_map.precio.content.has_discount}
	{def $discount_type = fetch( 'basket', 'get_discount_type', hash( 'user', fetch( 'user', 'current_user' ),
	                             'params', hash( 'contentclass_id', $node.object.contentclass_id,
                                 'contentobject_id', $node.object.id,
                                 'section_id', $node.object.section_id)))}
    		<div class="ofertaSus">
                                        {if $discount_type.id|eq(82)}
										   <span class="desc">{$node.object.data_map.texto_oferta.content}</span>
										{else}
										    <span class="desc">{$discount_type.name}</span>
										{/if}
							
                          <span class="precioAnterior">
                                	{$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA
                          </span>
                           <span class="precioNuevo" itemprop="price">
                           
                            	{$node.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)} € + IVA
                          </span>
<meta itemprop="priceCurrency" content="EUR" /> 
			</div>
{else}

                                          	<div class="ofertaSus">
                                           	 <span class="precioNuevo" itemprop="price">
                                                    	{$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA
                                                    </span>
                                                    <meta itemprop="priceCurrency" content="EUR" /> 
                                             </div>
{/if}
										
{if or( $node.parent_node_id|eq(1485), $node.parent_node_id|eq(69), $node.parent_node_id|eq(70) ) }
                             <div id="modInformacion">
                                 <h2>
                                    <img src={"bck_modInformacionTit.gif"|ezimage()} alt="¿Necesita información?" />
                                 </h2>
                             <div>
                             <span class="verMas">
                             	<a href={fetch('content', 'node', hash('node_id', 1456)).url_alias|ezurl()}>Nosotros nos ponemos en contacto con usted</a>
                             </span>
                             </div>
                             </div>
{/if}
{*si son actums*}
{if $node.parent_node_id|eq(66) }
                            <div class="modConvencerse">
                                 <h2>
                                 	<img src={"bck_modConvencerseTit.gif"|ezimage()} alt="¿Necesita convencerse?" />
                                 </h2>
                            <div>
                            <span class="verMas">
                                {switch match=$node.node_id}
                                    {case match=2265}
                                        <a href="http://solucionesmemento-indiv.efl.es/ActumPublic/ActumRss/demo_acceso.jsp?cdProd=ACTUMF" target="_blank">Pruebe GRATIS actum durante 1 mes</a>
                                    {/case}
                                    {case match=2270}
                                        <a href="http://solucionesmemento-indiv.efl.es/ActumPublic/ActumRss/demo_acceso.jsp?cdProd=ACTUMS" target="_blank">Pruebe GRATIS actum durante 1 mes</a>
                                    {/case}
                                    {case match=2271}
                                        <a href="http://solucionesmemento-indiv.efl.es/ActumPublic/ActumRss/demo_acceso.jsp?cdProd=ACTUMI" target="_blank">Pruebe GRATIS actum durante 1 mes</a>
                                    {/case}
                                    {case match=2272}
                                        <a href="http://solucionesmemento-indiv.efl.es/ActumPublic/ActumRss/demo_acceso.jsp?cdProd=ACTUMM" target="_blank">Pruebe GRATIS actum durante 1 mes</a>
                                    {/case}
                                {/switch}
                            </span>
                            </div>
</div>
{/if}	
{*fin si son actums*}
                                    	
                                    </div>
								
                                
                                
                                </div>{*nueva ficha*}
                                </div>
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            
            
            {*valoraciones del producto nuevas*}
           {if $clase|eq('valoraciones_producto')}
			<div class="modType4"  id="valCont">
                    <div class="clearFix">
                        <div class="volver frt">
                            <p style="text-align:right"><a href={$node.parent.url_alias|ezurl}>Volver al listado</a></p>
                            <p><a href={$node.url_alias|ezurl}>Volver a la ficha de producto</a></p>
                            
                            
                        </div>
                       
                    </div>
                    
                    <div class="descripcion">
                    
                    	<h2 class="titleOpinion">({$cuantasvaloracionestotales} ) Profesionales que ya conocen sus ventajas...</h2>
                        
                        <div class="cont cursoDet clearFix">
                            <div class="column1 opiniones">
                                <div class="versiones clearFix">
                                
                                	<ul class="valoraciones">
                                       <li>
                                        	<h3>Facilidad de consulta</h3>
                                        	<ul>
                                            	<li {if and($view_parameters.valor|eq('facilidad'), $view_parameters.estrellas|eq(5))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)}
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/facilidad/(estrellas)/5')|ezroot()}>
                                                    {/if}
                                                        	Cinco estrellas
                                                    {if $estrellas.cuantos|gt(0)}  </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                <li {if and($view_parameters.valor|eq('facilidad'), $view_parameters.estrellas|eq(4))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">
                                                  {if $estrellas.cuantos|gt(0)} 
                                                  	 <a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/facilidad/(estrellas)/4')|ezroot()}>

                                                    {/if} 
                                                    Cuatro estrellas
                                                   {if $estrellas.cuantos|gt(0)} </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('facilidad'), $view_parameters.estrellas|eq(3))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">
                                                 {if $estrellas.cuantos|gt(0)}   
                                                 	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/facilidad/(estrellas)/3')|ezroot()}>
                                                  {/if}  
                                                    Tres estrellas
                                                   {if $estrellas.cuantos|gt(0)} </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('facilidad'), $view_parameters.estrellas|eq(2))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">
                                                  {if $estrellas.cuantos|gt(0)} 
                                                  	 <a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/facilidad/(estrellas)/2')|ezroot()}>
                                                  {/if}   
                                                    Dos estrellas
                                             {if $estrellas.cuantos|gt(0)} </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('facilidad'), $view_parameters.estrellas|eq(1))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">
                                                {if $estrellas.cuantos|gt(0)}
                                                	    <a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/facilidad/(estrellas)/1')|ezroot()}>
                                                 {/if}       
                                                    Una estrella
	                                              {if $estrellas.cuantos|gt(0)} </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                        	<h3>Actualizaciones</h3>
                                        	<ul>
                                            	 <li {if and($view_parameters.valor|eq('actual'), $view_parameters.estrellas|eq(5))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)}
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/actual/(estrellas)/5')|ezroot()}>
                                                    {/if}
                                                    Cinco estrellas
                                                   {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('actual'), $view_parameters.estrellas|eq(4))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)}
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/actual/(estrellas)/4')|ezroot()}>
                                                    {/if}
                                                    Cuatro estrellas
                                                   {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                           
                                                 <li {if and($view_parameters.valor|eq('actual'), $view_parameters.estrellas|eq(3))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">
                                                   {if $estrellas.cuantos|gt(0)}
                                                   	 <a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/actual/(estrellas)/3')|ezroot()}>
                                                   {/if}
                                                    Tres estrellas
                                                    {if $estrellas.cuantos|gt(0)}</a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                
                                               <li {if and($view_parameters.valor|eq('actual'), $view_parameters.estrellas|eq(2))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">
                                                   {if $estrellas.cuantos|gt(0)} 
                                                   		<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/actual/(estrellas)/2')|ezroot()}>
                                                   {/if}
                                                    Dos estrellas
                                                  {if $estrellas.cuantos|gt(0)} </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                
                                                 <li {if and($view_parameters.valor|eq('actual'), $view_parameters.estrellas|eq(1))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)}
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/actual/(estrellas)/1')|ezroot()}>
                                                    {/if}
                                                    Una estrella
                                                	{if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                
                                            </ul>
                                        </li>
                                        <li>
                                        	<h3>Calidad Global</h3>
                                        	<ul>
                                            	 <li {if and($view_parameters.valor|eq('calidad'), $view_parameters.estrellas|eq(5))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">
                                                   {if $estrellas.cuantos|gt(0)} 
                                                   		<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/calidad/(estrellas)/5')|ezroot()}>
                                                    {/if}
                                                    Cinco estrellas
                                                  {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('calidad'), $view_parameters.estrellas|eq(4))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)} 
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/calidad/(estrellas)/4')|ezroot()}>
                                                     {/if}
                                                    Cuatro estrellas
                                                {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li {if and($view_parameters.valor|eq('calidad'), $view_parameters.estrellas|eq(3))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">
                                                     {if $estrellas.cuantos|gt(0)}
                                                     	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/calidad/(estrellas)/3')|ezroot()}>
                                                      {/if}
                                                    Tres estrellas
                                                {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('calidad'), $view_parameters.estrellas|eq(2))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">
                                                     {if $estrellas.cuantos|gt(0)}
                                                     	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/calidad/(estrellas)/2')|ezroot()}>
                                                      {/if}
                                                    Dos estrellas
                                                 {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                 <li {if and($view_parameters.valor|eq('calidad'), $view_parameters.estrellas|eq(1))}class="sel"{/if}>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">
                                                    {if $estrellas.cuantos|gt(0)} 
                                                    	<a href={concat($node.url_alias, '/(ver)/valoraciones/(valor)/calidad/(estrellas)/1')|ezroot()}>
                                                    {/if}
                                                    Una estrella
                                                  {if $estrellas.cuantos|gt(0)}   </a>{/if}</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="boton">
                                        	<p><strong>Comparta con los usuarios su valoración...</strong></p>
                                            {def $current_user=fetch( 'user', 'current_user' )}  
											{def $user_id=$current_user.contentobject_id}
                                           {def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.node_id , 'usuario',$user_id ))} 

											{if $current_user.is_logged_in}

                                                   {if $havotado|gt(0)}
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
                                              
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra"  /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                                        </li>
                                    </ul>
                                    
                                    <span class="verMas mrg"><a href={fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'valoraciones_producto' )
 )).0.url_alias|ezurl}>
                                    {$cuantasvaloracionestotales}{if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span>
                                    
                                	<div class="columnFlt">
                                        <ul class="clearFix">
											{foreach $muestratodas as $valoracion}
												<li>
   <div class="flt">
   <p>"{$valoracion.comentario}"</p>
   <span><span class="nombre">{$valoracion.nombre} {$valoracion.apellidos}. </span>{$valoracion.empresa}</span>
   </div>
   <div class="frt">
   <div class="opinion">
   <ul>
   {def $im=concat("image_valoracion_",$valoracion.calidad, ".gif")}
       <li><span>Calidad</span>
       <img src={$im|ezimage()} alt="" class="frt" />
   {undef $im}
       </li>
  {def $im=concat("image_valoracion_",$valoracion.actualizaciones, ".gif")}
       <li><span>Actualizaciones</span>
       <img src={$im|ezimage()} alt="" class="frt" />
  {undef $im}
       </li>
       <li><span>Facilidad de consulta</span>
       {def $im=concat("image_valoracion_",$valoracion.facilidad, ".gif")}
       <img src={$im|ezimage()} alt="" class="frt" />
       {undef $im}</li>
   </ul>
   </div>
   </div>
</li>
											 {/foreach}
                                        
                                        </ul>
                                        
                 <!--paginador-->
                {if $cuantaspaginas|gt(0)}
                             
                              {include name=navigator
								         uri='design:navigator/valoraciones.tpl'
								         page_uri=concat($node.url_alias,"/valoraciones")
										 page_uri_suffix="#valCont"
								         item_count=$cuantasvaloraciones
								         view_parameters=$view_parameters
								         node_id=$node.node_id
								         item_limit= $limite}
				{/if}
            <!--fin paginador-->                                        
                                    </div>
                                    
                                    <div class="columnFrt">
                                    	<div class="cont">
                                        	<h3>Últimas opiniones</h3>

                                            <ul>
                                            {foreach $muestraultimas as $ultimas}
                                                <li>
                                                    <p>"{$ultimas.comentario}"</p>
                                                  <span><span class="nombre">{$ultimas.nombre} {$ultimas.apellidos}. </span>{$ultimas.empresa}</span>
                                                    <div class="opinion">
                                                        <ul>
                                                           {def $im=concat("image_valoracion_",$ultimas.calidad, ".gif")}
                                                               <li><span>Calidad</span>
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                           {undef $im}
                                                               </li>
                                                          {def $im=concat("image_valoracion_",$ultimas.actualizaciones, ".gif")}
                                                               <li><span>Actualizaciones</span>
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                          {undef $im}
                                                               </li>
                                                               <li><span>Facilidad de consulta</span>
                                                               {def $im=concat("image_valoracion_",$ultimas.facilidad, ".gif")}
                                                               <img src={$im|ezimage()} alt="" class="frt" />
                                                               {undef $im}</li>
                                                           </ul>
                                                    </div>
                                                </li>
                                              {/foreach}  
                                            
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div>
                                                                    
                            </div>
                            
                        </div>
                    </div>                        
                    
                </div>
                
                </div>
            {*fin valoraciones del producto nuevas*}
            {*columnas originales del producto*}
           {else} 
            </div>    
            <div id="gridTwoColumnsFichas" class="clearFix">

            
                <div class="columnType1 flt">
                
          {*nuevo*}      

               {if $cuantasvaloraciones|gt(0)} 
                <div id="modFichasPrecio">
                    	<h2 class="subTitle">Profesionales que ya conocen sus ventajas...</h2>
                    	<div class="wrap">
                        <div class="botonOpine">
                        {def $current_user=fetch( 'user', 'current_user' )}  
											{def $user_id=$current_user.contentobject_id}
                                           {def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.node_id , 'usuario',$user_id ))} 

											{if $current_user.is_logged_in}

                                                   {if $havotado|gt(0)}
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
												
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                            </div>
                        	<p class="top">" {$muestraaleatorio.0.comentario}"</p>
                            <p><strong>{$muestraaleatorio.0.nombre} {$muestraaleatorio.0.apellidos}</strong>. {$muestraaleatorio.0.empresa}</p>
                            <div class="opinion">
                            	<h3>Los usuarios opinan:</h3>
                                <ul>
                                	<li><span>Calidad</span><a href="#" class="mas" id="mas">
                                    <img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                    {def $im=concat("image_valoracion_",$mediacalidad, ".gif")}
                                      <img src={$im|ezimage()} alt="" class="frt" />
                                    {undef $im}

                                    	<div class="modValoraciones" id="mod">
                                        	<h4>Calidad Global</h4>
                                            <div>
                                                <ul>
                                            	<li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">Cinco estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">Cuatro estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">Tres estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">Dos estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'calidad', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">Una estrella</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                            </ul>
                                                <a href="#" class="mas"><img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                                <span class="verMas mrg"><a href={fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'valoraciones_producto' )
 )).0.url_alias|ezurl}>{$cuantasvaloracionestotales}  {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li><span>Actualizaciones</span><a href="" class="mas" id="mas2">
                                    <img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                    {def $im=concat("image_valoracion_",$mediaactualizaciones, ".gif")}
                                      <img src={$im|ezimage()} alt="" class="frt" />
                                    {undef $im}
                                    	<div class="modValoraciones" id="mod2">
                                        	<h4>Actualizaciones</h4>
                                            <div>
                                                   <ul>
                                            	<li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">Cinco estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">Cuatro estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">Tres estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">Dos estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'actualizaciones', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">Una estrella</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                            </ul>
                                                <a href="#" class="mas"><img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                                <span class="verMas mrg"><a href={fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'valoraciones_producto' )
 )).0.url_alias|ezurl}>{$cuantasvaloracionestotales}  {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li><span>Facilidad de consulta</span><a href="" class="mas" id="mas3">
                                    <img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                     {def $im=concat("image_valoracion_",$mediafacilidad, ".gif")}
                                      <img src={$im|ezimage()} alt="" class="frt" />
                                    {undef $im}
                                    	<div class="modValoraciones" id="mod3">
                                        	<h4>Facilidades de Consulta</h4>
                                            <div>
                                               <ul>
                                            	<li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,5 ))}
                                                	<span class="estrellas">Cinco estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas}    
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,4 ))}
                                                	<span class="estrellas">Cuatro estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,3 ))}
                                                	<span class="estrellas">Tres estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,2 ))}
                                                	<span class="estrellas">Dos estrellas</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                   <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                                <li>
                                                {def $estrellas=fetch('producto','calculaestrellas' , hash( 'node_id', $node.node_id, 'categoria' , 'facilidad', 'n_estrellas' ,1 ))}
                                                	<span class="estrellas">Una estrella</span>
                                                    <span class="barra"><span style="width:{$estrellas.media}%;">&nbsp;</span></span>
                                                    <span>({$estrellas.cuantos})</span>
                                                {undef $estrellas} 
                                                </li>
                                            </ul>
                                                <a href="#" class="mas"><img src={"ico_mas.gif"|ezimage()} alt="" /></a>
                                                <span class="verMas mrg"><a href={fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'valoraciones_producto' )
 )).0.url_alias|ezurl}>{$cuantasvaloracionestotales}  {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearFix">
                                <span class="verMas frt"><a href={fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'valoraciones_producto' )
 )).0.url_alias|ezurl}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuarios</a></span>
                            </div>
                         </div>
                    </div>
               {else}
               
          <div id="modFichasPrecio">
                    	<h2 class="subTitle">Profesionales que ya conocen sus ventajas...</h2>
                    	<div class="wrap">
                        	<div class="botonOpine">
                             {def $current_user=fetch( 'user', 'current_user' )}  
											{def $user_id=$current_user.contentobject_id}
                                           {def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.node_id , 'usuario',$user_id ))} 

											{if $current_user.is_logged_in}

                                                   {if $havotado|gt(0)}
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
												
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                            
                            
                            
                            </div>
                         </div>
                    </div>
                    
               {/if} 
                
                
                
          {*nuevo*}      
                
                
                
                    <div id="modFichasPrecio">
                        <h2>
                        	<p><span>Precio: {if $node.data_map.precio.content.has_discount}<s>{/if}{$node.data_map.precio.content.price|l10n(clean_currency)} €{if $node.data_map.precio.content.has_discount}</s>{/if}</span> + IVA</p>
                        	{if $node.data_map.precio.content.has_discount}
                        	<p class="preciooferta"><span>Oferta: {$node.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)} €</span> + IVA</p>
                        	{/if}
                        </h2>
                        <div class="wrap">
                            <ul>
                               {if $node.data_map.edicion.has_content}
                                <li itemprop="bookEdition">Edición: {$node.data_map.edicion.content}</li>
                                {/if}
                                {if $node.data_map.fecha_aparicion.has_content}
                                <li>Aparición: {$node.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%d/%m/%Y')}</li>
                                {/if}
                                {if $node.data_map.paginas.has_content}
                                <li itemprop="numberOfPages">Páginas: {$node.data_map.paginas.content}</li>
                                {/if}
                                <li>{cond( $node.data_map.disp_librerias.content|eq( 1 ), 'Disponible en librerías')}</li>
                                {if $node.data_map.isbn.has_content}
                                <li  itemprop="isbn">ISBN: {$node.data_map.isbn.content.value}</li>
                                {/if}
                                {if $node.data_map.issn.has_content}
                                <li>ISSN: {$node.data_map.issn.content}</li>
                                {/if}
                            </ul>
							
							
							<div class="info">
                            	<div class="inner">
	                                <ul>
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
                                        <li class="reset compartelo">
	                                        <div class="clearFix">
    	    	                                <div class="flt"><a href="">Compartir:</a></div>
    	    	                                <div class="frt">
    	    	                                	<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
    	    	                                	<script type="IN/Share"></script>
													<a href="http://twitter.com/home?status={$node.name} http://{ezsys( 'hostname' )}/{$node.url_alias}"><img src={"btn_twit.gif"|ezimage} alt="twittear" /></a>	
                                                    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	        	    	                            <g:plusone size="medium" count="false"></g:plusone>    	                	                   		 									
													<a href="http://www.facebook.com/sharer.php?u=http://{ezsys( 'hostname' )}/{$node.url_alias}&t={$node.name}"><img src={"btn_f.gif"|ezimage} alt="me gusta" /></a>
                    	                	    	 <span class="compartelo"><a href="#bmarks-10" class="bmarks-btn">En otras webs</a></span>
                                    	    	 </div>
                                        	</div>	
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
                                	<li class="contacto"><a href={"contacto"|ezurl}>Otras formas de contacto</a></li>
                                </ul>

                            </div>
                         
                            <a href={concat( "basket/add/", $node.object.id, '/1')|ezurl} class="ejemplar"><img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" /></a>                           
                         </div>
                    </div>
                
                </div>
                
                <div class="columnType2 frt">
                    <div class="modType4">
                
                    	{def $tabscount = 1}
						{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.contenido.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.novedades.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $cuantasvaloraciones|gt(0)}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}                  
                        
{def $related_blog_post = fetch( 'blog', 'get_related_posts', hash( 'query', $node.name ))}

                        <div class="descripcion" id="producttext">
                        	<div class="clear">
                        	  <span class="volver {if eq($tabscount,6)}addmargin{/if}"><a href={$node.parent.url_alias|ezurl}
>Volver al listado</a></span>
                            <ul class="tabs">
                 				<li {if and( array( 'producto', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}class="sel"{/if}>
                              {if and( array( 'producto', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'ventajas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Ventajas{if and( array( 'producto', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}</h2>{else}</a>{/if}
                                </li>
                            
                           
                                {if $node.data_map.sumario.has_content}
                                <li {if $clase|eq('sumario_producto')}class="sel"{/if}>
                                	{if $clase|eq('sumario_producto')}<h2>{else}

<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'sumario_producto' )
 )).0.url_alias|ezurl(no)}#producttext">

{/if}Sumario{if $clase|eq('sumario_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.contenido.has_content}
                                <li {if $clase|eq('condiciones_producto')}class="sel"{/if}>
                                	{if $clase|eq('condiciones_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'condiciones_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}{cond( $node.parent_node_id|eq( 1485 ),  'Contenido', 'Condiciones' )}{if $clase|eq('condiciones_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.novedades.has_content}
                                <li {if $clase|eq('novedades_producto')}class="sel"{/if}>
                                	{if $clase|eq('novedades_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'novedades_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Novedades{if $clase|eq('novedades_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
 {if $node.parent_node_id|eq(66)}

                               {if $node.data_map.novedades.has_content}
                                <li {if $clase|eq('novedades_producto')}class="sel"{/if}>
                                	{if $clase|eq('novedades_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'novedades_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Últimas noticias{if $clase|eq('novedades_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
{/if}
                                 
                                {if $node.data_map.actualizaciones.has_content}
                                <li {if $clase|eq('actualizaciones_producto')}class="sel"{/if}>
                                	{if $clase|eq('actualizaciones_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'actualizaciones_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Actualizaciones{if $clase|eq('actualizaciones_producto')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {*if $testimonios|count|gt( 0 )*}
                                {if $cuantasvaloraciones|gt(0)}
                                <li {if $clase|eq('opiniones_clientes')}class="sel"{/if}>
                                	{if $clase|eq('opiniones_clientes')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'opiniones_clientes' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Opinión de los clientes{if $clase|eq('opiniones_clientes')}</h2>{else}</a>{/if}
                                </li>
                                {/if}

                                {if $node.data_map.notas_relacionadas.has_content}
                                <li {if $clase|eq('noticias_relacionadas_producto')}class="sel"{/if}>
                                	{if $clase|eq('noticias_relacionadas_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'noticias_relacionadas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Últimas noticias{if $clase|eq('noticias_relacionadas_producto')}</h2>{else}</a>{/if}
                                </li>      
                                {/if}
                                {if $node.data_map.faqs_producto.has_content}
                                <li {if $clase|eq('faqs_producto')}class="sel"{/if}>
                                	{if $clase|eq('faqs_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'faqs_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Preguntas frecuentes{if $clase|eq('faqs_producto')}</h2>{else}</a>{/if}
                                </li>                           
                                {/if}  

                                {if $related_blog_post|count|gt(0)}
                                <li {if and( is_set( $view_parameters.v ), $view_parameters.v|eq( 'blog' ) )} class="sel"{/if}>{if and( is_set( $view_parameters.v ), $view_parameters.v|eq( 'blog' ) )}<h2>{else}<a href="{$node.url_alias|ezurl(no)}/(v)/blog">{/if}Blog{if and( is_set( $view_parameters.v ), $view_parameters.v|eq( 'blog' ) )}</h2>{else}</a>{/if}</li>
                                {/if}   
                            </ul>
                          
                            </div>
                            
                            <div class="cont cursoDet clearFix">
                            	{*si es testimonios no podemos pintar la columna de la derecha*}
                            	{if $clase|eq( 'opiniones_clientes' )}
                            		{*llamamos a una plantilla aparte *}
                                    {*testimonios:{$testimonios|attribute(show,1)}*}
                            		{*include uri="design:common/ficha/testimonios.tpl" testimonios=$testimonios*}
                                    
                                   {include uri="design:common/ficha/testimonios.tpl" testimonios=$muestraultimas cuantas=$cuantasvaloracionestotales}
                            	{elseif $clase|eq( 'faqs_producto' )}
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
                            	                                   <a href="{$node.url_alias|ezurl(no)}/(ver)/faqs#p_{$nodo.node_id}">
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
                                                       <li id="p_{$nodo.node_id}">
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

                                    {if and( is_set( $view_parameters.v ), $view_parameters.v|eq( 'blog' ) )}
                                    <h2>Post del blog relacionados con el producto</h2>
                                    <ul>
                                    {foreach $related_blog_post as $post}
                                            <li><a href="{$post.guid}">{$post.post_title}</a></li>
                                    {/foreach}
                                    </ul>

                                    
									{elseif array( 'producto', 'ventajas_producto' )|contains( $clase )}
                                    <h2>Ventajas de tenerlo</h2>
                                    {$node.data_map.ventajas.content.output.output_text}
                                    {else}
                                    	{switch match=$clase}
                                    		{case match='sumario_producto'}
                                    			{$node.data_map.sumario.content.output.output_text}
                                    		{/case}
                                            {case match='actualizaciones_producto'}
                                    			{$node.data_map.actualizaciones.content.output.output_text}
                                    		{/case}
                                    		{case match='condiciones_producto'}
                                    			{$node.data_map.contenido.content.output.output_text}
                                    		{/case}
                                    		{case match='novedades_producto'}
                                    		    {if $node.parent_node_id|eq(66)}
                                    		    <div id="faq">
                                    		      <h2>Últimas noticias</h2>
                                    		      <div class="preguntas clearFix">
                            	                       <div class="flt">
                            	                       <div>
                                    		            <ul>
                                    		     {def $canal = fetch( 'content', 'tree', hash( 'parent_node_id', 2,
                                                                                               'class_filter_type', 'include',
                                                                                               'class_filter_array', array( 81 ),
                                                                                               'extended_attribute_filter', hash( 'id', 'ObjectRelationFilter',
                                                                                                                                  'params', array( 632 ,$node.data_map.area.content.relation_browse[0].contentobject_id ) 
                                                                                                )
                                                                                                
                                                  ))}
                                                  {def $items = fetch('content', 'list', hash('parent_node_id', $canal[0].node_id,
                                                                          'sort_by', array( 'published', false() ),
                                                                           'limit', 3
                                                        ))}
                                                        {foreach $items as $item}                                
                                                       	 <li><a target="_blank" href="{$item.data_map.url.content}">{$item.name} - {$item.object.published|datetime('custom', '%d/%m/%Y')}</a></li>
                                                        {/foreach}
                                                            <li style="font-size:10px"><a target="_blank" href="http://www.rssactum.es">ver más noticias</a></li>
                                                        </ul>
                                                    </div>
                                                    </div></div> </div>
                                    		    {else}
                                    			{$node.data_map.novedades.content.output.output_text}
                                    			{/if}
                                    		{/case}
                                    	{/switch}
                                    {/if}                                    
                                </div>
                                {*incluimos el template del modulo de Ventajas*}
                                {include uri="design:common/ficha/modVentajas.tpl"}
                                
                                {/if}
                                
                            </div>
                        </div>                        
                        
                    </div>
                    {if or( $node.data_map.productos_relacionados_por_area.has_content, $node.data_map.productos_relacionados_online.has_content, $node.data_map.relacionados_especializados.has_content )}                    
                    <div id="gridType3">
                          <div class="wrap clearFix">
                        {if $node.data_map.productos_relacionados_por_area.has_content}                            
                      
                            <div class="columnType1 flt">   
                                {if $node.parent_node_id|eq( 1485 )}
                                    <h2>Otros productos online</h2>
                                {else}
                                    <h2>Otros Mementos del Área {fetch( 'content', 'object',  hash( 'object_id',
     $node.data_map.area.content.relation_list.0.contentobject_id)).name}</h2>                                 
                                {/if}
                                <div class="wrapColumn">                                                                                        
                                    <div class="inner">
                                                          
                                        <ul class="clearFix columnsType1">
                                        	{for 0 to min( 2, $node.data_map.productos_relacionados_por_area.content.relation_browse|count())|sub(1) as $i}
                                        	
                                            <li {if 0|eq( min( 2, $node.data_map.productos_relacionados_por_area.content.relation_browse|count())|sub(1) ) }class="reset"{/if}>
                                            {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.productos_relacionados_por_area.content.relation_browse[$i].contentobject_id )) }
                                            
                                            	{node_view_gui content_node=$item.main_node view=relacionado}
                                            {undef $item}                                            
                                            </li>
                                            {/for}
                                         </ul>   
                                         <span class="verMas"><a href={concat("catalogo/area/", fetch( 'content', 'object',  hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id)).name|normalize_path()|explode('_')|implode('-') )|ezurl}>Ver todos los Mementos del Área {fetch( 'content', 'object',  hash( 'object_id', $node.data_map.area.content.relation_list.0.contentobject_id)).name}</a></span>

                                    </div>
                                    
                                </div>
                               {/if}
                                {if $node.data_map.relacionados_especializados.has_content}
                            	    <h2>Si necesita algo más especializado...</h2> 
                                <div class="wrapColumn">                                                                                        
                                    <div class="inner">
                                        <ul class="clearFix reset columnsType1">
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
                                                
                                                {def $item = fetch( 'content', 'object', hash( 'object_id', $node.data_map.productos_relacionados_online.content.relation_browse[$i].contentobject_id )) }
                                               
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
                    {/if}
                    {def $cursos = fetch( 'catalogo', 'custom_reverse_related_objects', hash( 
                                                                                            'from_object_version', false(),
                                                                                            'object_id', $node.object.id,
                                                                                            'attribute_id', array( 446, 447 ),
                                                                                            'group_by_attribute', false(),
                                                                                            'params', false(),
                                                                                            'reverse_related_objects', true()
                    ))}
                  
                    {if $cursos|count|gt(0)}                               
                  		  <div class="cursosRel">

                        <h2>Cursos relacionados</h2>
                        <div class="wrap">
                            <div class="description">
                                <ul>
                                	{for 0 to min( 3, $cursos|count()|sub(1) ) as $i}
                                	{def $item = fetch( 'content', 'node', hash( 'node_id', $cursos[$i].main_node_id )) }	
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
                    {/if}
                                   
                </div>
			{/if}
         {*fin columnas originales del producto*}
            
        


{literal}<script type="text/javascript">

	$("#video").fancybox({
			'width':624, 
			'height':453,
			'padding':0,
			'type':'iframe'
	});
	$("#formOpinion").fancybox({
			'width':624, 
			'height':438,
			'padding':0,
			'type':'iframe'
	});
</script>{/literal}
