<div id="bodyContent">

		
			
		
			<div id="gridTwoColumnsTypeB" class="clearFix">
            	
                <ol id="pasosCompra">
					<li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
					<li><img src={"txt_paso2-sel.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
					<li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
					<li class="reset"><img src={"txt_paso4.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
				</ol>
                
				<div class="columnType1">
					<div id="modType2">

						
							<h1>Datos de facturación y envío</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosFacturacion">
                                        	{if is_set( $errors )}
                                        		<div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			{foreach $errors as $key => $error }
                                        				<li>{$error}</li>
                                        			{/foreach}
                                        			</ul>
                                        		</div>
                                        	{/if}
                                            <form action={"basket/register"|ezurl} method="post" id="datosFacturacionForm" name="datosFacturacionForm" class="formulario">
                                            <span class="camposObligatorios">* Datos obligatorios</span>
                                            	<h2>Datos de facturación</h2>
                                                
                                                <ul class="datos">

                                                	<li>
                                                    	<span class="etiqueta">Nombre y Apellidos</span>
                                                    	<span class="valor">{ezhttp( 'register_nombre', 'session')} {ezhttp( 'register_apellido1', 'session')} {ezhttp( 'register_apellido2', 'session')}</span>
                                                        
                                                    </li>
                                                    <li>
                                                    	<span class="etiqueta">Email </span>
                                                    	<span class="valor">{ezhttp( 'register_email', 'session')}</span>

                                                        
                                                    </li>                       
                                                    <li {if is_set( $errors.nif)}class="error"{/if}>
                                                    	<label for="nif">NIF *</label>
                                                        <input type="text" id="nif" name="nif" class="text" value="{cond( is_set( $nif ), $nif, '')}" />
                                                        <span>00000000X</span>
                                                    </li>  
                                                    <li {if is_set( $errors.telefono)}class="error"{/if}>
                                                    	<label for="telefono">Teléfono *</label>

                                                        <input type="text" id="telefono" name="telefono" class="text" value="{cond( is_set( $telefono ), $telefono, '')}"/>
                                                    </li> 
                                                    <li {if is_set( $errors.movil)}class="error"{/if}>
                                                        <label for="movil">Móvil</label>
                                                        <input type="text" id="movil" name="movil" class="text" value="{cond( is_set( $movil ), $movil, '')}"/>
                                                    </li>       
                                                    {*                                                
                                                    <li>
                                                    	<label for="fax">Fax</label>
                                                        <input type="text" id="fax" name="fax" class="text" value="{cond( is_set( $fax ), $fax, '')}"/>
                                                    </li>
                                                    *}  
                                                    <li class="direccion">
                                                    	<fieldset {if is_set( $errors.direccion)}class="error"{/if}>
                                                    		<legend><span>Dirección *</span></legend>

                                                    		<div>
                                                    			{def $tipos = fetch( 'basket', 'get_tipos_via', hash() )}                                                    		
                                                    			<label for="tipoV">
                                                    					<select id="tipoV" name="tipoV">
                                                    						<option value="">Tipo de vía</option>
                                                    						{foreach $tipos as $tipo}
                                                    						<option value="{$tipo.clave}" {if and( is_set( $tipovia), $tipovia|eq( $tipo.clave ) )}selected="selected"{/if}>{$tipo.nombre}</option>
                                                    						{/foreach}
                                                    					</select>
                                                    			</label>
                                                    			{undef $tipos}
                                                    			<label for="dir1"><input type="text" id="dir1" name="dir1" class="text" value="{cond( is_set( $dir1 ), $dir1, '')}" /></label>
                                                    			<label for="num">Nº <input type="text" id="num" name="num" class="text" value="{cond( is_set( $num ), $num, '')}" /></label>
                                                    		</div>
                                                    	</fieldset>
                                                    </li>

                                                    <li>
                                                    	<label for="complemento">Complemento de dirección</label>
                                                        <input type="text" id="complemento" name="complemento" class="text" value="{cond( is_set( $complemento ), $complemento, '')}" />
                                                       <span class="hint">incluya aquí piso, puerta, bloque, escalera u otros datos complementarios</span>
                                                    </li>  
                                                    
                                                    <li {if is_set( $errors.provincia)}class="error"{/if}>
                                                    	<label for="provincia">Provincia *</label>
                                                        <select id="provincia" name="provincia">
                                                        	{def $provincias = ezini( 'ProvinciasNames', 'Provincias', 'basket.ini')|sort('string')}
                                                        	<option value=""></option>
                                                        	{foreach $provincias as $el}
                                                        		<option value="{$el}" {if and( is_set( $provincia ), $provincia|eq($el))}selected="selected"{/if}>{$el}</option>
                                                        	{/foreach}
                                                        	{undef $provincias}
                                                        </select>
                                                    </li>  
                                                    <li {if is_set( $errors.localidad)}class="error"{/if}>

                                                    	<label for="localidad">Localidad *</label>
                                                        <input type="text" id="localidad" name="localidad" class="text" value="{cond( is_set( $localidad ), $localidad, '')}" />
                                                    </li>  
                                                    <li {if is_set( $errors.cp)}class="error"{/if}>
                                                    	<label for="cp">Código Postal *</label>
                                                        <input type="text" id="cp" name="cp" class="text" value="{cond( is_set( $cp ), $cp, '')}" />
                                                    </li>  
                                                                                                    
                                                </ul>
                                                
                                                <h2>Datos de envío</h2>

                                                
                                                <fieldset>
                                                	<legend><span>¿Los datos de envío coinciden con los datos de facturación?</span></legend>
                                                		<div>
                                                		<label for="si"><input type="radio" id="si" name="datos"  value="si" {if or( is_set( $datos_coinciden)|not,   and( is_set( $datos_coinciden), $datos_coinciden|eq( 'si' ) ) ) )  } checked="checked"{/if} /> Sí  </label>
                                                      <label for="no"><input type="radio" id="no" name="datos" value="no" {if and( is_set( $datos_coinciden), $datos_coinciden|eq( 'no' ) )}checked="checked"{/if}/> No    </label>
                                                      </div>

                                                       
                                                </fieldset>
                                                
                                                <ul class="datos {if or( is_set( $datos_coinciden)|not, $datos_coinciden|ne( 'no' ) )} hide"{/if}">
                                                	<li {if is_set( $errors.nombre2)}class="error"{/if}>
                                                    	<label for="nombre2">Nombre *</label>
                                                        <input type="text" id="nombre2" name="nombre2" class="text" value="{cond( is_set( $nombre2 ), $nombre2, '' )}"/>
                                                    </li>
                                                    <li {if is_set( $errors.apellido12)}class="error"{/if}>
                                                    	<label for="apellido12">Apellido 1 *</label>

                                                        <input type="text" id="apellido12" name="apellido12" class="text" value="{cond( is_set( $apellido12 ), $apellido12, '' )}" />
                                                    </li>
                                                     <li {if is_set( $errors.apellido22)}class="error"{/if}>
                                                    	<label for="apellido22">Apellido 2</label>

                                                        <input type="text" id="apellido22" name="apellido22" class="text" value="{cond( is_set( $apellido22 ), $apellido22, '' )}" />
                                                    </li>
                                                    {*
                                                    <li {if is_set( $errors.nif2)}class="error"{/if}>
                                                    	<label for="nif2">NIF *</label>
                                                        <input type="text" id="nif2" name="nif2" class="text" value="{cond( is_set( $nif2 ), $nif2, '' )}"/>
                                                        <span>00000000C</span>
                                                    </li>
                                                    *}  
                                                     <li >
                                                    	<label for="empresa2">Nombre de la empresa</label>
                                                        <input type="text" id="empresa2" name="empresa2" class="text" value="{cond( is_set( $empresa2 ), $empresa2, '' )}" />
                                                    </li>  
                                                    <li {if is_set( $errors.telefono2)}class="error"{/if}>

                                                    	<label for="telefono2">Teléfono *</label>
                                                        <input type="text" id="telefono2" name="telefono2" class="text" value="{cond( is_set( $telefono2 ), $telefono2, '' )}"/>
                                                    </li>    
                                                     <li {if is_set( $errors.movil)}class="error"{/if}>
                                                    	<label for="movil2">Móvil</label>
                                                        <input type="text" id="movil2" name="movil2" class="text" value="{cond( is_set( $movil2 ), $movil2, '' )}" />
                                                    </li>  
                                                    {*
                                                    <li {if is_set( $errors.email2)}class="error"{/if}>
                                                    	<label for="email2">Email *</label>
                                                        <input type="text" id="email2" name="email2" class="text" value="{cond( is_set( $email2 ), $email2, '' )}" />
                                                    </li>
                                                    *}  
                                                    <li>
                                                        <label for="email2">Email </label>
                                                        <input type="text" id="email2" name="email2" class="text" value="{cond( is_set( $email2 ), $email2, '' )}" />
                                                    </li>
                                                    <li class="direccion">
                                                    	<fieldset  {if is_set( $errors.direccion2)}class="error"{/if}>
                                                    		<legend><span>Dirección *</span></legend>
                                                    		<div>
                                                    			{def $tipos = fetch( 'basket', 'get_tipos_via', hash() )}
                                                    			<label for="tipoV2">
                                                    				<select id="tipoV2" name="tipoV2">
                                                    					<option value="">Tipo de vía</option>
                                                    					{foreach $tipos as $tipo}
                                                    						<option value="{$tipo.clave}" {if and( is_set( $tipovia2), $tipovia2|eq( $tipo.clave ) )}selected="selected"{/if}>{$tipo.nombre}</option>
                                                    					{/foreach}
                                                    				</select>
                                                    			</label>
                                                    			{undef $tipos}                                                    			
                                                    			<label for="dir12"><input type="text" id="dir12" name="dir12" class="text" value="{cond( is_set( $dir12 ), $dir12, '' )}"/></label>
                                                    			<label for="num2">Nº <input type="text" id="num2" name="num2" class="text" value="{cond( is_set( $num2 ), $num2, '' )}" /></label>
                                                    		</div>
                                                    	</fieldset>
                                                    </li>
                                                    <li >
                                                    	<label for="complemento2">Complemento de dirección</label>
                                                        <input type="text" id="complemento2" name="complemento2" class="text" value="{cond( is_set( $complemento2 ), $complemento2, '' )}" />
                                                        <span class="hint">incluya aquí piso, puerta, bloque, escalera u otros datos complementarios</span>
                                                    </li>  
                                                    
                                                    <li  {if is_set( $errors.provincia2)}class="error"{/if}>
                                                    	<label for="provincia2">Provincia *</label>
                                                        <select id="provincia2" name="provincia2">
                                                        	{def $provincias = ezini( 'ProvinciasNames', 'Provincias', 'basket.ini')|sort('string')}
                                                        	<option value=""></option>
                                                        	{foreach $provincias as $el}
                                                        		<option value="{$el}" {if and( is_set( $provincia2 ), $provincia2|eq($el))}selected="selected"{/if}>{$el}</option>
                                                        	{/foreach}
                                                        	{undef $provincias}
                                                        </select>
                                                    </li>  
                                                    <li  {if is_set( $errors.localidad2)}class="error"{/if}>
                                                    	<label for="localidad2">Localidad *</label>
                                                        <input type="text" id="localidad2" name="localidad2" class="text" value="{cond( is_set( $localidad2 ), $localidad2, '' )}"  />
                                                    </li>  
                                                    <li {if is_set( $errors.cp2)}class="error"{/if}>
                                                    	<label for="cp2">Código Postal *</label>
                                                        <input type="text" id="cp2" name="cp2" class="text" value="{cond( is_set( $cp2 ), $cp2, '' )}"  />
                                                    </li>  
                                                                                                    
                                                </ul>
												{def $cursos = array()}
												
                                                {foreach fetch('shop', 'basket').items as $index => $item}
                                                {if $item.item_object.contentobject.class_identifier|contains('curso_')}
                                                {set $cursos = $cursos|append( $item.item_object.id )}
                                                <h2>Datos del asistente principal al curso "{$item.item_object.name}"</h2>
                                                
                                                <fieldset>
                                                	<legend><span>¿Los datos del asistente principal coinciden con los de usted?</span></legend>
                                                		<div>
                                                		<label for="sic_{$item.item_object.id}">
                                                			<input type="radio" id="sic{$item.item_object.id}" name="datosc{$item.item_object.id}" value="si" 
                                                			{if or( ezhttp_hasvariable( concat( 'datosc', $item.item_object.id), 'post' )|not, ezhttp( concat( 'datosc', $item.item_object.id), 'post' )|eq('si'))}checked="checked"{/if}/> Sí  </label>
                                                      <label for="noc_{$item.item_object.id}"><input type="radio" id="noc{$item.item_object.id}" name="datosc{$item.item_object.id}" value="no" {if and( ezhttp( concat( 'datosc', $item.item_object.id), 'post' )|eq('no'), is_set( concat('datosc', $item.item_object.id ) ) )}checked="checked"{/if} /> No    </label>

                                                      </div>                                                       
                                                </fieldset>
                                                <ul class="datos cursos {if or( ezhttp_hasvariable( concat( 'datosc', $item.item_object.id), 'post' )|not, ezhttp( concat( 'datosc', $item.item_object.id), 'post' )|eq('si'))}hide{/if}">
                                                	<li {if is_set( $errors[concat( 'nombrec', $item.item_object.id)])}class="error"{/if}>
                                                    	<label for="nombrec_{$item.item_object.id}">Nombre *</label>
                                                      <input type="text" id="nombrec{$item.item_object.id}" name="nombrec{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'nombrec', $item.item_object.id ) ), ezhttp( concat( 'nombrec', $item.item_object.id), 'post' ), '')}" />
                                                    </li>  
                                                    <li {if is_set( $errors[concat( 'apellido1c', $item.item_object.id)])}class="error"{/if}>

                                                    	<label for="apellido1c{$item.item_object.id}">Apellido 1 *</label>
                                                      <input type="text" id="apellido1c{$item.item_object.id}" name="apellido1c{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'apellido1c', $item.item_object.id ) ), ezhttp( concat( 'apellido1c', $item.item_object.id), 'post' ), '')}" />
                                                    </li>
                                                    <li>
                                                      <label for="apellido2c{$item.item_object.id}">Apellido 2</label>
                                                      <input type="text" id="apellido2c{$item.item_object.id}" name="apellido2c{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'apellido2c', $item.item_object.id ) ), ezhttp( concat( 'apellido2c', $item.item_object.id), 'post' ), '')}" />
                                                    </li>  
                                                      
                                                    <li {if is_set( $errors[concat( 'profesionc', $item.item_object.id)])}class="error"{/if}>
                                                    	<label for="profesionc{$item.item_object.id}">Profesión *</label>
                                                      <input type="text" id="profesionc{$item.item_object.id}" name="profesionc{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'profesionc', $item.item_object.id ) ), ezhttp( concat( 'profesionc', $item.item_object.id), 'post' ), '')}" />
                                                    </li>  
                                                    <li {if is_set( $errors[concat( 'telefonoc', $item.item_object.id)])}class="error"{/if}>
                                                    	<label for="telefonoc{$item.item_object.id}">Teléfono de contacto *</label>

                                                      <input type="text" id="telefonoc{$item.item_object.id}" name="telefonoc{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'telefonoc', $item.item_object.id ) ), ezhttp( concat( 'telefonoc', $item.item_object.id), 'post' ), '')}" />
                                                    </li>  
                                                    <li {if is_set( $errors[concat( 'emailc', $item.item_object.id)])}class="error"{/if}>
                                                    	<label for="emailc_{$item.item_object.id}">Email *</label>
                                                      <input type="text" id="emailc{$item.item_object.id}" name="emailc{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'emailc', $item.item_object.id ) ), ezhttp( concat( 'emailc', $item.item_object.id), 'post' ), '')}"/>
                                                    </li>  
                                                    <li>
                                                    	<label for="faxc1">Fax</label>
                                                      <input type="text" id="faxc{$item.item_object.id}" name="faxc{$item.item_object.id}" class="text" value="{cond( is_set( concat( 'faxc', $item.item_object.id ) ), ezhttp( concat( 'faxc', $item.item_object.id), 'post' ), '')}" />
                                                      <input type="hidden" name="nombrecurso_{$item.item_object.id}" value="{$item.item_object.name}" id="nombre_{$item.item_object.id}" class="nombreCurso" />
													  <input type="hidden" name="curso_id_{$item.item_object.id}" value="{$item.item_object.id}" id="curso_id_{$item.item_object.id}" class="curso_id" />
                                                    </li>  
                                                </ul>
                                                {/if}
                                                {/foreach}
                                                
                                                                                                
                                                <h2>Observaciones</h2>
                                                
                                                <ul class="datos">
                                                	<li>
                                                    	<label for="observaciones">Observaciones</label>
                                                        <textarea id="observaciones" name="observaciones" class="text" rows="5" cols="5">{if is_set( $observaciones )}{$observaciones}{/if}</textarea>

                                                    </li>
                                                    
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $errors['condiciones'] )}class="error"{/if}><input type="checkbox" id="condiciones" name="condiciones" /> Acepto las condiciones de contratación</label>
                                                    	<div>                                                    		
                                                    		{fetch('content', 'node', hash( 'node_id', 1321)).data_map.texto.content.output.output_text}
                                                    	</div>

                                                    </li>
                                                    {*
                                                    <li class="condiciones">
                                                    	<label for="condiciones" {if is_set( $errors['condiciones'] )}class="error"{/if}><input type="checkbox" id="condiciones" name="condiciones" /> Acepto las condiciones</label>
                                                    	<div>
                                                    		<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has 
roots in a piece of classical Latin literature from 45 BC, making it over 
2000 years old. Richard McClintock, a Latin professor at Hampden-
Sydney College in Virginia, looked up one of the more obscure Latin 
words, consectetur, from a Lorem Ipsum passage, and going through
the cites of the word in classical literature, discovered the undoubtabl</p>
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has 
roots in a piece of classical Latin literature from 45 BC, making it over 
2000 years old. Richard McClintock, a Latin professor at Hampden-
Sydney College in Virginia, looked up one of the more obscure Latin 
words, consectetur, from a Lorem Ipsum passage, and going through
the cites of the word in classical literature, discovered the undoubtabl</p>
                                                    	</div>

                                                    </li>*}
                                                                                                    
                                                </ul>
                                               
                                               <div class="clearFix">
	                                                {*<span class="volver"><a href="#" onclick="history.back()">Volver</a></span>*}
   	                                             <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} name="BtnRegisterParticular" alt="Continuar" /></span>
                                                
                                                </div>  
                                                   {if $cursos|count|gt(0)}
                                                   	<input type="hidden" name="cursos" value="{$cursos|implode(',')}"  />
                                                   {/if} 	                                                        
                                            </form>
                                                									
										</div>
								
									</div>								                        											
							</div>

						
					</div>
				</div>
				<div class="sideBar">
                
                	<div id="modComprando">
                    	{include uri="design:basket/cart.tpl"}

                    </div>
                    
					<div id="modContacto">
						{include uri="design:basket/contactmodule.tpl"}
					</div>

                    <div id="logohispassl">
					   <script type="text/javascript">TrustLogo("https://www.hispassl.com/entorno_seguro.gif", "HispS", "none");</script>
					</div>
                    
				</div>
                
			</div>
				
			
		
			
		
		</div>
