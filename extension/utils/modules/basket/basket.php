<?php
//
// Created on: <04-Jul-2002 13:19:43 bf>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

$http = eZHTTPTool::instance();
$module = $Params['Module'];

require_once( "kernel/common/template.php" );
$basket = eZBasket::currentBasket();

$tpl = eZTemplate::factory();
//comprabamos codigo
if( $http->hasPostVariable( 'btnCodigo' ) )
{
    
    $codigo = $http->postVariable( 'codigo' );
    $checkcode = eZContentObjectTreeNode::subTreeByNodeID( 
                        array( 'Limitation' => array(),
                                'AttributeFilter' => array( 'and',
                                                    array( 657, '=', $codigo ),
                                                    array( 659, '<=', time() ),
                                                    array( 660, '>=', time() ) )
 ),
        1194);

    if( $checkcode[0] )
    {
        
        $datacheck = $checkcode[0]->dataMap();
        
        $afectados = $datacheck['productos_bono']->content();
        $productos_bono = array();
        foreach( $afectados['relation_browse'] as $item )
        {
            $productos_bono[] = $item['contentobject_id'];
        }
         

        
                $order = array();
                $order['codigopromocional'] = $codigo;
                $tpl->setVariable( 'codigo', $codigo );
                $order['productos_bono'] = $productos_bono;
                $order['descuento'] = $datacheck['descuento']->content();
                $order_object = new eflOrders( array( 
                                                'productcollection_id' => $basket->attribute( 'productcollection_id' ),
                                                'order_serialized' => serialize( $order )
                    ) );
                
                $order_object->store();
                
       
       

         
        
    }
    else
    {
                $order = array();
                $order['codigopromocional'] = $codigo;
                $tpl->setVariable( 'codigo', $codigo );
                $order['productos_bono'] = array();
                $order['descuento'] = 0;
                $order_object = new eflOrders( array( 
                                                'productcollection_id' => $basket->attribute( 'productcollection_id' ),
                                                'order_serialized' => serialize( $order )
                    ) );
                
                $order_object->store();
                
    }
}


$basket->updatePrices(); // Update the prices. Transaction not necessary.


if ( $http->hasPostVariable( "ActionAddToBasket" ) )
{
    
	$objectID = $http->postVariable( "ContentObjectID" );

    if ( $http->hasPostVariable( "Quantity" ) )
    {
        $quantity = (int)$http->postVariable( "Quantity" );
        if ( $quantity <= 0 )
        {
            $quantity = 1;
        }
    }
    else
    {
        $quantity = 1;
    }

    if ( $http->hasPostVariable( 'eZOption' ) )
        $optionList = $http->postVariable( 'eZOption' );
    else
        $optionList = array();

    $http->setSessionVariable( "FromPage", $_SERVER['HTTP_REFERER'] );
    $http->setSessionVariable( "AddToBasket_OptionList_" . $objectID, $optionList );

    $module->redirectTo( "/basket/add/" . $objectID . "/" . $quantity );
    return;
}

if ( $http->hasPostVariable( "RemoveProductItemDeleteList" ) )
{
    $itemCountList = $http->postVariable( "ProductItemCountList" );
    $itemIDList = $http->postVariable( "ProductItemIDList" );   
	
    if ( is_array( $itemCountList ) && is_array( $itemIDList ) && count( $itemCountList ) == count( $itemIDList ) && is_object( $basket ) )
    {
        
    	$productCollectionID = $basket->attribute( 'productcollection_id' );
        //$removeItem = $http->postVariable( "RemoveProductItemButton" );
        $removeItem =  $http->postVariable( "RemoveProductItemDeleteList" );
        if ( $http->hasPostVariable( "RemoveProductItemDeleteList" ) )
            $itemList = $http->postVariable( "RemoveProductItemDeleteList" );
        else
            $itemList = array();

        $i = 0;

        $db = eZDB::instance();
        $db->begin();
        $itemCountError = false;
        
        if ( is_numeric( $removeItem )  )
        {
            if( ( $http->postVariable( 'RemoveProductItemDeleteList_' . $removeItem . '_x' ) != 0 ) and ( $http->postVariable( 'RemoveProductItemDeleteList_' . $removeItem . '_y' ) != 0 ) )
            {
                $basket->removeItem( $removeItem );
            }
            else
            {
                 

                    $itemCountList = $http->postVariable( "ProductItemCountList" );
                    $itemIDList = $http->postVariable( "ProductItemIDList" );

                    // We should check item count, all itemcounts must be greater than 0
                    foreach ( $itemCountList as $itemCount )
                    {
                        // If item count of product <= 0 we should show the error
                        if ( !is_numeric( $itemCount ) or $itemCount < 0 )
                        {
                            // Redirect to basket
                            $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
                            return;
                        }
                    }

                    $http->setSessionVariable( 'ProductItemCountList', $itemCountList );
                    $http->setSessionVariable( 'ProductItemIDList', $itemIDList );

                    $module->redirectTo( '/basket/updatebasket/' );
                    return;
            }
        }
        else
        {
            foreach ( $itemList as $item )
            {
                if( ( $http->postVariable( 'RemoveProductItemDeleteList_' . $item . '_x' ) != 0 ) and ( $http->postVariable( 'RemoveProductItemDeleteList_' .  $item . '_y' ) != 0 ) )
                {
                    $basket->removeItem( $item );
                }
                else
                {
                   

                    $itemCountList = $http->postVariable( "ProductItemCountList" );
                    $itemIDList = $http->postVariable( "ProductItemIDList" );

                    // We should check item count, all itemcounts must be greater than 0
                    foreach ( $itemCountList as $itemCount )
                    {
                        // If item count of product <= 0 we should show the error
                        if ( !is_numeric( $itemCount ) or $itemCount < 0 )
                        {
                            // Redirect to basket
                            $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
                            return;
                        }
                    }

                    $http->setSessionVariable( 'ProductItemCountList', $itemCountList );
                    $http->setSessionVariable( 'ProductItemIDList', $itemIDList );

                    $module->redirectTo( '/basket/updatebasket/' );
                    return;
                }
            }
        }

        // Update shipping info after removing an item from the basket.
        eZShippingManager::updateShippingInfo( $basket->attribute( 'productcollection_id' ) );

        $db->commit();

        if ( $itemCountError )
        {
            $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
            return;
        }

        $module->redirectTo( $module->functionURI( "basket" ) . "/" );
        return;
    }
}

