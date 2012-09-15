{if is_unset( $load_css_file_list )}
    {def $load_css_file_list = true()}
{/if}

{if $load_css_file_list}
  {ezcss_load( array( 'core.css',
                      'debug.css',
                      'pagelayout.css',
                      'content.css',
                      'websitetoolbar.css',
                      ezini( 'StylesheetSettings', 'CSSFileList', 'design.ini' ),
                      ezini( 'StylesheetSettings', 'FrontendCSSFileList', 'design.ini' ) ))}
{else}
  {ezcss_load( array( 'core.css',
                      'debug.css',
                      'pagelayout.css',
                      'content.css',
                      'websitetoolbar.css' ))}
{/if}

{if $module_result.node_id|eq( 2 )}
{ezcss_require( array( 'jquery.jcarousel.css' ) )} 
{/if}
<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href={"stylesheets/fixIE.css"|ezdesign()} /> 
<![endif]-->
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href={"stylesheets/fixIE6.css"|ezdesign()} />	
<![endif]-->
<link rel="stylesheet" type="text/css" href={"stylesheets/impresion.css"|ezdesign()} media="print" />
