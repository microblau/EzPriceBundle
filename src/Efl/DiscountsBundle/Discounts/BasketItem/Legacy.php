<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:08
 */

namespace Efl\DiscountsBundle\Discounts\BasketItem;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use Efl\BasketBundle\Discounts\BasketItemDiscountInterface;
use Efl\DiscountsBundle\eZ\Publish\Core\Repository\LegacyDiscountsService;
use eZ\Publish\API\Repository\Repository;

/**
 * Descuento para productos por publicación
 *
 * Class PrepublicationDiscount
 * @package Efl\DiscountsBundle\Discounts
 */
class Legacy implements BasketItemDiscountInterface
{
    /**
     * @var LegacyDiscountsService
     */
    private $discountsService;

    /**
     * @var Repository
     */
    private $repository;

    public function __construct(
        LegacyDiscountsService $discountsService,
        Repository $repository
    )
    {
        $this->discountsService = $discountsService;
        $this->repository = $repository;
    }

    public function isApplicableTo( BasketItem $item )
    {
        return $this->discountsService->getDiscount(
            $this->repository->getCurrentUser(),
            $item->getContent()
        );
    }
}
