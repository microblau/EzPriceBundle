{* Load JavaScript dependencys + JavaScriptList *}
{ezscript_load( array( ezini( 'JavaScriptSettings', 'JavaScriptList', 'design.ini' ), ezini( 'JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini' ) )|prepend( 'ezjsc::jquery', 'ezjsc::jqueryio' ) )}
<div id="gridTwoColumnsTypeB" class="clearFix">
                <div class="columnType1">
                    <div id="modType2">
                        
                            <h1>Resultados de búsqueda</h1>
                            <div class="wrap clearFix">
                                                        
                                    <div class="description">
                                        <div id="resultadosBusquedaPage">
                                       
                                        {if ezhttp_hasvariable( 'SearchText', 'get' )}
                                            {def $results = fetch( ezfind, search, hash( 
                                                            query, ezhttp( 'SearchText', 'get'),
                                                            'class_id', array( 48, 101, 99, 98, 66, 49, 61, 94, 64, 28 ),
                                                            'limit', ezhttp( 'numItems', 'get'),
                                                            'offset', $view_parameters.offset,
                                                            subtree_array, cond( ezhttp_hasvariable( 'SubTreeArray', 'get' ), ezhttp( 'SubTreeArray', 'get') , array( 61, 43 ) ),                                                           
                                                            
                                                    ) )}
                                                    
                                         
                                            
                                            {/if}
                                            
 
                                                   
                                            
                                            <form action={"content/search"|ezurl} method="get" id="searchResultsForm" name="searchResultsForm" class="searchResultsForm">


                                            

                                            <div class="unamodif">
                                            


                                            

                                                <label for="searchTerm">
                                                
            <!--input type="text" id="SearchText" name="SearchText" class="text" value="{ezhttp( 'SearchText', 'get')}" /-->

            {include uri='design:ngsuggest/searchfield.tpl' form_id="searchResultsForm" search_id="SearchText"  search_name="SearchText" }
            
            
            
            </label>
                                                <span class="submit"><input type="image" alt="buscar" src={"btn_buscar.gif"|ezimage}/></span>
                                                <span class="verMas"><a href={"content/advancedsearch"|ezurl}>Búsqueda avanzada</a></span>
                                            </div>
                                            

                                            {if $results.SearchCount|gt(0)}            
                                            <span class="searchTerm">Resultado de la búsqueda <strong>
{$view_parameters.offset|sum(1)}
- {cond( ezhttp_hasvariable( 'numItems', 'get' ),
         min( $view_parameters.offset|sum(ezhttp('numItems', 'get')), $results.SearchCount ), 
     max( 0, $results.SearchCount ) )}</strong> de <strong>{$results.SearchCount}</strong> para <strong>{ezhttp( 'SearchText', 'get')}</strong></span>
                                            {/if}
                                            

                                            

                                            
                                            
                                            <div id="numResults" class="numResults">

                                            <label for="numItems">Nº de resultados por página <select id="numItems" name="numItems">
                                                

                                                <option {if $numItems|ne('')}selected="selected"{/if} {if  ezhttp( 'numItems', 'get')|eq(10)}selected="selected"{/if}value="10">10</option>
                                                <option value="15" {if  ezhttp( 'numItems', 'get')|eq(15)}selected="selected"{/if}>15</option>
                                                <option  value="20" {if  ezhttp( 'numItems', 'get')|eq(20)}selected="selected"{/if}>20</option>                                               
                                                <option  value="25" {if  ezhttp( 'numItems', 'get')|eq(25)}selected="selected"{/if}>25</option>
                                                <option  value="50" {if  ezhttp( 'numItems', 'get')|eq(50)}selected="selected"{/if}>50</option>
                                                </select></label>
                                                <span class="submit"><input type="image" alt="ir1" src={"btn_ir.gif"|ezimage} name="image1"/></span>
                                            
                                            
                                            </div>
                                            
                                            <div id="definirResultados">
                                                    
                                                    <div>                                           


                                                    <span class="title">Define mejor los resultados {if $SearchText|count|gt(0)}para <strong>{$SearchText}</strong>{/if}:</span>
                                                    <ul class="clear">
                                                        {def $folders = fetch('content', 'list', hash('parent_node_id', 61,
                                                                                                      'sort_by', array( 'name', true() ),
                                                                                                      'class_filter_type', 'include',
                                                                                                      'class_filter_array', array( 'folder' )    
                                                                               
                                                         ))}
                                                         {foreach $folders as $folder}
                                                           <li class="flt">
                                                            <input type="checkbox" id="folder_{$folder.node_id}" name="SubTreeArray[]" value="{$folder.node_id}" {if $search_subtree_array|contains($folder.node_id)}checked{/if}/>
                                                            <label for="folder_{$folder.node_id}">{$folder.name}</label>
                                                        </li>
                                                         {/foreach}                 
                                                        

                                                        
                                                        
                                                    </ul>
                                                    <div style="text-align:center"><span class="submit"><input type="image" alt="ir2" src={"btn_ir.gif"|ezimage} name="image2"/></span></div>
                                                    
                                                    </div>
                                                
                                                
                                                
                                                
                                            
                                            </div>  
                                            
                                            


                                            {include name=navigator
                                                 uri='design:navigator/google.tpl'
                                                 page_uri='/content/search'
                                                 page_uri_suffix=concat('?SearchText=',$search_text,'&numItems=',ezhttp( 'numItems', 'get'))
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
                                                        <h2>[PDF] <a href={$objects.0.main_node.url_alias|ezurl}>{$resultado.name}</a> ({$objects.0.name})
                                                          <!--lo quiero-->
                              {if $objects.0.main_node.class_identifier|eq('producto_mementix')}
                             	  <a href={concat( 'basket/mementix')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if $objects.0.main_node.class_identifier|eq('producto')}
                                  <a href={concat( 'basket/ajaxadd/', $objects.0.id, '/1')|ezurl} class="boton loQuiero" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>         
                               {/if}
                               {if $objects.0.main_node.class_identifier|eq('producto_nautis4')}
                                  <a href={$resultado.url_alias|ezurl} class="boton" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                               {if $objects.0.main_node.class_identifier|eq('curso_distancia')}
                             	  <a href={concat( 'basket/ajaxadd/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                {if $objects.0.main_node.class_identifier|eq('curso_presencial')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
                               {/if}
                                 {if $objects.0.main_node.class_identifier|eq('curso_blended')}
                             	  <a href={concat( 'basket/add/', $resultado.object.id, '/1')|ezurl} class="boton {if $resultado.class_identifier|eq('producto_mementix')|not}loQuiero{/if}" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>
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
                                  <a href={concat( 'basket/ajaxadd/', $resultado.object.id, '/1')|ezurl} class="boton loQuiero" style="padding-left:15px;"><img src={"btn_lo-quiero.png"|ezimage} alt="Lo quiero" /></a>         {/if}
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
                                                 page_uri='/content/search'
                                                 page_uri_suffix=concat('?SearchText=',$search_text,'&numItems=',ezhttp( 'numItems', 'get'))
                                                 item_count=$results.SearchCount
                                                 view_parameters=$view_parameters
                                                 item_limit=cond( and( ezhttp_hasvariable( 'numItems', 'get'), ezhttp( 'numItems', 'get')|ne('') ), ezhttp( 'numItems', 'get'), 10 )}
                                                


                                           
                                            



                                                
                                            </form>
                                        
                                                                    
                                            
                                        
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
                
