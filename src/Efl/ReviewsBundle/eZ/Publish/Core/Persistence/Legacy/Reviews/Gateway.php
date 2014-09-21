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
    abstract public function getReviewsCountForLocationId( $locationId );

    abstract public function getReviewsForLocationId( $locationId, $limit, $offset = 0 );
}
