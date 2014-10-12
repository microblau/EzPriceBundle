<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:34
 */

namespace Efl\BasketBundle\eZ\Publish\API\Repository\Values\Shipping;

use eZ\Publish\API\Repository\Values\ValueObject;

class ShippingMethod extends ValueObject
{
    /**
     * @var float
     */
    protected $cost;

    /**
     * @var string
     */
    protected $info = '';
}
