<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 12/09/14
 * Time: 10:43
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class NosotrosHelper
{
    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    private $searchService;

    public function __construct(
        LocationService $locationService,
        SearchService $searchService
    )
    {
        $this->locationService = $locationService;
        $this->searchService = $searchService;
    }

    public function getRandomTestimonies()
    {
        $location = $this->locationService->loadLocation( 2 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::LT, $location->depth + 10 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( array( 'testimonio') )
            )
        );

        $query->offset = rand( 0, 210 );
        $query->limit = 2;

        $results = $this->searchService->findLocations( $query )->searchHits;

        $locations = array();

        foreach ( $results as $location )
        {
            $locations[] = $location->valueObject;
        }


        return $locations;
    }
}
