{ezscript_require(array( 'jquery.fancybox-1.3.0.pack.js', 'jQuery.tubeplayer.min.js' ) )}  
{ezcss_require( 'jquery.fancybox-1.3.0.css')}
<script type="text/javascript">

{literal}
(function( $ )
{
    $(document).ready( function()
    {
$(".btnOpinion").fancybox({
			'width':624, 
			'height':438,
			'padding':0,
			'type':'iframe'
	});
    })
})(jQuery);
{/literal}
</script>
					<h2>{$block.name}</h2>
					<div class="wrap clearFix">
					
						<div class="columnType1">
							<div class="curveSup wrapAjaxContent clearFix">
								
								
							<ul class="car">
							    {foreach $block.valid_nodes as $node}
								<li class="item">
								 {def $img = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}
								<div class="description clearFix">

									<div class="imgModuloDest">
                                       {if $node.data_map.url_youtube.has_content}
{def $aux=$node.data_map.url_youtube.content|explode('v=')}
                                            	<div class="youtube-player" id="{$aux.1}"></div>
{undef $aux}
                                       {elseif $node.data_map.video.has_content}

        	{def $video = fetch( 'content', 'object', hash( 'object_id', $node.data_map.video.content.relation_browse.0.contentobject_id ))}   
{$video.data_map.video.content|attribute(show)}

                                             {attribute_view_gui attribute=$video.data_map.video width=633 height=304 autostart=0}
                                        {else}
										<img src={$img.data_map.image.content.promoprimariaconrelacionado.url|ezroot} width="{$img.data_map.image.content.original.width}" height="{$img.data_map.image.content.original.height}" alt="" />
                                       {/if}
										<div class="txt {if $node.data_map.producto_relacionado.has_content|not}no-related{/if}">
                                            {if $node.data_map.producto_relacionado.has_content}
											<h3><a href={$node.data_map.producto_relacionado.content.main_node.url_alias|ezurl}>{$node.name}</a></h3>
                                            {else}
                                                <h3><a href="{$node.data_map.enlace.content}">{$node.name}</a></h3>
                                            {/if}
                                            
											<p>{$node.data_map.subtitulo.content}</p>
										</div>
									</div>
										
								
									

								</div>
								{if $node.data_map.producto_relacionado.has_content}
								<div class="clearFix info">
								
								
									<div class="flt">
									
										<span class="pvp precio">Precio: <span>{$node.data_map.producto_relacionado.content.data_map.precio.content.price|l10n(clean_currency)} €</span> + IVA</span>
            {if $node.data_map.producto_relacionado.content.data_map.precio.content.has_discount}
										<span class="pvp oferta">Oferta: <span>{$node.data_map.producto_relacionado.content.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)} €</span> + IVA</span>
{/if}
									
									</div>
								
										<div class="clearFix frt">
    									
											
											<div class="flt">
                                                    

 {def $current_user=fetch( 'user', 'current_user' )}  

{def $user_id=$current_user.contentobject_id}
                                           {def $havotado=fetch('producto','havotado' , hash( 'node_id', $node.data_map.producto_relacionado.content.main_node_id, 'usuario',$user_id ))} 

											{if $current_user.is_logged_in}

                                                   {if $havotado|gt(0)}
                                                      <a href="/producto/opinion?n=already"  class="btnOpinion" ><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                   {else}
                                                    <a href="{concat('/producto/opinion?n=', $node.data_map.producto_relacionado.content.main_node_id)}" class="btnOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                    
                                                    {/if}
                                             {else}
												
                                             	 <a href="/producto/login/(opinion)/{$node.data_map.producto_relacionado.content.main_node_id}"  class="btnOpinion"><img src={"btn_opine.png"|ezimage()} alt="Opine sobre esta obra" /></a>
                                                 
                                             
                                             {/if}     

                                                

											
											</div>
											
											<div class="frt">
                                                {if $node.data_map.producto_relacionado.content.class_identifier|eq('producto' )}
												<a href={concat( "basket/add/", $node.data_map.producto_relacionado.content.id, '/1')|ezurl}><img src={"btn_quieroEjemplar2.gif"|ezimage} alt="" /></a>{else}<a href={$node.data_map.producto_relacionado.content.main_node.url_alias|ezurl}><img src={"btn_quieroEjemplar2.gif"|ezimage} alt="" /></a>{/if}
											</div>
										
										
											
										</div>
										
								</div>		
								{/if}
								</li>
                                {/foreach}
								
							</ul>		
								
							</div>
						</div>
						
					
					</div>

