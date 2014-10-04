<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 13:55
 */

namespace Efl\BasketBundle\eZ\Publish\API\Repository\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

abstract class Basket extends ValueObject
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var
     */
    protected $sessionId;

    /**
     * @var int
     */
    protected $productCollectionId;

    /**
     * @var int
     */
    protected $orderId;
}
