{def $subareas = fetch('content', 'list', hash( 'parent_node_id', $node.node_id,
                                'class_filter_type', 'include',
                                'class_filter_array', array( 'folder' ),
                                'sort_by', $node.sort_array
))}
{*$subareas.0.url_alias|redirect()*}
{if $view_parameters.area|not}
{"http://formacion.efl.es/formacion/por-que-elegirnos/ponentes/(area)/fiscal/(id)/520"|redirect()}
{/if}
{ezpagedata_set( 'menuoption', 3 )}  

    <div id="commonGrid" class="clearFix">
    
        <div id="subNavBar">
            <div class="currentSection"><a href={$node.url_alias|ezurl()}><span >{$node.parent.name}</span></a></div>
            <ul>
                {include uri='design:formacion/menu_area.tpl' check=$node.parent actual=$node.name|normalize_path()|explode('_')|implode('-')}
            </ul>
        </div>
        
        <div id="content" class="valores">
            <ul id="listadoValores">
                {def $ponentes=fetch('content','tree',hash('parent_node_id',$view_parameters.id))}  
                {foreach $ponentes as $ponente}    
                        <li>
                            <div class="valor">
                                <h2>{$ponente.data_map.nombre.value}</h2>
                                <div class="wrap">
                                    <div class="inner clearFix">
                                        <div class="wysiwyg">
                                            <div class="attribute-cuerpo">
                                                {if $ponente.data_map.foto_ponente.has_content}
                                                <div class="object-left">
                                                    <div class="content-view-embed">
                                                        <div class="class-image">
                                                            <div class="attribute-image">     
                                                                {def $image = fetch( 'content', 'object', hash( 'object_id' , $ponente.data_map.foto_ponente.content.relation_browse.0.contentobject_id))}                  
       
                                                              
                                                                <img src={$image.data_map.image.content.listadoproductos.url|ezroot} alt="{$image.data_map.image.content.alternative_text}" />
                                                                {undef $image}
                                                            </div>                                                                                  
                                                        </div>
                                                    </div>
                                                </div>
                                                {/if}
                                                
                                                <span><strong>{$ponente.data_map.cargo.value}</strong></span>.
                                                <span>{$ponente.data_map.empresa.value}</span>
                                                                  
                                                {$ponente.data_map.informacion_ponente.content.output.output_text}
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>  
                        </li>
                 {/foreach}                        
              </ul>
        </div>
    </div>

    
