{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h4>{'DB Attribute Converter'|i18n( 'dbattributeconverter/wizard' )}</h4>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">
{*
<ul>
	{if is_set($wizard.variable_list.class_id)}<li>Class ID: {$wizard.variable_list.class_id}</li>{/if}
	{if is_set($wizard.variable_list.attribute_id)}<li>Attribute ID: {$wizard.variable_list.attribute_id}</li>{/if}
</ul>
*}
<form action={$wizard.url|ezurl} method="post">

<div class="block">
	<input class="button" type="submit" name="RestartButton" value="{'Restart wizard steps'|i18n( 'dbattributeconverter/wizard' )}" title="{'Restart wizard.'|i18n( 'extension/ezattributeconverter' )}" />
</div>

</form>

{* DESIGN: Content END *}</div></div></div></div></div></div>


{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h4>{'Info'|i18n( 'dbattributeconverter/wizard' )}</h4>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">

<p>
	Copyright 2009 by <a target="_blank" href="http://db-team.eu/" style="white-space: nowrap">DB Team</a>
</p>

<p>
	<a target="_blank" href="http://projects.ez.no/dbattributeconverter/">Link to latest version</a>
</p>

<p>
	Missing convert handler?<br />
	<a target="_blank" href="http://db-team.eu/">Let us know about it</a> !
</p>




{* DESIGN: Content END *}</div></div></div></div></div></div>