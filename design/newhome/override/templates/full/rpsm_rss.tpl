{def $node = fetch( 'content', 'object', hash( 'object_id', ezini( 'RPSMSettings',  'Destacados', 'rpsm.ini' ) ))}        
{def $user = fetch( 'user', 'current_user')}
{if $user.is_logged_in|not}

	<div id="gridTwoColumns" class="clearFix">
		<div class="columnType1">
			<div id="modAbonados">
				
					<h1>Recursos Portal Soluciones Memento</h1>
					<div class="wrap clearFix">
				
							<div class="description">
								<div class="wysiwyg">
									<h2>Le ayudamos a sacar el máximo partido a su Producto Electrónico, proporcionándole…</h2>
									<br>
									<ul>
										<li><strong>Formación.</strong><ul><li>Acceda a <b>videos demostrativos</b> para <b>dominar</b> su producto.</li><li>Participe en <b>sesiones formativas gratuitas.</b></li><li>Consulte <b>documentación con casos prácticos.</b></li></ul></li>
										<li><strong>Asistencia.</strong> <b>Solucione</b> todas sus dudas con nuestra <b>asistencia On line.</b></li>
										<li><strong>Experiencia.</strong><ul><li><b>Comparta su opinión</b> sobre nuestros productos.</li><li>Lea los <b>casos de éxito</b> de clientes que, como Usted, utilizan el Portal Soluciones Memento.</li></ul></li>
										<li><strong>Noticias.</strong> Reciba todas las <b>novedades relacionadas con su producto</b> a través de e-mail y RSS.</li>
									</ul>
								</div>
							</div>							                        											
					</div>
				
			</div>
		</div>
		<div class="sideBar">
			<div id="modAccesoAbonados">

				<h2>Acceso usuarios</h2>
				<div class="wrap clearFix">
					<form action={"colectivos/login"|ezurl} method="post">
						<ul>
							<li>
								<label for="usuario">Usuario</label>
								<input type="text" class="text" id="usuario" name="Login" />
							</li>

							<li>
								<label for="pass">Contraseña</label>
								<input type="password" class="text" id="pass" name="Password" />
								<span><a href={"basket/forgotpassword"|ezurl}>¿Olvidó su contraseña?</a></span>
							</li>
							<li>
								<span class="submit"><input type="image" src={"btn_entrar.gif"|ezimage} alt="entrar" name="LoginButton" /></span>
							</li>
						</ul>
						
						<input type="hidden" name="RedirectURI" value="RecursosPSM" />
						
					</form>
															
				</div>
			</div>
			<br>
			<div align="center">
				<a href={"formularios/pruebe-nuestros-productos-electronicos-15-dias-sin-compromiso"|ezurl} target="_blank"><img src={"banner_prueba_gratuita_rpsm.jpg"|ezimage} alt="" /></a>
			</div>
		</div>
	</div>

{else}

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
				
			</div>
			
		</div>

	</div>
{/if}