<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 15:58
 */

namespace Efl\BasketBundle\eZ\Publish\API\Repository\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

abstract class BasketItem extends ValueObject
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var float
     */
    protected $vatValue;

    /**
     * @var int
     */
    protected $itemCount;

    /**
     * @var mixed
     */
    protected $locationId;

    /**
     * @var string
     */
    protected $objectName;

    /**
     * @var float
     *
     * precio por unidad en cesta
     */
    protected $priceExVat;

    /**
     * @var float
     *
     * Precio base sin ningún descuento aplicado
     */
    protected $basePriceExVat;

    /**
     * @var float
     *
     * precio por unidad en cesta, impuestos incluidos
     */
    protected $priceIncVat;

    /**
     * @var float
     *
     * total de la fila
     */
    protected $totalPriceExVat;

    /**
     * @var float
     *
     * total de la fila impuestos incluidos
     */
    protected $totalPriceIncVat;

    /**
     * contenido asociado
     *
     * @return mixed
     */
    abstract function getContent();

    /**
     * Descuentos asociados a este item
     *
     * @return mixed
     */
    abstract function getDiscount();
}
