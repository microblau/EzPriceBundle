						<h2>¿Tiene alguna duda?</h2>

						<span class="contacte">Contacte <br />con nosotros</span>
						<ul>
							<li class="telefono">{ezini( 'RightLinks', 'Telefono', 'basket.ini')}</li>
							{def $links = ezini( 'RightLinks', 'Links', 'basket.ini')}
							{foreach $links as $link}
							<li class="{$link}"><a href={ezini( concat( 'RightLinks_', $link ), 'Link', 'basket.ini')|ezurl}>{ezini( concat( 'RightLinks_', $link ), 'Literal', 'basket.ini')}</a></li>
							{/foreach}
							
						</ul>