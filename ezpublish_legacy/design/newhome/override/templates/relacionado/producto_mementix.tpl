

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
    <span class="precio">{if $node.data_map.precio.content.has_discount}<s>{/if}{$node.data_map.precio.content.price|l10n(clean_currency)} €{if $node.data_map.precio.content.has_discount}</s>{/if}
    {if $node.data_map.precio.content.has_discount}<span class="preciooferta">{$node.data_map.precio.content.discount_price_ex_vat|l10n('clean_currency')} €</span>{/if}
    </span>
</div>
