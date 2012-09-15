{* cargamos en $combo los valores que iran en el select de tipos*}


{def $combo = ezini( 'Combos', 'Combo', 'tipoFormacion.ini' )}
<div id="moduloDestacadoContenido">
    <h1 class="mainTitle">Encuentre su curso</h1>
    <div class="wrap">
        <div class="inner clearFix">
            <div class="wysiwyg clearFix">
                <div class="attribute-cuerpo sinImagen flt">
                    <p>Francis Lefebvre le ofrece un amplio número de cursos que le permitirán anticiparse y encontrar soluciones en su área de trabajo.</p>
                    <div class="clearFix linksModulo">
                        <span class="font">Busque el suyo ahora ...</span>
                    </div>                                      
                </div>
                
                <div class="buscaCurso frt">
                    <h2>Quiero buscar un curso</h2>
                    <form action="/buscador/formacionFecha" method="post">
                        <ul>
                            <li>
                                <label for="tipos" class="hide">Tipos:</label>
                                <script type="text/javascript">
                                {literal}
                                
                                var combos = {
                                    comboTipoChange:function(valor){
                                        $.post('/ezjscore/call/formacion::comboArea::' + valor,function(respuesta){
                                            $("#areas_prueba").html(respuesta);}
                                        );
                                    }                                    
                                }
                                    
                                {/literal}
                                </script>
                                <select id="tipos" name="tipos" onchange="javascript:combos.comboTipoChange(this.value);">
                                    <option value="-1">Tipo de curso</option>
                                    {foreach $combo as $valor}
                                        {def $literal=ezini($valor,'Literal','tipoFormacion.ini')}
                                        <option value="{ezini($valor,'Nodo','tipoFormacion.ini')}" {cond($view_parameters.tipos|eq(ezini($valor,'Nodo','tipoFormacion.ini')),' selected="selected"')}>{$literal}</option>
                                        {undef $literal}
                                    {/foreach}
                                </select>
                            </li>
                            
                            <li>
                                <label for="areas" class="hide">Áreas:</label>
                                <span id="areas_prueba">
                                <select id="areas" name="areas">
                                    <option value="-1">En todas las áreas</option>
                                    {if $view_parameters.areas}
                                    {def $areas=fetch('content','list', hash('parent_node_id',$view_parameters.tipos,
                                                'class_filter_type','include',
                                                'class_filter_array',array('folder')
                                    ))}
                                    {foreach $areas as $area}
                                        <option value="{$area.node_id}" {cond($area.node_id|eq($view_parameters.areas),' selected="selected"')}>{$area.name}</option>
                                    {/foreach}
                                    {/if}
                                </select>
                                </span>
                            </li> 
                            
                            <li>
                                <label for="fecha" class="hide">Fecha:</label>
                                 
                                <select id="fecha" name="fecha">
                                    <option value="-1">Fecha</option>
                                    {for 0 to 11 as $counter}
                                        {def $nextMonth=currentdate()|datetime('custom','%n')|sum($counter)
                                             $pinta=makedate($nextMonth)}
                                        <option value="{$counter}" {cond($counter|eq($view_parameters.fecha|int),' selected="selected"')}>{$pinta|datetime('custom','%F %Y')}</option>
                                        {undef $nextMonth, $pinta}
                                    {/for}
                                </select>
                            </li>
                        </ul>
                        <div class="clearFix">
                            <span class="submit frt"><input type="image" alt="Ver curso" src={"btn_verCurso.gif"|ezimage} /></span> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>                                                                                                                                          
</div>

                                         