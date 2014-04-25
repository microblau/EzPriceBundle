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

<h1 class="context-title">{'Step 2: Select attribute'|i18n( 'dbattributeconverter/wizard')|wash}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

{def $attribute_list=fetch( 'class', 'attribute_list', hash( 'class_id', $class_id ) )}



<table class="list" cellspacing="0">
<tr>
	<th class="tight"></th>
    <th class="">Name</th>
    <th class="tight">ID</th>
    <th class="">Identifier</th>
    <th class="">Data type</th>
</tr>

{foreach $attribute_list as $attribute}

<tr class="bglight">
    <td><input type="radio" value="{$attribute.id}" name="AttributeID" {if $possible_datatypes|contains($attribute.data_type.information.string)|not} disabled="disabled"{/if} /></td>
    <td>{$attribute.name|wash}</td>
    <td>{$attribute.id}</td>
    <td>{$attribute.identifier}</td>
    <td>{$attribute.data_type.information.name} [{$attribute.data_type.information.string}]
    	{*$attribute.data_type.information|attribute(show)*}
    </td>
</tr>

{/foreach}

</table>

{* DESIGN: Content END *}</div></div></div>

<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
    <input class="button" type="submit" name="PreviousButton" value="{'Go back'|i18n( 'design/admin/class/grouplist' )}" />
    <input class="button" type="submit" name="NextButton" value="{'Select attribute'|i18n( 'ezattributeconverter/wizard' )}" title="{'Use this attribute.'|i18n( 'dbattributeconverter/wizard' )}" />
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>

</form>