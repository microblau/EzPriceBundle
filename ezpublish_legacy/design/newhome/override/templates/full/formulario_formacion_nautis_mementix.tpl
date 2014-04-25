{literal}<script type="text/javascript" src = "/design/site/javascript/yahoo-dom-event.js"></script>
<script type="text/javascript" src = "/design/site/javascript/ie-select-width-fix.js"></script>
<script type="text/javascript">
	new YAHOO.Hack.FixIESelectWidth( 'formacion-nautis-mementix' ); 
</script>{/literal}
{set-block scope=root variable=cache_ttl}0{/set-block}
{def $module_params = module_params()}

{foreach $validation.attributes as $key => $error }

	{switch match=$error.identifier}

	    {case match='formacion'} 
	    	{def $error_formacion = 1}
	    {/case}
	    {case match='num_cliente'} 
	    	{def $error_num_cliente = 1}
	    {/case}
	    {case match='nombre_empresa'} 
	    	{def $error_nombre_empresa = 1}
	    {/case}	
	    {case match='nombre_asistente'} 
	    	{def $error_nombre_asistente = 1}
	    {/case}	
	    {case match='apellidos_asistente'} 
	    	{def $error_apellidos_asistente = 1}
	    {/case} 
	    {case match='cif_nif'} 
	    	{def $error_cif_nif = 1}
	    {/case} 	
	    {case match='email'} 
	    	{def $error_email = 1}
	    {/case}		
	    {case match='telefono'} 
	    	{def $error_telefono = 1}
	    {/case}	    
	    {case match='politica_privacidad'} 
	    	{def $error_politica = 1}
	    {/case}
	    {case match='captchar'} 
	    	{def $error_captchar = 1}
	    {/case}

	{/switch}

	
{/foreach}


