{def $nodo=fetch('content','node',hash('node_id',$param|int))}
<div id="content">
    {* zone 0 *}                    
        {if and( is_set( $zones[0].blocks ), $zones[0].blocks|count() )}
            {foreach $zones[0].blocks as $block}
                {block_view_gui block=$block padre=$padre view_parameters=$view_parameters}
            {/foreach}
        {/if}  
     
    {* zone 1 *}
    
        {if and( is_set( $zones[1].blocks ), $zones[1].blocks|count() )}
            {foreach $zones[1].blocks as $block}
                {block_view_gui block=$block padre=$padre view_parameters=$view_parameters}
            {/foreach}
        {/if}
        
</div>    