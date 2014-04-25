<div id="gridWide">                
    <div id="moduloDestacadoContenido" class="type1 type1b">                               
        <h1>{attribute_view_gui attribute=$node.data_map.nombre} <span class="subTit twoLines">{$node.data_map.subtitulo.content.output.output_text|strip_tags()}</span></h1>
        <div class="wrap">
            <div class="inner">
                <div class="wysiwyg">
                    <div class="attribute-cuerpo clearFix">
                    
                        <div class="object-left column1">
                            <div class="content-view-embed">
                                <div class="class-image">
                                    <div class="attribute-image">                                 
                                        <img src={$node.parent.data_map.area.content.data_map.birrete.content.fichaproducto.url|ezroot} alt="" />
                                    </div>                                                                                  
                                </div>
                            </div>
                            {if $node.data_map.programa_experto.content|eq(1)}
                             <div class="pexperto">Programa Experto</div>
                            {/if}
		            {if $node.data_map.curso_subvencionable.content|eq(1)}
 <div class="pexperto" style="text-align:left"><span style="color:maroon">¡CURSO SUBVENCIONADO!</span><br/> <a href={fetch( 'content', 'node', hash( 'node_id', 172)).url_alias|ezurl} style="color:#4B90CC; font-weight:normal">Sepa por qué.</a></div>
                            
{/if}

                        </div>

                        <div class="column2">
                            {$node.data_map.entradilla.content.output.output_text}
                            
                            {if and( $node.data_map.precio.content.has_discount, $node.data_map.fecha_fin_oferta.has_content)}
                                <div class="clearFix linksModulo">
                                    <span class="oferta">¡Oferta válida sólo hasta el {attribute_view_gui attribute=$node.data_map.fecha_fin_oferta}!</span> 
                                </div>
                            {/if}
                        </div>
                                   
                        <div class="column3">                                    
                            <div class="precios">
                                {if $node.data_map.precio.content.has_discount}
		<!--
                              {$node.data_map.precio.content|attribute(show)} 
-->
                                    <div class="descuentoType1"><span>{$node.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}&euro;</span> + IVA</div>
                                {/if}
                                {if $node.data_map.precio.has_content}
                                    <div class="antes">{if $node.data_map.precio.content.has_discount}Antes {/if}<span>{$node.data_map.precio.content.ex_vat_price|l10n(clean_currency)} &euro;</span> + IVA</div>
                                {/if}
                            </div>
                                        
                            <a href={concat( "basket/add/", $node.object.id, '/1')|ezurl_www} class="ejemplar"><img src={'btn_quieroestecurso.png'|ezimage} alt="Quiero este curso" /></a>
                            <div id="modInformacion">
                                <h2><img src={'bck_modInformacionTit.gif'|ezimage} alt="¿Necesita información?" /></h2>
                            <div>
                            
                            <span class="verMas"><a href={"formularios/contacto-formacion"|ezurl_www()}>Nosotros nos ponemos en contacto con usted</a></span>
                            
                        </div>

                     </div>
                    {if $node.data_map.curso_medida.content|eq(1)}
                    <span class="link"><a href={"formacion-in-company"|ezurl}>Adapte este curso a su empresa</a></span>
                    {/if}
                    {if and( $node.data_map.curso_medida.content|eq(1), or( $node.object.contentclass_id|eq(61), $node.object.contentclass_id|eq(66) ) )}
                             <span class="link" style="margin-top: 10px"><a href="http://lefebvre.verticelearning.com/" target="_blank"><img src={"btn_campus_virtual.png"|ezimage} alt="Acceso al campus virtual"/></a></span>
                    {/if}
                 </div>
             </div>
        </div>
    </div>
</div>
