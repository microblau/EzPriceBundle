<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\eZ\Publish\Core\FieldType\Price;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * @var float
     */
    public $price;

    /**
     * Construct a new Value object and initialize with $value
     *
     * @param float|null $value
     */
    public function __construct( $value = null )
    {
        $this->price = $value;
    }

    public function __toString()
    {
        return (string)$this->price;
    }
}
