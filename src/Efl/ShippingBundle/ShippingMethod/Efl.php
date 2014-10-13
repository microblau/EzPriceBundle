<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/10/14
 * Time: 13:57
 */

namespace Efl\ShippingBundle\ShippingMethod;

use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Shipping\ShippingMethod;
use Efl\BasketBundle\Shipping\ShippingInterface;
use Symfony\Component\Security\Core\SecurityContext;

class Efl implements ShippingInterface
{
    /**
     * A partir de este valor el envío será gratuito en
     * penínusla y Baleares
     */
    const FREE_SHIPPING_IF_TOTAL_GREATER_THAN = 30;

    /**
     * Coste para para península y Baleares si no es gratuito
     */
    const PENINSULAR_COST = 3;

    /**
     * Precio para Canarias, Ceuta y Melilla
     */
    const NON_PENINSULAR_COST = 8;

    private $securityContext;

    public function __construct(
        SecurityContext $securityContext
    )
    {
        $this->securityContext = $securityContext;
    }

    public function getShippingCost( Basket $basket )
    {

        $_id_shipping_province =  $this->getIdShippingProvince();

        if ( $basket->getTotalExVat() > self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN )
        {
            return new ShippingMethod(
                array(
                    'cost' => 0,
                    'info' => 'Envío gratuito por total de cesta mayor de ' . self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN . ' €'
                )
            );
        }

        return new ShippingMethod(
            array(
                'cost' => self::PENINSULAR_COST,
                'info' => 'Gastos por envío a península'
            )
        );
    }

    private function getIdShippingProvince()
    {
        if( $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') )
        {
            /** @var \eZ\Publish\Core\MVC\Symfony\Security\UserWrapped $currentUser */
            $currentUser = $this->securityContext->getToken()->getUser();
        }
    }
}
