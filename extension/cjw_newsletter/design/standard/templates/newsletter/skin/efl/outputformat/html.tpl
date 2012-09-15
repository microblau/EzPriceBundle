{set-block variable=$subject scope=root}{$contentobject.name|wash}{/set-block}
{def $inicio=concat( "http://" , ezini( 'SiteSettings' , 'SiteURL' , 'site.ini' ) )}
{def $images=concat($inicio,'/extension/cjw_newsletter/design/standard/templates/newsletter/skin/efl/outputformat/')}
{def $list_items = fetch('content', 'list', hash( 'parent_node_id', $contentobject.contentobject.main_node_id,
                                                                      'sort_by', array( 'priority' , true() ),
                                                                      'class_filter_type', 'include',
                                                                      'class_filter_array', array( 'cjw_newsletter_article' ) ) )
                    }
                    
                    
        
{def $edition_data_map = $contentobject.data_map}
{def $code=concat('?',$contentobject.data_map.codigo.content)}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>
    {if $edition_data_map.title.has_content}
    	                    {$edition_data_map.title.content|wash()}
                           
    {/if}
    </title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	
	
</head>



<body bgcolor="#efefef">


{if $info|eq('')}
	{def $info='publicaciones-formacion'}
{/if}
{if $materias|eq('')}
	{*def $materias = 'Administrativo-Contable-Fiscal-Inmobiliario-Jurídico-Mercantil-Otras-RRHH-Social'*}
{def $materias = array()}
{foreach fetch( 'content', 'list', hash( 'parent_node_id', 143,
                                         'as_object', false() )) as $node}

{set $materias = $materias|append( $node.contentobject_id )}

{/foreach}
{/if}




<table cellpadding="0" cellspacing="0" width="620" border="0" align="center" bgcolor="#ffffff">
<tr>
<td align="center" style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;color:#6D6D6D;">  Si no puede visualizar correctamente este mensaje, <a href={concat('http://www.efl.es/newsletter/preview/', $contentobject.contentobject_id,'/', $contentobject.version,'/0/site/efl',$code)|ezurl(,'full')} style="color:#00528D; font-size:12px; font-weight:bold; text-decoration: none">  pulse aquí</a>
</td>
</tr>	 
</table>    
<table cellpadding="0" cellspacing="0" width="620" border="0" align="center" bgcolor="#013e74">
			<tr><td height="20" style="font-family: Arial,Helvetica,sans-serif; line-height: 1px; font-size: 1px;" colspan="4">&nbsp;</td></tr>
            <tr>
                <td width="20" style="font-family: Arial,Helvetica,sans-serif; line-height: 1px; font-size: 1px;">&nbsp;</td>
                <td width=191>
                    <img src={concat( $images, "images/logo.png" )}  alt="Novedades Ediciones Francis Lefebvre" height="44" width="191" />
                </td>
                <td width=389 align="right">
                <table cellpadding="0" cellspacing="0" >
                   <tr align="right">
                   		 <td align="right" bgcolor="#013e74" style="font-family: Arial, Helvetica, sans-serif;font-size: 28px;color:#70B6E0;">
                        	 {$edition_data_map.texto_cabecera.content|wash()}
                    	</td>
                   </tr>
                   <tr>     
                        <td align="right" bgcolor="#013e74" style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;color:#70B6E0;">
                            PUBLICIDAD
                        </td>
                   </tr> 
                 </table>  
                </td>  
                <td width="20" style="font-family: Arial,Helvetica,sans-serif; line-height: 1px; font-size: 1px;">&nbsp;</td>  
            </tr> 
            <tr><td height="20" style="font-family: Arial,Helvetica,sans-serif; line-height: 1px; font-size: 1px;" colspan="4">&nbsp;</td></tr>   
            </table>
	<table cellpadding="0" cellspacing="0" width="620" border="0"  align="center">
    	<tr><td height="7"  bgcolor="#0092CE" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
    </table>	
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
	<tr>
		<td align="center" bgcolor="#EFEFEF">
			<table cellpadding="0" cellspacing="0" width="620">
        			<tr><td colspan="3" height="19" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        			<tr>
        				<td width="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        				<td width="584" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#6D6D6D" align="left"><span style="font-size:19px; color:#3A3A3A; letter-spacing: -1px">
                        {if $edition_data_map.title.has_content}
    	                    {$edition_data_map.title.content|wash()}
	                    {/if}
                         
                         
                        </span><br /><p>
                        {if $edition_data_map.description.has_content}
                       		 {$edition_data_map.description.content.output.output_text|wash(xml)}
                    	{/if} 
                        
                        </p></td>
        				<td width="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        			</tr>
        			<tr><td colspan="3" height="19" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        </table>
        
        <table cellpadding="0" cellspacing="0" width="620">
        			
        			<tr>
        				<td width="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        				<td width="584" valign="top" align="left">
                        
