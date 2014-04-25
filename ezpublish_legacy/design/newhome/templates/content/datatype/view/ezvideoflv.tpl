{def $flv=concat( 'video/flv/', $attribute.contentobject_id,"/",$attribute.content.contentobject_attribute_id )
     $preview=concat( 'video/preview/', $attribute.contentobject_id,"/",$attribute.content.contentobject_attribute_id )
     $player=ezini( 'FLVPlayer', 'File', 'ezvideoflv.ini' )
     $options=ezini( 'FLVPlayer', 'Options', 'ezvideoflv.ini' )
     $opt_string=''}
{*
{if $attribute.has_content}
    {if $attribute.content.has_flv}
        {foreach $options as $key => $value}
            {set opt_string=concat( $opt_string, '&amp;', $key, '=', $value )}
        {/foreach}
        <object type="application/x-shockwave-flash" data={$player|ezdesign()} width="{$width}" height="{$height}">
            <param name="movie" value={$player|ezdesign()} />
            <param name="allowFullScreen" value="true" />
            <param name="FlashVars" value="flv={$flv|ezurl( 'no' )}&amp;startimage={$preview|ezurl( 'no' )}{$opt_string}" />
        </object>
    {else}
    <p>{'No file'|i18n( 'ezvideoflv/datatype' )}</p>
{/if}
*}


{if $attribute.has_content}
    {if $attribute.content.has_flv}
	
	<script type='text/javascript' src={'javascript/swfobject.js'|ezdesign}></script>
 
	<div id='mediaspace'></div>
	{literal}
	<script type='text/javascript'>
	  var so = new SWFObject('{/literal}{'swf/player.swf'|ezdesign(no)}{literal}','mpl','{/literal}{$width}{literal}','{/literal}{$height}{literal}','9');
	  so.addParam('allowfullscreen','true');
	  so.addParam('allowscriptaccess','always');
	  so.addParam('wmode','opaque');
	  so.addVariable('author','Ediciones Francis Lefebvre');
	  so.addVariable('duration','{/literal}{$attribute.content.duration}{literal}');
	  so.addVariable('file','{/literal}{$attribute.content.filepath|ezroot( 'no' )}{literal}');
	  so.addVariable('image','{/literal}{$attribute.content.preview|ezroot( 'no' )}{literal}');
      so.addVariable('autostart','{/literal}{cond( $autostart|eq(1), 'false', 'false')}{literal}');
//		so.addVariable('bufferlength', '200');
	  so.write('mediaspace');
	</script>
	{/literal}
    {/if}
{/if}
{undef $width $height $flv $opt_string $options $player $preview}
