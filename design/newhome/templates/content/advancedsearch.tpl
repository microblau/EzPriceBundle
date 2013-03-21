{* Load JavaScript dependencys + JavaScriptList *}
{ezscript_load( array( ezini( 'JavaScriptSettings', 'JavaScriptList', 'design.ini' ), ezini( 'JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini' ) )|prepend( 'ezjsc::jquery', 'ezjsc::jqueryio' ) )}
{literal}
<script type="text/javascript">
﻿(function ($) {
	$(document).ready( function()
	{
		$("#buscar").focus();
	});
})(jQuery);
</script>
{/literal}
{def $filter = array('and')}
{if ezhttp_hasvariable( 'areas', 'get')}
{def $areafilter=array( 'or' )}
{foreach ezhttp( 'areas', 'get' ) as $area}

{set $areafilter = $areafilter|append( concat( 'submeta_area___id_si:', $area ) ) }
{/foreach}
{/if}
{if $areafilter|count|gt(1)}
{set $filter = $filter|append( $areafilter )}
{/if}

{if ezhttp_hasvariable( 'sectores', 'get')}

{def $sectorfilter=array( 'or' )}
{foreach ezhttp( 'sectores', 'get' ) as $sector}

{set $sectorfilter = $sectorfilter|append( concat( 'submeta_sector___id_si:', $sector ) ) }
{/foreach}
{/if}
{if $sectorfilter|count|gt(1)}
{set $filter = $filter|append( $sectorfilter )}
{/if}

{if and( ezhttp_hasvariable( 'fecha_publicacion', 'get'), ezhttp( 'fecha_publicacion', 'get')|ne(''))}

    {set $filter=$filter|append( concat( 'attr_fecha_aparicion_dt:[* TO ', ezhttp('fecha_publicacion','get'),'-01-01T00:00:00Z]' ) ) }
{/if}

