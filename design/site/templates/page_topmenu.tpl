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
                
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 4 ) ) }class="sel"{/if}><a href={"por-que-lefebvre/valores"|ezurl}>Por qué Lefebvre</a></li>
                
              <li class="rss"><a href="/rss-feed" title="Suscripción RSS" ><img src={"rss/rss.png"|ezimage} alt="Suscripción RSS"/></a></li>
                
                <li class="buscador">               
				{include uri='design:ngsuggest/searchform.tpl' form_id="buscadorSimple" search_id="termino" search_default_value=""}     
                    <span class="link"><a href={"content/advancedsearch"|ezurl}>Buscador avanzado</a></span>
              

                </li>
            </ul>
        </div>
