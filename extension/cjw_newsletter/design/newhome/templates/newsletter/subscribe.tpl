<div id="gridTwoColumnsTypeB" class="clearFix">
{literal}            	
<!-- Google Code for Newsletter Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1053841085;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "wEmNCPPTiAIQva3B9gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1053841085/?label=wEmNCPPTiAIQva3B9gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
        {/literal}      
        {ezcss_require( 'jquery.fancybox-1.3.0.css')} 

				<div class="columnType1">
					<div id="modType2">

	
  {def $newsletter_root_node_id = ezini( 'NewsletterSettings', 'RootFolderNodeId', 'cjw_newsletter.ini' )
         $available_output_formats = 2

         $newsletter_system_node_list = fetch( 'content', 'tree', hash( 'parent_node_id', $newsletter_root_node_id,
                                                                        'class_filter_type', 'include',
                                                                        'class_filter_array', array( 'cjw_newsletter_system' ),
                                                                        'sort_by', array( 'name', true() ),
                                                                        'limitation', hash( )
                                                                      )
                                              )
      $newsletter_list_count = fetch( 'content', 'tree_count',
                                                            hash('parent_node_id', $newsletter_root_node_id,
                                                                 'extended_attribute_filter',
                                                                      hash( 'id', 'CjwNewsletterListFilter',
                                                                            'params', hash( 'siteaccess', array( 'current_siteaccess' ) ) ),
                                                                 'class_filter_type', 'include',
                                                                 'class_filter_array', array('cjw_newsletter_list'),
                                                                 'limitation', hash() )
   )}			
   {foreach $newsletter_system_node_list as $system_node}
   
                    {def $newsletter_list_node_list = fetch( 'content', 'tree',
                                                                hash('parent_node_id', $system_node.node_id,
                                                                     'extended_attribute_filter',
                                                                          hash( 'id', 'CjwNewsletterListFilter',
                                                                                'params', hash( 'siteaccess', array( 'current_siteaccess' ) ) ),
                                                                     'class_filter_type', 'include',
                                                                     'class_filter_array', array('cjw_newsletter_list'),
                                                                     'limitation', hash() )
                                                           )
                         $newsletter_list_node_list_count = $newsletter_list_node_list|count
                    }

   
   
    <h1>Suscríbase a nuestro boletín de novedades</h1>
  						<div class="wrap clearFix">                    		
									<div class="description">
										<div id="datosUsuario">

	

        <form name="subscribe" method="post" action={'/newsletter/subscribe/'|ezurl} id="form_inf_colectivo">
{if $warning_array|count|eq( 0 )}     
         
{/if}

{foreach $warning_array as $warning}
    {switch match=$warning.field_key}
	    {case match='Email'} 
	    	{def $Email = 1}
	    {/case}  
        {case match='Nombre'} 
	    	{def $Nombre = 1}
	    {/case} 
        {case match='Apellidos'} 
	    	{def $Apellidos = 1}
	    {/case} 
        {case match='Actividad'} 
	    	{def $Actividad = 1}
	    {/case} 
        {case match='Captcha'} 
	    	{def $Captcha = 1}
	    {/case} 
        {case match='Acepto'} 
	    	{def $Acepto = 1}
	    {/case} 	
	{/switch}

