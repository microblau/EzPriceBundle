<div id="gridType3">
                                                    
                        <div class="wrap clearFix">
                        
                            {if $node.data_map.productos_relacionados.has_content}
                            <div class="columnType1 flt">
                            
                               
                                <h2>Obras recomendadas</h2>
                                                                 
                                <div class="wrapColumn">                                                                                        
                                    <div class="inner">
                                        <ul class="clearFix">
                                        
                                            {foreach $node.data_map.productos_relacionados.content.relation_browse as $index => $productos}
                                            <li {if eq($index, $node.data_map.productos_relacionados.content.relation_browse|count|sub(1))}class="reset"{/if}>
                                            {let $producto=fetch('content','node', hash('node_id',$productos.node_id))}
                                            {if $producto.data_map.imagen.has_content}
                                                {def $image= fetch( 'content', 'object', hash( 'object_id', $producto.data_map.imagen.content.relation_browse.0.contentobject_id))}
                                                <div class="image flt">
                                                    <img src={$image.data_map.image.content.otraspublicaciones.url|ezroot} alt="" />
                                                </div>
                                                {undef $image}
                                            {else}
                                                  {def $image= fetch( 'content', 'object', hash( 'object_id', 2084 ))}
                                                <div class="image flt">
                                                    <img src={$image.data_map.image.content.otraspublicaciones.url|ezroot} alt="" />
                                                </div>
                                                {undef $image}
                                            {/if}
                                                <div class="description frt">
                                                    <h3><a href="{$producto.url_alias|ezurl_www(no)}">{$producto.data_map.nombre.content}</a></h3>
                                                    {if $producto.data_map.subtitulo.has_content}
                                                    <p>{$producto.data_map.subtitulo.content}</p>
                                                    {/if}
                                                    <span class="precio">{$producto.data_map.precio.content.price|l10n(clean_currency)} €</span>
                                                </div>
                                            {/let}
                                            </li>
                                            {/foreach}
                                         </ul>
                                        <span class="verMas"><a href={"catalogo/formato/papel"|ezurl_www}>Ver más publicaciones que le interesan</a></span>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            {/if}

                            {if $node.data_map.productos_relacionados_2.has_content}
                            
                            <div class="columnType2 frt">   
                                <h2>¿Prefiere trabajar online?</h2>                                    
                                <div class="wrapColumn">                                            
                                    <div class="inner clearFix">
                                        <ul class="borde">
                                            <li>
                                            
                                            {def $producto=fetch('content','node',hash('node_id',$node.data_map.productos_relacionados_2.content.relation_browse.0.node_id))}
                                                  {if $producto.data_map.imagen.has_content}
                                                {def $image= fetch( 'content', 'object', hash( 'object_id', $producto.data_map.imagen.content.relation_browse.0.contentobject_id))}
                                                <img src={$image.data_map.image.content.otraspublicaciones.url|ezroot} alt="" />
                                                {undef $image}
                                                {else}
                                                  {def $image= fetch( 'content', 'object', hash( 'object_id', 2084))}
                                                     <img src={$image.data_map.image.content.otraspublicaciones.url|ezroot} alt="" />
                                                   {undef $image}
                                                {/if}
                                                <div class="description">
                                                    <h3><a href="{$producto.url_alias|ezurl_www(no)}">{$producto.data_map.nombre.content}</a></h3>

                                                    {if $producto.data_map.subtitulo.has_content}
                                                    <p>{$producto.data_map.subtitulo.content}</p>
                                                    {/if}
                                                    {if $producto.class_identifier = 'producto_nautis')}
        {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $producto.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}                                         	                                    	
                                            	<div class="precioIva">Desde {if $versiones.0.data_map.precio.content.has_discount}<s>{/if}{$$versiones.0.data_map.precio.content.price|l10n(clean_currency)} € + IVA{if $versiones.0.data_map.precio.content.has_discount}</s>{/if}
{if $versiones.0.data_map.precio.content.has_discount}<br /><span class="price_offer">{$versiones.0.data_map.precio.content.discount_price_ex_vat|l10n(clean_currency)}  € <span class="iva">+ IVA</span></span>{/if}</div>
                                                    {else}
                                                    <span class="precio">{$producto.data_map.precio.content.price|l10n(clean_currency)} €</span>
                                                    {/if}
                                                </div> 
                                                <span class="verMas"><a href={"catalogo/formato/digital"|ezurl_www}>Ver más productos online que le interesan</a></span>
                                            {/undef $producto}
                                            </li>
                                        </ul>                                    
                                    </div>
                                </div>

                            </div>
                            {/if}
                            
                            
                        </div>
                    </div> 
