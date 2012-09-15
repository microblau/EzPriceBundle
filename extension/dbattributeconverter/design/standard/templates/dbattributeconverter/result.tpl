<form action={$wizard.url|ezurl} method="post">

<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h1 class="context-title">{'Wizard finished'|i18n( 'extension/dbattributeconverter')|wash}</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

<div class="block">

{if $in_background}
	
	{if $scheduled_script_id|gt(0)}

    <p>
        {'The process has been scheduled to run in the background, and will be started automatically. Please do not edit the class again until the process has finished. You can monitor the progress of the background process here:'|i18n( 'design/admin/class/view' )}<br />
        <b><a href={concat('scriptmonitor/view/',$scheduled_script_id)|ezurl}>{'Background process monitor'|i18n( 'design/admin/class/view' )}</a></b>
    </p>

	{else}

	<h2>Run the following CLI script to make conversion</h2>
	
	<label>php extension/dbattributeconverter/bin/converter.php -s <your_siteaccess> --filename-part={$filename_part}</label>

    {/if}

{else}

	<h2>Finished!</h2>

	<p>Total eZContentAttribute objects converted: {$total_attribute_count}</p>

{/if}

</div>

{* DESIGN: Content END *}</div></div></div>

<div class="controlbar">
{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-tc"><div class="box-bl"><div class="box-br">
<div class="block">
    <input class="button" type="submit" name="RestartButton" value="{'Restart'|i18n( 'dbattributeconverter/wizard' )}" title="{'Restart wizard.'|i18n( 'extension/ezattributeconverter' )}" />
</div>
{* DESIGN: Control bar END *}</div></div></div></div></div></div>
</div>

</div>

</form>