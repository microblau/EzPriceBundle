{def $cursos = fetch( 'content', 'tree', hash( 'parent_node_id', 2,
																		   'main_node_only', true(),
																		   'extended_attribute_filter', hash(
																			   			'id', 'relatedTraining',
																			   			'params', hash( 'items', $object_ids ) 
																		   ),
																		   'limit', 5																		   
							))}
							{if $cursos|count}
							<div class="columnType2 frt">	
														
								<div class="wrapColumn">											
									<div id="modTab" class="inner">									
																			 
										<h2 class="title"><span>Cursos que le interesan</span></h2>
										
										<ul>
											{foreach $cursos as $index => $item }											
											<li {if eq($index, $cursos|count|sub(1) )}class="reset"{/if}>
												<h3><a href={$item.url_alias|ezurl_formacion()}>{$item.name}</a></h3>
												
											</li>
											{/foreach}
											
										</ul>
									</div>

								</div>

							</div>
							{/if}
							{undef $cursos}
