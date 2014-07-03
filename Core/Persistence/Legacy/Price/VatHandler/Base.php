<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\VatHandler;

use EzSystems\EzPriceBundle\SPI\Persistence\Price\AutomaticVatHandler;

abstract class Base implements AutomaticVatHandler
{
    /**
     * Chooses VAT Type Id when Automatic Vat Handling is used
     *
     * @param mixed $fieldId
     * @param int $versionNo
     *
     * @return int
     */
    abstract public function chooseVatRateId( $fieldId, $versionNo );
}
