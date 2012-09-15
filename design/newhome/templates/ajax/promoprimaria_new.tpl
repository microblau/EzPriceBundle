                            <div class="description">
                                {$node.data_map.texto.content.output.output_text}
                              

                                {if or($node.data_map.youtube_url.has_content,$node.data_map.video.has_content)}
                                <span class="verVideo"><a href={concat('/producto/vervideo?n=', $node.node_id)} id="video">Mire el vídeo de esta publicación</a></span>

                                {/if}
                            </div>
<script type="text/javascript">
{literal}
  $("#video").fancybox({
			'width':624, 
			'height':453,
			'padding':0,
			'type':'iframe'
	    });
{/literal}
</script>
