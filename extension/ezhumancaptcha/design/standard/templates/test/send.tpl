<form action={"/ezhumancaptcha/test/receive/"|ezurl} method="post">
<img src={ezhumancaptcha_image()|ezroot()} alt="eZHumanCAPTCHA" />
<input class="box" type="text" size="4" name="eZHumanCAPTCHACode" value="" />
<br />
<input class="button" type="submit" name="SendButton" value="{'Send'|i18n('extension/ezhumancaptcha')}" />
</form>
