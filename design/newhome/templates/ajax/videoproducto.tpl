{*ezcss_require( 'styles.css')}   
{ezscript_require('jquery-1.3.1.js')}
{ezscript_require('langEs.js')}
{ezscript_require('common.js')}
{ezscript_require('jquery.fancybox-1.3.0.pack.js')*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Vídeo {$node.name} - Ediciones Francis Lefebvre.</title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Metadatos para los buscadores -->
	<meta name="description" content="..." />
	<meta name="keywords" content="..." />
	<meta name="language" content="es" />
	

	
	
	<!-- Icono en la barra de la URL -->
	 <link rel="shortcut icon" href="favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/styles.css" media="all" />	
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" href="css/fixIE.css" /> 
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="css/fixIE6.css" />	
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="/design/site/stylesheets/print.css" media="print" />
	



</head>
<body id="lightboxWrap">
	<div id="wrapper">
	
		
		
		
		<div id="bodyContent">
                
				<div id="videoLightbox" class="columnType1">
					<div id="modType2">
						
							<h1>{$node.name}</h1>
							
							<div class="wrap clearFix">                    		
									<div class="description">
                                    	<div class="videoLgb">
                                        	
                {if $node.data_map.youtube_url.has_content}
                    {eflyoutube( $node.data_map.youtube_url.content, 581, 320 )}
                {else}
                    {if $node.data_map.video.has_content}
                        {def $video = fetch( 'content', 'object', hash( 'object_id', $node.data_map.video.content.relation_browse.0.contentobject_id ))}                        {attribute_view_gui attribute=$video.data_map.video width=236 height=213 autostart=0}                       
                    {/if}
                {/if}
                                            
                                        </div>								
									</div>								                        											
							</div>
						
					</div>
		
				</div>		
			
		
		</div>
	</div>
    
   <script type="text/javascript" src="/design/site/javascript/jquery-1.3.1.js"></script>   	   
   <script type="text/javascript" src="/design/site/javascript/langEs.js"></script>
   <script type="text/javascript" src="/design/site/javascript/common.js"></script>
    
    
    
</body>
</html> 
