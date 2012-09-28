{ezcss_require( 'imemento.css' )}
{ezscript_require( 'imemento.js' ))}
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
<div id="iMementoDest" class="clearFix">
<div class="clearFix">
				<h2 class="logo"><img src={"logo_iMemento.png"|ezimage} alt="iMemento"/></h2>
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
						<a href="#" class="tryProd"><span>Pruebe gratis <strong>iMemento</strong> 15 días </span></a>

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
<input type="hidden" name="ContentObjectAttribute_ezselect_selected_array_10807" value="" />

									<select id="prod" name="ContentObjectAttribute_ezselect_selected_array_10807[]">
										
<option value="13">iMemento</option>
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
					<div class="confPromo">
						<strong class="dest">Desde: {$node.data_map.precio.content.price|l10n(clean_currency)} € <span>+ IVA</span></strong>
						<a href={"basket/imemento"|ezurl} class="conf"><span>Configure su <strong>iMemento</strong> a la carta</span></a>
						<a href={"basket/imementorama"|ezurl} class="conf"><span>Configure su <strong>iMemento</strong> por rama del derecho</span></a>
						<!--div class="moreInfo">
							<span>¿Necesita más <strong>información</strong>?</span>
							<a href="">Nosotros nos ponemos en contacto con usted</a>
						</div-->
						<div id="modInformacion">
							<h2><img alt="¿Necesita información?" src={"bck_modInformacionTit.gif"|ezimage}></h2>
							<div>
								<span class="verMas"><a href={"contacto"|ezurl}>Nosotros nos ponemos en contacto con usted</a></span>
							</div>
						</div>
					</div>
					<a href="#" class="appStore"><img src={"i_appStore.png"|ezimage} alt="Disponible en el AppStore" width="159" height="55" /></a>
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
                </div>

                <div class="columnType2 frt">
                	<div class="modType4">
{def $tabscount = 1}
						{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.contenido.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.novedades.has_content}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $cuantasvaloraciones|gt(0)}{set $tabscount = $tabscount|inc()}{/if}
                    	{if $node.data_map.sumario.has_content}{set $tabscount = $tabscount|inc()}{/if}                  
                    	<span class="volver imprimir frt"><a href="#" onclick="window.print()">Imprimir ficha</a></span>

                    	<div class="descripcion" id="producttext">
                            <ul class="tabs" style="float:none">
                            	<li {if and( array( 'producto_qmementix', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}class="sel"{/if}>
                              {if and( array( 'producto_qmementix', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'ventajas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Ventajas{if and( array( 'producto_qmementix', 'ventajas_producto' )|contains( $clase ), is_set( $view_parameters.v)|not )}</h2>{else}</a>{/if}
                                </li>
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
                                {if $cuantasvaloraciones|gt(0)}
                                <li {if $clase|eq('opiniones_clientes')}class="sel"{/if}>
                                	{if $clase|eq('opiniones_clientes')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'opiniones_clientes' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Opinión de los clientes{if $clase|eq('opiniones_clientes')}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                            </ul>

                            <div class="cont cursoDet clearFix">
                            	
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

                                    
									{elseif array( 'producto_qmementix', 'ventajas_producto' )|contains( $clase )}
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
            </div>
{/if}
{literal}<script type="text/javascript">

	$("#formOpinion").fancybox({
			'width':624, 
			'height':438,
			'padding':0,
			'type':'iframe'
	});
</script>{/literal}
