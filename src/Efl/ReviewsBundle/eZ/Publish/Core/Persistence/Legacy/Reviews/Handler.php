<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 19:46
 */

namespace Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews;

use eZ\Publish\API\Repository\Values\Content\Location;

class Handler
{
    /**
     * @var Gateway
     */
    protected $reviewsGateway;

    public function __construct( Gateway $reviewsGateway )
    {
        $this->reviewsGateway = $reviewsGateway;
    }

    /**
     * Número de reviews que ha tenido un producto
     *
     * @param Location $location
     * @return int
     */
    public function getReviewsCountForLocation( Location $location )
    {
        return $this->reviewsGateway->getReviewsCountForLocationId( $location->id );
    }

    /**
     * Reviews de un producto
     *
     * @param Location $location
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getReviewsForLocation( Location $location, $limit, $offset )
    {
        return $this->reviewsGateway->getReviewsForLocationId( $location->id, $limit, $offset );
    }
}

