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
use Efl\WebBundle\Helper\UtilsHelper;

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

    /**
     * Código de Madrid. Usado si el usuario no tiene todavía seteado
     * su dirección de envío
     */
    const DEFAULT_PROVINCE_CODE = 28;

    /**
     * @var UtilsHelper
     */
    private $utilsHelper;

    /**
     * @var array
     */
    private $nonPeninsularProvinceCodes;

    public function __construct(
        UtilsHelper $utilsHelper,
        array $nonPeninsularCodes = array()
    )
    {
        $this->utilsHelper = $utilsHelper;
        $this->nonPeninsularProvinceCodes = $nonPeninsularCodes;
    }

    public function getShippingCost( Basket $basket )
    {
        $_id_shipping_province =  $this->getIdShippingProvince();

        if ( ( $basket->getTotalExVat() > self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN )
            && !in_array( $_id_shipping_province, $this->nonPeninsularProvinceCodes ) )
        {
            return new ShippingMethod(
                array(
                    'cost' => 0,
                    'info' => 'Envío gratuito por total de cesta mayor de ' . self::FREE_SHIPPING_IF_TOTAL_GREATER_THAN
                        . ' € y encontrarse en Península o Baleares'
                )
            );
        }

        if ( in_array( $_id_shipping_province, $this->nonPeninsularProvinceCodes ) )
        {
            return new ShippingMethod(
                array(
                    'cost' => self::NON_PENINSULAR_COST,
                    'info' => 'Gastos por envío a Canarias, Ceuta o Melilla'
                )
            );
        }

        return new ShippingMethod(
            array(
                'cost' => self::PENINSULAR_COST,
                'info' => 'Gastos por envío a península o Balerares'
            )
        );
    }

    /**
     * Función auxiliar para obtener el código de la provincia de envío.
     *
     * @return int
     */
    private function getIdShippingProvince()
    {
        $userFriendlyData = $this->utilsHelper->getCurrentUserFriendlyData();

        if ( isset( $userFriendlyData['facturacion'] ) && ( $userFriendlyData['facturacion']->_indDirFactIgualEnvio == 1 ) )
        {
            return $userFriendlyData['facturacion']->_id_provincia;
        }

        if ( isset( $userFriendlyData['envio'] ) && !empty( $userFriendlyData['envio']->_id_provincia ) )
        {
            return $userFriendlyData['envio']->_id_provincia;
        }

        return self::DEFAULT_PROVINCE_CODE;
    }
}
