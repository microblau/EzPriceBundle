{* Load JavaScript dependencys + JavaScriptList *}
{ezscript_load( array( ezini( 'JavaScriptSettings', 'JavaScriptList', 'design.ini' ), ezini( 'JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini' ) )|prepend( 'ezjsc::jquery', 'ezjsc::jqueryio' ) )}
        <div id="navBar">
            <ul>
                <li class="first"><a href={"/"|ezurl}>Inicio</a></li>
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 2 ) ) }class="sel"{/if}><a href={"catalogo"|ezurl}>Catálogo</a>
                    <ul>
                        <li><a href={"catalogo"|ezurl}>Tipo de producto</a></li>
                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61, 
																		'class_filter_type', 'include',
																		'class_filter_array', array( 'subhome' ),
																		'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array,																		
															))
						}
						{foreach $folders as $index => $folder }
						<li {if eq( $index, $folders|count|sub(1))}class="reset"{/if}><a href={$folder.url_alias|ezurl()}>{$folder.name}</a></li>
						{/foreach}
						{undef $folders}
                    </ul>                               
                </li>
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 3 ) ) }class="sel"{/if}><a href={""|ezurl_formacion()}>Formación</a>
                    <ul>
                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 62, 
                                                                        'class_filter_type', 'include',
                                                                        'class_filter_array', array( 'folder' ),
                                                                        'attribute_filter', array('and',array('priority','<','1000')),
                                                                        'sort_by', fetch( 'content', 'node', hash( 'node_id', 62 )).sort_array,                                                                     
                                                            ))
                        }
                        {foreach $folders as $index => $folder }
                        <li {if eq( $index, $folders|count|sub(1))}class="reset"{/if}><a href={$folder.url_alias|ezurl_formacion()}>{$folder.name}</a></li>
                        {/foreach}
                        {undef $folders}
                    </ul>                               
                </li>
                
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 4 ) ) }class="sel"{/if}><a href={"colectivos"|ezurl}>Colectivos</a></li>
                     {def $links = fetch( 'content', 'list', hash( 'parent_node_id', 13044, 
                                                                        'class_filter_type', 'include',
                                                                        'class_filter_array', array( 'link_to_blog' ),
                                                                        
                                                                        'sort_by', fetch( 'content', 'node', hash( 'node_id', 13044 )).sort_array,                                                                     
                                                            ))
                        }
               	<li><a href="http://blog.efl.es">Blog{if $links|count|gt(0)}s{/if}</a>
                {if $links|count|gt(0)}
                <ul>
                    {foreach $links as $index => $link}
                    <li {if eq( $index, $links|count|sub(1))}class="reset"{/if}>
                        <a href="{$link.data_map.url.content}" {if $link.data_map.open_in_new_window.content|eq(1)}target="_blank"{/if}>{$link.name}</a>
                    </li>
                    {/foreach}
                </ul>
                {/if}
               
                </li> 
              {*<li class="rss"><a href="/rss-feed" title="Suscripción RSS" ><img src={"rss/rss.png"|ezimage} alt="Suscripción RSS"/></a></li>*}                
            </ul>
            {def $n_productos = fetch( shop, basket ).items|count}
            <span class="cesta full"><span id="infocesta">Tiene <a href={"basket/basket"|ezurl}>{$n_productos} producto{if ne( $n_productos, 1)}s{/if}</a> en la cesta</span></span>
            {undef $n_productos}           
			<div id="abonado">
				<div class="ab">
					<div class="ar">
						<span><a href={"acceso-abonados"|ezurl}>Acceso abonados</a></span>
					</div>	
				</div>
			</div>
        </div>
