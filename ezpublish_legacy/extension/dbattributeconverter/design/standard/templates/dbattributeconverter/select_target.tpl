{if $wizard.warning_count|gt(0)}
<div class="message-warning">
<ul>
    {section var=warning loop=$wizard.warning_list}
        <li>{$warning}</li>
    {/section}
</ul>
</div>
{/if}

<form action={$wizard.url|ezurl} method="post">

<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h1 class="context-title">{'Step 3: Select new datatype'|i18n( 'dbattributeconverter/wizard')|wash} | {'number of attributes'|i18n( 'dbattributeconverter/wizard')|wash}: {$number_of_attributes}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

<table class="list" cellspacing="0">
<tr>
	<th class="tight"></th>
    <th class="">Name</th>
    <th class="">Warnings</th>
	<th class="">Settings</th>
</tr>

{foreach $possible_target_datatypes as $datatype}

<tr class="bglight">
    <td><input type="radio" value="{$datatype.name}" name="Datatype" /></td>
    <td>{$datatype.name|wash}</td>
    <td>
    	<ul>
    	{foreach $datatype.warnings as $warning}

    		<li>{$warning|wash}</li>
    	{/foreach}

    	</ul>
    </td>
    <td>
		{include uri='design:dbattributeconverter/settings.tpl' settings=$datatype.settings posted=$wizard.variable_list.settings}
    	  
    </td>
</tr>

{/foreach}

</table>

{* DESIGN: Content END *}</div></div></div>

<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
    <input class="button" type="submit" name="PreviousButton" value="{'Go back'|i18n( 'dbattributeconverter/wizard' )}" />
    <input class="button" type="checkbox" name="InBackground" value="1" title="{'Select this radio if you want to execute conversion in background from CLI.'|i18n( 'dbattributeconverter/wizard' )}" />
    {'Execute in background'|i18n( 'dbattributeconverter/wizard' )}
    <input class="button" type="submit" name="NextButton" value="{'Convert!'|i18n( 'dbattributeconverter/wizard' )}" title="{'Use this class.'|i18n( 'dbattributeconverter/wizard' )}" />
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>

</form>