{def $tipo_formacion = $collection_attributes.10959.content}



			<div id="gridTwoColumnsTypeB" class="clearFix">
            	
               
				<div class="columnType1">
					<div id="modType2">

						
							<h1>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.titulo.content}</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">

						{if and( not($validation.attributes|count()|gt(0)), not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))))  }
						<p>{fetch('content', 'node', hash( 'node_id', $node.node_id)).data_map.descripcion.content.output.output_text}</p><br>

						{/if}
						{if not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))) }
						<div id="div_tabla_formaciones">

							{def $formaciones=fetch( 'content', 'list',
								hash( 'parent_node_id', 1468,
								      'sort_by',array( 'attribute',
											      true(),
											      735 ) ) )}
							

							<table  class="tabla_formaciones" >
								<tr >
									<td><strong>Ciudad</strong></td>
									<td><strong>Fecha</strong></td>
									<td><strong>Horario</strong></td>	
									<td><strong>Lugar</strong></td>
									<td><strong>Dirección</strong></td>
								<tr>

								

							
								{foreach $formaciones as $key => $formacion }
								{def $formacion_nodo = fetch('content', 'node', hash( 'node_id', $formacion.node_id))}

								{if currentdate()|le($formacion_nodo.data_map.fecha.content.timestamp) }
									<tr>
										<td>{$formacion_nodo.data_map.ciudad.content}</td>
										<td>{$formacion_nodo.data_map.fecha.content.timestamp|l10n( 'shortdate' )}</td>
										<td>{$formacion_nodo.data_map.horario.content}</td>	
										<td>{$formacion_nodo.data_map.lugar.content}</td>
										<td>{$formacion_nodo.data_map.direccion.content}</td>
									<tr>
									{/if}
								{/foreach}
								
							</table>
						</div>
					
						{/if}

						
                                        	{if $validation.attributes|count()|gt(0)}
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			{foreach $validation.attributes as $key => $error }
                                        				<li>{$error.name} : {$error.description}<br></li>
                                        			{/foreach}
                                        			</ul>
                                        		</div>
                                        	{else}	
	
							{if and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo')) }
								<div class="contacte" >
								El formulario se ha enviado correctamente.
								En breve nos pondremos en contacto con usted.	
								</div>
							{/if}
						{/if}


{if not(and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo'))) }
                                           
<form method="post" action={"content/action"|ezurl} id="form_inf_colectivo">
                                            <span class="camposObligatorios">* Datos obligatorios</span>

						


                                            	<h2>Datos de usuario</h2>                                                
                                                <ul class="datos">

                                                    <li {if is_set( $error_formacion)}class="error"{/if}>
                                                    	<label for="formacion">Deseo recibir formación en *</label>
                                                        
							 <span class="select-box" style="padding:0;margin:0;">    
                            <select name="ContentObjectAttribute_ezstring_data_text_10959" class="formacion-nautis-mementix" id="formacion-nautis-mementix">

							<option value="" {if $tipo_formacion|count()|eq(0)}selected="selected"{/if}>Seleccionar</option>
								{foreach $formaciones as $key => $formacion }
								{def $formacion_nodo = fetch('content', 'node', hash( 'node_id', $formacion.node_id))}
								

								{if currentdate()|le($formacion_nodo.data_map.fecha.content.timestamp) }
					
									<option {if eq($tipo_formacion,concat($formacion_nodo.data_map.ciudad.content,' - ',$formacion_nodo.data_map.fecha.content.timestamp|l10n( 'shortdate' ), ' - ', $formacion_nodo.data_map.horario.content) )}selected="selected"{/if} >{$formacion_nodo.data_map.ciudad.content} - {$formacion_nodo.data_map.fecha.content.timestamp|l10n( 'shortdate' )} - {$formacion_nodo.data_map.horario.content}</option>
									{/if}
								{/foreach}
							</select>
                            </span>
							{*attribute_view_gui attribute=$node.data_map.formacion*}
							
                                                    </li>
                                                    <li {if is_set( $error_num_cliente)}class="error"{/if}>
                                                    	<label for="num_cliente">Nº cliente</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.num_cliente}
                                                    </li>
	     					    <li {if is_set( $error_nombre_empresa)}class="error"{/if}>
                                                    	<label for="nombre_empresa">Nombre empresa </label>
                                                        
							{attribute_view_gui attribute=$node.data_map.nombre_empresa}
                                                    </li>	
				                    <li {if is_set( $error_nombre_asistente)}class="error"{/if}>
                                                    	<label for="nombre_asistente">Nombre asistente *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.nombre_asistente}
                                                    </li>
					            <li {if is_set( $error_apellidos_asistente)}class="error"{/if}>
                                                    	<label for="apellidos_asistente">Apellidos asistente *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellidos_asistente}
                                                    </li>
						    <li {if is_set( $error_cif_nif)}class="error"{/if}>
                                                    	<label for="cif_nif">CIF / NIF *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.cif_nif}
                                                    </li>	
						<li {if is_set( $error_telefono)}class="error"{/if}>
                                                    	<label for="telefono">Teléfono *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.telefono}
                                                    </li>  		 
                                                    
                                                    <li {if is_set( $error_email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.email}
                                                    </li>                                   

						 
                                                    
                                                </ul>
                                                
                                                <ul class="datos">
                                                	
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $error_politica)}class="error"{/if}>{attribute_view_gui attribute=$node.data_map.politica_privacidad} Acepto las condiciones legales</label>

                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1451)).data_map.texto.content.output.output_text}
                                                    	</div>

                                                    </li>
							<li>
								<label for="capchar" {if is_set( $error_captchar)}class="error"{/if}>Introduzca los caracteres que visualiza en la imagen inferior *:</label><br>
<div>
<input class="box" type="text" size="4" name="eZHumanCAPTCHACode" value="" />
</div>
<br>
<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHA" /><br>


 <br/>
							</li>
                                                        
                                                                                                    
                                                </ul>
                                                
                                               
                                               <div class="clearFix">
	                                                <span class="volver"><a href={"Colectivos"|ezurl}>Volver</a></span>
   	                                                <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="ActionCollectInformation" value="Enviar" id="send"/></span>
                                                
                                                </div> 

						<div >
						   
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

				
			
		
			
		




