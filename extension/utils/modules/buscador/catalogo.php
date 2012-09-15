<?php

/*
 * redirigimos al nodo que nos viene por post.
 */
$module = $Params['Module']; 
$http = eZHTTPTool::instance();

if ( ( $http->hasPostVariable( 'quieroVer' ) ) and ( is_numeric( $http->postVariable( 'quieroVer' ) ) ) )
{   
    $module->redirectTo( eZContentObjectTreeNode::fetch( $http->postVariable( 'quieroVer' ) )->urlAlias() );
}

?>