{ezscript_require( array( 'asociacion_colectivo.js' ) )}

{def $groups = fetch( 'content', 'list', hash( 'parent_node_id', 411,
                                                                                                           'limitation', array(),
                                                                                                           'as_object', false()

                                                            ))}
                                                            <select name="groups" id="groups" >
                                                                <option value=""></option>
                                                                {foreach $groups as $group}
                                                                <option value="{$group.name}">{$group.name}</option>
                                                                {/foreach}
                                                            </select>    
                                                            {undef $groups}
{default attribute_base='ContentObjectAttribute' html_class='full'}
{let data_text=cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}
<input class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )}" type="hidden" size="70" name="{$attribute_base}_ezstring_data_text_{$attribute.id}" value="{$data_text|wash( xhtml )}" id="asociacion_colectivo" />
{/let}
{/default}
