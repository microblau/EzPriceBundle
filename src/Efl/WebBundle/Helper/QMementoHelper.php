<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 3/10/14
 * Time: 12:11
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;

class QMementoHelper
{
    private $locationService;

    private $searchService;

    public function __construct(
        LocationService $locationService,
        SearchService $searchService
    )
    {
        $this->locationService = $locationService;
        $this->searchService = $searchService;
    }

    public function findQMementoLocationId()
    {
        $location = $this->locationService->loadLocation( 70 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier(
                    array(
                        'qmemento'
                    )
                )
            )
        );

        $results = $this->searchService->findLocations( $query )->searchHits;

        return $results[0]->valueObject->id;
    }
}
