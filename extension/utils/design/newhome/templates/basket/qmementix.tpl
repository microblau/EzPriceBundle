{ezcss_require( 'qmementix.css' )}
{ezscript_require( array('imemento.js','qmementixcarta.js' ))}
{ezpagedata_set( 'bodyclass', 'fichas')}
{ezpagedata_set( 'menuoption', 2 )}    
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}    
{ezcss_require( 'jquery.fancybox-1.3.0.css')}
{ezcss_require( 'jquery.fancybox-1.3.0.css')}
{ezscript_require('jquery.jcarousel.js')}  
{ezcss_require( 'jquery.jcarousel.css')}
{ezscript_require('jquery.fancybox-1.3.0.pack.js')} 
{ezscript_require('common.js')}
{def $limite=6}
{def $offset=0}

{def $object = fetch( 'content', 'object', hash( 'object_id', ezini( 'Qmementix', 'Object', 'qmementix.ini' ) ))}
{def $node=fetch('content','node',hash('node_id',$object.main_node_id))}


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
 {if $clase|eq('valoraciones_producto')}
	<div id="gridWide" class="imemento">
{/if}
{def $mementos = $object.data_map.imemento_productos.content}
<div id="iMementoDest" class="clearFix">
<div class="clearFix">
				<h2 class="logo"><img src={"logo_Qmementix.png"|ezimage} alt="Qmementix"/></h2>
<div id="mycarousel">
<div class="jcarousel-control">
						<a href="#" class="sel"><span>1</span></a>
						<a href="#"><span>2</span></a>
						<a href="#"><span>3</span></a>
					</div>
				<ul class="carrusel">
                    {foreach $node.data_map.carrusel.content.relation_browse as $index => $item}
                    {def $promo = fetch( 'content', 'object', hash( 'object_id', $item.contentobject_id))}
					<li >
						<div class="multimedia">
							{if $promo.data_map.youtube_url.has_content}
	   
                		                   	{eflyoutube( $promo.data_map.youtube_url.content, 640, 350 )}
    	                	        	 
{else}
		{if $promo.data_map.video.has_content}
        	{def $video = fetch( 'content', 'object', hash( 'object_id', $promo.data_map.video.content.relation_browse.0.contentobject_id ))}                         
                               {attribute_view_gui attribute=$video.data_map.video width=640 height=350 autostart=0}
                                                   
                            
        
        {else}
        	{if $promo.data_map.imagen.has_content}
        	      {def $imagen = fetch( 'content', 'object', hash( 'object_id', $promo.data_map.imagen.content.relation_browse.0.contentobject_id ))}
                                        <div class="media">
                                        <img src={$imagen.data_map.image.content.original.url|ezroot()} width="{$imagen.data_map.image.content.original.width}" height="{$imagen.data_map.image.content.original.height}" alt="{$imagen.data_map.image.content.alternative_text}" />
                                        </div>       
        	{/if}
        {/if}

{/if}
						</div>
						<h3>{$index|sum(1)} {$promo.name}</h3>
						{$promo.data_map.texto.content.output.output_text}
					</li>
                    {undef  $promo}
					{/foreach}
				</ul>
