<div id="moduloDestacadoContenido">
    <h1 class="mainTitle">{$block.valid_nodes.0.name}</h1>                               
        <div class="wrap">
            <div class="inner clearFix">
                <div class="wysiwyg">

                    <div class="attribute-cuerpo clearFix">

                    
                        <div class="object-left column1">
                            <div class="content-view-embed">
                                <div class="class-image">
                                    <div class="attribute-image priceCont">
                                    
                                         <img src={$block.valid_nodes.0.parent.data_map.area.content.data_map.birrete.content.fichaproducto.url|ezroot} alt="" />
                                     <div class="descuentoType1"><span>{if $block.valid_nodes.0.data_map.precio.content.has_discount}{$block.valid_nodes.0.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}{else}{$block.valid_nodes.0.data_map.precio.content.price|l10n(clean_currency)}{/if}€</span> + IVA</div>

                                    </div>                                                                                  
                                </div>
                            </div>
                        </div>
                        
                        <div class="column2">                                            
                                {$block.valid_nodes.0.data_map.entradilla.content.output.output_text}
                            <div class="clearFix linksModulo">
                                <span class="verMas flt"><a href={$block.valid_nodes.0.url_alias|ezurl}>Quiero saber más</a></span>
                                <a href={concat( "basket/add/", $block.valid_nodes.0.object.id, '/1')|ezurl} class="frt"><img src={"btn_quieroestecurso.png"|ezimage()} alt="quiero este curso" /></a>
                            </div>
                        </div>                                  
                    </div>
                </div>
            </div>
        </div>                                                                                                                                          
</div>
