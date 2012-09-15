<div class="message-warning">
	<h2>Warning</h2>

	<p>
    Before you start, remember to backup all your data !
	</p>
</div>

{if $wizard.warning_count|gt(0)}

<div class="message-warning">
	<h2>Warning</h2>

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

<h1 class="context-title">{'Step 1: Select class'|i18n( 'extension/dbattributeconverter')|wash}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

{def $class_list=fetch( 'class', 'list' )}

<table class="list" cellspacing="0">
<tr>
	<th class="tight"></th>
    <th class="">Name</th>
    <th class="tight">ID</th>
    <th class="">Identifier</th>
    <th class="">Class groups</th>
</tr>

{foreach $class_list as $class}

<tr class="bglight">
    <td><input type="radio" value="{$class.id}" name="ClassID" /></td>
    <td>{$class.name|wash}</td>
    <td>{$class.id}</td>
    <td>{$class.identifier}</td>
    <td>
    	{foreach $class.ingroup_list as $class_group}
	    	{$class_group.group_name|wash}
	    	{delimiter}, {/delimiter}
    	{/foreach}
    </td>
</tr>


{/foreach}

</table>

{* DESIGN: Content END *}</div></div></div>

<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
    <input class="button" type="submit" name="NextButton" value="{'Select class'|i18n( 'extension/dbattributeconverter' )}" title="{'Use this class.'|i18n( 'extension/dbattributeconverter' )}" />
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>

</form>