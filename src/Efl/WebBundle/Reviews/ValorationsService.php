<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/09/14
 * Time: 13:08
 */

namespace Efl\WebBundle\Reviews;

use eZ\Publish\Core\Persistence\Database\DatabaseHandler;

class ValorationsService
{
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

    public function getReviewsNumberForLocationId( $locationId )
    {
        $dbHandler = $this->getConnection();

        $statement = $dbHandler->prepare( 'SELECT count(*) as cuantos from valoraciones_productos where node_producto=:node_id and visible=1' );
        $statement->bindValue( ':node_id', $locationId );

        $statement->execute();
        $rows = $statement->fetchAll();
        return $rows[0]['cuantos'];
    }
}
