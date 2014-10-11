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
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Discounts\BasketItem;

class LegacyDiscountsService
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

    /**
     * Devuelve el descuento a aplicar al producto según
     * las reglas definidas en la primera versión de la tienda
     *
     * En caso de no encontrar ninguna devuelve false
     *
     * @param User $user
     * @param Content $content
     * @return BasketItem|bool
     */
    public function getDiscount( User $user, Content $content )
    {
        $discount = $this->discountsHandler->getDiscount( $user, $content );
        return $discount ? new BasketItem( $discount ) : false;
    }
}
