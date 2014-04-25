
{def $usuario_areas_interes = fetch( 'basket', 'get_usuario_areas_interes', hash( 'user_id', ezhttp( 'id_user_lfbv', 'session')))}
{def $usuario_datos_paso3 = fetch( 'basket', 'get_usuario_datos_paso3', hash( 'user_id', ezhttp( 'id_user_lfbv', 'session')))}

 <ul class="datos">
                                                	<li>
                                                    	<label for="profesion">¿Cuál es su profesión?</label>
                                                        {*<input type="text" id="profesion" name="profesion" class="text" />*}
                                                        {def $profesiones = fetch( 'basket', 'get_profesiones', hash())}
                                                        <select name="profesiones">
                                                            <option value="">Seleccione</option>
                                                            {foreach $profesiones as $profesion}
                                                            <option value="{$profesion.COD_PROFESION1}" {if eq( $profesion.COD_PROFESION1, $usuario_datos_paso3.perfil_profesion)}selected="selected"{/if}>{$profesion.DESCRIPCION}</option>
                                                            {/foreach}
                                                        </select>
                                                        {undef $profesiones}
                                                    </li>
                                                    <li>

                                                    	<label for="cargo">¿Cuál es su cargo?</label>
                                                        {*<input type="text" id="cargo" name="cargo" class="text" />*}
                                                        {def $cargos = fetch( 'basket', 'get_cargos', hash())}
                                                        <select name="cargo">
                                                            <option value="">Seleccione</option>
                                                            {foreach $cargos as $cargo}
                                                            <option value="{$cargo.CDFN}" {if eq( $cargo.CDFN, $usuario_datos_paso3.perfil_cargo)}selected="selected"{/if}>{$cargo.LBFN}</option>
                                                            {/foreach}
                                                        </select>
                                                        {undef $cargos}
                                                    </li>
                                                    <li>
                                                    	<label for="departamento">¿En que departamento trabaja?</label>
                                                        {*<input type="text" id="departamento" name="departamento" class="text" />*}
                                                        {def $departamentos = fetch( 'basket', 'get_departamentos', hash())}
                                                        <select name="departamento">
                                                            <option value="">Seleccione</option>
                                                            {foreach $departamentos as $departamento}
                                                            <option value="{$departamento.CD_SVC}"  {if eq( $departamento.CD_SVC, $usuario_datos_paso3.perfil_dpto)}selected="selected"{/if}>{$departamento.LB_SVC}</option>
                                                            {/foreach}
                                                        </select>
                                                        {undef $departamentos}
                                                    </li>  
                                                     <li>
                                                        <label for="numEmple">¿Cuántos empleados tiene su empresa?</label>
                                                        <input type="text" id="numEmple" name="numEmple" class="text" value="{$usuario_datos_paso3.num_empleados}"/>
                                                    </li> 
                                                    
                                                    <li>
                                                        <label for="actividad">¿Cuál es la actividad de su empresa?</label>
                                                        {def $actividades = fetch( 'basket', 'get_actividades', hash())}
                                                        <select id="actividad" name="actividad">
                                                            <option selected="selected" value="">Seleccione</option>
                                                            {foreach $actividades as $actividad}
                                                            <option value="{$actividad.CD_ACTIV}" {if eq( $actividad.CD_ACTIV, $usuario_datos_paso3.actividad)}selected="selected"{/if}>{$actividad.LB_ACTIV}</option>
                                                            {/foreach}
                                                        </select>
                                                        {undef $actividades}
                                                        
                                                    </li>
                                                    
                                                     <li>
                                                    	<label for="especialidad">¿Cuál es su especialidad?</label>
                                                        <select id="especialidad" name="especialidad">
                                                        	<option value="">Seleccione</option>
                                                        	{def $areas = fetch( 'basket', 'get_areas', hash())}
                                                        	{foreach $areas as $area}
                                                            <option value="{$area.CD_MAT}" {if eq( $area.CD_MAT, $usuario_datos_paso3.perfil_areaesp)}selected="selected"{/if}>{$area.LB_MAT}</option>
                                                            {/foreach}
                                                            {undef $areas}
                                                        </select>
                                                        
                                                    </li>   
                                                    
                                                    
                                                       
                                                                         
                                                  
                                                    <li>
                                                    	<fieldset>
                                                    		<legend><span>¿Qué otras áreas también le interesan?</span></legend>
                                                    		<ul id="areaslist">
                                                                {def $areas = fetch( 'basket', 'get_areas', hash())}
                                                                {foreach $areas as $area}
                                                    			<li>

                                                    				<label for="area{$area.CD_MAT}"><input type="checkbox" id="area{$area.CD_MAT}" name="area[]" value="{$area.CD_MAT}" {if $usuario_areas_interes|contains($area.CD_MAT)}checked="checked"{/if} /> {$area.LB_MAT}</label>
                                                                </li>
                                                                {/foreach}  
                                                                {undef $areas}                                                             
                                                    		</ul>
                                                    	</fieldset>
                                                    </li>                           
                                                </ul>
