<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 14:06
 */

namespace Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts;

use eZ\Publish\API\Repository\Values\ValueObject;

abstract class Product extends ValueObject
{
    protected $percentage;

    protected $message = '';
} 