if ( $http->hasPostVariable( "StoreChangesButton" ) )
{
    $itemCountList = $http->postVariable( "ProductItemCountList" );
    $itemIDList = $http->postVariable( "ProductItemIDList" );

    // We should check item count, all itemcounts must be greater than 0
    foreach ( $itemCountList as $itemCount )
    {
        // If item count of product <= 0 we should show the error
        if ( !is_numeric( $itemCount ) or $itemCount < 0 )
        {
            // Redirect to basket
            $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
            return;
        }
    }

    $http->setSessionVariable( 'ProductItemCountList', $itemCountList );
    $http->setSessionVariable( 'ProductItemIDList', $itemIDList );

    $module->redirectTo( '/basket/updatebasket/' );
    return;
}



if ( $http->hasPostVariable( "ContinueShoppingButton" ) )
{
    $itemCountList = $http->hasPostVariable( "ProductItemCountList" ) ? $http->postVariable( "ProductItemCountList" ) : false;
    $itemIDList = $http->hasPostVariable( "ProductItemIDList" ) ? $http->postVariable( "ProductItemIDList" ) : false;
    if ( is_array( $itemCountList ) && is_array( $itemIDList ) && count( $itemCountList ) == count( $itemIDList ) && is_object( $basket ) )
    {
        $productCollectionID = $basket->attribute( 'productcollection_id' );

        $i = 0;

        $db = eZDB::instance();
        $db->begin();
        $itemCountError = false;
        foreach ( $itemIDList as $id )
        {
            if ( !is_numeric( $itemCountList[$i] ) or $itemCountList[$i] <= 0 )
            {
                $itemCountError = true;
            }
            else
            {
                $item = eZProductCollectionItem::fetch( $id );
                if ( is_object( $item ) && $item->attribute( 'productcollection_id' ) == $productCollectionID )
                {
                    $item->setAttribute( "item_count", $itemCountList[$i] );
                    $item->store();
                }
            }
            $i++;
        }
        $db->commit();
        if ( $itemCountError )
        {
            // Redirect to basket
            $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
            return;
        }
    }
    $fromURL = $http->sessionVariable( "FromPage" );
    $http->RemoveSessionVariable( "FromPage" );
    $module->redirectTo( $fromURL );
    return;
}

$doCheckout = false;
if ( $http->hasSessionVariable( 'DoCheckoutAutomatically' ) )
{
    if ( $http->sessionVariable( 'DoCheckoutAutomatically' ) === true )
    {
        $doCheckout = true;
        $http->setSessionVariable( 'DoCheckoutAutomatically', false );
    }
}

$removedItems = array();

