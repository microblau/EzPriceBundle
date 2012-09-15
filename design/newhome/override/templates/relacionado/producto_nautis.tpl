

{if $node.data_map.imagen.has_content}

{def $imagen = fetch( 'content', 'object', hash( 'object_id', $node.data_map.imagen.content.relation_browse.0.contentobject_id ))}                                    
             
<div class="image">
	<img src={$imagen.data_map.image.content.otraspublicaciones.url|ezroot()} alt="" />
</div>
{undef $imagen}
{else}
{def $imagen = fetch( 'content', 'object', hash( 'object_id', 2084 ))}                                    
                     
<div class="image">
	<img src={$imagen.data_map.image.content.otraspublicaciones.url|ezroot()} alt="" />
</div>
{undef $imagen}
{/if}
<div class="description">
	<h3><a href={$node.url_alias|ezurl()}>{$node.name}</a></h3>
    <p>{$node.data_map.subtitulo.content}</p>    
    
     {def $versiones = fetch( 'content', 'list', hash( 'parent_node_id', $node.node_id,
                                                                                  'class_filter_type', 'include',
                                                                                  'class_filter_array', array( 100 ),
                                                                                  'sort_by', array( array( 'attribute', true(), 852 ),
                                                                                                    array( 'attribute', true(), 851  )
                                                                                                )
                                                                                    ))}
{*

    <span class="precio">Desde {if $versiones.0.data_map.precio.content.has_discount}<s>{/if}{$versiones.0.data_map.precio.content.price|l10n(clean_currency)} €{if $versiones.0.data_map.precio.content.has_discount}</s>{/if}
    {if $versiones.0.data_map.precio.content.has_discount}<span class="preciooferta">{$versiones.0.data_map.precio.content.discount_price_ex_vat|l10n('clean_currency')} €</span>{/if}
    </span>
*}

</div>
