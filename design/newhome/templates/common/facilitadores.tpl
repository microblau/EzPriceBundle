<div class="info">
                        <div class="inner">
                            <ul>

                                <li class="imprimir"><a href="">Imprimir</a></li>
                                <li class="compartelo"><a class="bmarks-btn" href="#bmarks-10">Compártelo</a>
                                <div id="bmarks-10" class="bmarks">
	                                <div class="inner">
	                                    <ul class="clear">
	                                        {def $links = ezini( 'ShareIt', 'AvailableSites', 'shareit.ini')}
	                                        {def $array_search = array( '<urlalias>', '<title>' )}
	                                        {def $array_replace = array( concat( 'http://', ezsys( 'hostname' ), $node.url_alias|ezurl( 'no') ), $node.name )}
	                                        {foreach $links as $link}
	                                            {def $url = ''}
	                                            {set $url = concat( $url, ezini($link, 'URL', 'shareit.ini'), '?')}                                                     
	                                            {foreach ezini( $link, 'Params', 'shareit.ini') as $index => $param}
	                                                {set $url = concat( $url, $index, '=', shareit_replace( $array_search, $array_replace, $param ), '&' )}                                                                                                                     
	                                            {/foreach}
	                                            <li><a href="{$url}" title="{ezini($link, 'Name', 'shareit.ini')}"><img src={ezini($link, 'Icon', 'shareit.ini')|ezimage()} alt="{ezini($link, 'Name', 'shareit.ini')}" />{ezini($link, 'Name', 'shareit.ini')}</a></li>
	                                            {undef $url}
	                                        {/foreach}
	                                        {undef $links $array_search $array_replace}                                                 
	                                    </ul>                                               
	                                </div>
                                </div>              
                                </li>
                            </ul>
                        </div>
                    </div>