</div>
				<div class="infoDest">
					<div class="tryPromo">
						<a href="#" class="tryProd"><span>Pruébelo <strong>GRATIS</strong> 15 días </span></a>

                        <form id="frm_tryImemento" action={"content/action"|ezurl} method="post">
							<fieldset>
								<legend>Solicitud de prueba de producto</legend>
							<span class="requiredText">* Datos obligatorios</span>
							
									<label for="nombre">Su nombre <span>*</span>
									<input type="text" id="nombre" name="ContentObjectAttribute_ezstring_data_text_10808" class="text" /></label>
								
									<label for="apellidos">Sus apellidos <span>*</span>
									<input type="text" id="apellidos" name="ContentObjectAttribute_ezstring_data_text_10809" class="text" /></label>
								
									<label for="telefono">Su teléfono <span>*</span>
									<input type="text" id="telefono" name="ContentObjectAttribute_ezstring_data_text_10811" class="text" /></label>
								
									<label for="email">Su email <span>*</span>
									<input type="text" id="email" name="ContentObjectAttribute_data_text_10810" class="text" /></label>
								
									

									<label for="prod">Seleccione producto  <span>*</span></label>
									<input type="hidden" id="prod" name="ContentObjectAttribute_ezselect_selected_array_10807[]" value="0" />

									<select id="prodQI" name="ContentObjectAttribute_ezstring_data_text_329708">
										{foreach $mementos.relation_browse as $index => $el}
											{def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
												{if ne($memento.data_map.precio_qmementix.content.price,0)}
													<option value="{$memento.name}">{$memento.name}</option>
												{/if}	
											{undef $memento}	
										{/foreach}
									</select>
								</label>

									
							
									<label class="check" for="legal"> <input type="checkbox"id="legal" name="ContentObjectAttribute_data_boolean_10812" /> Acepto las <a id="condicionesligthBox" href={'lightbox/ver/1451'|ezurl}>condiciones legales</a></label>
								
							<input name="ActionCollectInformation" type="submit" value="Enviar solicitud" id="trySend" />
	{def $currentusuario = fetch( 'user', 'current_user') }				
						 <input class="box" type="hidden" size="70" name="ContentObjectAttribute_ezstring_data_text_21371" value="" id="colectivo" value="{cond( $currentusuario.is_logged_in, $currentusuario.contentobject.main_node.parent.name, '')}
" />						   <input type="hidden" name="ContentNodeID" value="1456" />
						   <input type="hidden" name="ContentObjectID" value="1512" />
						   <input type="hidden" name="ViewMode" value="full" />
                            </fieldset>
						
						</form>
						
					</div>
		<form action={"basket/addqmementix"|ezurl} method="post" id="mementosForm" name="mementosForm">
					<div class="myQMementix">
                        <span class="tit">Mi QMementix</span>
                        <div class="resume">
                            <p><strong><span class="flt">Ha añadido</span> <span class="cant" id="modMiImemento">0 Mementos</span></strong></p>
							<del><span id="partial"></span></del>
                            <ins><span id="ptotal"></ins>
							<img src={"ajax-loader.gif"|ezimage} id="preload" />
							<input type="image" id ="addToBasket" src={"btn_aniadir-compra.gif"|ezimage} alt="Añadir a la cesta" name="AddToBasket" />
						</div>
					</div>
				</div>
	</div>
				<ul class="footerTools"> 
					<li>
						<span>Compártalo:</span>
                    </li>							
					<li>
						 <script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
    	    	                                	<script type="IN/Share"></script>
					</li>
					<li>
						<a href="http://twitter.com/home?status={$node.name} http://{ezsys( 'hostname' )}/{$node.url_alias}"><img src={"btn_twit.gif"|ezimage} alt="twittear" /></a>	
					</li>
					<li>
                                                                            <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
						  <g:plusone size="medium" count="false"></g:plusone>    	                	                   	
					</li>
					<li>
						<a href="http://www.facebook.com/sharer.php?u=http://{ezsys( 'hostname' )}/{$node.url_alias}&t={$node.name}"><img src={"btn_f.gif"|ezimage} alt="me gusta" /></a>
					</li>
                    <li  class="compartelo">
                     <span><a href="#bmarks-10" class="bmarks-btn">En otras webs</a></span>
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
				</ul>
			</div>

              {*valoraciones del producto nuevas*}
           {if $clase|eq('valoraciones_producto')}
			<div class="modType4"  id="valCont">
                    <div class="clearFix">
                       
                            
                            <p><span class="volver frt"><a href={$node.url_alias|ezurl}>Volver a la ficha de producto</a></span></p>
                            
                            
                        
                       
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
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
                                              
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra"  /></a>
                                             
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
                
                
            {*fin valoraciones del producto nuevas*}
            {*columnas originales del producto*}
           {else} 

			<div id="gridTwoColumnsFichas" class="clearFix">

            	<div class="columnType1 flt">
                	
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
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
												
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
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
                    	<h2 class="subTitle">Si ya conoce sus ventajas...</h2>
                    	<div class="wrap">
                        	<div class="botonOpine">
                             {def $current_user=fetch( 'user', 'current_user' )}  
											{def $user_id=$current_user.contentobject_id}
                                           {def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.node_id , 'usuario',$user_id ))} 

											{if $current_user.is_logged_in}

                                                   {if $havotado|gt(0)}
                                                      <a href="/producto/opinion?n=already" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.node_id)}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
												
                                             	 <a href="/producto/login/(opinion)/{$node.node_id}" id="formOpinion"><img src={"btn_opine_producto.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                            
                            
                            
                            </div>
                         </div>
                    </div>
                    
               {/if} 
                </div>

                <div class="columnType2 frt">
                	<div class="modType4">
					<span class="volver frt"><a href={"catalogo/qmementix/qmementix"|ezurl()}>Volver</a></span>
					
					<div class="listado" id="productlist">
                            <h2>Seleccione sus Mementos</h2>
                            	<table>
									<thead>
										<tr>
											<th class="name" width=""><span class="hide">MEMENTO</span></th>
											<th class="pvp">PVP</th>
											<th class="pvp-offer">PVP OFERTA</th>
										</tr>
									</thead>
									<tbody>
										{foreach $mementos.relation_browse as $index => $el}
											{def $memento = fetch( 'content', 'object', hash( 'object_id', $el.contentobject_id))}
											{if ne($memento.data_map.precio_qmementix.content.price,0)}
												<tr>
													<td>
														<label for="hacienda_0{$memento.id}">
															<input type="checkbox" id="hacienda_0{$memento.id}" name="mementos[]" value="{$memento.id}" class="pretty" />
															{if $memento.data_map.nombre_mementix.content|ne('')}{$memento.data_map.nombre_mementix.content}{else}{$memento.name}{/if}
														</label>
													</td>
													{if eq($memento.data_map.oferta_qmementix.content.price,0)}
													<td class="pvp-offer"><ins>{$memento.data_map.precio_qmementix.content.ex_vat_price|l10n('clean_currency)} € + IVA</ins></td>
													<td class="pvp"></td>
													{else}
													<td class="pvp"><del>{$memento.data_map.precio_qmementix.content.ex_vat_price|l10n('clean_currency)} € + IVA</del></td>
													<td class="pvp-offer"><ins>{$memento.data_map.oferta_qmementix.content.ex_vat_price|l10n('clean_currency)} € + IVA</ins></td>
													{/if}	
													
												</tr>
											{/if}
											{undef $memento}
										{/foreach}
										
									</tbody>
								</table>
								<input type="hidden" name="discount" id="discountfield" value="" />
								<input type="hidden" name="total" id="totalfield" value="" />
								<input type="hidden" name="object" id="object" value="{ezini( 'Qmementix', 'Object', 'qmementix.ini' )}" />
		</form>
                            
                        </div>
					
                </div>
            </div>
{/if}
{undef $node}
