{ezscript_load( array( ezini( 'JavaScriptSettings', 'JavaScriptList', 'design.ini' ), ezini( 'JavaScriptSettings', 'FrontendJavaScriptList', 'design.ini' ) )|prepend( 'ezjsc::jquery', 'ezjsc::jqueryio' ) )}
{if $module_result.uri|contains( '/basket/')}
<script language="JavaScript" src='https://secure.comodo.net/trustlogo/javascript/trustlogo.js'></script>
{/if}