{def $subtree_array=cond( ezhttp_hasvariable( 'obras', 'get' ), ezhttp( 'obras', 'get') , array( 61, 43 ) )}
{def $subtree = concat( '&', 'obras[]'|urlencode, '=', $subtree_array|implode( concat( '&', 'obras[]'|urlencode, '=' ) ) ) )}
{set $filter = $filter|append('-meta_is_invisible_b:1') }


 {if ezhttp_hasvariable( 'SearchText', 'get' )}
                                            {def $results = fetch( ezfind, search, hash( 
                                                            query, ezhttp( 'SearchText', 'get'),
                                                            'limit', ezhttp( 'numItems', 'get'),
 'class_id', array( 48, 101, 99, 98, 66, 49, 61, 94, 64, 28 ,147 ,142,145,149 ),
                                                            'offset', $view_parameters.offset,
                                                            'subtree_array', cond( ezhttp_hasvariable( 'obras', 'get' ), ezhttp( 'obras', 'get') , array( 2 ) ),                                                           
                                                       'filter', $filter,
														'ignore_visibility', false()													   
                                                    ) )}
                                                    
                                         
                                            
                                            {/if}
		
			
		
			<div id="gridTwoColumnsTypeB" class="clearFix">
				<div class="columnType1">
					<div id="modType2">
						
							<h1>Búsqueda Avanzada</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
										<div id="busquedaAvanzada">
											 
											<form  action={"content/advancedsearch"|ezurl} method="get"  id="busquedaAvanzadaForm" name="busquedaAvanzadaForm">
											
												<span class="camposObligatorios">* Datos obligatorios</span>

												<label for="buscar" class="termSearch">Buscar 
                                                <!--input type="text" class="text" id="buscar" name="SearchText" /-->
												{include uri='design:ngsuggest/searchfield.tpl' form_id="busquedaAvanzadaForm" search_id="buscar"  search_name="SearchText" }
                                                </label>

                                                {if $results.SearchCount|gt(0)}            
                                            <span class="searchTerm">Resultado de la búsqueda <strong>
{$view_parameters.offset|sum(1)}
- {min( $view_parameters.offset|sum(10), $results.SearchCount )}</strong> de <strong>{$results.SearchCount}</strong> para <strong>{ezhttp( 'SearchText', 'get')}</strong></span>
                                            {/if}
                                                <fieldset>
													<legend><span>En las siguientes obras</span></legend>
				                                    {def $subfolders = fetch( 'content', 'list', hash( 'parent_node_id', 61,
  'class_filter_type', 'include',
  'class_filter_array', array( 'folder' ),
  'sort_by', array( 'priority', true() )  
))}
													<ul>
                                                        {foreach $subfolders as $subfolder }
														<li>
															<input type="checkbox" id="obras{$subfolder.node_id}" name="obras[]" value="{$subfolder.node_id}" {if ezhttp( 'obras', 'get')|contains( $subfolder.node_id)}checked="checked"{/if}/>
															<label for="obras{$subfolder.node_id}">{$subfolder.name}</label>

														</li>
                                                        {/foreach}
														
													</ul>											  	
												</fieldset>
												
												<fieldset>
													<legend><span>En obras de interés</span></legend>

				
													<ul>


													{def $areas_interes =fetch( 'content','list', hash( 'parent_node_id',  143))}
													{foreach $areas_interes as $index => $area}
														
														<li>
															<input type="checkbox" id="area{$area.object.id}" name="areas[]" value="{$area.object.id}" {if ezhttp( 'areas', 'get')|contains( $area.object.id) }checked="checked"{/if}/>
															<label for="area{$area.object.id}">{$area.data_map.nombre.content}</label>
														</li>
													{/foreach}




														
													</ul>															
												</fieldset>
												
												<fieldset>
													<legend><span>Buscar elementos en </span></legend>

				
													<ul>
														<li>
															<input type="checkbox" id="sumarios" name="archivos" value="1"/>
															<label for="sumarios">Sumarios y Tablas alfabéticas</label>
														</li>
														
														
													</ul>															
												</fieldset>
												
												<fieldset>
													<legend><span>En obras del sector de</span></legend>
				
													<ul>
														{def $sectores =fetch( 'content','list', hash( 'parent_node_id',  157))}
													{foreach $sectores as $index => $sector}
														
														<li>
															<input type="checkbox" id="sector{$sector.object.id}" name="sectores[]" value="{$sector.object.id}" {if ezhttp( 'sectores', 'get')|contains( $sector.object.id)}checked="checked"{/if}/>
															<label for="sector{$sector.object.id}" >{$sector.data_map.nombre.content}</label>
														</li>
													{/foreach}
														
													</ul>															
												</fieldset>
											
											<label for="obras" class="tipoObras">En obras publicadas antes de  <select id="obras" name="fecha_publicacion">

								<option value="">Selecciona</option>	
								{for currentdate()|datetime( 'custom', '%Y' )  to 2009 as $counter}
 
								    <option value="{$counter}" {if $counter|eq( ezhttp( 'fecha_publicacion', 'get') )}selected="selected"{/if}>{$counter}</option>
								 
								{/for}

								
</select>

											</label>
											
											<span class="submit"><input type="image" src={"btn_buscar.gif"|ezimage} alt="buscar" /></span>
											
											</form>
										
										</div>

                                        
                                            {include name=navigator
                                                 uri='design:navigator/google.tpl'
                                                 page_uri='/content/advancedsearch'
                                                 page_uri_suffix=concat('?SearchText=',$search_text,'&numItems=',ezhttp( 'numItems', 'get'),'&obras=',$subtree)
                                                 item_count=$results.SearchCount
                                                 view_parameters=$view_parameters
                                                 item_limit=cond( ezhttp_hasvariable( 'numItems', 'get'), ezhttp( 'numItems', 'get'), 10 )}
                                                
                                                <ul id="listResults">

                                                    {foreach $results.SearchResult as $index => $resultado}

                                                
                                                    {if $resultado.class_name|eq('Archivo')}   
                                                   
                                                       {def $objects = fetch( 'content', 'reverse_related_objects', hash( 'object_id',            $resultado.object.id, 
      'all_relations', true()

))}

