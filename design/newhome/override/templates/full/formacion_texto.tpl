{ezpagedata_set( 'menuoption', 3 )}  

    <div id="commonGrid" class="clearFix">
    
        <div id="subNavBar">
            <div class="currentSection"><a href={$node.url_alias|ezurl()}><span>{$node.parent.name}</span></a></div>
            <ul>
                {include uri='design:formacion/menu.tpl' check=$node.parent actual=$node}
            </ul>
        </div>
    
        
        <div id="content" class="valores">
            <div id="moduloDestacadoContenido">
                <h1 class="mainTitle">{$node.name}</h1>
                <div class="wrap">
                    <div class="inner">
                        <div class="wysiwyg">
                             <div class="attribute-cuerpo">
                                   {$node.data_map.description.content.output.output_text}
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
