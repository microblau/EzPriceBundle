 <div id="navBar">
            <ul>
                <li class="first"><a href={"/"|ezurl_www()}>Inicio</a></li>
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 2 ) ) }class="sel"{/if}><a href={"catalogo"|ezurl_www()}>Catálogo</a>
                    <ul>
                        <li><a href={"catalogo"|ezurl_www()}>Tipo de producto</a></li>
                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 61, 
																		'class_filter_type', 'include',
																		'class_filter_array', array( 'subhome' ),
																		'sort_by', fetch( 'content', 'node', hash( 'node_id', 61 )).sort_array,																		
															))
						}
						{foreach $folders as $index => $folder }
						<li {if eq( $index, $folders|count|sub(1))}class="reset"{/if}><a href={$folder.url_alias|ezurl_www()}>{$folder.name}</a></li>
						{/foreach}
						{undef $folders}
                    </ul>                               
                </li>
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 3 ) ) }class="sel"{/if}><a href="{""|ezurl(no)}">Formación</a>
                    <ul>
                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', 62, 
                                                                        'class_filter_type', 'include',
                                                                        'class_filter_array', array( 'folder' ),
                                                                        'attribute_filter', array('and',array('priority','<','1000')),
                                                                        'sort_by', fetch( 'content', 'node', hash( 'node_id', 62 )).sort_array,                                                                     
                                                            ))
                        }
                        {foreach $folders as $index => $folder }
                        <li {if eq( $index, $folders|count|sub(1))}class="reset"{/if}>
                        {if eq($index, $folders|count|sub(1))}
                        <a href="{concat($folder.url_alias,"/valores")|ezurl(no)}">
                        {else}
                        <a href="{$folder.url_alias|ezurl(no)}">
                        {/if}
                        {$folder.name}
                        </a>
                        </li>
                        {/foreach}
                        {undef $folders}
                    </ul>                               
                </li>
                
                <li {if and( is_set( ezpagedata().persistent_variable.menuoption ),  ezpagedata().persistent_variable.menuoption|eq( 4 ) ) }class="sel"{/if}><a href={"por-que-lefebvre/valores"|ezurl_www(no)}>Por qué Lefebvre</a></li>
                <li class="buscador"><a href={"formacion-presencial/por-fechas"|ezurl}>Buscador</a></li>
            </ul>
        </div>
