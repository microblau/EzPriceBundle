<?php

class eflVATHandler
{
    /**
     * \public
     * \static
     */
    function getVatPercent( $object )
    {   
    	if( eZUser::currentUser()->isLoggedIn() )
    	{
    		$email = eZUser::currentUser()->Email;
    		$eflws = new eflWS();
            if( $existeUsuario = $eflws->existeUsuario( $email ) )
            {
            $usuario_empresa = $eflws->getUsuarioCompleto( $existeUsuario );   
            $usuario = $usuario_empresa->xpath( '//usuario' );
           
            $provincia = (string)$usuario[0]->direnvio_provincia;           
            }
            else
            {
            	$provincia = 'Madrid';
            }
    	}
    	else
    	{
    		$provincia = 'Madrid';
    	}        
        $productCategory = eflVATHandler::getProductCategory( $object );
        // If product category is not specified
        if ( $productCategory === null )
        {
            // Default to a fake product category (*) that will produce
            // weak match on category for any VAT rule.
            $productCategory = new eZProductCategory( array( 'id' => -1,
                                                             'name' => '*' ) );
        }
        
        $vatType = eflVATHandler::chooseVatType( $productCategory, $provincia );

        return $vatType->attribute( 'percentage' );
    }

    /**
     * Determine object's product category.
     *
     * \private
     * \static
     */
    function getProductCategory( $object )
    {
        $ini = eZINI::instance( 'shop.ini' );
        if ( !$ini->hasVariable( 'VATSettings', 'ProductCategoryAttribute' ) )
        {
            eZDebug::writeError( "Cannot find product category: please specify its attribute identifier " .
                                 "in the following setting: shop.ini.[VATSettings].ProductCategoryAttribute" );
            return null;
        }

        $categoryAttributeName = $ini->variable( 'VATSettings', 'ProductCategoryAttribute' );

        if ( !$categoryAttributeName )
        {
            eZDebug::writeError( "Cannot find product category: empty attribute name specified " .
                                 "in the following setting: shop.ini.[VATSettings].ProductCategoryAttribute" );

            return null;
        }

        $productDataMap = $object->attribute( 'data_map' );

        if ( !isset( $productDataMap[$categoryAttributeName] ) )
        {
            eZDebug::writeError( "Cannot find product category: there is no attribute '$categoryAttributeName' in object '" .
                                  $object->attribute( 'name' ) .
                                  "' of class '" .
                                  $object->attribute( 'class_name' ) . "'." );
            return null;
        }

        $categoryAttribute = $productDataMap[$categoryAttributeName];
        $productCategory = $categoryAttribute->attribute( 'content' );

        if ( $productCategory === null )
        {
            eZDebug::writeNotice( "Product category is not specified in object '" .
                                   $object->attribute( 'name' ) .
                                   "' of class '" .
                                   $object->attribute( 'class_name' ) . "'." );
            return null;
        }

        return $productCategory;
    }

    /**
     * Choose the best matching VAT type for given product category and country.
     *
     * We calculate priority for each VAT type and then choose
     * the VAT type having the highest priority
     * (or first of those having the highest priority).
     *
     * VAT type priority is calculated from county match and category match as following:
     *
     * CountryMatch  = 0
     * CategoryMatch = 1
     *
     * if ( there is exact match on country )
     *     CountryMatch = 2
     * elseif ( there is weak match on country )
     *     CountryMatch = 1
     *
     * if ( there is exact match on product category )
     *     CategoryMatch = 2
     * elseif ( there is weak match on product category )
     *     CategoryMatch = 1
     *
     * if ( there is match on both country and category )
     *     VatTypePriority = CountryMatch * 2 + CategoryMatch - 2
     * else
     *     VatTypePriority = 0
     *
     * \private
     * \static
     */
    function chooseVatType( $productCategory, $provincia )
    {    	
    	$basketini = eZINI::instance( 'basket.ini' );
    	$exentos = $basketini->variable( 'VatRules', 'ProvinciasExentas' );    
    	if( in_array( $provincia, $exentos ) )
    	{
    		
    	   $bestVatType = eZVatType::fetch( 3 );	
    	}    	
    	else
    	{
    		if( $productCategory->ID == 1 )
    		{
    			$bestVatType = eZVatType::fetch( 1 );
    		}
    		else
    		{
    			$bestVatType = eZVatType::fetch( 2 );
    		}
    	}
        
       
        return $bestVatType;
    }
}

?>
