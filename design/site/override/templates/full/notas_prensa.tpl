<div id="commonGrid" class="clearFix">
	{include uri="design:menus/quienessomos.tpl"}

{def $listado-notas-prensa=fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id, 'sort_by', array('attribute',false(),'nota_prensa/fecha')))}

	<div id="content">	
			<ul id="listadoNotas">
			
			{foreach $listado-notas-prensa as $nota-prensa}
			
				<li>
					<div class="nota">
						<h2>{$nota-prensa.data_map.titular.content}</h2>
						<div class="wrap">
							<div class="inner clearFix">
								<div class="wysiwyg">
								
									<div class="date">
										<span class="day">{$nota-prensa.data_map.fecha.content.day}</span> 
										<span class="month">{$nota-prensa.data_map.fecha.content.timestamp|datetime( 'custom', '%F' )}</span> 
										<span class="year">{$nota-prensa.data_map.fecha.content.year}</span>
									</div>

                                    <div class="attribute-cuerpo">
								
										<p>{$nota-prensa.data_map.entradilla.content.output.output_text}</p>

									</div>
													
									<div class="attribute-cuerpo">
								
										<p>{$nota-prensa.data_map.body.content.output.output_text}</p>

									</div>
								</div>
							</div>
						</div>		
					</div>			
				</li>
				
			{/foreach}
			
			</ul>
	</div>
</div>
{undef $listado-notas-prensa}
