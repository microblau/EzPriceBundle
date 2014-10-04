<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 15:58
 */

namespace Efl\BasketBundle\eZ\Publish\API\Repository\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

abstract class BasketItem extends ValueObject
{
    protected $id;

    protected $vatValue;

    protected $itemCount;

    protected $locationId;

    protected $objectName;

    protected $priceExVat;

    protected $priceIncVat;

    protected $discountPercent;

    protected $totalPriceExVat;

    protected $totalPriceIncVat;

    abstract function getContent();
}
