			
			 <div id="breadCrumb">
												<ul>
  {if $module_result.content_info.node_id|eq(61)}
       <li><a href='/catalogo'>Catálogo</a></li>
       <li class="reset">Tipo de producto</li>
  {else}
  {switch match=$module_result.content_info.parent_node_id}
                                            {case match='156'}
                                              {* formatos *}
                                              {def $total = $module_result.path|count()}
                                                {foreach $module_result.path as $index => $elemento}
                                                {if and( $index|gt(0), ne($elemento.text,'Formularios') )}
                                    
                                                    {if eq($index, $total|sub(1))}
                                                    <li class="reset">{$elemento.text|shorten(54,'[...]')}</li>
                                                    {else}
                                                    
                                                            {if $elemento.text|eq('Auxiliar')}

                                                            <li><a href='/catalogo'>Catálogo</a></li>
                                                            {else}
                                                             	{if $elemento.text|eq('Formatos')}
                                                            <li><a href='/catalogo/por-formato'>Por formato</a></li>
                                                            	{else}
                                                                 <li><a href={$elemento.url_alias|ezurl}>{$elemento.text}</a></li>
                                                                {/if}
                                                            {/if}
                                                    {/if}
                                    
                                                {/if}
                                                {/foreach}
                                              
                                               
                                               
                                               
                                            {/case}
                                            {case match='143'}
                                            	 {def $total = $module_result.path|count()}
                                                {foreach $module_result.path as $index => $elemento}
                                                {if and( $index|gt(0), ne($elemento.text,'Formularios') )}
                                    
                                                    {if eq($index, $total|sub(1))}
                                                    <li class="reset">{$elemento.text|shorten(54,'[...]')}</li>
                                                    {else}
                                                    
                                                            {if $elemento.text|eq('Auxiliar')}

                                                            <li><a href='/catalogo'>Catálogo</a></li>
                                                            {else}
                                                             	{if $elemento.text|eq('Áreas de interés')}
                                                            <li><a href='/catalogo/por-rama-del-derecho'>Por rama del Derecho</a></li>
                                                            	{else}
                                                                 <li><a href={$elemento.url_alias|ezurl}>{$elemento.text}</a></li>
                                                                {/if}
                                                            {/if}
                                                    {/if}
                                    
                                                {/if}
                                                {/foreach}
                                              
											{/case}
                                            {case match='157'}
                                            	
                                                 {def $total = $module_result.path|count()}
                                                {foreach $module_result.path as $index => $elemento}
                                                {if and( $index|gt(0), ne($elemento.text,'Formularios') )}
                                    				
                                                    {if eq($index, $total|sub(1))}
                                                    <li class="reset">{$elemento.text|shorten(54,'[...]')}</li>
                                                    {else}
                                                    
                                                            {if $elemento.text|eq('Auxiliar')}

                                                            <li><a href='/catalogo'>Catálogo</a></li>
                                                            {else}
                                                             	{if $elemento.text|eq('Sectores Productivos')}
                                                            <li><a href='/catalogo/por-sector-profesional'>Por Sector Profesional</a></li>
                                                            	{else}
                                                                 <li><a href={$elemento.url_alias|ezurl}>{$elemento.text}</a></li>
                                                                {/if}
                                                            {/if}
                                                    {/if}
                                    
                                                {/if}
                                                {/foreach}
                                                
                                                
											{/case}	
											{case}
                                            	{*default*}
                                                {def $total = $module_result.path|count()}
                                                {foreach $module_result.path as $index => $elemento}
                                                {if $index|gt(0)}
                                    
                                                    {if eq($index, $total|sub(1))}
                                                    <li class="reset">{$elemento.text|shorten(54,'[...]')}</li>
                                                    {else}
                                                    <li><a href={$elemento.url_alias|ezurl}>{$elemento.text}</a></li>
                                                    {/if}
                                    
                                                {/if}
                                                {/foreach}
                                       
                                            {/case}				


 {/switch}
{/if}
			</ul>

</div>
