{foreach $items as $item}                                
<li><a target="_blank" href="{$item.data_map.url.content}">{$item.name} - {$item.object.published|datetime('custom', '%d/%m/%Y')}</a></li>
{/foreach}
<li style="font-size:10px"><a target="_blank" href="http://www.rssactum.es">ver más noticias</a></li>
