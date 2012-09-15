{set-block scope=root variable=cache_ttl}0{/set-block}
{def $module_params = module_params()}
 
<div id="gridTwoColumnsTypeB" class="clearFix"> 
		<div class="columnType1">
			<div id="modType2">

					
					<h1>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.titulo.content}</h1>
					
					<div class="wrap clearFix">                    		
							<div class="description">
								<div id="datosUsuario">
				
					{if and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo')) }
						<div class="contacte" >
						El formulario se ha enviado correctamente.
						Muchas gracias.	
						</div>
					{else}
						<p>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.descripcion.content.output.output_text}</p><br>
					{/if}
					
				


					


{if not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))) }
                                           
<form method="post" action={"content/action"|ezurl} id="form_inf_colectivo">					

				 <ul class="datos" style="width:900px;">

					<li>
                        {attribute_view_gui attribute=$node.data_map.sugerencia}
							
                     </li>
                 </ul>
				 
					<div class="clearFix">
						<span class="volver"><a href={"Colectivos"|ezurl}>Volver</a></span>
						<span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="ActionCollectInformation" value="Enviar" id="send"/></span>
					</div> 

					<div>
					   
					   <input type="hidden" name="ContentNodeID" value="{$node.node_id}" />
					   <input type="hidden" name="ContentObjectID" value="{$node.object.id}" />
					   <input type="hidden" name="ViewMode" value="full" />
					</div>                                              	                                                        
</form>
{/if}

                                                									
						</div>
								
					</div>								                        											
			</div>
						
		</div>
	</div>
	<div class="sideBar">

		<div id="modContacto">
			{include uri="design:basket/contactmodule.tpl"}
		</div>
		
	</div>
                
</div>

				
			
		
			
		




