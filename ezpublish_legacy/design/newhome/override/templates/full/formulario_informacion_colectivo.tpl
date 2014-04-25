{literal}<script type="text/javascript" src = "/design/site/javascript/yahoo-dom-event.js"></script>
<script type="text/javascript" src = "/design/site/javascript/ie-select-width-fix.js"></script>
<script type="text/javascript">
	new YAHOO.Hack.FixIESelectWidth( 'groups' );
</script>{/literal}



{set-block scope=root variable=cache_ttl}0{/set-block}
{def $module_params = module_params()}

{foreach $validation.attributes as $key => $error }

	{switch match=$error.identifier}

	    {case match='nombre'} 
	    	{def $error_nombre = 1}
	    {/case}
	    {case match='apellido1'} 
	    	{def $error_apellido1 = 1}
	    {/case}
	    {case match='apellido2'} 
	    	{def $error_apellido2 = 1}
	    {/case}	
	    {case match='asociacion_colectivo'} 
	    	{def $error_asociacion = 1}
	    {/case}	
	    {case match='email'} 
	    	{def $error_email = 1}
	    {/case}		
	    {case match='contrasena'} 
	    	{def $error_contrasena = 1}
	    {/case}
	    {case match='repetir_contrasena'} 
	    	{def $error_repetir_contrasena = 1}
	    {/case}
		{case match='tipo_usuario'} 
	    	{def $error_tipo_usuario = 1}
	    {/case}
	    {case match='politica_privacidad'} 
	    	{def $error_politica = 1}
	    {/case}
	    {case match='captchar'} 
	    	{def $error_captchar = 1}
	    {/case}

	{/switch}

	
{/foreach}



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

                                                    <li {if is_set( $error_nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.nombre}
							
                                                    </li>
                                                    <li {if is_set( $error_apellido1)}class="error"{/if}>
                                                    	<label for="apellido1">Primer Apellido *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellido1}
                                                    </li>
	     					    <li {if is_set( $error_apellido2)}class="error"{/if}>
                                                    	<label for="apellido2">Segundo Apellido *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellido2}
                                                    </li>	
         
				                    <li {if is_set( $error_asociacion)}class="error"{/if}>
                                                    	<label for="asociacion">Asociación / Colectivo *</label>
                         <span class="select-box" style="padding:0;margin:0;">
							                               
{attribute_view_gui attribute=$node.data_map.asociacion_colectivo}

						</span>                

                                                    </li>
                   
                
                   
                                                    
                                                    <li {if is_set( $error_email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.email}
                                                    </li>
                                                    

                                                    <li {if is_set( $error_contrasena)}class="error"{/if}>
                                                    	<label for="contrasena">Contraseña *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.contrasena}
                                                    </li>                                                  

						   <li {if is_set( $error_repetir_contrasena)}class="error"{/if}>
                                                    	<label for="repetir_contrasena">Repetir Contraseña *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.repetir_contrasena}
                                                    </li>	
													
							<li {if is_set( $error_tipo_usuario)}class="error"{/if}>
                                                    	<label for="tipo_usuario">Usted va a comprar como *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.tipo_usuario}
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

				
			
		
			




