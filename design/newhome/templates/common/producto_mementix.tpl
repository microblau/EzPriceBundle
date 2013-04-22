{ezpagedata_set( 'bodyclass', 'fichas' )}
{ezpagedata_set( 'menuoption', 2 )}    
{ezpagedata_set( 'metadescription', $node.data_map.subtitulo.content )}         
 
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
                {*modulo destacado*}
                <div id="moduloDestacadoContenido" class="type1">                             
                    <h1>{$node.name}

                    <span class="subTit twoLines">{$node.data_map.subtitulo.content}</span></h1>
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
												<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" alt="{$imagen.data_map.image.content.alternative_text}"/>
												 {undef $imagen}
											{else}
												{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
																<img src={$imagen.data_map.image.content.fichaproducto.url|ezroot()} width="{$imagen.data_map.image.content.fichaproducto.width}" height="{$imagen.data_map.image.content.fichaproducto.height}" alt="{$imagen.data_map.image.content.alternative_text}" />
											{undef $imagen}
                                            {/if}
                                                </div>																					
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
	                                    <li class="sumario"><a href={concat( 'content/download/', $pdf_sumario.data_map.file.contentobject_id, '/', $pdf_sumario.data_map.file.id,'/version/', $pdf_sumario.data_map.file.version , '/file/', $pdf_sumario.data_map.file.content.original_filename|urlencode )|ezurl}>Ver el sumario</a></li>
                {undef $pdf_sumario}
{/if}
 {if $node.data_map.pdf_10pags.has_content}
	       {def $pdf = fetch( 'content', 'object', hash( 'object_id', $node.data_map.pdf_10pags.content.relation_browse.0.contentobject_id ))}             <li class="paginas"><a href={concat( 'content/download/', $pdf.data_map.file.contentobject_id, '/', $pdf.data_map.file.id,'/version/', $pdf.data_map.file.version , '/file/', $pdf.data_map.file.content.original_filename|urlencode )|ezurl}>Leer las 10 primeras páginas</a></li>
	      {undef $pdf}
 {/if}
  <li class="imprimir"><a href="#" onclick="window.print()">Imprimir</a></li>
                                                </ul>
                                            </div>
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
	                                        <span>¿Quiere probarlo gratis durante 15 días?</span>
	                                        <span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1456)).url_alias|ezurl}>Solicite una clave ahora</a></span>                                        
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
                                    
                                    
                                   {* 
                                    	<a href={'basket/mementix'|ezurl} class="ejemplar"><img src={"botonconfiguracion.png"|ezimage} alt="Configúrelo aquí" /></a>*}
                                    	
                                    	{if $node.data_map.precio.content.has_discount}
 {def $discount_type = fetch( 'basket', 'get_discount_type', hash( 'user', fetch( 'user', 'current_user' ),																                                                      'params', hash( 'contentclass_id', $node.object.contentclass_id,
													  'contentobject_id', $node.object.id,
                                                      'section_id', $node.object.section_id ) ))}
                                         <div class="ofertaSus">
                                            {if $discount_type.id|eq(3)}
                                                <p>{$node.object.data_map.texto_oferta.content}</p>
                                            {else}
                                                <p>{$node.object.data_map.precio.content.discount_percent}% por {$discount_type.name}</p>
                                            {/if}
                                            
                                            <div>
                                                <div class="precioAnterior">
                                                    <span>Desde <s>{$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA
                                                    </s></span>
                                                </div>
                                                <div>
                                                    Desde {$node.data_map.precio_oferta.content.price|l10n(clean_currency)} € + IVA
                                                </div>
                                            </div>
                                            
                                        </div>
                                        {else}
                                             <div class="ofertaSus">
                                             	<div>
                                                	<div class="precioAnterior">
                                                    	<span>Desde {$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA</span>
                                                    </div> 
                                                </div>
                                              </div>
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
            
      
      
       {if $clase|eq('valoraciones_producto')}
     		  	 <div class="modType4">
                    
                    <div class="clearFix">
                        <span class="volver frt">
                        
                        <a href={$node.parent.url_alias|ezurl}>Volver al listado</a></span>
                    </div>
                    
                    <div class="descripcion">
                    
                    	<h2 class="titleOpinion">({$cuantasvaloraciones} ) Profesionales que ya conocen sus ventajas...</h2>
                        
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
                                        	<p>Comparta con los usuarios su valoración...</p>
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
                                             
                                             	 <a href="/producto/login" id="formOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                                        </li>
                                    </ul>
                                    
                                    <span class="verMas mrg"><a href="">{$cuantasvaloraciones} valoraciones de usuarios</a></span>
                                    
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
								         page_uri=$node.url_alias
								         item_count=$cuantasvaloraciones
								         view_parameters=$view_parameters
								         node_id=$node.node_id
								         item_limit= $limite}
                             
                                        <!--div class="pagination frt">
                                            <span class="botones">
                                                <span class="prev reset">anterior</span>
                                                <a href="" class="next">siguiente</a>
                                            </span>
                                            <span class="items"><span class="actual">1</span> / <span class="total">{$cuantaspaginas}</span></span>
                                        </div-->
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
                    
               </div></div></div></div>
       
       {*cierro el gridWide*}
       {else}{*si no es valoraciones*}
            </div>
            <div id="gridTwoColumnsFichas" class="clearFix">{*INICIO GRID*}
                <div class="columnType1 flt">
          	       {*nuevo*}      
		               {if $cuantasvaloraciones|gt(0)} 
        				<div id="modFichasPrecio">
                    	<h2 class="subTitle">Profesionales que ya conocen sus ventajas...</h2>
                    	<div class="wrap">
                       
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
                                                <span class="verMas mrg"><a href={concat( $node.url_alias, "/(ver)/valoraciones")|ezroot()}>{$cuantasvaloraciones}  valoraciones de usuarios</a></span>
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
                                                <span class="verMas mrg"><a href={concat( $node.url_alias, "/(ver)/valoraciones")|ezroot()}>{$cuantasvaloraciones}  valoraciones de usuarios</a></span>
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
                                                <span class="verMas mrg"><a href={concat( $node.url_alias, "/(ver)/valoraciones")|ezroot()}>{$cuantasvaloraciones}  valoraciones de usuarios</a></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearFix">
                                <span class="verMas frt"><a href={concat( $node.url_alias, "/(ver)/valoraciones")|ezroot()}>{$cuantasvaloraciones} valoraciones de usuarios</a></span>
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
                                             
                                             	 <a href="/user/login"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                             
                                             {/if}       
                                            {undef $user_id}
                                            {undef $current_user}
                            </div>
                         </div>
                    </div>
                   
               			{/if} 
         	 	{*fin nuevo*}      
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
                               <li>{cond( $node.data_map.disp_librerias.content|eq( 1 ), 'Disponible en librerías')}</li>
                                {if $node.data_map.isbn.has_content}
                                <li>ISBN: {$node.data_map.isbn.content.value}</li>
                                {/if}
                                {if $node.data_map.issn.has_content}
                                <li>ISSN: {$node.data_map.issn.content}</li>
                                {/if}
                            </ul>
                            
                            <div class="dudas" style="margin-bottom:0">
                            	<h3>¿Tiene dudas?</h3>
                                <ul>
                                	{*<li class="chat"><a href="">Accede a nuestro chat</a></li>*}
                                    <li class="contacto"><a href={"contacto"|ezurl}>Otras formas de contacto</a></li>
                                </ul>

                            </div>
{*
                             <a href={concat( "basket/add/", $node.object.id, '/1')|ezurl} class="ejemplar"><img src={"btn_quieroEjemplar.gif"|ezimage} alt="Quiero un ejemplar" /></a>                                             *}
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
                       
                       <div class="descripcion" id="producttext">
                        	<div class="clear">
                        	  <span class="volver {if eq($tabscount,6)}addmargin{/if}">
                              		<a href={$node.parent.url_alias|ezurl}>
                                    	Volver al listado
                                    </a>
                              </span>
                          	  <ul class="tabs">
                 				<li {if array( 'producto_mementix', 'ventajas_producto' )|contains( $clase )}class="sel"{/if}>
                              {if array( 'producto_mementix', 'ventajas_producto' )|contains( $clase )}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'ventajas_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Ventajas{if array( 'producto_mementix', 'ventajas_producto' )|contains( $clase )}</h2>{else}</a>{/if}
                                </li>
                                <li><a href={"basket/mementix"|ezurl}>Mementos disponibles</a></li>
                               
                                <li {if $clase|eq('condiciones_producto') }class="sel"{/if}>
                                	{if $clase|eq('condiciones_producto') }<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'condiciones_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}{cond( $node.parent_node_id|eq( 1485 ),  'Contenido', 'Condiciones' )}{if $clase|eq('condiciones_producto') }</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if $node.data_map.novedades.has_content}
                                <li {if $clase|eq('novedades_producto') }class="sel"{/if}>
                                	{if $clase|eq('novedades_producto') }<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'novedades_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Novedades{if $clase|eq('novedades_producto') }</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                                {if and( $cuantasvaloraciones|gt(0), $clase|ne( 'valoraciones_producto' ) )}
                                <li {if $clase|eq( 'opiniones_clientes' )}class="sel"{/if}>
                                	{if $clase|eq( 'opiniones_clientes' )}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'opiniones_clientes' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Opinión de los clientes{if $clase|eq( 'opiniones_clientes' )}</h2>{else}</a>{/if}
                                </li>
                                {/if}
                                
                               {if and( $clase|ne( 'valoraciones_producto' ), $node.data_map.faqs_producto.has_content)}
                                <li {if $clase|eq('faqs_producto')}class="sel"{/if}>
                                	{if $clase|eq('faqs_producto')}<h2>{else}<a href="{fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                'class_filter_type', 'include',
                                                'class_filter_array', array( 'faqs_producto' )
 )).0.url_alias|ezurl(no)}#producttext">{/if}Preguntas frecuentes{if $clase|eq('faqs_producto')}</h2>{else}</a>{/if}
                                </li>                           
                                {/if}     
                            </ul>
                          
                            </div>
                            
                            <div class="cont cursoDet clearFix">
                            	{*si es testimonios no podemos pintar la columna de la derecha*}
                            	{if $clase|eq( 'opiniones_clientes' )}
                            		{*llamamos a una plantilla aparte *}
                            		{*include uri="design:common/ficha/testimonios.tpl" testimonios=$testimonios*}
                                    
                                     {include uri="design:common/ficha/testimonios.tpl" testimonios=$muestraultimas cuantas=$cuantasvaloraciones}
                            	{elseif $clase|eq( 'faqs_producto')}
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
									{if array( 'producto_mementix', 'ventajas_producto' )|contains( $clase )}
                                    <h2>Ventajas de tenerlo</h2>
                                    {$node.data_map.ventajas.content.output.output_text}
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
                                   
                                    </div>
                                    {else}
                                    	{switch match=$clase}
                                    		{case match='sumario_producto'}
                                    			{$node.data_map.sumario.content.output.output_text}
                                    		{/case}
                                    		{case match='condiciones_producto'}
                                    			{$node.data_map.contenido.content.output.output_text}
                                    		{/case}
                                    		{case match='novedades_producto'}
                                    			{$node.data_map.novedades.content.output.output_text}
                                    		{/case}
                                    	{/switch}
                                    {/if}                                    
                                </div>
                                {*inluimos el template del modulo de Ventajas*}
                                {if $clase|ne( 'valoraciones_producto' )}            
                                {include uri="design:common/ficha/modVentajas.tpl"}
                                {/if}
                                
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

				</div> {*FIN GRID*}


















{ezscript_require( array( 'jquery.fancybox-1.3.0.pack.js', 'ui.core.js', 'ui.slider.js', 'mementix.js') )}
{ezcss_require( array( 'jquery.fancybox-1.3.0.css') )}
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
            
        


