<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license   For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\ContentVat;

use eZ\Publish\Core\Persistence\Doctrine\ConnectionHandler;
use eZ\Publish\SPI\FieldType\StorageGateway;
use EzSystems\EzPriceBundle\SPI\Persistence\Price\ContentVatHandler as ContentVatHandlerInterface;

class ContentVatHandler extends StorageGateway implements ContentVatHandlerInterface
{
    /**
     * @var ConnectionHandler
     */
    protected $dbHandler;

    /**
     * ContentVatHandler constructor.
     *
     * @param ConnectionHandler $dbHandler
     */
    public function __construct(ConnectionHandler $dbHandler)
    {
        $this->dbHandler = $dbHandler;
    }

    /**
     * Loads the VAT rate for $fieldId in $versionNo
     *
     * @param mixed $fieldId
     * @param int   $versionNo
     *
     * @return int
     * @throws \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\ContentVat\Gateway\VatIdentifierNotFoundException
     *          when the identifier can't be found.
     *
     */
    public function getVatRateIdForField($fieldId, $versionNo)
    {
        return $this->getVatRateId($fieldId, $versionNo);
    }

    /**
     * Gets the id of the vat rate associated with $fieldId and $versionNo
     *
     * @param $fieldId
     * @param $versionNo
     *
     * @return int;
     * @throws \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\ContentVat\Gateway\VatIdentifierNotFoundException
     *         when vat_identifier can't be found (empty data_text).
     *
     */
    public function getVatRateId($fieldId, $versionNo)
    {
        $query = $this->dbHandler->createSelectQuery();
        $query
            ->select('data_text')
            ->from($this->dbHandler->quoteTable('ezcontentobject_attribute'))
            ->where(
                $query->expr->lAnd(
                    $query->expr->eq(
                        $this->dbHandler->quoteColumn('id'),
                        $query->bindValue($fieldId, null, \PDO::PARAM_INT)
                    ),
                    $query->expr->eq(
                        $this->dbHandler->quoteColumn('version'),
                        $query->bindValue($versionNo, null, \PDO::PARAM_INT)
                    )
                )
            );

        $statement = $query->prepare();
        $statement->execute();

        $rowDataText = $statement->fetchColumn();
        if (empty($rowDataText)) {
            throw new VatIdentifierNotFoundException('Vat Identifier for ', $fieldId . ' - ' . $versionNo);
        }

        [$vatRateId] = explode(',', $rowDataText);

        return $vatRateId;
    }

}
