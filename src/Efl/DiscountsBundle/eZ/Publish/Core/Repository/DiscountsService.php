<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 15:22
 */

namespace Efl\DiscountsBundle\eZ\Publish\Core\Repository;

use Efl\DiscountsBundle\eZ\Publish\Core\Persistence\Legacy\Discounts\Handler;
use eZ\Publish\API\Repository\Values\User\User;
use eZ\Publish\API\Repository\Values\Content\Content;

class DiscountsService
{
    /**
     * @var Handler;
     */
    private $discountsHandler;

    public function __construct(
        Handler $discountsHandler
    )
    {
        $this->discountsHandler = $discountsHandler;
    }

    public function getDiscountPercent( User $user, Content $content )
    {
        return $this->discountsHandler->getDiscountPercent( $user, $content );
    }
}
