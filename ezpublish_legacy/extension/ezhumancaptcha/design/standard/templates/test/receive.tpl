{def $errorArray = ezhumancaptcha_validate()}
{if count($errorArray)}
	{'CAPTCHA validation failed'|i18n('extension/ezhumancaptcha')}:
	<ul>
	{foreach $errorArray as $errorMsg}
		<li>{$errorMsg}</li>
	{/foreach}
	</ul>
{else}
	{'CAPTCHA validation successful'|i18n('extension/ezhumancaptcha')}!
{/if}
{undef $errorArray}

<br /><br />
<form action={"/ezhumancaptcha/test/send/"|ezurl} method="post">
<input class="button" type="submit" name="SendButton" value="{'Back'|i18n('extension/ezhumancaptcha')}" />
</form>
