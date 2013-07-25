<div id="footer">
		  {def $textos_footer = fetch( 'content', 'list', hash( 'parent_node_id', 142,
                                                                'class_filter_type', 'include',
                                                                'class_filter_array', array( 'textos_pie' ) )).0.data_map}

			<div class="clearFix">
		
				<div class="mediosPago">
				
					<div class="inner clearFix">
						<div class="c1">
							<h2>Seguridad en sus compras</h2>
							<div class="wysiwyg">
								{$textos_footer.pago_seguro.content.output.output_text}													
							</div>
						</div>
						<div class="c2">
							<h2>Sistemas de pagos admitidos</h2>
							<div class="wysiywg">
								{$textos_footer.sistemas_pago.content.output.output_text}						
							</div>
							<ul class="logos">
								<li><img src={"ico_visa-big.png"|ezimage} alt="Visa" /></li>
								<li><img src={"ico_masterCard-big.png"|ezimage} alt="MasterCard" /></li>
								<li><img src={"ico_paypal-big.png"|ezimage} alt="PayPal" /></li>
							</ul>
							<ul class="logos">
								<li><img src={"ico_transBancaria-big.png"|ezimage} alt="Transferencia Bancaria" /></li>
                   				<li><img src={"ico_pago-aplazado-big.png"|ezimage} alt="Pago Aplazado" /></li>
			                    <li><img src={"ico_domiciliacion-banc-big.png"|ezimage} alt="Domiciliación Bancaria" /></li>
							</ul>
						
						</div>
						<div class="c3">
							<h2>Envíos y devoluciones</h2>
							<div class="wysiwyg">
								{$textos_footer.envios.content.output.output_text}		
							</div>
							<ul>
								<li><span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 1073)).url_alias|ezurl}>Contacta con nosotros</a></span></li>
								<li><span class="verMas"><a href={fetch( 'content', 'node', hash( 'node_id', 80)).url_alias|ezurl}>Preguntas frecuentes</a></span></li>
							</ul>
						</div>
					
					</div>
				
		            	
		        </div>
		        
{cache-block expiry=900}		        
	<div class="modTwitter">
		        
		        
		        	<div class="inner">
		        	
		        		<span class="cab"><img src={"txt_twitter.png"|ezimage} alt="síguenos en twitter" /></span>
		        		{*def $tweets = fetch( 'efltwitter', 'get_tweets', hash( 'limit', 2 ))*}
                      
                        {foreach $tweets as $tweet}
		        		<div class="twtr-tweet-wrap">                 
		        			<div class="twtr-tweet-text">           
		        				<p>@<a class="twtr-user" href="http://twitter.com/intent/user?screen_name=EdicionesFL" target="_blank">EdicionesFL</a> {$tweet.text|parsetext()}           <em>            <a href="http://twitter.com/EdicionesFL/status/{$tweet.id_str}"><abbr class="timeago" title="{$tweet.created_at|strtotime()|datetime( 'custom', '%Y-%m-%dT%H:%i:%s+01:00' )}">{$tweet.created_at|parsetime}</abbr></a> ·            <a href="http://twitter.com/intent/tweet?in_reply_to={$tweet.id}" class="twtr-reply" target="_blank">responder</a> · <a href="http://twitter.com/intent/retweet?tweet_id=={$tweet.id}" class="twtr-rt" target="_blank">retweet</a> ·  <a href="http://twitter.com/intent/favorite?tweet_id=={$tweet.id}" class="twtr-fav" target="_blank">favorito</a> </em></p> 
		        		   </div> 
		        		 </div>
                       {/foreach}  		   
		      
		        	</div>
		        
		        
		        </div>
{/cache-block}
	        
	        </div>
		
			<div id="wrapperSections">
			    {if and( is_set( $module_result.node_id ), $module_result.node_id|eq(2))}
				<div id="newsletterContacto">
				
					<div>
						<img src={"txt_contacta.gif"|ezimage} alt="Contacta con Francis Lefebvre 91 210 80 00" class="tlf" />
						<a href="mailto:clientes@efl.es" class="contacto">clientes@efl.es</a>
					</div>
				
				</div>
                {else}
                <div id="newsletterContacto">
                 <img src={"txt_contacta.gif"|ezimage} alt="Contacte con Francis Lefebvre 91 210 80 00" class="tlf" />
                    <a href="mailto:clientes@efl.es" class="contacto">clientes@efl.es</a>
                <img src={"txt_recibe.gif"|ezimage} alt="Reciba nuestro boletín con las últimas novedades" />
                <a href={"newsletter/subscribe"|ezurl} class="alta">Quiero darme de alta</a>
                </div>
                {/if}
				<div id="wrapSections">
					 <ul>
                        <li>
                            <strong>Catálogo</strong>
                            <ul>
                                <li><a href={"catalogo"|ezurl()}>Tipo de producto</a></li>
                                {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array,
                                                                              'class_filter_type', 'include',
                                                                              'class_filter_array', array( 'subhome' )
                                                                             
                                                                         ))}
                                {foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl()}>{$child.name}</a></li>
                                {/foreach}
								{undef $children}
                            </ul>
                        </li>
                        <li>
                            <strong>Formación</strong>
                            {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 62,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 62 )).sort_array,
                                                                              'attribute_filter', array( array( 'priority', '<', 100 ) )
                                                                         ))}
                            <ul>
                                {foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl_formacion()}>{$child.name}</a></li>
                                {/foreach}
								{undef $children}
                            </ul>
                        </li>
                        <li>
                            <strong>{fetch( 'content', 'node', hash( 'node_id', 63 )).name}</strong>
			    {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 63,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 63 )).sort_array
                                                                         ))}
<ul>
				{foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl}>{$child.name}</a></li>
                                {/foreach}

                            </ul>
			    {undef $children}
                        </li>
                        <li>
                            <strong>{fetch( 'content', 'node', hash( 'node_id', 88 )).name}</strong>
			    {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 88,
							                     'sort_by', fetch( 'content', 'node', hash( 'node_id', 88 )).sort_array
									 ))}
                            <ul>{foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl}>{$child.name}</a></li>
				{/foreach}
                            </ul>
			    {undef $children}
                        </li>
                        <li>
                            <ul>
                                <li><a href={"acceso-abonados"|ezurl}>Abonados</a></li>
                                <li><a href={"colectivos"|ezurl}>Colectivos</a></li>
                                {*<li><a href={"agentes"|ezurl}>Agentes</a></li>*}
                            </ul>
                        </li>
                        <li><a href={fetch('content', 'node', hash( 'node_id', 1457)).url_alias|ezurl()}>Newsletter</a></li>
                        <li class="reset"><a href={"contacto"|ezurl}>Contacto</a></li>
                    </ul>
				
				</div>
			
			</div>
		
			<span id="wrapperCopy">
		
				<a href={"mapaweb"|ezurl}>Mapa Web</a>
                <span>Todos los derechos reservados</span>
                <a href={fetch( 'content', 'node', hash( 'node_id', 292) ).url_alias|ezurl}>Aviso Legal y Política de Privacidad</a>
			
			</span>
		</div>

