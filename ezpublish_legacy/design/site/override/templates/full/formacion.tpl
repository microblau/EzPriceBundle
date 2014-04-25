{ezpagedata_set( 'menuoption', 3 )}      
<div id="commonGrid" class="clearFix">
                
                <div id="subNavBar">
                
                    <span class="currentSection">Todas las obras</span>

                    <ul>
                        {def $folders = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id, 
                                                                        'class_filter_type', 'include',
                                                                        'class_filter_array', array( 'folder' ),
                                                                        'sort_by', $node.sort_array,
                                                                        'attribute_filter', array( array( 'priority', '<', 100 ) )
                                                            ))
                        }
                        {foreach $folders as $folder }
                        <li><a href={$folder.url_alias|ezurl()}>{$folder.name}</a></li>
                        {/foreach}
                    </ul>
                </div>
            
                
                <div id="content">              
                    {attribute_view_gui attribute=$node.data_map.zona_central}                      
                </div>
            </div>