<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license   For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat;

use eZ\Publish\Core\Persistence\Doctrine\ConnectionHandler;
use eZ\Publish\SPI\FieldType\StorageGateway;
use EzSystems\EzPriceBundle\SPI\Persistence\Price\VatHandler as VatHandlerInterface;

class VatHandler extends StorageGateway implements VatHandlerInterface
{
    /**
     * @var ConnectionHandler
     */
    protected $dbHandler;

    /**
     * VatHandler constructor.
     *
     * @param ConnectionHandler $dbHandler
     */
    public function __construct(ConnectionHandler $dbHandler)
    {
        $this->dbHandler = $dbHandler;
    }

    /**
     * Loads the VAT rate data for $vatRateId
     *
     * @param mixed $vatRateId
     *
     * @return \EzSystems\EzPriceBundle\API\Price\Values\VatRate
     * @throws \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\AutomaticVatHandlerException when automatic VAT is used.
     *
     */
    public function load($vatRateId)
    {
        if ($vatRateId == -1) {
            throw new AutomaticVatHandlerException('Automatic Vat Handling is not Implemented');
        }

        $vatRateData = $this->getVatRateData($vatRateId);
    }

    /**
     * Queries database to get data of the Vat Rate
     *
     * @param int $vatRateId
     *
     * @return array
     * @throws \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\VatNotFoundException
     *          if there is no data for $vatId
     *
     */
    public function getVatRateData($vatRateId)
    {
        $query = $this->dbHandler->createSelectQuery();
        $query
            ->select(['name', 'percentage'])
            ->from($this->dbHandler->quoteTable('ezvattype'))
            ->where(
                $query->expr->eq(
                    $this->dbHandler->quoteColumn('id'),
                    $query->bindValue($vatRateId, null, \PDO::PARAM_INT)
                )
            );

        $statement = $query->prepare();
        $statement->execute();

        if ($statement->rowCount() === 0) {
            throw new VatNotFoundException('Vat Rate', $vatRateId);
        }

        return $statement->fetch();
    }

}
