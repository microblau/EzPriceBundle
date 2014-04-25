<div id="footer">
        <div class="mediosPago">
            	<ul>
                    <li><img src={"ico_visa-big.png"|ezimage} alt="Visa" /></li>
                    <li><img src={"ico_masterCard-big.png"|ezimage} alt="MasterCard" /></li>
                    <li><a href="https://www.paypal.com/es/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside" target="_blank"><img src={"ico_paypal-big.png"|ezimage} alt="PayPal" /></a></li>
                    <li><img src={"ico_transBancaria-big.png"|ezimage} alt="Transferencia Bancaria" /></li>
                    <li><img src={"ico_pago-aplazado-big.png"|ezimage} alt="Pago Aplazado" /></li>
                    <li class="reset"><img src={"ico_domiciliacion-banc-big.png"|ezimage} alt="Domiciliación Bancaria" /></li>
        </ul>
        </div>
            <div id="wrapperSections">
            
                <div id="newsletterContacto">
                
                    <img src={"txt_contacta.gif"|ezimage} alt="Contacte con Francis Lefebvre 91 210 80 00" class="tlf" />
                    <a href="mailto:clientes@efl.es" class="contacto">clientes@efl.es</a>
                <img src={"txt_recibe.gif"|ezimage} alt="Reciba nuestro boletín con las últimas novedades" />
                <a href={"newsletter/subscribe"|ezurl} class="alta">Quiero darme de alta</a>
                </div>
                <div id="wrapSections">
                    <ul>
                        <li>
                            <strong>Catálogo</strong>
                            <ul>
                                <li><a href={"catalogo"|ezurl()}>Tipo de producto</a></li>
                                {def $children = fetch( 'content', 'list', hash( 'parent_node_id', 61,
                                                                             'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array,
                                                                              'class_filter_type', 'include',
                                                                              'class_filter_array', array( 'subhome' ),
                                                                              'attribute_filter', array( array( 'priority', '<', 100 ) )
                                                                         ))}
                                {foreach $children as $child}
                                <li><a href={$child.url_alias|ezurl()}>{$child.name}</a></li>
                                {/foreach}
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
                            </ul>
                        </li>
                        <li>
                            <strong>Por qué Lefebvre</strong>
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
                            <strong>Quiénes somos</strong>
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
                <a href={fetch( 'content', 'node', hash( 'node_id', 292) ).url_alias|ezurl}>Aviso Legal</a>
            
            </span>
        </div>
