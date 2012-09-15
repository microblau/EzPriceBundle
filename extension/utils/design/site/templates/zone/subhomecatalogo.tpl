{if and( is_set( $zones[0].blocks ), $zones[0].blocks|count() )}
{foreach $zones[0].blocks as $block}
{if or( $block.valid_nodes|count(), 
    and( is_set( $block.custom_attributes), $block.custom_attributes|count() ), 
    and( eq( ezini( $block.type, 'ManualAddingOfItems', 'block.ini' ), 'disabled' ), ezini_hasvariable( $block.type, 'FetchClass', 'block.ini' )|not ) )}
    <div id="address-{$block.zone_id}-{$block.id}">
    {block_view_gui block=$block}
    </div>
{else}
    {skip}
{/if}    
{/foreach}
{/if}

{if and( is_set( $zones[1].blocks ), $zones[1].blocks|count() )}
<div id="todasLasObras">
{if eq( $zones[1].blocks[0].type, 'Completo2Modalidades')}
<div id="gridType1">
{foreach $zones[1].blocks as $block}
    <div id="address-{$block.zone_id}-{$block.id}" class="ezflow-block">
    {block_view_gui block=$block}
    </div>
{/foreach}
</div>
{elseif eq( $zones[1].blocks[0].type, 'Simple')}
<div id="gridType3_zona1" class="divcarousel">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">
                                        <div id="address-{$zones[1].blocks[0].zone_id}-{$zones[1].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[1].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[1].blocks[1].zone_id}-{$zones[1].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[1].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
{elseif eq( $zones[1].blocks[0].type, 'Completo')}
<div id="gridType2_zona2" class="divcarousel2">
   {block_view_gui block=$zones[1].blocks[0]}
</div>
{/if}
{/if}

{*********** ZONA 3 ******}

{if and( is_set( $zones[2].blocks ), $zones[2].blocks|count() )}
{if eq( $zones[2].blocks[0].type, 'Simple')}
<div id="gridType3_zona2" class="divcarousel">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">   
                                        <div id="address-{$zones[2].blocks[0].zone_id}-{$zones[2].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[2].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[2].blocks[1].zone_id}-{$zones[2].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[2].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
{elseif eq( $zones[1].blocks[0].type, 'Completo')}
<div id="gridType2_zona3" class="divcarousel2">
   {block_view_gui block=$zones[2].blocks[0]}
</div>
{else}
{foreach $zones[2].blocks as $block}
<div id="gridType2">
    <div id="address-{$block.zone_id}-{$block.id}">
    {block_view_gui block=$block}
    </div>
</div>
{/foreach}
{/if}
{/if}



{if and( is_set( $zones[3].blocks ), $zones[3].blocks|count() )}
{if eq( $zones[1].blocks[0].type, 'Completo')}
<div id="gridType2_zona4" class="divcarousel2">
   {block_view_gui block=$zones[3].blocks[0]}
</div>
{else}
<div id="gridType3" class="divcarousel">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">   
                                        <div id="address-{$zones[3].blocks[0].zone_id}-{$zones[3].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[3].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[3].blocks[1].zone_id}-{$zones[3].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[3].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
                            
                            

{/if}

{*********** ZONA 5 ******}

{if and( is_set( $zones[4].blocks ), $zones[4].blocks|count() )}
{if eq( $zones[4].blocks[0].type, 'Simple')}
<div id="gridType3_zona4" class="divcarousel">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">   
                                        <div id="address-{$zones[4].blocks[0].zone_id}-{$zones[4].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[4].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[4].blocks[1].zone_id}-{$zones[4].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[4].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
{elseif eq( $zones[1].blocks[0].type, 'Completo')}
<div id="gridType2_zona5" class="divcarousel2">
   {block_view_gui block=$zones[4].blocks[0]}
</div>
{else}
<div id="gridType4">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">   
                                        <div id="address-{$zones[4].blocks[0].zone_id}-{$zones[4].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[4].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[4].blocks[1].zone_id}-{$zones[4].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[4].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
                            
{/if}                            

{/if}

{if and( is_set( $zones[5].blocks ), $zones[5].blocks|count() )}
{if eq( $zones[5].blocks[0].type, 'Simple')}
<div id="gridType3_zona5" class="divcarousel">
                                                        
                                <div class="wrap clearFix">

                                    <div class="columnType1">   
                                        <div id="address-{$zones[5].blocks[0].zone_id}-{$zones[5].blocks[0].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[5].blocks[0]}
                                        </div>
                                        
                                    </div>
                                    <div class="columnType2">   
                                        <div id="address-{$zones[5].blocks[1].zone_id}-{$zones[5].blocks[1].id}" class="ezflow-block">
                                            {block_view_gui block=$zones[5].blocks[1]}
                                        </div>
                                    </div>
                                </div>

                            
</div>
{else}
{foreach $zones[5].blocks as $block}
    <div id="address-{$block.zone_id}-{$block.id}" class="ezflow-block">
    {block_view_gui block=$block}
    </div>
{/foreach}
{/if}
{/if}

</div>