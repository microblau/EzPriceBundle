<?php 
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();
$http = eZHTTPTool::instance();
$basket = eZBasket::currentBasket();
$tpl->setVariable( 'basket',  eZBasket::currentBasket() );
$tpl->setVariable( 'order_id', $Params['OrderID'] );
if( $http->hasPostVariable( 'btnContinuar' ) )
{
    $tpl->setVariable( 'id', $Params['OrderID'] );
    $eflws = new eflWS();
    $eflws->setUsuarioDatosPaso3( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'profesiones' ),
                $http->postVariable( 'cargo' ),
                $http->postVariable( 'departamento' ),
                $http->postVariable( 'especialidad' ),
                $http->postVariable( 'numEmple' ),
                $http->postVariable( 'actividad' )
            );
     
     $eflws->setAreasInteres( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'area' )
            );
    $Result = array();
    $Result['content'] = $tpl->fetch( "design:paypal/finproceso.tpl" );
    $Result['path'] = array( array( 'url' => false,
                                    'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
    return;
}
$basket->remove();
$contents = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' )->fetchContents();
$unserialized_cache = unserialize( $contents );
$encuesta = eZContentObject::fetch( $unserialized_cache['encuesta'] );
if( $encuesta != 0 )
{
    $data = $encuesta->dataMap();
    $survey = $data['survey']->content();    
    $surveyvalidation = $survey['survey_validation'];
    if ( ( isset( $surveyvalidation['one_answer'] ) || ( isset( $surveyvalidation['one_answer_count']) &&  ( $surveyvalidation['one_answer_count']>0 ) ) ) === false )
    {
        if( !$http->hasPostVariable( 'BtnPassSurvey' ) &&  !$http->hasPostVariable                               ( 'ContentObjectAttribute_ezsurvey_store_button'  ) )
        {
            
            
             $tpl->setVariable( 'encuesta', true );
                $tpl->setVariable( 'node', $encuesta->attribute( 'main_node' ) );
                $Result = array();
            	$Result['content'] = $tpl->fetch( "design:transferencia/complete.tpl" );
	            $Result['path'] = array( array( 'url' => false,
	                                        'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
        } 
        elseif( $http->hasPostVariable                               ( 'ContentObjectAttribute_ezsurvey_store_button'  ) )
        {
          
            
             $tpl->setVariable( 'encuesta', false );
                $tpl->setVariable( 'node', $encuesta->attribute( 'main_node' ) );
                $Result = array();
            	$Result['content'] = $tpl->fetch( "design:transferencia/complete.tpl" );
	            $Result['path'] = array( array( 'url' => false,
	                                        'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
        }
    }
}
if( $http->hasPostVariable( 'btnContinuar' ) )
{
    $eflws = new eflWS();
    $eflws->setUsuarioDatosPaso3( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'profesiones' ),
                $http->postVariable( 'cargo' ),
                $http->postVariable( 'departamento' ),
                $http->postVariable( 'especialidad' ),
                $http->postVariable( 'numEmple' ),
                $http->postVariable( 'actividad' )
            );
     
     $eflws->setAreasInteres( 
                $http->hasSessionVariable( 'id_user_lfbv' ) ? $http->sessionVariable( 'id_user_lfbv' ) : 90,
                $http->postVariable( 'area' )
            );
    $Result = array();
    $Result['content'] = $tpl->fetch( "design:paypal/finproceso.tpl" );
}
else
{
    
	$tpl->setVariable( 'id', $http->sessionVariable( 'id_pedido_lfbv' ) );
    
	$Result = array();
	$Result['content'] = $tpl->fetch( "design:paypal/complete.tpl" );
	$Result['path'] = array( array( 'url' => false,
	                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
}
?>