<!--hasta aqui fijo-->
{foreach $list_items as $items}

{*if $items.name|downcase()|eq('destacado')*}
{*$items.name}-{$items.data_map.tipo.data_text*}
{if $items.data_map.tipo.data_text|eq('1')}
{*solo mostramos el primero si es que hubieran añadido mas de uno en destacados*}
   
    
      
                        
<!--empieza destacado *******************************************************************************-->

    {def $dest=$items.data_map.producto.content.relation_list.0.node_id}
    {def $destacado=fetch( 'content', 'node', hash( 'node_id', $dest ) ) }  
    
    
  		<!-- cabecera destacado -->
        					<table cellpadding="0" cellspacing="0" width="584" border="0">
        						<tr>
        							<td width="13" height="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="556" height="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="13" height="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        						</tr>		
        						<tr>
        							<td colspan="3"><img src={concat( $images, "images/cabecera_destacado.gif" )} style="display:block; margin:0; padding:0;" alt="" height="23" width="584" /></td>
        						</tr>
        						<tr>
        							<td width="13" valign="top" align="left" bgcolor="#B8E8FF">
                                    <img src={concat( $images, "images/lf-destacado.gif") } style="display:block; margin:0; padding:0;" 
                                    alt="" height="34" width="13" /></td>
        							<td width="558" height="34" valign="top" align="left" background="{concat( $images,  "images/bck_destacado.gif")}" bgcolor="#B8E8FF" style="font-size:22px; color:#00477B; font-family: Arial, Helvetica, sans-serif;">
									
                                    
	                                    {$items.name}
                                    
                                    </td>
        							<td width="13" valign="top" align="left" bgcolor="#B8E8FF"><img src={concat( $images, "images/rg-destacado.gif") } style="display:block; margin:0; padding:0;"  alt="" height="34" width="13" /></td>
        						</tr>
        						<tr><td colspan="3" valign="top"><img src={concat( $images, "images/cabecera_destacado-2.gif")} style="display:block; margin:0; padding:0;"  alt="" height="29" width="584" /></td></tr>
        						
        					</table>
        					<!-- fin cabecera destacado -->
        					<!-- contenido destacado -->
        					<table cellpadding="0" cellspacing="0" width="584" border="0">
        						<tr>
        							<!--td width="9" valign="top" bgcolor="#B8E8FF"><img src={concat( $images, "images/lf-destacado-2.gif")} style="display:block; margin:0; padding:0;"  alt="" height="26" width="9" /></td-->
                                    <td width="1" valign="top" bgcolor="#e6e6e4" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                    <td width="1" valign="top" bgcolor="#e7f8ff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                    <td width="6" valign="top" bgcolor="#B8E8FF" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                   
                                  	<td width="1" valign="top" bgcolor="#d4f2ff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
        							<td width="17" bgcolor="#ffffff" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>

                                    <td width="211" valign="top" bgcolor="#ffffff">
        							
        								<table cellpadding="0" cellspacing="0" width="100%">
        									<tr><td>
                                            
                                            

                                            
                                            
                                             {if $destacado.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $destacado.data_map.imagen.content.relation_browse.0.contentobject_id ))}   
                                             {def $ruta=$imagen.data_map.image.content.fichaproducto.url}  
                                               <img src="{concat($inicio,'/', $ruta)}" height="151" width="171"  />   
                                            {/if}
                                            </td></tr>
        									<tr><td height="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									
        								</table>
        							
        							
        						
        							
        							</td>
        							<td width="341" valign="top" bgcolor="#ffffff" style="font-size:14px; color:#434343; font-family: Arial, Helvetica, sans-serif;">
        								<table cellpadding="0" cellspacing="0" width="100%" border="0" >
                                        
                                        
                                        <tr>
                                        		<td style="font-family: Arial,Helvetica,sans-serif; font-size: 17px; color:#00477B; font-weight: bold;" colspan="2"><a style="color: #00477B; text-decoration: none;" href="{$inicio}{concat($destacado.url_alias,$code)|ezurl(no)}">{$destacado.name}</a></td>
                                            </tr>
                                            <tr>
                                            	<td colspan="2" height="10" valign="top" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                            </tr>
        					
                                        
                                        {def $texto=$destacado.data_map.entradilla.content.output.output_text}
                                        <tr><td>
                                    {$texto}
                                        </td></tr>
                                        <tr><td align="center"><a href="{$inicio}{concat($destacado.url_alias,$code)|ezurl(no)}">
                                            <img src={concat( $images, "images/btn_masinfo.gif")} alt="" height="75" width="163" border="0" /></a></td></tr>
                                                								
        								</table>
        							</td>
        							
        							
        							
                                    <td width="1" valign="top" bgcolor="#e1f6ff" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
                                    <td width="5" valign="top" bgcolor="#B8E8FF" style="font-family:Arial, Helvetica, sans-serif; font-size:1px; line-height:1px;">&nbsp;</td>
        						</tr>
        					</table>	
        					<!-- fin contenido destacado -->
        					
        					<!-- pie destacado -->
        						<table cellpadding="0" cellspacing="0" width="584" border="0">
        							<tr><td><img src="{concat( $images , 'images/pie_destacado.gif' ) }" alt="" height="31" width="584" /></td></tr>
        							<tr><td height="12" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        						</table>	
        					<!-- fin pie destacado -->
        				
