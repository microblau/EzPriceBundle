{$node.data_map|attribute(view, 1)}
{if $node.data_map.video_youtube.has_content}
{$node.data_map.video_youtube.content|redirect()}
{elseif $node.data_map.video_html.has_content}
{$node.data_map.video_html.content|redirect()}
{/if}

