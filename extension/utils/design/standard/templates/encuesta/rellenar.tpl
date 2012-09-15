{def $products_ua = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{$products_ua|attribute(show)}
{def $training_ua = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
{def $order_info_ua = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_addTrans',
    '{/literal}{$id}{literal}',           // order ID - required
    'Ediciones Francis Lefebvre',  // affiliation or store name
    '{/literal}{$basket.total_ex_vat}{literal}',          // total - required
    '{/literal}{$basket.total_inc_vat|sub( $basket.total_ex_vat )}{literal}',           // tax
    '0',              // shipping
    'Madrid',       // city
    'Madrid',     // state or province
    'Spain'             // country
  ]);
{/literal}
    {foreach $products_ua as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id}{literal}',           // order ID - required
    '{/literal}{$product.item_object.contentobject.data_map.referencia.content}{literal}',           // SKU/code - required
    '{/literal}{$product.object_name}{/literal}',        // product name
{/literal}
{def $formato = $product.item_object.contentobject.data_map.formato.content.relation_list.0}

{def $formatoobject= fetch('content', 'object', hash( 'object_id', $formato.contentobject_id))}

{literal}
    '{/literal}{$formatoobject.name}{literal}',   // category or variation
{/literal}
{undef $formato $formatoobject}
{literal}
    '{/literal}{$product.total_price_ex_vat}{literal}',          // unit price - required
    '{/literal}{$product.item_count}{literal}'               // quantity - required
  ]);
{/literal}
{/foreach}
{foreach $training_ua as $product}

{literal}
   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each
  _gaq.push(['_addItem',
    '{/literal}{$id}{literal}',           // order ID - required
    '{/literal}{literal}',           // SKU/code - required
    '{/literal}{$product.object_name}{/literal}',        // product name
{/literal}
{def $formato = $product.item_object.contentobject.data_map.formato.content.relation_list.0}

{def $formatoobject= fetch('content', 'object', hash( 'object_id', $formato.contentobject_id))}

{literal}
    '{/literal}''{literal}',   // category or variation
{/literal}
{undef $formato $formatoobject}
{literal}
    '{/literal}{$product.total_price_ex_vat}{literal}',          // unit price - required
    '{/literal}{$product.item_count}{literal}'               // quantity - required
  ]);
{/literal}
{/foreach}
{literal}
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
{/literal}
</script>                                
        

<div id="gridTwoColumnsTypeB" class="clearFix">
  <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>{$node.name|wash()}</h1>
                            
                            <div class="wrap clearFix curvaFondo">                          
                                    <div id="finProceso" class="description">
                                                    
                                                
                                        {def $name_pattern = $node.object.content_class.contentobject_name|explode('>')|implode(',')
         $name_pattern_array = array('enable_comments', 'enable_tipafriend', 'show_children', 'show_children_exclude', 'show_children_pr_page')
         $exclude_datatypes = array('ezoption', 'ezmultioption', 'ezmultioption2', 'ezrangeoption', 'ezprice', 'ezmultiprice')}
    {set $name_pattern  = $name_pattern|explode('|')|implode(',')}
    {set $name_pattern  = $name_pattern|explode('<')|implode(',')}
    {set $name_pattern  = $name_pattern|explode(',')}
    {foreach $name_pattern  as $name_pattern_string}
        {set $name_pattern_array = $name_pattern_array|append( $name_pattern_string|trim() )}
    {/foreach}

                {*attribute_view_gui attribute=$node.data_map.survey*}
                {def $attribute = $node.data_map.survey}
                {def $survey_validation=$attribute.content.survey_validation}
                {def $survey=$node.data_map.survey.content.survey}
{if is_set($attribute.content.survey_validation.one_answer_need_login)}
<p>{"You need to log in in order to answer this survey"|i18n('survey')}.</p>
{include uri='design:user/login.tpl'}
{else}
{if $survey.valid|eq(false())}
<p>{"The survey is not active"|i18n('survey')}.</p>
{else}
{def $survey_validation=$attribute.content.survey_validation}
{if or(is_set( $survey_validation.one_answer ), and(is_set($survey_validation.one_answer_count), $survey_validation.one_answer_count|gt(0)))}
<p>{"The survey does already have an answer from you"|i18n('survey')}.</p>
{else}
{def $prefixAttribute='ContentObjectAttribute'}
{def $node=fetch( 'content', 'node', hash( 'node_id', $node.node_id ))}
{def $module_param_value=concat(module_params().module_name,'/', module_params().function_name)}
{if $module_param_value|ne('content/edit')}
<form enctype="multipart/form-data" method="post" action={concat( 'encuesta/', $hash )|ezurl()}>
{/if}
<input type="hidden" name="{$prefixAttribute}_ezsurvey_contentobjectattribute_id_{$attribute.id}" value="{$attribute.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_node_id_{$attribute.id}" value="{$node.node_id}" />

<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_{$attribute.id}" value="{$survey.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_view_mode_{$attribute.id}" value="{$survey.id}" />

{"Questions marked with %mark% are required."|i18n('survey', '', hash( '%mark%', '<strong class="required">*</strong>' ) )}

{section show=$preview|not}
{include uri="design:survey/view_validation.tpl"}
{/section}

{let question_results=$survey.question_results}
{section show=$question_results}
  {section var=question loop=$survey.questions}
    {section show=$question.visible}
      <div class="block">
      <input type="hidden" name="{$prefix}_ezsurvey_question_list_{$attribute.id}[]" value="{$question.id}" />
      <a name="survey_question_{$question.question_number}"></a>
      {if is_set($question_results[$question.id])}
        {survey_question_view_gui question=$question question_result=$question_results[$question.id] attribute_id=$attribute.id prefix_attribute=$prefixAttribute survey_validation=$survey_validation}
      {else}
        {survey_question_view_gui question=$question question_result=0 attribute_id=$attribute.id prefix_attribute=$prefixAttribute}
      {/if}
      <div class="break"></div>
      </div>
    {/section}
  {/section}
{section-else}
  {section var=question loop=$survey.questions}
    {section show=$question.visible}
      <div class="block">
      <input type="hidden" name="{$prefixAttribute}_ezsurvey_question_list_{$attribute.id}[]" value="{$question.id}" />
      <a name="survey_question_{$question.question_number}"></a>
      {survey_question_view_gui question=$question question_result=0 attribute_id=$attribute.id prefix_attribute=$prefixAttribute}
      <div class="break"></div>
      </div>
    {/section}
  {/section}
{/section}
{/let}

<div class="block">

<input type="hidden" name="send" value="1" />
<input class="button" type="submit" name="{$prefixAttribute}_ezsurvey_store_button_{$attribute.id}" value="{'Submit'|i18n( 'survey' )}" />
<input class="button" type="submit" name="ContinueButton" value="Continuar" />
</div>

{if $module_param_value|ne('content/edit')}
</form>
{/if}
{/if}
{/if}
{/if}
                                        
                                        
                                        
                                        
                                        
                                    </div>
                            </div>  
                                   
                            </div>             
                           
                    
                    
                </div>

                <div class="sideBar">
                    
                    <div id="modContacto">
                        {include uri="design:basket/contactmodule.tpl"}
                    </div>
                    
                </div>

                
            </div>
