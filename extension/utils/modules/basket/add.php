<?php

$http = eZHttpTool::instance();
$module = $Params['Module'];

$basket = eZBasket::currentBasket();
$basket->updatePrices(); // Update the prices. Transaction not necessary.

$objectID = $Params['ObjectID'];

if ( $Params['Quantity'] )
{
	$quantity = (int)$Params['Quantity'];
    if ( $quantity <= 0 )
    {
    	$quantity = 1;
    }
}
else
{
	$quantity = 1;
}

if( $_SERVER['HTTP_HOST'] == 'formacion.efl.es')
{
  
    header( 'Location: http://www2.efl.es/basket/add/' . $objectID . "/" . $quantity );
}

$http->setSessionVariable( "FromPage", $_SERVER['HTTP_REFERER'] );
$http->setSessionVariable( "addingProduct", $objectID );
$http->setSessionVariable( "AddToBasket_OptionList_" . $objectID, array() );

$module->redirectTo( "/shop/add/" . $objectID . "/" . $quantity );

?>
