{literal}<script type="text/javascript" src = "/design/site/javascript/yahoo-dom-event.js"></script>
<script type="text/javascript" src = "/design/site/javascript/ie-select-width-fix.js"></script>
<script type="text/javascript">
	new YAHOO.Hack.FixIESelectWidth( 'ContentObjectAttribute_ezselect_selected_array_10807[]' ); 
</script>{/literal}
{ezcss_require( 'jquery.fancybox-1.3.0.css')} 
{set-block scope=root variable=cache_ttl}0{/set-block}
{def $module_params = module_params()}


{foreach $validation.attributes as $key => $error }

	{switch match=$error.identifier}

	    {case match='producto'} 
	    	{def $error_producto = 1}
	    {/case}  	
	    {case match='nombre'} 
	    	{def $error_nombre = 1}
	    {/case}
	    {case match='apellidos'} 
	    	{def $error_apellidos = 1}
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

{if or( $validation.attributes|count|gt(0), and($module_params.module_name|eq('content'),$module_params.function_name|eq('collectedinfo')) )}
{literal}
<!-- Google Code for Prueba gratuita Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "pYBNCPvSiAIQva3B9gM";
var google_conversion_value = 0;
if (50) {
  google_conversion_value = 50;
}
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
{/literal}
{/if}
{literal}
<!-- Google Code for Home Page Remarketing List -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "666666";
var google_conversion_label = "_xsRCIvRiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?label=_xsRCIvRiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?value=50&amp;label=pYBNCPvSiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
{/literal}
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

						    <li {if is_set( $error_producto)}class="error"{/if}>
                                                    	<label for="producto">Deseo pedir una prueba gratuita del producto *</label>
                            <span class="select-box" style="padding:0;margin:0;">                            
								{attribute_view_gui attribute=$node.data_map.producto}
							</span>
                                                    </li>

                                                    <li {if is_set( $error_nombre)}class="error"{/if}>
                                                    	<label for="nombre">Nombre *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.nombre}
							
                                                    </li>
                                                    <li {if is_set( $error_apellidos)}class="error"{/if}>
                                                    	<label for="apellidos">Apellidos *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.apellidos}
                                                    </li>
	     					   
                                                    
                                                    <li {if is_set( $error_email)}class="error"{/if}>
                                                    	<label for="email">Email *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.email}
                                                    </li>
                                                    

                                                    <li {if is_set( $error_telefono)}class="error"{/if}>
                                                    	<label for="telefono">Teléfono *</label>
                                                        
							{attribute_view_gui attribute=$node.data_map.telefono}
                                                    </li>                                                  
							
						  	<li>
                               <label for="telefono">Producto Qmementix</label>
									{*attribute_view_gui attribute=$node.data_map.telefono*}
									
                            </li>                                               
                                                     
                                                    
                                                </ul>
                                                
                                                <ul class="datos">
                                                	
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $error_politica)}class="error"{/if}>{attribute_view_gui attribute=$node.data_map.politica_privacidad} He leído y acepto las condiciones de la <a class="lb" style="white-space: normal" id="politicaligthBox" href={'lightbox/ver/19526'|ezurl}>Política de Privacidad</a> y el <a class="lb" id="avisoLightbox" href={'lightbox/ver/292'|ezurl}>Aviso Legal</a></label>

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
						   {attribute_view_gui attribute=$node.data_map.colectivo}
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

				
			
		
			
		
		



