{default page_uri_suffix=false()
         left_max=5
         right_max=4}
{default name=ViewParameter
         page_uri_suffix=false()
         left_max=$left_max
         right_max=$right_max}

{let page_count=int( ceil( div( $item_count,$item_limit ) ) )
      current_page=min($:page_count,
                       int( ceil( div( first_set( $view_parameters.offset, 0 ),
                                       $item_limit ) ) ) )
      item_previous=sub( mul( $:current_page, $item_limit ),
                         $item_limit )
      item_next=sum( mul( $:current_page, $item_limit ),
                     $item_limit )

      left_length=min($ViewParameter:current_page,$:left_max)
      right_length=max(min(sub($ViewParameter:page_count,$ViewParameter:current_page,1),$:right_max),0)
      view_parameter_text=""
      offset_text=eq( ezini( 'ControlSettings', 'AllowUserVariables', 'template.ini' ), 'true' )|choose( '/offset/', '/(offset)/' )}
{* Create view parameter text with the exception of offset *}
{section loop=$view_parameters}
 {section-exclude match=eq($:key,offset)}
 {section-exclude match=$:item|not}
 {set view_parameter_text=concat($:view_parameter_text,'/(',$:key,')/',$:item)}
{/section}


{section show=$:page_count|gt(1)}



<div class="pagination frt">
 <span class="botones">
     {switch match=$:item_previous|lt(0) }
       {case match=0}
          <a href={concat($page_uri,$:item_previous|gt(0)|choose('',concat($:offset_text,$:item_previous)),$:view_parameter_text,$page_uri_suffix)|ezurl} class="prev">anterior</a>
       {/case}
       {case match=1}
      	 <span class="prev reset">anterior</span>
       {/case}
     {/switch}

    


{section show=$:current_page|gt($:left_max)}

{section show=sub($:current_page,$:left_length)|gt(1)}

{/section}
{/section}

    {section loop=$:left_length}
        {let page_offset=sum(sub($ViewParameter:current_page,$ViewParameter:left_length),$:index)}
        {/let}
    {/section}
    {section loop=$:right_length}
        {let page_offset=sum($ViewParameter:current_page,1,$:index)}
        {/let}
    {/section}

{section show=$:page_count|gt(sum($:current_page,$:right_max,1))}
{section show=sum($:current_page,$:right_max,2)|lt($:page_count)}

{/section}
{/section}

	{switch match=$:item_next|lt($item_count)}
      {case match=1}
        <a href={concat($page_uri,$:offset_text,$:item_next,$:view_parameter_text,$page_uri_suffix)|ezurl} class="next">siguiente</a>
      {/case}
      {case}
       <span class="next reset">anterior</span>
      {/case}
    {/switch}

</span>
 <span class="items"><span class="actual">{$:current_page|inc}</span> / <span class="total">{$:page_count}</span></span>

</div>

{/section}

 {/let}
{/default}
{/default}

