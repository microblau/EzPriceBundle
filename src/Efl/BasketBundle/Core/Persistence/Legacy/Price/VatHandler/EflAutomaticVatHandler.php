<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 24/09/14
 * Time: 8:15
 */

namespace Efl\BasketBundle\Core\Persistence\Legacy\Price\VatHandler;

use EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\VatHandler\Base;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use Efl\WebBundle\Helper\UtilsHelper;
use eZ\Publish\API\Repository\ContentService;
use PDO;

class EflAutomaticVatHandler extends Base
{
    private $utilsHelper;

    /**
     * Database handler
     *
     * @var \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    private $handler;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var array
     */
    private $provinciasExentas;

    public function __construct(
        UtilsHelper $utilsHelper,
        DatabaseHandler $handler,
        ContentService $contentService,
        array $provinciasExentas
    )
    {
        $this->utilsHelper = $utilsHelper;
        $this->handler = $handler;
        $this->contentService = $contentService;
        $this->provinciasExentas = $provinciasExentas;
    }

    /**
     * Chooses VAT Type Id when Automatic Vat Handling is used
     *
     * @param mixed $fieldId
     * @param int $versionNo
     *
     * @return int
     */
    public function chooseVatRateId( $fieldId, $versionNo )
    {
        $provincia = strtolower( $this->getProvincia() );
        $productCategory = $this->getProductCategory( $fieldId, $versionNo );
        return $this->chooseVatType( $productCategory, $provincia );
    }

    private function getProvincia()
    {
        $userData = $this->utilsHelper->getCurrentUserFriendlyData();
        return isset( $userData['facturacion'] ) && !empty( $userData['facturacion']->_dir_provincia )
            ? $userData['facturacion']->_dir_provincia
            : 'Madrid';
    }

    private function getProductCategory( $fieldId, $versionNo )
    {
        $productId = $this->getProduct( $fieldId, $versionNo );
        $product = $this->contentService->loadContent( $productId, null, $versionNo );
        return $product->getFieldValue( 'categoria' )->id;
    }

    private function getProduct( $fieldId, $versionNo )
    {
        $query = $this->handler->createSelectQuery();
        $query
            ->select( 'contentobject_id' )
            ->from( $this->handler->quoteTable( 'ezcontentobject_attribute' ) )
            ->where(
                $query->expr->lAnd(
                    $query->expr->eq(
                        $this->handler->quoteColumn( 'id' ),
                        $query->bindValue( $fieldId, null, PDO::PARAM_INT )
                    ),
                    $query->expr->eq(
                        $this->handler->quoteColumn( 'version' ),
                        $query->bindValue( $versionNo, null, PDO::PARAM_INT )
                    )
                )
            );

        $statement = $query->prepare();
        $statement->execute();
        return $statement->fetchColumn();
    }

    private function chooseVatType( $productCategory, $provincia )
    {
        if ( in_array( $provincia, $this->provinciasExentas ) )
        {
            return 3;
        }

        if ( $productCategory == 1 )
        {
            return 1;
        }

        return 2;
    }
} 