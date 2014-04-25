<div id="modSusc">
						<a href={fetch( 'content', 'node', hash( 'node_id', 1457 )).url_alias|ezurl} class="tit">Suscríbase a nuestro boletín y recibirá gratis un ebook</a>
						<div class="inner">
							<form action={"newsletter/subscribe"|ezurl} method="post">
								<label for="sem">Su email* <input type="text" class="text" id="sem" name="email" /></label>
								<label for="seb">Seleccione ebook <select id="seb" name="seb">
<option value=""></option>
{foreach $block.valid_nodes as $node}
<option value="{$node.object.id}">{$node.name}</option>
{/foreach}</select></label>
								<span class="submit"><input type="image" src={"btn_enviar.png"|ezimage} alt="enviar" /></span>
							
							</form>
							<div class="fix">&nbsp;</div>
						</div>
					
					
					</div>
