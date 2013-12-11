{ezscript_load( array( ezini( 'JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini' ) ) )}
{if  or( $module_result.template_list.0|contains( 'listadoproductos.tpl' ), 
		 $module_result.template_list.0|contains( 'subhomeproductos.tpl' ), 
		 $module_result.template_list.0|contains( 'catalog.tpl' ),  
		 $module_result.uri|contains( 'catalogo/novedades/' ),
		 $module_result.uri|contains( 'buscador/productos/' ),

 )}
	{ezscript_require( array( 'filtros.js' ) )}  
{/if}

{if $module_result.node_id|eq( 2 )}
{ezscript_require( array( 'jquery.jcarousel.js' ) )} 
{/if}

{if $module_result.uri|eq( '/basket/payment' )}
{ezscript_require( array( 'pagos.js' ) )} 
{/if}

{if or( $module_result.template_list.0|contains( 'listado_ofertas.tpl' ),
        $module_result.template_list.0|contains( 'formacion.tpl' ),
        $module_result.template_list.0|contains( 'subhomecursospresenciales_area.tpl' ),
        $module_result.template_list.0|contains( 'subareaproductos.tpl' ),
         $module_result.template_list.0|contains( 'colectivos.tpl' ),
         $module_result.template_list.0|contains( 'formacionincompany.tpl' ),
         $module_result.template_list.0|contains( 'formacionfechas.tpl' ),
         )}
        
    {ezscript_require( array( 'filtros.js' ) )}
{/if}
{ezscript_require( array( 'msg-cookies.js' ) )}