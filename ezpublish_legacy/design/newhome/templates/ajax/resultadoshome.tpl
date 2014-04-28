						<h3>{cond( is_set( $title ), $title, 'Hemos encontrado para usted...')}</h3>
				<div class="carrousel jcarousel tops">
                            	
                                <ul class="carrousel" id="itemscarrousel">
				

				{foreach $products as $index => $node}
                                    <li {if eq( $index, $products|count|sub(1) )}class="reset"{/if}>
                                    	{if $node.data_map.precio.content.has_discount}
                                    		<img src={"img_oferta.png"|ezimage()} alt="Oferta" class="oferta" /> 
                                    	{/if}
                                        {if $node.data_map.imagen.has_content}                                        
                                       
                                        <div class="multim">
                                             {def $image = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
                                       	<img src="{$image.data_map.image.content.block_resultados.url|ezroot(no)}" alt="" class="producto" />
                                       	{undef $image}
                                        </div>
                                        
                                        {else}
                                            <div class="multim">
                                            {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
                                            <img src={$image.data_map.image.content.block_resultados.url|ezroot} alt="" class="producto" />
                                            {undef $image}
                                            </div>
                                        {/if}
                                        <a href={$node.url_alias}><span>{$node.name}</span></a>
                                        <span class="comments">
                                        {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $node.node_id ))}                                {if $cuantasvaloracionestotales|gt(0)}
                                         <span>     <a href={concat($node.url_alias, '/(ver)/valoraciones')|url()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} comentario{else} comentarios{/if}</a></span>
								{/if}                        
                                {undef $cuantasvaloracionestotales}
                                                                     
                                      	{if $node.object.contentclass_id|eq(98)}
                                        <a href={'basket/mementix'|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                        {elseif or( $node.object.contentclass_id|eq(101),  $node.object.contentclass_id|eq(99) )}
                                        <a href={$node.url_alias|ezurl} class="boton"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>

                                        {else}
                                        <a href={concat( 'basket/ajaxadd/', $node.object.id, '/1')|ezurl} class="boton loQuiero"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                                        {/if}</span>
                                        
                                        
                                        

                                   </li>
                                   {/foreach}
                                </ul>
                         	</div>
                        <a class="jcarousel-control-prev" href="#">anterior</a>
                        <a class="jcarousel-control-next" href="#">Next</a>
                        {if is_set( $n )}
                         <div class="consulta">
                            	<ul>
                                	<li><a href={"catalogo/formato/digital"|ezurl}>Conozca nuestras soluciones online</a></li>
                                    <li class="reset frt">{if $n|gt(0)}<span>Y otros {$n} más, {/if}</span><span class="verMas"><a href={concat("buscador/productos/", $filters|implode('/') )|ezurl}>Consúltalos ahora</a></span></li>

                                </ul>
                            </div>
                         {/if}
