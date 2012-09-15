<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$site.http_equiv.Content-language|wash}" lang="{$site.http_equiv.Content-language|wash}">
<head>
{def $estamos_en_home=false()}{if eq($module_result.node_id,2)}{set $estamos_en_home=true()}{/if}
{def $estamos_en_sage=false()}{if eq($module_result.uri|extract_left(17),'/recursospsm_sage')}{set $estamos_en_sage=true()}{/if}
{def $user_hash         = concat( $current_user.role_id_list|implode( ',' ), ',', $current_user.limited_assignment_value_list|implode( ',' ) )}


{if is_set( $extra_cache_key )|not}
    {def $extra_cache_key = ''}
{/if}

{if and( ezhttp_hasvariable( 'hash', 'get'), ezhttp_hasvariable( 'id', 'get') )}
    {concat( 'newsletter/track/', ezhttp( 'hash', 'get' ), '/', ezhttp( 'id', 'get' ) )|redirect}
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


<body class="sage_home_recursos">
	<div id="wrapper">
		<div id="sage_header" class="clearfix">
			<div id="logo" class="flt" style="margin-right:150px">
				<h1><a href="http://www.efl.es" target="_blank"><img src={"sage_logo_efl.gif"|ezimage} alt="Ediciones Francis Lefevre - La referencia en libros jurídicos" /></a></h1>
			</div>
			<div id="logoSage" class="flt">
				<h1><a href="http://www.sage.es" target="_blank"><img src={"sage_logo_sage.gif"|ezimage} alt="Sage" /></a></h1>
			</div>
			<div id="imgHeader" class="frt">
				<h1><img src={"sage_image_header.gif"|ezimage} alt="" /></h1>
			</div>
		</div>
		
	<table width="100%">
		<tr>
			<td width="50%" align="left">
				{include uri="design:breadCrumb.tpl}
			</td>
			<td width="50%" align="right">
				<a href="http://solucionesmemento-indiv.efl.es/" target="_blank"><img src={"sage_btn_accesoMementosSAGE.gif"|ezimage} alt=""/></a>
			</td>
		</tr>
	</table>
{/cache-block}
	{include uri='design:page_mainarea.tpl'} 
	</div>
	
	<div id="footer">
		<span id="wrapperCopy">
			<span>Todos los derechos reservados</span>
		</span>
	</div>





<script type="text/javascript">
{literal}
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2627590-1']);
  _gaq.push(['_trackPageview']); 

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
{/literal}
</script>

{include uri='design:page_footer_script.tpl'}

{include uri='design:page_footer_script.tpl'}


{* This comment will be replaced with actual debug report (if debug is on). *}
<!--DEBUG_REPORT-->

</body>
</html>
