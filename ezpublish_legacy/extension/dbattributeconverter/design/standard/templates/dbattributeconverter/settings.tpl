{foreach $settings as $item}

	{switch match=$item.type}
	
		{case match='checkbox'}

			<div class="block">
				<input type="checkbox" name="Settings[{$item.name}]" {if is_set($posted[$item.name])}checked="checked"{/if} /> {$item.label|wash}
			</div>
		{/case}
		
		{case match='select'}
		
			<div class="block">
				{$item.label|wash}
    			<select name="Settings[{$item.name}]">
			
			{foreach $item.options as $key => $option_name}
			
				  <option value="{$key}" {if eq($key,$posted[$item.name])}selected="selected"{/if}>{$option_name|wash}</option>
			{/foreach}
			
    			</select>
			</div>
		{/case}
		
		{case}

			<div class="block">
				{$item.label|wash} <input type="text" name="Settings[{$item.name}]" value="{cond( $posted[$item.name], $posted[$item.name], $item.default )}" />
			</div>
		{/case}
		
	{/switch}
	
{/foreach}
