<?php
/**
 * File containing the eZPrice class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZPrice ezprice.php
  \ingroup eZDatatype
*/



class eZPrice extends eZSimplePrice
{
    /*!
     Constructor
    */
    function eZPrice( $classAttribute, $contentObjectAttribute, $storedPrice = null )
    {
        eZSimplePrice::eZSimplePrice( $classAttribute, $contentObjectAttribute, $storedPrice );

        $isVatIncluded = ( $classAttribute->attribute( eZPriceType::INCLUDE_VAT_FIELD ) == 1 );
        $VATID = $classAttribute->attribute( eZPriceType::VAT_ID_FIELD );
        $this->setVatIncluded( $isVatIncluded );
        $this->setVatType( $VATID );
    }

    /// \privatesection
}

?>
