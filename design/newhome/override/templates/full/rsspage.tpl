{literal}<script type="text/javascript">
	function abre(caja){		
			if (document.getElementById(caja).style.display == 'none') 
			{
				document.getElementById(caja).style.display = 'block';
			}else{
				document.getElementById(caja).style.display = 'none';				
			}
		
		}


</script>
{/literal}
	
    
    		<div id="gridWide">
								
				<h1>Suscríbase a nuestros contenidos vía RSS </h1>
			
				<div class="wrap clearFix">
                
                	<div class="columnType1">
				
                
                
                        <div class="inner rss">
                    
                            <div class="wysiwyg">
                        
<div class="entry">
                
<h2>¿Qué significa RSS?</h2>
<br  />
<p>
RSS, Really Simple Syndication (Sindicación realmente simple) es un formato que permite el <b>acceso a contenidos</b> mediante unas herramientas expresamente desarrolladas para este fin. 
</p>
<br  />
<p>
Con RSS, Usted podrá:
</p>
<div class="ventajas">
<ul>
<li class="vent"> <b>Enterarse de cualquier actualización</b> de nuestros contenidos directamente en su <b>escritorio, programa de correo o servicio vía Web</b>.</li>
<li class="vent"> Como ejemplo del contenido de RSS tenemos las fuentes de información de los titulares de las noticias que se actualizan con frecuencia.</li>
<li class="vent"> <b>Podrá agregar</b> todo el contenido de varios orígenes en una sola ubicación.</li>
</ul>
</div>

<br  />

<h2>¿Cómo puedo usarlo?</h2>
<br  />
<p>Para poder hacer uso del formato RSS:
</p>
 <div class="ventajas">
<ul>
 <li> <b>Acceda </b> al contenido que desea agregar. </li>
 <li> <b>Seleccione</b> el programa  de escritorio, correo o servicio vía Web que desee.</li>
 <li> <b>Agregue</b> el contenido que le permitirá estar informado continuamente de las últimas novedades.</li>
