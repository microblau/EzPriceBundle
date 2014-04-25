{set-block scope=root variable=cache_ttl}0{/set-block} 
{ezpagedata_set( 'vistawidth', 'no')}

<div class="content-view-full">
	<div class="context-block">
		<div class="box-header">
			<div class="box-tc">
				<div class="box-ml">
					<div class="box-mr">
						<div class="box-tl">
							<div class="box-tr">
								<h2 class="context-title">Lista de valoraciones</h2>
								<div class="header-subline"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="box-bc">
		<div class="box-ml">
			<div class="box-mr">
				<div class="box-bl">
					<div class="box-br">
						<div class="box-content">

{def $limite=10}
{if is_set($params.offset)}
	{def $offset = $params.offset}
{else}
	{def $offset = 0}
{/if}

{def $orden='fecha desc'}
	
{if ezhttp( 'sort_by', 'get' )|ne('')}
{def $sort_by=ezhttp( 'sort_by', 'get' )}
	 {switch match=$sort_by}
         {case match='fechaasc'} 
              {set $orden='fecha asc'}	
         {/case}
         {case match='fechadesc'}
            {set $orden='fecha desc'}
         {/case}
         {case match='productoasc'} 
              {set $orden='node_producto asc'}	
         {/case}
         {case match='productodesc'}
            {set $orden='node_producto desc'}
         {/case}
         {case match='estadoasc'} 
              {set $orden='visible asc'}	
         {/case}
         {case match='estadodesc'}
            {set $orden='visible desc'}
         {/case}
         {case}
            {set $orden='fecha desc'}
         {/case}
    {/switch}
{/if}

{def $damevaloraciones = fetch('producto','damevaloraciones', hash( 'orden', $orden,'limite' ,$limite, 'offset', $offset) )} 

{def $cuantasvaloraciones=fetch('producto','damevaloraciones', hash( 'orden', $orden,'limite' ,0, 'offset', 0))}

{include name=navigator
									uri='design:navigator/google.tpl'
									page_uri= 'valoraciones/view'
                                    page_uri_suffix=concat('?sort_by=',$sort_by)
									item_count=$cuantasvaloraciones|count()
									view_parameters=$params
									item_limit=$limite}  
   					
    						<table class="list" cellspacing="0">
								<tr>
									<th>Usuario</th>
			                        <th>
                                    {if $sort_by|eq('fechadesc')}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=fechaasc" )|ezurl}>{else}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=fechadesc" )|ezurl}>
                                    {/if}
                                    Fecha
                                    </a>
                                    </th>
									<th>
                                    {if $sort_by|eq('productodesc')}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=productoasc" )|ezurl}>{else}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=productodesc" )|ezurl}>
                                    {/if}
                                    Producto
                                    </a>
                                    </th>
									<th>Valoraciones</th>
									<th width="30%">Comentario</th>
                                    <th>
                                     {if $sort_by|eq('estadodesc')}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=estadoasc" )|ezurl}>{else}
                                    <a href={concat("/valoraciones/view",'/(offset)/' ,$offset,"?sort_by=estadodesc" )|ezurl}>
                                    {/if}
                                    Estado
                                    </a>
                                    </th>
								</tr>
                                <form method="post" name="modificarvaloraciones" action={'valoraciones/modificar'|ezurl} >
                                
	    						{foreach $damevaloraciones as $valoracion}	
									{def $nombre_producto=fetch('content', 'node' , hash('node_id', $valoracion.node_producto))}	
                                        <tr bordercolor="#CCCCCC">
                                        	<td>{$valoracion.nombre} {$valoracion.apellidos}
                                            <br />
                                            {$valoracion.empresa}
                                            </td>
                                            <td>{$valoracion.fecha|datetime('custom', '%d.%m.%Y  %H:%i'  )}</td>
                                            <td><a href={$nombre_producto.url_alias|ezroot()}>{$nombre_producto.name}</a></td>
                                            <td>
                                               {def $im=concat("image_valoracion_",$valoracion.calidad, ".gif")}
                                              	Q:<img src={$im|ezimage()} alt="" class="frt" />
                                                {undef $im}
                                                <br />
                                            	{def $im=concat("image_valoracion_",$valoracion.actualizaciones, ".gif")}
                                                A:<img src={$im|ezimage()} alt="" class="frt" />
                                                {undef $im}
												<br />
                                                {def $im=concat("image_valoracion_",$valoracion.facilidad, ".gif")}
                                                F:<img src={$im|ezimage()} alt="" class="frt" />
                                                {undef $im}
                                             </td>
                                            <td>{$valoracion.comentario}</td>
                                            <td>
                                            {*$valoracion.visible*}
                                            <select id="{concat('visible_',$valoracion.node_producto,'_', $valoracion.user_id)}" name="{concat('visible_',$valoracion.node_producto,'_', $valoracion.user_id)}">
                                            	<option value="2" {if $valoracion.visible|eq('2')}selected="selected"{/if}>Pendiente</option>
                                            	<option value="1" {if $valoracion.visible|eq('1')}selected="selected"{/if}>Aprobado</option>
                                                <option value="0" {if $valoracion.visible|eq('0')}selected="selected"{/if}>Denegado</option>
											</select>	
                                             </td>
                                        </tr>
                              {undef $nombre_producto}
                              {/foreach}      
                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                            
      									  <input type="submit" title="Pulsa este botón para guardar los cambios si has modificado alguno de los campos de arriba." value="Aplicar cambios" name="SaveOrderStatusButton" class="button">
                                          
                            </td></tr>              
  							     </form>
							</table>
                       
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
