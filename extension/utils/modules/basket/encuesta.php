<?php
include( 'kernel/common/template.php' );
$tpl = templateInit();
$http = eZHTTPTool::instance();
if( $http->hasPostVariable( 'Send' ) )
{
    $content = array( 'encuesta' => $http->postVariable( 'encuesta' ) );
    $handler = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' );
    $handler->storeContents( serialize( $content ), 'text', 'text/plain' ) ;
}

$contents = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' )->fetchContents();
$unserialized_cache = unserialize( $contents );
$tpl->setVariable( 'encuesta_id', $unserialized_cache['encuesta'] ) ;

$Result = array();
$Result['content'] = $tpl->fetch( "design:encuesta/config.tpl" );
$Result['path'] = array( array( 'url' => false,
	                                'text' => ezi18n( 'kernel/shop', 'Basket' ) ) );
?>