</ul>
<br  />
</div>
                                <ul>
                                    <li class="reset">

                                        <h2><a href={"catalogo"|ezurl}>Catálogo</a>
                                          <!--a href={'feeds/catalogo'|ezurl()}>
                                                	<img src={"ico_rss.gif"|ezimage} alt="rss" />
                                                </a-->
                                          </h2>
                                        <ul>
                                            <li>
                                                <h3><a href={"catalogo"|ezurl}>Tipo de producto</a>
                                              
                                                </h3>
                                                <ul>
                                                	{def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                													'class_filter_type', 'include', 
                                                													'class_filter_array', array( 'folder'),
                                                													'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array
                                                					
                                                	 ))}
                                                	{def $contador=0}
                                                    {def $id=''}
                                                     {foreach $folders as $folder}
                                                    	{set $contador = $contador|sum(1)}
                                                        {set $id=concat('tipo', $contador)}
                                                    
                                                    <li>
                                                    <a href='javascript:;'{*$folder.url_alias|ezurl()*} onclick="javascript:abre('{$id}');">{$folder.name}</a>
                                                   {def $url= concat( 'feeds/' , $folder.url_alias )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}

                                                 <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}> 
                                                 <ul>
                                                 	 <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>
                                                  </div>
                                                    </li>
                                                    
                                                    {undef $url}
                                                    {undef $google_url}
                                                    {undef $bloglines_url}
                                                    {undef $yahoo_url}
                                                    {undef $windows_url}
                                                    {undef $netvibes_url}
                                                   
                                                    
                                                    {/foreach}
                                                    {undef $folders}                                                    
                                                </ul>

                                            </li>
                                            
                                            <li>
                                            	<h3>Por Área</h3>
                                                <ul>{def $areas = fetch( 'content', 'list', hash( 'parent_node_id', 143, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 143 )).sort_array
                                                                                  
                                     				))}
                                                    {def $contador=0}
                                                    {def $id=''}
				                                    {foreach $areas as $area}
                                                        {set $contador = $contador|sum(1)}
                                                        {set $id=concat('area', $contador)}
				                                        <li>
                                                        
                                              <!--a href={concat( "catalogo/area/", $area.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$area.name}</a-->
                                              <a href='javascript:;' onclick="javascript:abre('{$id}');">{$area.name}</a>
                                                   {def $url= concat( "feeds/catalogo/area/", $area.name|normalize_path()|explode('_')|implode('-') )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}    
                                              
                                               <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}>         
                                                  <ul>
                                                     <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>
                                                 </div> 
                                                        </li>
				                                    {/foreach}
				                                    {undef $areas}       
				                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>Por formato</h3>
                                                <ul>
                                                	{def $formatos = fetch( 'content', 'list', hash( 'parent_node_id', 156, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 156 )).sort_array
                                                                                  
                                     				))}
                                                    
                                                    {def $contador=0}
                                                    {def $id=''}
				                                    {foreach $formatos as $formato}
				                                        {set $contador = $contador|sum(1)}
                                                        {set $id=concat('formato', $contador)}
				                                   
                                                        <li>
                                                        <!--a href={concat( "catalogo/formato/", $formato.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$formato.name}</a-->
                                                        <a href='javascript:;' onclick="javascript:abre('{$id}');" >{$formato.name}</a>
                                                      
                                                      
                                                      {def $url= concat( "feeds/catalogo/formato/", $formato.name|normalize_path()|explode('_')|implode('-') )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}    
                                                  <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}>      
                                                  <ul>
	                                                 <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>
                                                 </div>
                                                      </li>
				                                    {/foreach}
				                                    {undef $formatos}   
                                                </ul>
                                            </li>
                                            
                                            <li>
                                            	<h3>Por sector profesional</h3>
                                                <ul>

                                                	{def $sectores = fetch( 'content', 'list', hash( 'parent_node_id', 157, 'sort_by', fetch( 'content', 'node', hash( 'node_id', 157 )).sort_array
                                                                                  
                                     				))}
                                                    {def $contador=0}
                                                    {def $id=''}
				                                   
				                                    {foreach $sectores as $sector}
				                                        {set $contador = $contador|sum(1)}
                                                        {set $id=concat('sector', $contador)}
				                                   
                                                        <li>
                                                        
                                                        <!--a href={concat( "catalogo/sector/", $sector.name|normalize_path()|explode('_')|implode('-') )|ezurl()}>{$sector.name}</a-->											
                                                        <a href='javascript:;' onclick="javascript:abre('{$id}');" >{$sector.name}</a>
                                                     
                                                     
                                                     
                                                     
                                                   {def $url= concat( "feeds/catalogo/sector/", $sector.name|normalize_path()|explode('_')|implode('-') )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}    
                                                   <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}>           
                                                  <ul>
                                                     <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>   
                                                     </div>
                                                     </li>
				                                    {/foreach}
				                                    {undef $sectores}   
                                                </ul>

                                            </li>
                                            
                                            <li>
                                            	<h3>Novedades</h3>
                                            	{def $els = ezini( 'Submenu_423', 'Items', 'submenusproductos.ini')}
                                                <ul>
                                                
                                                {def $contador=0}
                                                    {def $id=''}
				                                   
				                                   
				                                   {foreach $els as $el}
                                                        {set $contador = $contador|sum(1)}
                                                        {set $id=concat('novedades', $contador)}
                                                	
                                                	<li>
                                                    
                                                    <!--a href={ezini(concat( 'Submenu_423_', $el ), 'URL', 'submenusproductos.ini')|ezurl}>{ezini(concat( 'Submenu_423_', $el ), 'Literal', 'submenusproductos.ini')}</a-->
                                               <a href='javascript:;' onclick="javascript:abre('{$id}');">{ezini(concat( 'Submenu_423_', $el ), 'Literal', 'submenusproductos.ini')}</a>    
                                                   
                                                       
                                                   {def $url= concat('feeds/' ,ezini(concat( 'Submenu_423_', $el ), 'URL', 'submenusproductos.ini')    )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}    
                                                  <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}>                
                                                  <ul>
                                                     <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>  
                                                     </div> 
                                              
                                                    </li>
                                                	{/foreach}
                                                </ul>
                                                {undef $els}
                                            </li>
                                            
                                            <li>
                                            	<h3>Ofertas</h3>
                                                <ul>
                                                	{def $els = ezini( 'Submenu_426', 'Items', 'submenusproductos.ini')}
	                                                <ul>
                                                    {def $contador=0}
                                                    {def $id=''}
				                                   
	                                                	{foreach $els as $el}
	                                                    {set $contador = $contador|sum(1)}
                                                        {set $id=concat('ofertas', $contador)}
                                                	
                                                    	<li><!--a href={ezini(concat( 'Submenu_426_', $el ), 'URL', 'submenusproductos.ini')|ezurl}>{ezini(concat( 'Submenu_426_', $el ), 'Literal', 'submenusproductos.ini')}</a-->
                                                        
                                                        <a href='javascript:;' onclick="javascript:abre('{$id}');" >{ezini(concat( 'Submenu_426_', $el ), 'Literal', 'submenusproductos.ini')}</a>
                                                        
                                                        
                                                        
                                                        
                                                         {def $url=concat( 'feeds/', ezini(concat( 'Submenu_426_', $el ), 'URL', 'submenusproductos.ini') )|ezurl('no','full')}
                                                   {def $google_url=concat('http://fusion.google.com/add?feedurl=' , $url  )}
                                                   {def $bloglines_url=concat('http://www.bloglines.com/sub/' , $url  )}
                                                   {def $yahoo_url=concat('http://add.my.yahoo.com/rss?url=' , $url  )}
                                                   {def $windows_url=concat('http://www.live.com/?add=' , $url  )}
                                                   {def $netvibes_url=concat('http://www.netvibes.com/subscribe.php?url=' , $url  )}    
                                                   <div style="border:solid 1px #004A7F;display:none;" id={$id} name={$id}>                     
                                                  <ul>
                                                     <li class="cerrar">  <a href='javascript:;' onclick="javascript:abre('{$id}');">X</a></li>
                                                     <li>  <a href={$google_url}><img src={"rss/igoogle.gif"|ezimage} alt="iGoogle" />iGoogle</a></li>
                                                     <li>  <a href={$bloglines_url}><img src={"rss/bloglines.gif"|ezimage} alt="Bloglines" />Bloglines</a></li>
                                                     <li>  <a href={$yahoo_url}><img src={"rss/miyahoo.gif"|ezimage} alt="Mi Yahoo" />Mi Yahoo</a></li>
                                                     <li>  <a href={$windows_url}><img src={"rss/windowslive.gif"|ezimage} alt="Windows Live" />Windows Live</a></li>
                                                     <li>  <a href={$netvibes_url}><img src={"rss/netvibes.gif"|ezimage} alt="Netvibes" />Netvibes</a></li>
                                                     <li>  <a href={$url}><img src={"rss/ico_rss.gif"|ezimage} alt="rss" />Enlace directo</a> </li>                                                 </ul>   
                                                     </div>
                                                        
                                                  
                                                        </li>
	                                                	{/foreach}
	                                                </ul>
                                                	{undef $els}
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                    
                                   </ul>
                                                                                 
                        
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
				</div>
			
			
			</div>
		
				
			
		
			
		
		
