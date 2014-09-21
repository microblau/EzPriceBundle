<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 19:43
 */

namespace Efl\ReviewsBundle\eZ\Publish\Core\Repository;

use Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews\Handler as ReviewsHandler;
use eZ\Publish\API\Repository\Repository;
use eZ\Publish\API\Repository\Values\Content\Location;

class ReviewsService
{
    /**
     * @var \eZ\Publish\API\Repository\Repository
     */
    protected $repository;

    /**
     * @var ReviewsHandler
     */
    protected $reviewsHandler;

    public function __construct(
        Repository $repository,
        ReviewsHandler $reviewsHandler
    )
    {
        $this->repository = $repository;
        $this->reviewsHandler = $reviewsHandler;
    }

    public function getReviewsCountForLocation( Location $location )
    {
        return $this->reviewsHandler->getReviewsCountForLocation( $location );
    }

    /**
     * Reviews de un producto
     *
     * @param Location $location
     * @return mixed
     */
    public function getReviewsForLocation( Location $location, $limit, $offset = 0 )
    {
        return $this->reviewsHandler->getReviewsForLocation( $location, $limit, $offset );
    }
}

