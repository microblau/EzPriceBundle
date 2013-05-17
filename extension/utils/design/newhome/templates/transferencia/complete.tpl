{if is_set( $donottrack )|not}
	{def $products_ua = fetch( 'basket', 'get_products_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
	{def $training_ua = fetch( 'basket', 'get_training_in_basket', hash( 'productcollection_id', $basket.productcollection_id ))}
	{def $order_info_ua = fetch( 'basket', 'get_order_info', hash( 'productcollection_id', $basket.productcollection_id ))}
		{if sum( $products_ua|count, $training_ua|count )|gt(0)}
			{def $aux1=$basket.total_inc_vat|mul(100)}
			{def $aux2=$aux1|div($basket.total_ex_vat)}
			{def $porcentaje=$aux2|sub(100)}
			<script type="text/javascript">
			{literal}
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-2627590-1']);
			  _gaq.push(['_trackPageview']);
			  _gaq.push(['_addTrans',
				'{/literal}{$id}{literal}',           // order ID - required
				'Ediciones Francis Lefebvre',  // affiliation or store name
				'{/literal}{$basket.total_ex_vat|mul(100)|round()|div(100)|l10n("number","eng-US")}{literal}', // total - required
				'{/literal}{$porcentaje|l10n("number","eng-US")}{literal}', // tax
				'0',              // shipping
				'Madrid',       // city
				'Madrid',     // state or province
				'Spain'             // country
			  ]);
			{/literal}
    		{foreach $products_ua as $product}
    			{def $formato_gaq=""}
				{foreach $product.item_object.contentobject.data_map.formato.content.relation_list as $k=>$forma}
					{def $formato=fetch(content,object, hash(object_id, $forma.contentobject_id))}
					{if $k|eq(0)}
						{set $formato_gaq=concat($formato_gaq,$formato.name)}
					{else}
						{set $formato_gaq=concat($formato_gaq,',',$formato.name)}
					{/if}	
					{undef $formato}
				{/foreach}
				{def $areas_gaq=""}
				{foreach $product.item_object.contentobject.data_map.area.content.relation_list as $k=>$area}
					{def $areas=fetch(content,object, hash(object_id, $area.contentobject_id))}
					{if $k|eq(0)}
						{set $areas_gaq=concat($areas_gaq,$areas.name)}
					{else}
						{set $areas_gaq=concat($areas_gaq,',',$areas.name)}
					{/if}	
					{undef $areas}
				{/foreach}
				{def $combi_gaq=concat($areas_gaq,',',$formato_gaq)}
				
				{undef $formato_gaq $areas_gaq }
			{literal}
			   // add item might be called for every item in the shopping cart
			   // where your ecommerce engine loops through each item in the cart and
			   // prints out _addItem for each
			  _gaq.push(['_addItem',
				'{/literal}{$id}{literal}',           // order ID - required
				'{/literal}{$product.item_object.contentobject.data_map.referencia.content}{literal}',           // SKU/code - required
 				'{/literal}{$product.object_name}{literal}',        // product name
 				'{/literal}{$combi_gaq}{literal}',   // category or variation
 				'{/literal}{$product.total_price_ex_vat|mul(100)|round()|div(100)|l10n("number","eng-US")}{literal}',          // unit price - required
 				'{/literal}{$product.item_count}{literal}'               // quantity - required
  			]);
		{/literal}
		{undef $combi_gaq}
		{/foreach}
		{foreach $training_ua as $train}
					{def $areas_gaq=""}
					{foreach $train.item_object.contentobject.data_map.areas_interes.content.relation_list as $k=>$area}
						{def $areas=fetch(content,object, hash(object_id, $area.contentobject_id))}
						{if $k|eq(0)}
							{set $areas_gaq=concat($areas_gaq,$areas.name)}
						{else}
							{set $areas_gaq=concat($areas_gaq,',',$areas.name)}
						{/if}	
					{undef $areas}
					{/foreach}
				{def $combi_gaq=concat($areas_gaq,',Curso Presencial')}
				
				{undef $areas_gaq}
		{literal}
			//para los cursos
		   // add item might be called for every item in the shopping cart
		   // where your ecommerce engine loops through each item in the cart and
		   // prints out _addItem for each
		  _gaq.push(['_addItem',
			'{/literal}{$id}{literal}',           // order ID - required
			'{/literal}{$train.node_id}{literal}',           // SKU/code - required
 		 	'{/literal}{$train.object_name}{literal}',        // product name
 			'{/literal}{$combi_gaq}{literal}',   // category or variation
 			'{/literal}{$train.total_price_ex_vat|mul(100)|round()|div(100)|l10n("number","eng-US")}{literal}',          // unit price - required
 			'{/literal}{$train.item_count}{literal}'               // quantity - required
 				
		  ]);
		{/literal}
		{undef $combi_gaq}
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
		{undef $aux1 $aux2 $porcentaje}                             
	{/if}
{/if}






{if $encuesta}

        

<div id="gridTwoColumnsTypeB" class="clearFix">
  <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>{$node.name|wash()}</h1>
                            
                            <div class="wrap clearFix curvaFondo">                          
                                    <div id="finProceso" class="description">
                                               <div class="encuesta">
                                                
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
<form enctype="multipart/form-data" method="post" action={concat("transferencia/complete/", $order_id )|ezurl()}>
{/if}
<input type="hidden" name="pid" value="{$basket.productcollection_id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_contentobjectattribute_id_{$attribute.id}" value="{$attribute.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_node_id_{$attribute.id}" value="{$node.node_id}" />

<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_{$attribute.id}" value="{$survey.id}" />
<input type="hidden" name="{$prefixAttribute}_ezsurvey_id_view_mode_{$attribute.id}" value="{$survey.id}" />


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
<input type="image" name="{$prefixAttribute}_ezsurvey_store_button_{$attribute.id}" value="{'Submit'|i18n( 'survey' )}" src={"btn_continuar.gif"|ezimage} />
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
                           
                    
                    
                </div>

                <div class="sideBar">
                    
                    <div id="modContacto">
                        {include uri="design:basket/contactmodule.tpl"}
                    </div>
                    
                </div>

                
            </div>
{else}
        
            
        
            <div id="gridTwoColumnsTypeB" class="clearFix">
                
                <ol id="pasosCompra">
                    <li><img src={"txt_paso1.png"|ezimage} alt="Cesta de la compra" height="57" width="234" /></li>
                    <li><img src={"txt_paso2.png"|ezimage} alt="Datos personales y pago" height="57" width="234" /></li>
                    <li><img src={"txt_paso3.png"|ezimage} alt="Confirmación de datos" height="57" width="234" /></li>
                    <li class="reset"><img src={"txt_paso4-sel.png"|ezimage} alt="Fin de proceso" height="57" width="234" /></li>
                </ol>
                
                <div class="columnType1">
                    <div id="modType2">

                            
                            <h1>Fin de proceso de compra</h1>
                            
                            <div class="wrap clearFix curvaFondo">                          
                                    <div id="finProceso" class="description">
                                                    
                                                
                                        <ul>
                                            <li>El pedido <strong>Nº {$id}</strong> se ha procesado con éxito.</li>
                                            <li>En breves instantes <strong>recibirá un email</strong> con la información de dicho proceso. Si esto no ocurre en los próximos minutos póngase en contacto con nosotros.</li>

                                        </ul>
                                        
                                        <div class="instruccionesTransferencia">
                                        
                                        <h2>Instrucciones de pago por transferencia</h2>
                                        <ol>
                                            <li><span>Haga su transferencia antes de 72 horas* en el siguiente número de <abbr ttile="Cuenta Corriente">C/C</abbr>: {ezini( 'Infocompras', 'CC', 'basket.ini')}.</span></li>
                                            <li><span>Envíenos el justificante bancario de su transferencia a la dirección de email <a href="mailto:{ezini( 'Infocompras', 'Mail', 'basket.ini')}">{ezini( 'Infocompras', 'Mail', 'basket.ini')}</a> o por fax al número  {ezini( 'Infocompras', 'Fax', 'basket.ini')}.</li>
                                            <li><span>¡Importante!. Indique el siguiente número de pedido <strong>{$id}</strong> en las observaciones de su transferencia.</span></li>
                                        </ol>
                                        
                                        <p>Muchas gracias por confiar en nuestra documentación jurídica</p>
                                        
                                        <p class="note">* Condición indispensable para el envío de las obras exceptuando aquellas que se encuentran en prepublicación. </p>
                                        
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                    </div>                                                                                                  
                            </div>  
                                   
                            </div>             
                            <div id="modType3">
                                <h2 class="title">Déjenos conocerle</h2>
                                <div class="wrap clearFix curvaFondo">                          
                                    <div class="description">
                                        <div class="cont" style="padding:20px;">
                                            <form action={concat( "transferencia/complete/", $id)|ezurl} method="post" id="finCompraForm" class="formulario conocer" name="finCompraForm">
                                                
                                               {include uri="design:basket/dejenosconocerle.tpl"}
                                               
                                               <div class="clearFix">
                                                    <!--span class="volver"><a href="">Volver</a></span-->
                                                 <span class="submit"><input type="image" src={"btn_continuar.gif"|ezimage} alt="Continuar" name="btnContinuar" /></span>

                                                
                                                </div>  
                                                                                                                
                                            </form>

                                         </div>

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
                
            
{/if}        
            
        

