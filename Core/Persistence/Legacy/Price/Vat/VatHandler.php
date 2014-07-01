<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat;

use EzSystems\EzPriceBundle\SPI\Persistence\Price\VatHandler as VatHandlerInterface;
use EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway;
use EzSystems\EzPriceBundle\API\Price\Values\VatRate;
use EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\AutomaticVatHandlerException;

class VatHandler implements VatHandlerInterface
{
    /**
     * @var \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway
     */
    protected $gateway;

    /**
     * @param \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway $gateway
     */
    public function __construct( Gateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * Loads the VAT rate data for $vatRateId
     *
     * @param mixed $vatRateId
     *
     * @throws \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\AutomaticVatHandlerException when automatic VAT is used.
     *
     * @return \EzSystems\EzPriceBundle\API\Price\Values\VatRate
     */
    public function load( $vatRateId )
    {
        if ( $vatRateId == -1 )
            throw new AutomaticVatHandlerException( 'Automatic Vat Handling is not Implemented' );

        $vatRateData = $this->gateway->getVatRateData( $vatRateId );
        return new VatRate( $vatRateData );
    }
}
