{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSM-SAGESettings',  'Destacados', 'rpsm.ini' ) ))}        

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
    
<div id="gridWide" class="tituloRSS">
	<h1>Suscríbase a nuestros contenidos vía RSS </h1>
</div>

<div id="rss">
	<div id="gridType2">
		<div class="wrap clearFix">
			<div class="columnType1">
				<div class="wrapColumn">
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

							<ul>
								<li class="reset">

									<h2><a href={"catalogo"|ezurl}>Temáticas</a></h2>
										<ul>
											{def $folders = fetch( 'content', 'list', hash( 'parent_node_id', ezini( 'RPSMSettings',  'RSS', 'rpsm.ini' ),
																							'class_filter_type', 'include', 
																							'class_filter_array', array( 'folder'),
																							'sort_by', fetch( 'content', 'node', hash( 'node_id', ezini( 'RPSMSettings',  'RSS', 'rpsm.ini' ) )).sort_array
															
											 ))}
											{def $contador=0}
											{def $id=''}
											 {foreach $folders as $folder}
												{set $contador = $contador|sum(1)}
												{set $id=concat('tipo', $contador)}
											
											<li>
											<a href='javascript:;'{*$folder.url_alias|ezurl()*} onclick="javascript:abre('{$id}');">{$folder.data_map.description.content.output.output_text}</a>
										   {def $url= concat( 'rss/feed/' , $folder.name )|ezurl('no','full')}
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
								
							</ul>
									
					</div>	
				</div>
				<img src={"sage_curve_infWrapColumn_926.gif"|ezimage}>				
			</div>
		</div>
	</div>
</div>