{foreach $items as $item}                                
<li><a target="_blank" href="{$item.data_map.url.content}">{$item.name} - {$item.object.published|datetime('custom', '%d/%m/%Y')}</a></li>
{/foreach}
<li style="font-size:10px"><a target="_blank" href="{$items.0.parent.data_map.origen.content}">ver más noticias</a></li>
