{ezcss_require( 'home.css' )}
{def $block1class = ''}
{if is_set( $zones[0].blocks[1] )|not}
{set $block1class = concat( $block1class, 'wide' )}
{/if}
{if $zones[0].blocks[0].type|eq( 'PromocionPrimariaUnica' )}
{set $block1class = concat( $block1class, ' type2')}
{/if}
{if $zones[0].blocks[0].type|eq( 'PromocionPrimariaRelatedObjects' )}
{set $block1class = concat( $block1class, ' type3')}
{/if}
<div class="clearFix">
    <div id="promocionPrimaria"  {if $block1class|ne('')}class="{$block1class}"{/if}>
	    <div id="address-{$zones[0].blocks[0].zone_id}-{$zones[0].blocks[0].id}">     
        {block_view_gui block=$zones[0].blocks[0] zone=$zones[0] attribute=$attribute}
        </div>
    </div>
    {if is_set( $zones[0].blocks[1] )}
    <div id="formPrueba">
    <div id="address-{$zones[0].blocks[1].zone_id}-{$zones[0].blocks[1].id}">
        {block_view_gui block=$zones[0].blocks[1] zone=$zones[0] attribute=$attribute}
    </div>
    </div>
    {/if}
</div>
<div id="gridHome1" class="clearFix">
    <div class="columnType1">
        <div id="address-{$zones[1].blocks[0].zone_id}-{$zones[1].blocks[0].id}">
		            {block_view_gui block=$zones[1].blocks[0]}
		            </div>
                    <div id="address-{$zones[1].blocks[1].zone_id}-{$zones[1].blocks[1].id}">
		            {block_view_gui block=$zones[1].blocks[1]}
		            </div>
                    <div id="address-{$zones[1].blocks[2].zone_id}-{$zones[1].blocks[2].id}">
		            {block_view_gui block=$zones[1].blocks[2]}
		            </div>
                    </div>

                    <div id="address-{$zones[1].blocks[3].zone_id}-{$zones[1].blocks[3].id}">
                    {block_view_gui block=$zones[1].blocks[3]}
                    </div>
            </div>   
        </div>    
            <div class="columnType2">
            <div id="address-{$zones[1].blocks[4].zone_id}-{$zones[1].blocks[4].id}">
		            {block_view_gui block=$zones[1].blocks[4]}
            </div>
    </div>    
</div>

</div>
<div id="gridHome2" class="clearFix">
    <div id="modDestacados">
    <div id="address-{$zones[2].blocks[0].zone_id}-{$zones[2].blocks[0].id}">
                    {block_view_gui block=$zones[2].blocks[0]}
    </div>
    <div id="address-{$zones[2].blocks[1].zone_id}-{$zones[2].blocks[1].id}">
                    {block_view_gui block=$zones[2].blocks[1]}
    </div>
    </div>
    <div id="address-{$zones[2].blocks[2].zone_id}-{$zones[2].blocks[2].id}">
                    {block_view_gui block=$zones[2].blocks[2]}
    </div>
    
</div>
<div id="address-{$zones[3].blocks[0].zone_id}-{$zones[3].blocks[0].id}">
{block_view_gui block=$zones[3].blocks[0] zone=$zones[3] attribute=$attribute}
</div>

