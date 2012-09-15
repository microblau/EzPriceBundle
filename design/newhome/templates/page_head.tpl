{default enable_help=true() enable_link=true()}

{if is_set($module_result.content_info.persistent_variable.site_title)}
    {set scope=root site_title=$module_result.content_info.persistent_variable.site_title}
{else}
{let name=Path
     path=$module_result.path
     reverse_path=array()}
  {if is_set($pagedata.path_array)}
    {set path=$pagedata.path_array}
  {elseif is_set($module_result.title_path)}
    {set path=$module_result.title_path}
  {/if}
  {section loop=$:path}
    {set reverse_path=$:reverse_path|array_prepend($:item)}
  {/section}

{set-block scope=root variable=site_title}
{section loop=$Path:reverse_path}{$:item.text|wash}{delimiter} / {/delimiter}{/section} - Ediciones Francis Lefebvre
{/set-block}

{/let}
{/if}
	{def $metadatas = fetch( 'fezmetadata', 'list_by_node_id', hash( 'node_id', $module_result.node_id, 'as_object', false() ))}
	{if is_set($metadatas.title)}
		<title>{$metadatas.title.meta_value}</title>
	{else}
    <title>{$site_title}</title>
    {/if}    
<meta name="google-site-verification" content="lTvJWRbmNaqOK0H0rm0hf1m0OfNDEaLWaHy5y5QQdTY" />    
    {if is_set($metadatas.description)}
    	<meta name="description" content="{$metadatas.description.meta_value|wash}" />
        {elseif is_set( ezpagedata().persistent_variable.metadescription )}    	
        <meta name="description" content="{ezpagedata().persistent_variable.metadescription|wash}" />
    {/if}
    
    {if is_set($metadatas.keywords)}
    	<meta name="keywords" content="{$metadatas.keywords.meta_value|wash}" />
    	
    {/if}
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    {foreach $site.http_equiv as $key => $item}
    <meta name="{$key|wash}" content="{$item|wash}" />
    

    {/foreach}
    {*
    {foreach $site.meta as $key => $item}
    {if is_set( $module_result.content_info.persistent_variable[$key] )}
        <meta name="{$key|wash}" content="{$module_result.content_info.persistent_variable[$key]|wash}" />
    {else}
        <meta name="{$key|wash}" content="{$item|wash}" />
    {/if}

    {/foreach}
    *}
    

{if $enable_link}
    {include uri="design:link.tpl" enable_help=$enable_help enable_link=$enable_link}
{/if}

{/default}