{/foreach}
        {* warnings *}
            {if and( is_set( $warning_array ), $warning_array|count|ne( 0 ) )}
           
           <div class="msgError">
                                        			<span>Lo sentimos, pero se han encontrado los siguientes errores</span> 
                                        			<ul>
                                        			 {foreach $warning_array as $message_array_item}
                                        				<li>{$message_array_item.field_key|wash}: {$message_array_item.message|wash()}<br></li>
                                        			{/foreach}
                                        			</ul>
          </div>
           
           
            {/if}
            
            
            <div class="block">
                {foreach $newsletter_system_node_list as $system_node}

                    {def $newsletter_list_node_list = fetch( 'content', 'tree',
                                                                hash('parent_node_id', $system_node.node_id,
                                                                     'extended_attribute_filter',
                                                                          hash( 'id', 'CjwNewsletterListFilter',
                                                                                'params', hash( 'siteaccess', array( 'current_siteaccess' ) ) ),
                                                                     'class_filter_type', 'include',
                                                                     'class_filter_array', array('cjw_newsletter_list'),
                                                                     'limitation', hash() )
                                                           )
                         $newsletter_list_node_list_count = $newsletter_list_node_list|count
                    }

             

                    {if $newsletter_list_node_list_count|ne(0)}
                        <h2>Datos de usuario</h2>
                        <table border="0" width="100%" style="display:block">

                            {foreach $newsletter_list_node_list as $list_node sequence array( 'bglight', 'bgdark' ) as $style}
                                {def $list_id = $list_node.contentobject_id
                                     $list_selected_output_format_array = array(0)
                                     $td_counter = 0}

                                    {if is_set( $subscription_data_array.list_output_format_array[$list_id] )}
                                        {set $list_selected_output_format_array = $subscription_data_array.list_output_format_array[$list_id]}
                                    {/if}

                                <tr>
                                    {if $list_node.data_map.newsletter_list.content.output_format_array|count|ne(0)}

                                    {* check box subscribe to list *}
                                    <td valign="top" class="newsletter-list">
                                        <input type="hidden" name="Subscription_IdArray[]" value="{$list_id}" title="" />
                                        {if $newsletter_list_node_list_count|eq(1)}
                                            <input type="hidden" name="Subscription_ListArray[]" value="{$list_id}" title="{$list_node.data_map.title.content|wash}" /> 
                                        {else}
                                            <input type="checkbox" name="Subscription_ListArray[]" value="{$list_id}"{if $subscription_data_array['list_array']|contains( $list_id )} checked="checked"{/if} title="{$list_node.data_map.title.content|wash}" /> {$list_node.data_map.title.content|wash}
                                        {/if}
                                    </td>
                                    {* outputformats *}

                                        {if $list_node.data_map.newsletter_list.content.output_format_array|count|gt(1)}

                                            {foreach $list_node.data_map.newsletter_list.content.output_format_array as $output_format_id => $output_format_name}
                                    <td class="newsletter-list"><div class="nl-outputformat"><input type="radio" name="Subscription_OutputFormatArray_{$list_id}[]" value="{$output_format_id}" {if $list_selected_output_format_array|contains( $output_format_id )} checked="checked"{/if} title="{$output_format_name|wash}" /> {$output_format_name|wash}&nbsp;{*({$output_format_id})*}</div></td>
                                            {set $td_counter = $td_counter|inc}
                                            {/foreach}

                                        {else}

                                            {foreach $list_node.data_map.newsletter_list.content.output_format_array as $output_format_id => $output_format_name}
                                    <td class="newsletter-list">&nbsp;<input type="hidden" name="Subscription_OutputFormatArray_{$list_id|wash}[]" value="{$output_format_id|wash}" title="{$output_format_name|wash}" /></td>
                                            {set $td_counter = $td_counter|inc}
                                            {/foreach}

                                        {/if}

                                    {else}
                                    {* nix *}

                                    {/if}

                                    {* fehlende td erzeugen *}
                                    {while $td_counter|lt( $available_output_formats )}
                                    <td>&nbsp;{*$td_counter} < {$available_output_formats*}</td>
                                    {set $td_counter = $td_counter|inc}
                                    {/while}

                                </tr>
                                {undef $list_id $list_selected_output_format_array $td_counter $newsletter_list_node_list_count}
                            {/foreach}
                        </table>
                    {/if}

                    {undef $newsletter_list_node_list}
                {/foreach}
            </div>

  {*Informacion*}
           
           <ul class="datos">
            <li>
            <label for="about_info">Deseo recibir información sobre *</label>
            <br /><br />
            		<div>
						  <ul>	
                            <li class="form_newsletter"><input name="publicaciones" type="checkbox">  Publicaciones</li>
							<li class="form_newsletter"><input name="formacion" type="checkbox">  Formación </li>
                           </ul> 
                    </div>       
							
			</li>
            {* First name. *}
            <li {if is_set( $Nombre)}class="error"{/if}>
                <label for="Subscription_FirstName">Nombre *</label>
                <input class="halfbox" id="Subscription_FirstName" type="text" name="Subscription_FirstName" value="{cond( and( is_set( $user), $subscription_data_array['first_name']|eq('') ), $user.contentobject.data_map.first_name.content|wash , $subscription_data_array['first_name'] )|wash}" title="{'First name of the subscriber.'|i18n( 'cjw_newsletter/subscribe' )}"
                       {*cond( is_set( $user ), 'disabled="disabled"', '')*} />
            </li>

            {* Last name. *}
            <li {if is_set( $Apellidos)}class="error"{/if}>
                <label for="Subscription_LastName">Apellidos *</label>
                <input class="halfbox" id="Subscription_LastName" type="text" name="Subscription_LastName" value="{cond( and( is_set( $user ), $subscription_data_array['last_name']|eq('') ), $user.contentobject.data_map.last_name.content|wash , $subscription_data_array['last_name'] )|wash}" title="{'Last name of the subscriber.'|i18n( 'cjw_newsletter/subscribe' )}"
                       {*cond( is_set( $user ), 'disabled="disabled"', '')*} />
            </li>
            
             {* Actividad. *}
            <li {if is_set( $Actividad)}class="error"{/if}>
                <label for="organisation">Actividad *</label>
                <input class="halfbox" id="organisation" type="text" name="organisation" value="{cond( and( is_set( $user ), $subscription_data_array['organisation']|eq('') ), $user.contentobject.data_map.organisation.content|wash , $subscription_data_array['organisation'] )|wash}" title="organisation"  {*cond( is_set( $user ), 'disabled="disabled"', '')*} />
            </li>
            <br />
           
             {*Materia*}
             
            <li>
            <label for="about_materia">Materia de Interés *</label>
            <br /><br />
            <div>   
                        {def $areas = fetch( 'content', 'list', hash( 'parent_node_id', 143))}
            			<ul>
                            {foreach $areas as  $area}
							<li class="form_newsletter"><input name="areas[]" type="checkbox" value="{$area.object.id}"> {$area.name} </li>
                            {/foreach}
							
                        </ul>
           </div>             
			</li>
            
           {*ebook*}
            <li class="ebook" style="margin-top: 15px">
            <label for="ebook">Ebook de regalo</label>
                <select name="ebook" id="ebook">
                    <option value=""></option>
                    {foreach fetch( 'content', 'node', hash( 'node_id', 2 )).data_map.page.content.zones.1.blocks.3.valid_nodes as $node}
                    <option value="{$node.object.id}" {if and( ezhttp_hasvariable( 'seb', 'post' ), ezhttp( 'seb', 'post' )|eq($node.object.id))}selected="selected"{/if}>{$node.name}</option>
                    {/foreach}
                </select>
            </li>
            {*fin ebook}
 
            
            
            {* Email. *}
            <li {if is_set( $Email)}class="error"{/if}>
                <label for="Subscription_Email">{"Email"|i18n( 'cjw_newsletter/subscribe' )}*:</label>
                <input class="halfbox" id="Subscription_Email" type="text" name="Subscription_Email" value="{if ezhttp_hasvariable( 'email', 'post')}{ezhttp( 'email', 'post')}{else}{cond( and( is_set( $user ), $subscription_data_array['email']|eq('') ), $user.email|wash(), $subscription_data_array['email']|wash )}{/if}" title="{'Email of the subscriber.'|i18n( 'cjw_newsletter/subscribe' )}" />
            </li>
            
            {*acepto condiciones*}
               <li class="condiciones" >
                    <label for="condiciones" {if is_set( $Acepto)}class="error"{/if}>
                    <input name="Acepto" type="checkbox"> He leído y acepto las condiciones de la <a class="lb" id="politicaligthBox" href={'lightbox/ver/19526'|ezurl}>Política de Privacidad</a> y el <a class="lb" id="avisoLightbox" href={'lightbox/ver/292'|ezurl}>Aviso Legal</a>
                     </label>
                            <div>                                                    		
                                    {fetch('content', 'node', hash( 'node_id', 1451)).data_map.texto.content.output.output_text}
                            </div>
               </li>
            {*fin acepto condiciones*}

                
            {*captcha*}            
            <li {if is_set( $Captcha)}class="error"{/if}>
                <label for="capchar" {if is_set( $error_captchar)}class="error"{/if}>Introduzca los caracteres que visualiza en la imagen inferior *:</label><br>
                <div>
                    <input class="box" type="text" size="4" name="eZHumanCAPTCHACode" value="" />
                </div>
                <br>
                    <img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHA" /><br>
                 <br/>
                </li>

            {*fin captcha*}            

            <li>
                <input type="hidden" name="BackUrlInput" value="{cond( ezhttp_hasvariable('BackUrlInput'), ezhttp('BackUrlInput'), 'newsletter/subscribe'|ezurl('no'))}" />
              
               <span class="volver"><a href={"Colectivos"|ezurl}>Volver</a></span>
                <span class="submit">
                <input type="image" id="send" value="Enviar" name="SubscribeButton" alt="Continuar" src="/design/site/images/btn_continuar.gif">
                </span>
            
            </li>


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
