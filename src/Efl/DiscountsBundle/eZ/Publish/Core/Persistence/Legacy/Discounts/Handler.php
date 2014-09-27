<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 15:24
 */

namespace Efl\DiscountsBundle\eZ\Publish\Core\Persistence\Legacy\Discounts;

use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\Values\User\User;

class Handler
{
    private $discountsGateway;

    public function __construct(
        Gateway $discountsGateway
    )
    {
        $this->discountsGateway = $discountsGateway;
    }

    public function getDiscountPercent( User $user, Content $content )
    {
        return $this->discountsGateway->getDiscountPercent( $user, $content );
    }
}