if ( $http->hasPostVariable( "CheckoutButton" ) /*or ( $doCheckout === true )*/ )
{


 
    if ( $http->hasPostVariable( "ProductItemIDList" ) )
    {
        $itemCountList = $http->postVariable( "ProductItemCountList" );

        $counteditems = 0;
        foreach ($itemCountList as $itemCount)
        {
            $counteditems = $counteditems + $itemCount;
        }
        $zeroproduct = false;
        if ( $counteditems == 0 )
        {
            $zeroproduct = true;
            return $module->redirectTo( $module->functionURI( "basket" ) );
        }

        $itemIDList = $http->postVariable( "ProductItemIDList" );
        
        if ( is_array( $itemCountList ) && is_array( $itemIDList ) && count( $itemCountList ) == count( $itemIDList ) && is_object( $basket ) )
        {
            $productCollectionID = $basket->attribute( 'productcollection_id' );
            $db = eZDB::instance();
            $db->begin();

            for ( $i = 0, $itemCountError = false; $i < count( $itemIDList ); ++$i )
            {
                // If item count of product <= 0 we should show the error
                if ( !is_numeric( $itemCountList[$i] ) or $itemCountList[$i] <= 0 )
                {
                    $itemCountError = true;
                    continue;
                }
                $item = eZProductCollectionItem::fetch( $itemIDList[$i] );
                if ( is_object( $item ) && $item->attribute( 'productcollection_id' ) == $productCollectionID )
                {
                    $item->setAttribute( "item_count", $itemCountList[$i] );
                    $item->store();
                }
            }
            $db->commit();
            if ( $itemCountError )
            {
                // Redirect to basket
                $module->redirectTo( $module->functionURI( "basket" ) . "/(error)/invaliditemcount" );
                return;
            }
        }
    }

    // Fetch the shop account handler
    $accountHandler = eZShopAccountHandler::instance();
   
    // Do we have all the information we need to start the checkout
    if ( !$accountHandler->verifyAccountInformation() )
    {
        // Fetches the account information, normally done with a redirect
        //die( 'n' );
        $accountHandler->fetchAccountInformation( $module );
        return;
    }
    else
    {
        // Creates an order and redirects
        $basket = eZBasket::currentBasket();
        $productCollectionID = $basket->attribute( 'productcollection_id' );

        $verifyResult = true;

        $db = eZDB::instance();
        $db->begin();
        $basket->updatePrices();

        if ( $verifyResult === true )
        {
           
            $order = $basket->createOrder();
            $order->setAttribute( 'account_identifier', "default" );
            $order->store();

            $http->setSessionVariable( 'MyTemporaryOrderID', $order->attribute( 'id' ) );

            $db->commit();
            $module->redirectTo( '/basket/userdata/' );
            return;
        }
        else
        {
            
            $basket = eZBasket::currentBasket();
            $removedItems = array();
            foreach ( $itemList as $item )
            {
                $removedItems[] = $item;
                $basket->removeItem( $item->attribute( 'id' ) );
            }
        }
        $db->commit();
    }
}
$basket = eZBasket::currentBasket();


if ( isset( $Params['Error'] ) )
{
    $tpl->setVariable( 'error', $Params['Error'] );
    if ( $Params['Error'] == 'options' )
    {
        $tpl->setVariable( 'error_data', $http->sessionVariable( 'BasketError') );
        $http->removeSessionVariable( 'BasketError');
    }
}


$tpl->setVariable( "removed_items", $removedItems);
$tpl->setVariable( "basket", $basket );
$tpl->setVariable( "module_name", 'shop' );
$tpl->setVariable( "vat_is_known", $basket->isVATKnown() );


// Add shipping cost to the total items price and store the sum to corresponding template vars.
$shippingInfo = eZShippingManager::getShippingInfo( $basket->attribute( 'productcollection_id' ) );
if ( $shippingInfo !== null )
{
    // to make backwards compability with old version, allways set the cost inclusive vat.
    if ( ( isset( $shippingInfo['is_vat_inc'] ) and $shippingInfo['is_vat_inc'] == 0 ) or
         !isset( $shippingInfo['is_vat_inc'] ) )
    {
        $additionalShippingValues = eZShippingManager::vatPriceInfo( $shippingInfo );
        $shippingInfo['cost'] = $additionalShippingValues['total_shipping_inc_vat'];
        $shippingInfo['is_vat_inc'] = 1;
    }

    $totalIncShippingExVat  = $basket->attribute( 'total_ex_vat'  ) + $shippingInfo['cost'];
    $totalIncShippingIncVat = $basket->attribute( 'total_inc_vat' ) + $shippingInfo['cost'];

    
    $tpl->setVariable( 'shipping_info', $shippingInfo );
    $tpl->setVariable( 'total_inc_shipping_ex_vat', $totalIncShippingExVat );
    $tpl->setVariable( 'total_inc_shipping_inc_vat', $totalIncShippingIncVat );
}

// tratamos de darle al usuario información sobre gastos de envío
$user = eZUser::currentUser();
$email = $user->attribute( 'login' );

$eflws = new eflWS();
$existeUsuario = $eflws->existeUsuario( $email );

if( $existeUsuario )
{
    $usuario_empresa = $eflws->getUsuarioCompleto( $existeUsuario );
    $usuario = $usuario_empresa->xpath( '//usuario' );
    $provincia = (string)$usuario[0]->direnvio_provincia;
    $total = $basket->attribute( 'total_ex_vat' );
    $gastosEnvio = eZShopFunctions::getShippingCost( $provincia, $total );
    $tpl->setVariable( 'gastos_envio', $gastosEnvio );
}

$infoOrder = eZPersistentObject::fetchObject( eflOrders::definition(), null, array( 'productcollection_id' => $basket->attribute( 'productcollection_id') ) );
$unserialized_order = unserialize($infoOrder->Order);

$tpl->setVariable( 'codigo', $unserialized_order['codigopromocional'] );
$Result = array();
$Result['content'] = $tpl->fetch( "design:shop/basket.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/shop', 'Basket' ) ) );
?>
