<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/10/14
 * Time: 11:08
 */

namespace Efl\DiscountsBundle\Discounts\Product;

use Efl\BasketBundle\Discounts\ProductDiscountInterface;
use Efl\DiscountsBundle\eZ\Publish\Core\Repository\LegacyDiscountsService;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\API\Repository\Values\Content\Content;

/**
 * Descuento por producto definidos en la versión uno de la tienda
 *
 * Class Legacy
 * @package Efl\DiscountsBundle\Discounts
 */
class Legacy implements ProductDiscountInterface
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

    /**
     * Este descuento será aplicable si tras mirar los descuentos en la
     * base de datos sale algún descuento
     *
     * @param Content $content
     * @return bool|\Efl\BasketBundle\eZ\Publish\API\Repository\Values\Discounts\Product
     */
    public function isApplicableTo( Content $content )
    {
        return $this->discountsService->getDiscount(
            $this->repository->getCurrentUser(),
            $content
        );
    }
}
