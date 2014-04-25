	<div id="address-{$zones[0].blocks[0].zone_id}-{$zones[0].blocks[0].id}">
        {block_view_gui block=$zones[0].blocks[0] zone=$zones[0] attribute=$attribute}
    </div>

    <div id="address-{$zones[0].blocks[1].zone_id}-{$zones[0].blocks[1].id}">
        {block_view_gui block=$zones[0].blocks[1] zone=$zones[0] attribute=$attribute}
    </div>

<div id="gridHome1" class="clearFix">
	    <div class="columnType1">
	     
		        <div id="address-{$zones[1].blocks[0].zone_id}-{$zones[1].blocks[0].id}">
		        {block_view_gui block=$zones[1].blocks[0]}
		        </div>
	     
	         {foreach $zones[2].blocks as $block}
                
                {block_view_gui block=$block}
                
            {/foreach}
	        {foreach $zones[4].blocks as $block}
	            <div id="address-{$block.zone_id}-{$block.id}">
	            {block_view_gui block=$block}
	            </div>
            {/foreach}
	    </div>	    
    </div></div>
    <div class="columnType2">
        {foreach $zones[3].blocks as $block}
        <div id="address-{$block.zone_id}-{$block.id}">
        {block_view_gui block=$block}
        </div>
        {/foreach}
    </div>
</div>
</div>

<div id="gridHome2" class="clearFix">
    {foreach $zones[5].blocks as $block}
        <div id="address-{$block.zone_id}-{$block.id}">
        {block_view_gui block=$block}
        </div>
    {/foreach}
    
    {foreach $zones[6].blocks as $block}
        <div id="address-{$block.zone_id}-{$block.id}">
        {block_view_gui block=$block}
        </div>
    {/foreach}
</div>


    <div id="address-{$zones[7].blocks[0].zone_id}-{$zones[7].blocks[0].id}">
        {block_view_gui block=$zones[7].blocks[0] zone=$zones[7] attribute=$attribute}
    </div>

</div>