<!--si tiene relaciones-->
{if $objects|count()|ne(0)}

                                                       <li>
                                                         <h2><!--[PDF] --><a href={$objects.0.main_node.url_alias|ezurl}>{$objects.0.main_node.name}</a>
                                                          <!--lo quiero-->
                              {if $objects.0.main_node.class_identifier|eq('producto_mementix')}
                             	  <a href={concat( 'basket/mementix')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if $objects.0.main_node.class_identifier|eq('producto')}
                                  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton loQuiero" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>         {/if}
                               {if$objects.0.main_node.class_identifier|eq('producto_nautis4')}
                                  <a href={$resultado.url_alias|ezurl} class="boton" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if$objects.0.main_node.class_identifier|eq('curso_distancia')}
                             	  <a href={concat( 'basket/ajaxadd/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                {if $objects.0.main_node.class_identifier|eq('curso_presencial')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                 {if $objects.0.main_node.class_identifier|eq('curso_blended')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                
								{if $objects.0.main_node.class_identifier|eq('producto_qmementix')}
                             	  <a href={concat( 'basket/qmementix')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_qmementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
								
                               <!--fin lo quiero-->  
                              
                                                        </h2>
                                                        <div class="wysiwyg">
                                                            <div class="attribute-cuerpo">
                                                                <p>Formato de archivo: PDF/Adobe Acrobat - Vista</p>

                                                            
                                                                {*$resultado.highlight*}
                                                            </div>
                                                        </div>                                                  
                                                    </li>
                                                    {/if}<!--si tiene relaciones-->
                                                    {else}
                                                    <li>
                                                        {if array( 60, 100 )|contains( $resultado.object.contentclass_id)}
                                                            {if $resultado.path.1.node_id|eq(62)}
                                                             <h2><a href={$resultado.parent.url_alias|ezurl_formacion}>{$resultado.name}</a></h2>
                                                            {else}
                                                            <h2><a href={$resultado.parent.url_alias|ezurl}>{$resultado.name}</a></h2>
                                                            {/if}
                                                        {else}
                                                        <h2><a href={$resultado.url_alias|ezurl}>{$resultado.name}</a>
                                                                                           
                              <!--lo quiero-->
                              {if $resultado.class_identifier|eq('producto_mementix')}
                             	  <a href={concat( 'basket/mementix')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if $resultado.class_identifier|eq('producto')}
                                  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton loQuiero" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>         {/if}
                               {if $resultado.class_identifier|eq('producto_nautis4')}
                                  <a href={$resultado.url_alias|ezurl} class="boton" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if $resultado.class_identifier|eq('curso_distancia')}
                             	  <a href={concat( 'basket/ajaxadd/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                {if $resultado.class_identifier|eq('curso_presencial')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                 {if $resultado.class_identifier|eq('curso_blended')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
							   {if $resultado.class_identifier|eq('producto_qmementix')}
                             	  <a href={concat( 'basket/qmementix')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_qmementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                
                               <!--fin lo quiero-->  
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        </h2>
                                                        {/if}
                                                        <div class="wysiwyg">
                                                            <div class="attribute-cuerpo">
                                                                {$resultado.highlight}

                                                            </div>
                                                        </div>
                                                    
                                                    </li>
                                                    {/if}
                                                    {/foreach}
                                                
                                                
                                                </ul>
                                            
                                                {include name=navigator
                                                 uri='design:navigator/google.tpl'
                                                 page_uri='/content/advancedsearch'
                                                 page_uri_suffix=concat('?SearchText=',$search_text,'&numItems=',ezhttp( 'numItems', 'get'),'&obras=',$subtree)
                                                 item_count=$results.SearchCount
                                                 view_parameters=$view_parameters
                                                 item_limit=10}
                                                
								
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
				
			
		
			
		
		
	
		