<!--fin destacado entero*************************************************************************************-->		
        			
 {else}                   
      {if and($items.data_map.tipo.data_text|eq('2'),$info|contains('formacion') )}
      	  {def $hayc=0}		
          {def $cursos=$items.data_map.producto.content.relation_list}
                 {def $materias_cursos=array()}
                 
                    {foreach $cursos as $cur}
                        {def $prod=$cur.node_id}
                        {def $curso=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
                           {foreach $curso.data_map.areas_interes.content.relation_list as $pieza}
                                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                           {set $materias_cursos=$materias_cursos|append($nome.object.id)}
                                        {/let}	
                           {/foreach}
					
                        
					{/foreach}               
                {foreach $materias_cursos as $mat}
                	{if $materias|contains($mat)}
                		{set $hayc=1}
                	{/if}
                {/foreach}
        
        <!--cuantos cursos hay que se vayan a mostrar-->
        
        {def $cursos=$items.data_map.producto.content.relation_list}
                    {def $totalelementos=0}
                    {foreach $cursos as $cur}
						{def $prod=$cur.node_id}
                        {def $curso=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
                            {foreach $curso.data_map.areas_interes.content.relation_list as $pieza}
                                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                           {if $materias|contains($nome.data_map.nombre.data_text)}
                                           		{set $totalelementos=$totalelementos|sum(1)}
                                                {break}
                                           {/if}
                                        {/let}	
                           {/foreach}
                         {/foreach}               
               
        <!--cuantos cursos hay que se vayan a mostrar-->              
                
   {if $hayc|eq(1)}<!--si hay al menos un curso de formacion de la materia de interes-->
   	<!-- titulo obras en formacion -->	
   <table cellpadding="0" cellspacing="0" border="0">
        							<tr>
        								<td width="17" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        								<td><img src="{concat( $images , 'images/lf-titulo.gif' ) }" style="display:block; margin:0; padding:0;"  height="31" width="21" alt="" /></td>
        								<td bgcolor="#A2E9FF" style="font-family: Arial, Helvetica, sans-serif; font-size:19px; color:#00477B" valign="middle">                                        		{$items.name}
		                                
                                        </td>
        								<td><img src="{concat( $images , 'images/rg-titulo.gif' ) }" style="display:block; margin:0; padding:0;"  height="31" width="21" alt="" /></td>
        							</tr>
        							
        						        						
        						</table>
        				
        					
        					<!-- fin titulo obras en formacion -->		
        					
        					<!-- contenido #formacion -->
        					<table cellpadding="0" cellspacing="0" border="0">
        						<tr><td><img src="{concat( $images , 'images/sup_bloque.gif' ) }" style="display:block; margin:0; padding:0;"  height="25" width="592" alt="" /></td></tr>
        					</table>	
        					<table cellpadding="0" cellspacing="0" border="0" width="592">
        						<tr>
        							<td width="3" bgcolor="#B8E8FF" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="7" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#ffffff">&nbsp;</td>
        							<td width="572" valign="top" align="left" bgcolor="#ffffff">        	
        					
        								<!-- cuerpo -->
   {/if}<!--fin si hay al menos un curso de #formacion de la materia de interes-->                                     
<!-- para cada curso encontrado -->

 {def $elementos=$items.data_map.producto.content.relation_list}
 {def $orden=0}
 {foreach $elementos as $k=>$elem}
	
	{def $prod=$elem.node_id}
    {def $node=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
    {def $materias_curso=array()}
    {def $mostrarc = 0}
   
<!--areas-->

						{foreach $node.data_map.areas_interes.content.relation_list as $pieza}
                                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                            {set $materias_curso = $materias_curso|append($nome.object.id)}   
                                        {/let}	
                           {/foreach}

						{foreach $materias_curso as $mapro}
                            {if $materias|contains($mapro)}
                                {set $mostrarc = 1}
                               
                            {/if}
                         {/foreach}


<!--areas-->   

   {if $mostrarc|eq('1')}<!--si tiene que mostrarse el curso-->                     	
 {set $orden=$orden|sum(1)}

        									<table cellpadding="0" cellspacing="0" border="0" width="572">
        										<tr>
        									<!--imagen--><td width="121" valign="middle">
    {if and(ge(currentdate(),$node.data_map.fecha_inicio_oferta.value.timestamp|int),le(currentdate(),$node.data_map.fecha_fin_oferta.value.timestamp|int))}
           <img class="novedad" src="{concat( $images , 'images/img_oferta.png' ) }" alt="oferta" />
        {/if}
        
        {if $node.data_map.imagen.has_content}
            {def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}              
            {def $ruta=$imagen.data_map.image.content.listadoproductos.url}    
			<img src="{concat($inicio,'/', $ruta)}" height="110" width="119" />                          
                
            {undef $imagen}
        {else}
        
            <img src={concat($inicio,'/',$node.parent.data_map.area.content.data_map.birrete.content.listadoproductos.url)} alt="" class="producto"/>    
        {/if}
                                            
                                            
                                             </td><!--fin imagen-->   
                                                    <td width="317" bgcolor="#ffffff" valign="top">
        											
        												<table cellpadding="0" cellspacing="0" border="0">
        													<tr>
        														<td style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#00477B; font-weight:bold">
                                                        <!--titulo--> 
                                                               <a href={$inicio}{concat($node.url_alias,$code)|ezurl(no)}" style="color:#00477B; text-decoration: none">
                                                        	      {$node.name}
                                                                </a>
                                                        <!--fin titulo-->
                                                        
                                                            <br />
                                  						</td>
                                                      	     
        													</tr>
                                                           
                                                         <!--subtitulo-->   	               
        													{if $node.data_map.subtitulo.has_content}
                                                            <tr>
        														<td valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#535548;">
                                                               
                                                                	<p> {$node.data_map.subtitulo.content.output.output_text|strip_tags()}</p>
                                            				<!--ponentes-->
                                                                        {if $node.data_map.ponentes.has_content}
                                                                        
                                                                      <p>
                                                                            <strong>Ponente:</strong>
                                                                            {foreach $node.data_map.ponentes.content.relation_browse as $index => $ponente}
                                                                               {let $pon = fetch('content','node',hash('node_id',$ponente.node_id))}
                                                                                   {$pon.data_map.nombre.content}.
                                                                               {/let}
                                                                           {/foreach}
                                                                       </p> 
                                                                        {/if}
                                                            <!--ponentes-->            
                                                            <!--fechas-->            
                                                                        {if $node.data_map.fecha_inicio.has_content}
                                                                       <p>
                                                                            <strong>Fecha:</strong> 
                                                                                {attribute_view_gui attribute=$node.data_map.fecha_inicio}
                                                                                {if and( $node.data_map.fecha_de_fin.has_content, $node.data_map.fecha_de_fin.content.timestamp|ne( $node.data_map.fecha_inicio.content.timestamp ) ) }
                                                                                - {attribute_view_gui attribute=$node.data_map.fecha_de_fin}
                                                                                {/if} 
                                                                        </p>
                                                                        {/if}
                                                            <!--fechas-->            
                                                            <!--lugar-->                        
                                                                        {if $node.data_map.lugar.has_content}
                                                                       <p>
                                                                            <strong>Impartido en:</strong>
                                                                                 {$node.data_map.lugar.content.output.output_text}
                                                                       </p>
                                                                        {/if}
                                                            <!--lugar-->     


                                                                </td>
        													</tr>
                                                            {/if}
											          <!--subtitulo-->        
        												</table>
        											
        											
        											</td>
        											<td width="134">
        											
        												<table cellpadding="0" cellspacing="0" border="0" width="114">
        													<tr>
        									<td style="border: 2px solid #FAA636; font-family: Arial, Helvetica, sans-serif; font-size:14px; padding: 5px 0" align="center">
                                             <span style="color:#00674E">  
   								 
                                  {if $node.data_map.precio.content.has_discount}<s>{/if}
                                 <strong> {$node.data_map.precio.content.price|l10n(clean_currency)} € + IVA</strong>
                                  {if $node.data_map.precio.content.has_discount}</s>
                                  </span>{/if}
								  {if $node.data_map.precio.content.has_discount}
                                  <br />
                                  <span style="color:#990000">
                                  <strong>	{$node.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}  € </strong>+ IVA</span>
                                   {/if}
                                   </td>
                                 </tr>
        													<tr><td height="22" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        													
        												</table>
        											
        												<a href="{$inicio}{concat($node.url_alias,$code)|ezurl(no)}"><img src="{concat( $images , "images/btn_masinfo2.gif" ) }" height="26" width="117" alt="" border="0" /></a>
        											</td>
        										</tr>

											<tr><td colspan="3" height="20" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
       									
         {if $orden|ne($totalelementos)}                                       
         <tr><td colspan="3" height="2" align="center"><img src="{concat( $images , 'images/sep.gif' ) }" height="2" width="538" alt="" /></td></tr>
        									
        										<tr><td colspan="3" height="20" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr> {/if}	

<!-- fin para cada curso encontrado -->  
     										
</table>
     					
   {/if}<!--fin si tiene que mostrarse el curso-->                     	
{/foreach}	    										
        <!--cierre de la caja de #formacion-->										
        									

        	{if $hayc|eq(1)}<!--si hay al menos un curso de #formacion de la materia de interes-->						
        							
        							</td>
        							<td width="7" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#ffffff">&nbsp;</td>
                                    
        							<td width="3" bgcolor="#B8E8FF" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>	
                                   
        						</tr>
        					</table>	
        			
                    		<table cellpadding="0" cellspacing="0" border="0">	
        						<tr><td colspan="3"><img src="{concat( $images , 'images/inf_bloque.gif' ) }" height="25" width="592" alt="" /></td></tr>
        					</table>
   
   <!--fin cierre de la caja de #formacion-->
                        <br/>
                            
              {/if}<!--fin si hay al menos un curso de #formacion de la materia de interes-->              
                                  
                
                
       {else}
      
        <!--else de si no es #formacion ni destacado-->
             <!--si hay al menos un producto de esta categoria que se tiene que mostrar-->
                    {def $elementos=$items.data_map.producto.content.relation_list}
                    {def $orden=0}
                    {def $hayuno = 0}
                     {foreach $elementos as $k=>$elem}
                        {def $prod=$elem.node_id}
                        {def $producto=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
                        {def $materias_producto=array()}
                    	  {foreach $producto.data_map.area.content.relation_list as $pieza}
                                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                           {set $materias_producto = $materias_producto|append($nome.object.id)}      
                                        {/let}	
                           {/foreach}
                      
                       {foreach $materias_producto as $mapro}
                        {if $materias|contains($mapro)}
                            {set $hayuno=1}
                        {/if}
                       {/foreach}
                       {/foreach}
                       <!--SE MUESTRA:{$mostrar}-->

 <!--cuantos productos hay que se vayan a mostrar-->
        
        {def $productos=$items.data_map.producto.content.relation_list}
                    {def $totalelementos=0}
                    {foreach $productos as $pro}
						{def $prod=$pro.node_id}
                        {def $producto=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
                           {foreach $producto.data_map.area.content.relation_list as $pieza}
                                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                            {if $materias|contains($nome.object.id)}
                                           		{set $totalelementos=$totalelementos|sum(1)}
                                                {break}
                                           {/if}
                                        {/let}	
                           {/foreach}
                        
					{/foreach}               
             
        <!--cuantos productos hay que se vayan a mostrar--> 







             <!--si hay al menos un producto de esta categoria que se tiene que mostrar-->                                    
                    		<!-- titulo obras en oferta si al menos hay uno-->
                           
        		{if and($hayuno|eq(1),$info|contains('publicaciones'))}			
        						<table cellpadding="0" cellspacing="0" border="0">
        							<tr>
        								<td width="17" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        								<td><img src="{concat( $images , 'images/lf-titulo.gif' ) }" style="display:block; margin:0; padding:0;"  height="31" width="21" alt="" /></td>
        								<td bgcolor="#A2E9FF" style="font-family: Arial, Helvetica, sans-serif; font-size:19px; color:#00477B" valign="middle">                                        
                                        {if $items.data_map.short_description.data_text.has_content}
	                                   		 {$items.data_map.short_description.data_text}
                                   		 {else}
                                    	 	{$items.name}
                                   		 {/if}                                     
                                       
                                        </td>
        								<td><img src="{concat( $images , 'images/rg-titulo.gif' ) }" style="display:block; margin:0; padding:0;"  height="31" width="21" alt="" /></td>
        							</tr>
        							
        						        						
        						</table>
        				
        					
        					<!-- fin titulo obras en oferta -->		
        					
        					<!-- contenido obras en oferta -->
        					<table cellpadding="0" cellspacing="0" border="0">
        						<tr><td><img src="{concat( $images , 'images/sup_bloque.gif' ) }" style="display:block; margin:0; padding:0;"  height="25" width="592" alt="" /></td></tr>
        					</table>	
        					<table cellpadding="0" cellspacing="0" border="0" width="592">
        						<tr>
        							<td width="3" bgcolor="#B8E8FF" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="7" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#ffffff">&nbsp;</td>
        							<td width="572" valign="top" align="left" bgcolor="#ffffff">        	
        					{/if}	<!--fin si al menos hay uno y qiere publicaciones-->		
        								<!-- cuerpo -->
                                        
<!-- para cada producto encontrado -->

 {def $elementos=$items.data_map.producto.content.relation_list}
 {foreach $elementos as $k=>$elem}
	
	{def $prod=$elem.node_id}
    {def $producto=fetch( 'content', 'node', hash( 'node_id', $prod ) ) }
<!--trazas areas-->
  {def $materias_producto=array()}
  {foreach $producto.data_map.area.content.relation_list as $pieza}
      
                        {let nome=fetch('content','node',hash('node_id',$pieza.node_id))}
                                 {*$nome.data_map.nombre.data_text*}
                               
                          {set $materias_producto = $materias_producto|append($nome.object.id)}      
                        {/let}	
 
  {/foreach}
  {*$materias_producto|attribute(show)*}
  {def $mostrar = 0}
   {foreach $materias_producto as $mapro}
   	{if $materias|contains($mapro)}
   		{set $mostrar = 1}
    {/if}
   {/foreach}
   <!--SE MUESTRA:{$mostrar}-->
   
   
  
<!--trazas areas-->
	{if and($mostrar|eq(1),$info|contains('publicaciones'))}
    {set $orden=$orden|sum(1)}


        									<table cellpadding="0" cellspacing="0" border="0" width="572">
        										<tr>
												
        									<!--imagen--><td width="121" valign="middle">
                                            {if $producto.data_map.imagen.has_content}
                                   			{def $imagen = fetch( 'content', 'object', hash( 'object_id', $producto.data_map.imagen.content.relation_browse.0.contentobject_id ))}   
                                                 {def $ruta=$imagen.data_map.image.content.listadoproductos.url}    
                                                 <img src="{concat($inicio,'/', $ruta)}" height="110" width="119" />   
											{else}
                                            {def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084))}
												<img src={$imagen.data_map.image.content.listadoproductos.url|ezroot()} width="{$imagen.data_map.image.content.listadoproductos.width}" height="{$imagen.data_map.image.content.listadoproductos.height}" class="producto" />
											{/if}      
                                             </td><!--fin imagen-->   
                                                    <td width="317" bgcolor="#ffffff" valign="top">
        											
        												<table cellpadding="0" cellspacing="0" border="0">
        													<tr>
        														<td style="font-family: Arial, Helvetica, sans-serif; font-size:17px; color:#00477B; font-weight:bold">
                                                        <!--titulo-->        <a href="{$inicio}{concat($producto.url_alias,$code)|ezurl(no)}" style="color:#00477B; text-decoration: none">
                                                              {$producto.name}
                                                                </a>
                                                        <!--fin titulo-->
                                                            <br />
{*															
<!--empiezan estrellas-->  
                                                
{def $value = sum( $producto.data_map.calidad_rate.content.rounded_average, $producto.data_map.actualizaciones_rate.content.rounded_average, $producto.data_map.facilidad_rate.content.rounded_average )|div( 3) }

{def $total=round($value|div(0.5))|mul(0.5)}
{def $llenas=floor($total)}
{def $vacias=floor(5|sub($total))}
{def $aus1=5|sub($total)}
{def $aus=$aus1|sub(floor(5|sub($total)))}
{if $aus|eq(0.5)}
	{def $medias= $aus|div(0.5)}
{/if}
{if $llenas|ne(0)}
    {for 1 to $llenas}
         <img src="{concat( $images , "images/estrella-llena.gif" ) }" height="17" width="17" alt="" />                                            
    {/for}
{/if}
{if $aus|eq(0.5)}
    {for 1 to $medias}
         <img src="{concat( $images , "images/estrella-media.gif" ) }" height="17" width="17" alt="" />                                            
    {/for}
{/if}    
{if $vacias|ne(0)}
    {for 1 to $vacias}
         <img src="{concat( $images , "images/estrella-vacia.gif" ) }" height="17" width="17" alt="" />                                            
    {/for}
{/if}
                                                         
                                                         <!--fin estrellas-->
 *}                                                        
                                                            
        														</td>
        													</tr>
        													<tr>
        														<td valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#535548;">
                                                                <!--descripcion-->
                                                                	<p>{$producto.data_map.subtitulo.content}</p>
                                            							{$producto.data_map.entradilla.content.output.output_text} 

                                                                <!--fin descripcion-->
                                                                </td>
        													</tr>
        												</table>
        											
        											
        											</td>
        											<td width="134">
        											
        												<table cellpadding="0" cellspacing="0" border="0" width="114">
        													<tr>
        									<td style="border: 2px solid #FAA636; font-family: Arial, Helvetica, sans-serif; font-size:14px; padding: 5px 0" align="center">
                                             <span style="color:#00674E">  
   								  {if $producto.class_identifier|eq('producto_mementix')}Desde {/if}
                                  {if $producto.data_map.precio.content.has_discount}<s>{/if}
                                 <strong> {$producto.data_map.precio.content.price|l10n(clean_currency)} € + IVA</strong>
                                  {if $producto.data_map.precio.content.has_discount}</s>
                                  </span>{/if}
								  {if $producto.data_map.precio.content.has_discount}
                                  <br />
                                  <span style="color:#990000">
                                  <strong>	{$producto.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}  € </strong>+ IVA</span>
                                   {/if}
                                   </td>
                                 </tr>
        													<tr><td height="22" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        													
        												</table>
        											
        												<a href="{$inicio}{concat($producto.url_alias,$code)|ezurl(no)}"><img src="{concat( $images , "images/btn_masinfo2.gif" ) }" height="26" width="117" alt="" border="0" /></a>
        											</td>
        										</tr>

											<tr><td colspan="3" height="20" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        										
         {if $orden |ne($totalelementos)}                                       
         <tr><td colspan="3" height="2" align="center"><img src="{concat( $images , 'images/sep.gif' ) }" height="2" width="538" alt="" /></td></tr>
        									
        										<tr><td colspan="3" height="20" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr> {/if}	

<!-- fin para cada producto encontrado -->  
     										
</table>
     	 {/if}<!--si mostrar-->	 								
    {/foreach}	    										
        										
        									
{if and($hayuno|eq(1),$info|contains('publicaciones'))}	<!--fin del bloque si hay al menos uno-->
        								<!-- fin cuerpo -->
        							
        							
        							</td>
        							<td width="7" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#ffffff">&nbsp;</td>
                                    
        							<td width="3" bgcolor="#B8E8FF" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>	
                                   
        						</tr>
        					</table>	
        			
                    		<table cellpadding="0" cellspacing="0" border="0">	
        						<tr><td colspan="3"><img src="{concat( $images , 'images/inf_bloque.gif' ) }" height="25" width="592" alt="" /></td></tr>
        					</table>
        			
        					<!-- fin contenido obras en oferta -->
       				
        					<br />
   {/if}<!--fin del bloque si hay al menos uno-->			
        	{/if}<!--else de si no es formacion ni destacado-->		
     {/if}

{/foreach}    					
        					<!-- cabecera pie newsletter -->
        					
        					<table cellpadding="0" cellspacing="0" width="588" border="0">
        						<tr><td colspan="5"><img src="{concat( $images , 'images/sup-pie.gif' ) }" style="display:block; margin:0; padding:0;"  alt="" height="15" width="588" /></td></tr>
        						<tr>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        							<td width="150" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#F7F7F7">&nbsp;</td>
        							<td width="336" style="font-family: Arial, Helvetica, sans-serif;" valign="top" align="left" bgcolor="#F7F7F7">
        								<table cellpadding="0" cellspacing="0" border="0" width="100%">
        									<tr>
        										<td width="41" height="46" rowspan="2" valign="top"><img src="{concat( $images , 'images/telefono.gif' ) }" height="46" width="41" alt="" /></td>
        										<td width="265" height="10" colspan="2" style="color:#333333; font-size:11px; font-weight:bold;">Contacte con Francis Lefbvre</td>
        									</tr>
        									<tr>
        										<td width="101" height="12" style="color:#333333; font-size:16px; font-weight:bold;">91 210 80 00</td>
        										<td width="164" height="12"><a href="mailto:clientes@efl.es" style="color:#00528D; font-size:11px; font-weight:bold; text-decoration: none">clientes@efl.es</a></td>
        									</tr>
        								</table>
        								
        							</td>
                                    <td width="100" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#F7F7F7">&nbsp;</td>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        						</tr>
                                
                                <tr>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
                                </tr>
                               <tr>
	        						<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        							<td colspan="3" height="8" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#F7F7F7">&nbsp;</td>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        						</tr>	
        						<tr><td colspan="5" height="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td></tr>	
        					</table>
        					
        					
        					<!-- fin cabecera pie newsletter -->
        					
        					<!-- pie newsletter -->
        					<table cellpadding="0" cellspacing="0" width="588" border="0">
	        					<tr>
        							<td width="1" height="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        							<td width="12" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="137" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="154" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="128" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="155" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        						</tr>
        						<tr>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        							<td width="12" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        							<td width="137" valign="top" align="left">
        								<table cellpadding="0" cellspacing="0" border="0" width="100%">
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 1px; color:#666666; font-size:11px; font-weight:bold">Catálogo</td></tr>
                                            <tr><td width="1" height="5" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-size:10px; font-weight:bold">
                                            <a href={concat("catalogo",$code)|ezurl()} style="color:#666666; text-decoration:none">Todas las obras</a></td></tr>

                                            {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array,
                                                                              'class_filter_type', 'include',
                                                                              'class_filter_array', array( 'subhome' ),
                                                                              'attribute_filter', array( array( 'priority', '<', 100 ) )
                                                                         ))}
                                {foreach $children as $child}
                                <tr><td width="1" height="5" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-size:10px; font-weight:bold">
                                            <a href="{$child.url_alias|ezurl(no)}{$code}" style="color:#666666; text-decoration:none">{$child.name}</a></td></tr>
                                
                                {/foreach}	
        									
        									
        								</table>
        							</td>
        							<td width="154" valign="top" align="left">
        								<table cellpadding="0" cellspacing="0" border="0" width="100%">
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 1px; color:#666666; font-size:11px; font-weight:bold">Formación</td></tr>	

                                            {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 62,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 62 )).sort_array,
                                                                              'attribute_filter', array( array( 'priority', '<', 100 ) )
                                                                         ))}
                                             {foreach $children as $child}
        									<tr><td width="1" height="5" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-size:10px; font-weight:bold">
                                            <a href="{$inicio}{concat( $child.url_alias,$code)|ezurl_formacion(no)} style="color:#666666; text-decoration:none">{$child.name}</a></td></tr>
                                            {/foreach}
        									
        									
        								
        								</table>
        							</td>
        							<td width="128" valign="top" align="left">
        								<table cellpadding="0" cellspacing="0" border="0" width="100%">
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 1px; color:#666666; font-size:11px; font-weight:bold">Por qué Lefebvre</td></tr>	
                                            {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 63,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 63 )).sort_array
                                                                         ))}

				{foreach $children as $child}
        									<tr><td width="1" height="5" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-size:10px; font-weight:bold">
                                            <a href={concat($child.url_alias,$code)|ezurl} style="color:#666666; text-decoration:none">{$child.name}</a></td></tr>
        									{/foreach}
        									
        								
        								</table>
        							</td>
        							<td width="155" valign="top" align="left">
        								<table cellpadding="0" cellspacing="0" border="0" width="100%">
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 1px; color:#666666; font-size:11px; font-weight:bold">Quiénes somos</td></tr>	
        									
                                            {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 88,
							                     'sort_by', fetch( 'content', 'node', hash( 'node_id', 88 )).sort_array
									 ))}
                                            {foreach $children as $child}
                                          <tr><td width="1" height="5" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        									<tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-size:10px; font-weight:bold">
                                            <a href={concat($child.url_alias,$code)|ezurl()} style="color:#666666; text-decoration:none">{$child.name}</a></td></tr>
                                            {/foreach}
        									
        								
        								</table>
        							</td>
        							<td width="1" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px" bgcolor="#D3D3D3">&nbsp;</td>
        						</tr>
        						<tr><td colspan="7"><img src="{concat( $images , 'images/inf-pie.gif' ) }" style="display:block; margin:0; padding:0;"   height="9" width="588" alt="" /></td></tr>
        					</table>
        					
        					
        					<!-- fin pie newsletter -->
        				
        				</td>
        				<td width="18" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td>
        			</tr>
        			<tr><td colspan="3" height="19" style="font-family: Arial, Helvetica, sans-serif; line-height: 1px; font-size: 1px">&nbsp;</td></tr>
        </table>
		
		
		</td>
	 </tr>	
	 
	</table> 
	<table cellpadding="0" cellspacing="0" width="620" border="0" align="center" bgcolor="#ffffff">
<tr>
<td align="center" style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;color:#6D6D6D;"> Usted recibe esta comunicación como suscriptor del boletín electrónico de Ediciones Francis Lefebvre, al que se ha suscrito voluntariamente, si desea darse de baja  <a href="http://www.efl.es{concat('/newsletter/unsubscribe/', $hash)|ezurl('no')}" style="color:#00528D; font-size:11px; font-weight:bold; text-decoration: none">pulse aquí</a>
</td>
</tr>	
<tr>
    <td><img width="0" height="0" alt="" src="http://www.efl.es/x.gif?hash={$hash}&id={$cont}" /></td>
</tr> 
</table>  
    
    
    
</body>
</html>
