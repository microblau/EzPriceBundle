<?php
include( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
$contents = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' )->fetchContents();
$unserialized_cache = unserialize( $contents );
$encuesta = eZContentObject::fetch( $unserialized_cache['encuesta'] );
$data = $encuesta->dataMap();
$http = eZHTTPTool::instance();
$module = $Params['Module'];
$modos = array( 'transferencia', 'paypal', 'tpv', 'domiciliacion' );
$tpl->setVariable( 'basket', eZBasket::currentBasket() );
eZBasket::currentBasket()->remove();
if( $http->hasPostVariable( 'ContinueButton' ) )
{
   
    $hash = eflHashEncuestas::fetch( $Params['Hash'] );
    $hash->setAttribute( 'status', 3 );
    $hash->store();
    $type = $hash->attribute( 'type' );
    $order_id = $hash->attribute( 'order_id' );
    $module->redirectTo( $modos[$type] . '/complete/' . $order_id . '/1' );
}
elseif( $http->hasPostVariable( 'send' ) )
{
    $s = new eZSurveyType();
    $content =  $s->objectAttributeContent( $data['survey'] );

    if( $content['survey_validation'] )
    {
        $tpl->setVariable( 'preview', false );
    }

    if( $content['survey_validation']['one_answer_count'] == 1 )
    {
        $hash = eflHashEncuestas::fetch( $Params['Hash'] );
        $type = $hash->attribute( 'type' );
        $order_id = $hash->attribute( 'order_id' );
        $module->redirectTo( $modos[$type] . '/complete/' . $order_id . '/1' );
    }
}

$tpl->setVariable( 'hash', $Params['Hash'] );
$tpl->setVariable( 'order_id', $Params['OrderID'] );
$tpl->setVariable( 'node', $encuesta->attribute( 'main_node' ) );
$Result = array();
$Result['content'] = $tpl->fetch( "design:encuesta/rellenar.tpl" );
$Result['path'] = array( array( 'url' => false,
	                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
?>
