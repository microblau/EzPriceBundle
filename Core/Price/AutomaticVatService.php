<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Core\Price;

use EzSystems\EzPriceBundle\API\Price\AutomaticVatService as AutomaticVatServiceInterface;
use EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\VatHandler\Base;

class AutomaticVatService implements AutomaticVatServiceInterface
{
    /**
     * @var \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\VatHandler\Base
     */
    protected $automaticVatHandler;

    /**
     * @param \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\VatHandler\Base $automaticVatHandler
     */
    public function __construct( Base $automaticVatHandler )
    {
        $this->automaticVatHandler = $automaticVatHandler;
    }

    /**
     * Chooses VAT Type Id when Automatic Vat Handling is used
     *
     * @param mixed $fieldId
     * @param int $versionNo
     *
     * @return int
     */
    public function chooseVatRateId( $fieldId, $versionNo )
    {
        return $this->automaticVatHandler->chooseVatRateId( $fieldId, $versionNo );
    }
}
