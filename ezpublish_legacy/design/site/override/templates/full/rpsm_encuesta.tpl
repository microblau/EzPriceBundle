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
						</div>
				{else}
					<p>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.descripcion.content.output.output_text}</p><br>
				{/if}


{if not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))) }
                                           
	<form method="post" action={"content/action"|ezurl} id="form_encuesta_rpsm">
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px;">
					{attribute_view_gui attribute=$node.data_map.item1}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px;">
					{attribute_view_gui attribute=$node.data_map.item2}
				</div>
				
				<div style="font-family: Arial, Helvetica, sans-serif;color:#000; font-weight:normal; font-size:12px">
					3. Cual es su valoración de los distintos tipos de búsqueda disponibles:
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px; padding-left:30px;">
					{attribute_view_gui attribute=$node.data_map.item3}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px; padding-left:30px;">
					{attribute_view_gui attribute=$node.data_map.item4}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px; padding-left:30px;">
					{attribute_view_gui attribute=$node.data_map.item5}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px; padding-left:30px;">
					{attribute_view_gui attribute=$node.data_map.item6}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px;">
					{attribute_view_gui attribute=$node.data_map.item7}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px;">
					{attribute_view_gui attribute=$node.data_map.item8}
				</div>
				<div style="border-bottom:1px solid #c6e7ff; margin-bottom:20px; padding-bottom:5px;">
					{attribute_view_gui attribute=$node.data_map.item9}
				</div>
				<div style="font-family: Arial, Helvetica, sans-serif;color:#000; font-weight:normal; font-size:12px">
					7. Bajo su criterio indíquenos qué aspectos mejoraría del Nuevo Portal Soluciones Memento (Nautis/Mementix):<br><br>
				</div>
				{attribute_view_gui attribute=$node.data_map.opinion}
			
				   <div class="clearFix">
						<span class="volver"><a href={"recursospsm"|ezurl}>Volver</a></span>
						<span class="submit"><input type="image" src={"btn_enviar.gif"|ezimage} alt="Continuar" name="ActionCollectInformation" value="Enviar" id="send"/></span>
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
