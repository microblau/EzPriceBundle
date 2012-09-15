<div id="gridTwoColumnsTypeB" class="clearFix">
	{* zona 0 *}
	    <div class="columnType1">
		    {if and( is_set( $zones[0].blocks ), $zones[0].blocks|count() )}
		        {foreach $zones[0].blocks as $block}
		            {block_view_gui block=$block}
		        {/foreach}
		    {/if}
	    </div>
	{* end zona 0 *}
	    
	{* zona 1 *}
	    <div class="sideBar">
	        {if and( is_set( $zones[1].blocks ), $zones[1].blocks|count() )}
	            {foreach $zones[1].blocks as $block}
		           {block_view_gui block=$block}
		        {/foreach}
		     {/if}
	    </div>
	{* end zona 1 *}
</div>

{* zona 2 *}
<div id="modFormacion">
    <div>
        <h2>¿Qué formación prefiere? Lefebvre le ofrece todo lo que necesita</h2>
        <div class="wrap clearFix">
            <div class="description">
                <ul class="formacionList formacionList2">
                {if and( is_set( $zones[2].blocks), $zones[0].blocks|count() )}
                    {foreach $zones[2].blocks as $index => $block}
                        <li class="curso{cond(eq($index|inc|mod(3),0), " reset")} {cond($index|lt(3), 'file01', 'file02')}">
                            <div class="cont">
                                <h3 class="title {$block.custom_attributes.estilo}"><span>{$block.name}</span></h3>
                                <ul>
                                    {foreach $block.valid_nodes as $index2 => $curso}
                                        {if $index2|lt(3)}
                                            <li {cond(eq($index2,2),' class="last"')}>
                                                <a href="{$curso.url_alias|ezurl(no)}"><span class="curso">{$curso.name}</span></a>
                                                {if $curso.data_map.fecha_inicio.has_content}
                                                <span>{$curso.data_map.fecha_inicio.content.timestamp|datetime( 'custom', '%d/%m/%Y')} {if $curso.data_map.fecha_fin.has_content}- {$curso.data_map.fecha_fin.content.timestamp|datetime( 'custom', '%d/%m/%Y')}{/if}</span>
                                                {/if}
                                            </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                                {def $nodoEnlace=fetch('content','node',hash('node_id',$block.custom_attributes.enlace|int))}
                                <span class="verMas"><a href={$nodoEnlace.url_alias|ezurl()}>{$block.custom_attributes.textoenlace}</a></span>
                                {def $nodoTestimonio=fetch('content','node',hash('node_id',$block.custom_attributes.testimonio|int))}
                                {if $nodoTestimonio.object.contentclass_id|eq(51)}
                                <div class="modInt">
                                    <div class="cont clearFix">
                                        
                                        
                                        <img src={$nodoTestimonio.data_map.foto_testimonio.content[original].url|ezroot} alt="{$nodoTestimonio.data_map.foto_testimonio.content[original].text}" />
                                        <div class="text">
                                            {$nodoTestimonio.data_map.testimonio.content.output.output_text}
                                            <span><strong>{$nodoTestimonio.data_map.nombre_persona.data_text|wash}</strong></span>
                                            <span>{$nodoTestimonio.data_map.empresa.data_text|wash}</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                {/if}
                                {undef $nodoTestimonio $nodoEnlace}
                            </div>
                        </li>
                    {/foreach}
                {/if}
                </ul>
             </div>
         </div>
    </div>
</div>
{* end zona 2*} 
