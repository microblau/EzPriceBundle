<?php

namespace Efl\WebBundle\Basket;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;

/**
 * funciones para estadísticas en cesta, tales como productos comprados en otras compras o
 * productos más comprados
 */
class BasketService
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    private $contentService;

    /**
     * @var DatabaseHandler
     */
    private $dbHandler;

    public function __construct( ContentService $contentService )
    {
        $this->contentService = $contentService;
    }

    /**
     * Set database handler
     *
     * @param mixed $dbHandler
     *
     * @return void
     * @throws \RuntimeException if $dbHandler is not an instance of
     *         {@link \eZ\Publish\Core\Persistence\Database\DatabaseHandler}
     */
    public function setConnection( $dbHandler )
    {
        // This obviously violates the Liskov substitution Principle, but with
        // the given class design there is no sane other option. Actually the
        // dbHandler *should* be passed to the constructor, and there should
        // not be the need to post-inject it.
        if ( !$dbHandler instanceof DatabaseHandler )
        {
            throw new \RuntimeException( "Invalid dbHandler passed" );
        }

        $this->dbHandler = $dbHandler;
    }

    /**
     * Returns the active connection
     *
     * @throws \RuntimeException if no connection has been set, yet.
     *
     * @return \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    protected function getConnection()
    {
        if ( $this->dbHandler === null )
        {
            throw new \RuntimeException( "Missing database connection." );
        }
        return $this->dbHandler;
    }

    /**
     * Productos que han sido comprados en compras en las que también se ha comprado este producto
     *
     * @param array $contentIds
     * @param int $limit
     * @return \eZ\Publish\API\Repository\Values\Content\Content[]
     */
    public function relatedPurchasedListForContentIds( array $contentIds, $limit )
    {
        $tmpTableName = $this->generateUniqueTempTableName( 'ezproductcoll_tmp_%' );
        //create temporary table
        $this->createTemporaryTable( $tmpTableName );
        $this->fillTemporaryTable( $tmpTableName, $contentIds );
        $result = $this->getRelatedContents( $tmpTableName, $contentIds, $limit );
        $this->deleteTemporaryTable( $tmpTableName );
        $products = array();
        foreach ( $result as $row )
        {
            $products[] = $this->contentService->loadContent( $row['contentobject_id'] );
        }
        return $products;
    }

    /**
     * Crea una tabla temporal para hacer la consulta
     * Código sacado del legacy
     *
     * @param string $tmpTableName
     */
    private function createTemporaryTable( $tmpTableName )
    {
        $statement = $this->getConnection()->prepare( "CREATE TEMPORARY TABLE $tmpTableName( productcollection_id int )" );
        $statement->execute();
    }

    /**
     * Borra la tabla creada en el proceso
     *
     * @param $tmpTableName
     */
    private function deleteTemporaryTable( $tmpTableName )
    {
        $statement = $this->getConnection()->prepare( "DROP TABLE $tmpTableName" );
        $statement->execute();
    }

    /**
     * Inserta en la tabla temporal los objetos sobre los que queremos obtener las relaciones
     *
     * @param $tmpTableName
     * @param array $contentIds
     */
    private function fillTemporaryTable( $tmpTableName, $contentIds )
    {
        $statement = $this->getConnection()->prepare("INSERT INTO $tmpTableName SELECT ezorder.productcollection_id
                                                          FROM ezorder, ezproductcollection_item
                                                          WHERE ezorder.productcollection_id=ezproductcollection_item.productcollection_id
                                                          AND ezproductcollection_item.contentobject_id IN ( " . implode(',', $contentIds) . ")");
        $statement->execute();
    }

    /**
     * Objetos comprados en otras compras en las que estaban implicadas estos productos
     *
     * @param $tmpTableName
     * @param $contentIds
     * @param $limit
     * @return array
     */
    private function getRelatedContents( $tmpTableName, $contentIds, $limit )
    {
        $statement = $this->getConnection()->prepare( "SELECT sum(ezproductcollection_item.item_count) as count, contentobject_id FROM ezproductcollection_item, $tmpTableName
                 WHERE ezproductcollection_item.productcollection_id=$tmpTableName.productcollection_id
                   AND ezproductcollection_item.contentobject_id NOT IN ( " . implode( ',' , $contentIds ) . " )
              GROUP BY ezproductcollection_item.contentobject_id
              ORDER BY count desc
              LIMIT $limit" );
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * Se asegura de que la tabla temporal creada sea única
     *
     * @param $pattern
     * @param bool $randomizeIndex
     * @return mixed
     */
    private function generateUniqueTempTableName( $pattern, $randomizeIndex = false )
    {
        $tableList = $this->getDatabaseTables();
        if ( $randomizeIndex === false )
        {
            $randomizeIndex = mt_rand( 10, 1000 );
        }
        do
        {
            $uniqueTempTableName = str_replace( '%', $randomizeIndex, $pattern );
            $randomizeIndex++;
        } while ( in_array( $uniqueTempTableName, $tableList ) );

        return $uniqueTempTableName;
    }

    /**
     * Función auxiliar para obtener las tablas que tiene la base de datos
     * y así evitar colisiones en la creación de la temporal.
     *
     * @return array
     */
    private function getDatabaseTables()
    {
        $tables = array();
        $statement = $this->getConnection()->prepare( 'SHOW TABLES' );
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ( $rows as $row )
        {
            $tables[] = $row['Tables_in_lefebvre'];
        }

        return $tables;

    }
}
