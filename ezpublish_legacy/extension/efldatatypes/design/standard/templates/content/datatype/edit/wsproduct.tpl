{ezcss_require( array( 'ui-lightness/jquery-ui-1.10.4.custom.min.css', 'wsproducts.css' ))}
{ezscript_require( array( 'jquery-ui-1.10.3.custom.min.js', 'wsproduct_jquery.js' ))}
{default attribute_base='ContentObjectAttribute'
html_class='full'}
    {def $value = $attribute.data_text|wash( xhtml )|explode('|')}
    <input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}" class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )} ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier} autocomplete" type="text" size="70" name="{$attribute_base}_ezstring_data_text_{$attribute.id}" value="{$value.1}" />
    <input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}_id" class="product-id" type="hidden" name="{$attribute_base}_ezstring_data_int_{$attribute.id}" value="{$value.0}" />
    {undef $value}
{/default}
