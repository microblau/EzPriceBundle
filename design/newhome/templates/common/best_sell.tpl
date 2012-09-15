										
										{if or( eq( $mode, 'vendido' ), eq( $mode, ''))}
										{def $list = fetch( 'basket', 'best_sell_list', hash(
																				'top_parent_node_id', $parentnode,
																				'limit', 3,
																				'attribute_filter', cond( is_set( $attribute_filter ), $attribute_filter, null ),
																				'extended_attribute_filter', cond( is_set( $extended_attribute_filter ), $extended_attribute_filter, null ),
                                                                        'end_time', currentdate(),
                                                                        'duration', 90|mul(86400), 
																				
										 ) ) }
                                         {if $list|count|eq(0)}
                                            {def $list = fetch( 'basket', 'best_sell_list', hash(
																				'top_parent_node_id', 61,
																				'limit', 3,
																				'attribute_filter', cond( is_set( $attribute_filter ), $attribute_filter, null ),
																				'extended_attribute_filter', cond( is_set( $extended_attribute_filter ), $extended_attribute_filter, null ), 
                                                                 'end_time', currentdate(),
                                                                  'duration', 90|mul(86400),  
																				
										 ) ) }
                                         {/if}
										 {if $list|count}
										<ul>											
											{foreach $list as $index => $item}
											<li {if eq($index, $list|count|sub(1) )}class="reset {if $item.data_map.imagen.has_content|not}sinImage{/if}"{/if}>							            {if $item.contentclass_id|eq(100)}
                                                {if $item.main_node.parent.data_map.imagen.has_content}                                        
		                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $item.main_node.parent.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
                                                {else}
                                                {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
		                                        {/if}
                                                {elseif array( 49, 66, 61, 94 )|contains(  $item.contentclass_id )}
                                         
                                                <img src={$item.main_node.parent.data_map.area.content.data_map.birrete.content.block_bestsell.url|ezroot} alt="" />
                                                {else}
												{if $item.data_map.imagen.has_content}                                        
		                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $item.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
                                                {else}
                                                {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
		                                        {/if}
                                                {/if}
												<div>
													<h3>
                                                        {if $item.contentclass_id|eq(100)}
                                                            <a href={$item.main_node.parent.url_alias|ezurl}>{$item.name}</a>
                                                        {else}
                                                        <a href={$item.main_node.url_alias|ezurl}>{$item.name}</a>
                                                        {/if}</h3>
                                                    {*if array( 66, 61, 49, 94, 64)|contains($item.contentclass_id)|not}
													{def $value = sum( $item.data_map.calidad_rate.content.rounded_average, $item.data_map.actualizaciones_rate.content.rounded_average, $item.data_map.facilidad_rate.content.rounded_average )|div( 3) }
                                               		<ul id="vote_ezsr_rating_{$item.id}" class="ezsr-star-rating list">
												   		<li id="vote_ezsr_rating_percent_{$item.id}" class="ezsr-current-rating" style="width:{$value|div(5)|mul(100)}%;">{'Currently %current_rating out of 5 Stars.'|i18n('extension/ezstarrating/datatype', '', hash( '%current_rating', concat('<span>', $rating.rounded_average|wash, '</span>') ))}</li>
												   		{for 1 to 5 as $num}
												       		<li><a href="JavaScript:void(0);" id="vote_ezsr_{$item.id}_{$num}" title="{$num} sobre 5" class="ezsr-stars-{$num}" rel="nofollow" onfocus="this.blur();">{$num}</a></li>
												   		{/for}
													</ul>
													{run-once}
														{ezcss_require( 'star_rating.css' )}
													{/run-once}
                                                    {/if*}
								
                                {def $cuantasvaloracionestotales = fetch('producto','cuantasvaloraciones' , hash( 'node_id', $item.main_node_id ))}
                                {if $cuantasvaloracionestotales|gt(0)}
                                              <a href={concat( $item.main_node.url_alias, '/(ver)/valoraciones')|ezroot()}>{$cuantasvaloracionestotales} {if $cuantasvaloracionestotales|eq(1)} valoración{else} valoraciones{/if} de usuario</a>
								{/if}
                                {undef $cuantasvaloracionestotales}
												</div>
												<span>{$item.data_map.precio.content.price|l10n(clean_currency)} €</span>
											</li>	
											{/foreach}											
																			
										</ul>
										{undef $list}
										{/if}
										{else}
										
										{def $list = fetch( 'stats', 'view_top_list', hash(
																				'class_id', 48,
																				'limit', 3,
																				'attribute_filter', cond( is_set( $attribute_filter ), $attribute_filter, false() ),
																				'extended_attribute_filter', cond( is_set( $extended_attribute_filter ), $extended_attribute_filter, false() )
																				
										 ) ) }		
										 <ul>
											{foreach $list as $index=>$item}
											<li {if eq($index, $list|count|sub(1) )}class="reset"{/if}>										
												{if $item.contentclass_id|eq(100)}
                                                {if $item.main_node.parent.data_map.imagen.has_content}                                        
		                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $item.main_node.parent.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
                                                {else}
                                                {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
		                                        {/if}
                                                {else}
												{if $item.data_map.imagen.has_content}                                        
		                                        {def $image = fetch( 'content', 'object', hash( 'object_id', $item.data_map.imagen.content.relation_browse.0.contentobject_id ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
                                                {else}
                                                {def $image = fetch( 'content', 'object', hash( 'object_id', 2084 ) )}
		                                       	<img src={$image.data_map.image.content.block_bestsell.url|ezroot} alt="" />
		                                        {undef $image}
		                                        {/if}
                                                {/if}

												<div>
													<h3>{if $item.contentclass_id|eq(100)}
                                                            <a href={$item.parent.url_alias|ezurl}>{$item.name}</a>
                                                        {else}

                                                        <a href={$item.url_alias|ezurl}>{$item.name}</a>
                                                        {/if}</h3>
                                                
												</div>
												<span>{$item.data_map.precio.content.price|l10n(clean_currency)} €</span>
											</li>	
											{/foreach}											
																			
										</ul>				
										{undef $list}				
										{/if}
