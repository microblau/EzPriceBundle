<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$site.http_equiv.Content-language|wash}" lang="{$site.http_equiv.Content-language|wash}">
<head>
{def $user_hash         = concat( $current_user.role_id_list|implode( ',' ), ',', $current_user.limited_assignment_value_list|implode( ',' ) )}


{if is_set( $extra_cache_key )|not}
    {def $extra_cache_key = ''}
{/if}

{cache-block keys=array( $module_result.uri, fetch( 'shop', 'basket' ).items|count, $current_user.contentobject_id, $extra_cache_key )}
{def $pagedata         = ezpagedata()
     $pagestyle        = $pagedata.css_classes
     $locales          = fetch( 'content', 'translation_list' )
     $pagedesign       = $pagedata.template_look
     $current_node_id  = $pagedata.node_id}

{include uri='design:page_head.tpl'}
{include uri='design:page_head_style.tpl'}
{include uri='design:page_head_script.tpl'}

</head>
<body id="formacion">
    <div id="wrapper">

  {if and( is_set( $pagedata.persistent_variable.extra_template_list ), 
             $pagedata.persistent_variable.extra_template_list|count() )}
    {foreach $pagedata.persistent_variable.extra_template_list as $extra_template}
      {include uri=concat('design:extra/', $extra_template)}
    {/foreach}
  {/if}

  
  {include uri='design:page_header.tpl' }
  
  
  {cache-block keys=array( $module_result.uri, $user_hash, $extra_cache_key )}

  
  {if $pagedata.top_menu}
    {include uri='design:page_topmenu.tpl'}
  {/if}
  

  {*
  {if $pagedata.show_path}
    {include uri='design:page_toppath.tpl'}
  {/if}
  *}
  
 
  {if and( $pagedata.website_toolbar, $pagedata.is_edit|not)}
    {include uri='design:page_toolbar.tpl'}
  {/if} 
{/cache-block}
{/cache-block}
  <!-- Main area: START -->
  {include uri='design:page_mainarea.tpl'}
{cache-block keys=array( $module_result.uri, $user_hash, $access_type.name, $extra_cache_key )}  
  
  {include uri='design:page_footer.tpl'}  

</div>


{include uri='design:page_footer_script.tpl'}

{/cache-block}

{* This comment will be replaced with actual debug report (if debug is on). *}
<!--DEBUG_REPORT-->
</body>
</html>
