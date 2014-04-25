{ezscript_require( array( 'provincia_formulario_a_medida.js' ) )}


                                                            <select name="provinces" id="provinces" >
                                                                <option value=""></option>
                                                                {def $provincias = ezini( 'ProvinciasNames', 'Provincias', 'basket.ini')|sort('string')}
                                                        	   
                                                            	{foreach $provincias as $el}
                                                        		<option value="{$el}" {if and( is_set( $provincia ), $provincia|eq($el))}selected="selected"{/if}>{$el}</option>
                                                        	{/foreach}
                                                            </select>    
                                                            {undef $provincias}
{default attribute_base='ContentObjectAttribute' html_class='full'}
{let data_text=cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}
<input class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )}" type="hidden" size="70" name="{$attribute_base}_ezstring_data_text_{$attribute.id}" value="{$data_text|wash( xhtml )}" id="provincia" />
{/let}
{/default}
