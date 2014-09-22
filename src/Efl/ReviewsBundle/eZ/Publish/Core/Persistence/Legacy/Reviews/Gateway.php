<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 19:48
 */

namespace Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews;

abstract class Gateway
{
    /**
     * Nº total de reviews que tiene un producto
     *
     * @param $locationId
     *
     * @return mixed
     */
    abstract public function getReviewsCountForLocationId( $locationId );

    /**
     * Devuelve el rango de reviews especificado por limit y offset
     * para el producto con locationId
     *
     * @param $locationId
     * @param $limit
     * @param int $offset
     *
     * @return mixed
     */
    abstract public function getReviewsForLocationId( $locationId, $limit, $offset = 0 );

    /**
     * Crea una nueva review
     *
     * @param $locationId
     * @param $userId
     * @param array $data
     *
     * @return mixed
     */
    abstract public function createReview( $locationId, $userId, array $data );

    /**
     * Determina si el usuario userId ha hecho alguna review
     * de la location LocationId
     *
     * @param int $userId
     * @param int $locationId
     *
     * @return bool
     */
    abstract public function userHasReviewedLocation( $userId, $locationId );
}
