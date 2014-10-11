<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 15:24
 */

namespace Efl\DiscountsBundle\eZ\Publish\Core\Persistence\Legacy\Discounts;

use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\Core\Repository\Values\User\User;

abstract class Gateway
{
    abstract public function getDiscount( User $user, Content $content );
}
