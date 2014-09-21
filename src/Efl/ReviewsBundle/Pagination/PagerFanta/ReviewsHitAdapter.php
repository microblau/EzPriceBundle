<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/09/14
 * Time: 11:43
 */

namespace Efl\ReviewsBundle\Pagination\PagerFanta;

use Efl\ReviewsBundle\eZ\Publish\Core\Repository\ReviewsService;
use Pagerfanta\Adapter\AdapterInterface;
use eZ\Publish\API\Repository\Values\Content\Location;

class ReviewsHitAdapter implements AdapterInterface
{
    /**
     * @var int
     */
    private $nbResults;

    /**
     * @var ReviewsService
     */
    private $reviewsService;

    private $location;

    public function __construct(
        ReviewsService $reviewsService,
        Location $location
    )
    {
        $this->reviewsService = $reviewsService;
        $this->location = $location;
    }

    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     */
    public function getNbResults()
    {
        if ( isset( $this->nbResults ) )
        {
            return $this->nbResults;
        }

        return $this->nbResults = $this->reviewsService->getReviewsCountForLocation( $this->location );
    }

    public function getSlice( $offset, $length )
    {
        if ( !isset( $this->nbResults ) )
        {
            $this->nbResults = $this->reviewsService->getReviewsCountForLocation( $this->location );
        }

        return $this->reviewsService->getReviewsForLocation( $this->location, $length, $offset );
    }
}
