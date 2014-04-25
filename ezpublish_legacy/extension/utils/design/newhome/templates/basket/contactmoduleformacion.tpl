						<h2>¿Tiene alguna duda?</h2>

						<span class="contacte">Contacte <br />con nosotros</span>
						<ul>
							<li class="telefono">{ezini( 'RightLinksFormacion', 'Telefono', 'basket.ini')}</li>
							{def $links = ezini( 'RightLinksFormacion', 'Links', 'basket.ini')}
							{foreach $links as $link}
                            {if ezini( concat( 'RightLinksFormacion_', $link ), 'Link', 'basket.ini')|contains('@')}
                             <li class="{$link}"><a href="mailto:{ezini( concat( 'RightLinksFormacion_', $link ), 'Link', 'basket.ini')}">{ezini( concat( 'RightLinks_', $link ), 'Literal', 'basket.ini')}</a></li>
                            {else}
							<li class="{$link}"><a href={ezini( concat( 'RightLinksFormacion_', $link ), 'Link', 'basket.ini')|ezurl}>{ezini( concat( 'RightLinks_', $link ), 'Literal', 'basket.ini')}</a></li>
                            {/if}
							{/foreach}
							
						</ul>
