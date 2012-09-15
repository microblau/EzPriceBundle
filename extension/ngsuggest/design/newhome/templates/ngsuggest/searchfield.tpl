{default $size="20"
	$search_text=""
	$search_id="searchtext"
	$search_style="searchtext"
	$search_name="SearchText"
    $search_default_value=$search_text}
{if is_set($form_id)}

<script language="javascript" type="text/javascript">
{literal}
(function($) {

jQuery(document).ready(function() {
    $("#{/literal}{$search_id}{literal}").attr( 'autocomplete', 'off' ) ;
	function ngSuggestBuildAction() {
		jQuery('#{/literal}{$form_id}{literal}').attr('action',jQuery('#{/literal}{$form_id}{literal}').attr('action')+getTextValue(document.{/literal}{$form_id}{literal}.SearchText,'term'));
	}
});
})(jQuery);

{/literal}
</script>
{/if}
<input class="{$search_style} ngsuggestfield inputtext" id="{$search_id}" name="{$search_name}" type="text" size="{$size}" 
value="{$search_default_value}" {if is_set($form_id)}onkeypress="var keycode; if (window.event) keycode=window.event.keyCode; else if (event) keycode=event.which; if(keycode=='13') ngSuggestBuildAction(); return true;" {/if}/>
{/default}
