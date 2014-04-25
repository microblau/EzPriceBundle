{set-block scope=global variable=cache_ttl}0{/set-block}

{def $bypassAttributeArray=ezini( 'GeneralSettings', 'TokenBypassLoggedInClassAttributeID', 'ezhumancaptcha.ini' )}
{if $bypassAttributeArray|contains( $attribute.contentclassattribute_id|string() )}
	{def $currentUser=fetch( 'user', 'current_user' )}
	{if $currentUser.is_logged_in}
		{default attribute_base=ContentObjectAttribute}
		<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}" class="box ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="hidden" size="10" name="{$attribute_base}_data_text_{$attribute.id}" value="{ezhumancaptcha_sessidhash()}" />
		{/default}
	{else}
		<div class="block_spam">
		<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHACode" />
		{default attribute_base=ContentObjectAttribute}
		<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}" class="box ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="text" size="10" name="{$attribute_base}_data_text_{$attribute.id}" value="" />
		{/default}
		</div>
	{/if}
{else}
	<div class="block_spam">
	<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHACode" />
	{default attribute_base=ContentObjectAttribute}
	<input id="ezcoa-{if ne( $attribute_base, 'ContentObjectAttribute' )}{$attribute_base}-{/if}{$attribute.contentclassattribute_id}_{$attribute.contentclass_attribute_identifier}" class="box ezcc-{$attribute.object.content_class.identifier} ezcca-{$attribute.object.content_class.identifier}_{$attribute.contentclass_attribute_identifier}" type="text" size="10" name="{$attribute_base}_data_text_{$attribute.id}" value="" />
	{/default}
	</div>
{/if}

{undef}