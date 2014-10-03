<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 3/10/14
 * Time: 12:11
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;

class QMementoHelper
{
    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(
        LocationService $locationService,
        SearchService $searchService,
        ContentService $contentService
    )
    {
        $this->locationService = $locationService;
        $this->searchService = $searchService;
        $this->contentService = $contentService;
    }

    /**
     * Encuentra el id del nodo qmemento
     *
     * @return mixed
     */
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

    /**
     * Obtiene las versiones nautis que cuelgan de una localización dada
     *
     * @param $locationId
     * @return array
     */
    public function getVersionsForQmemento( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier(
                    array(
                        'version_nautis'
                    )
                )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $queryResults = $this->searchService->findLocations( $query )->searchHits;

        $items = array();
        foreach ( $queryResults as $queryResult )
        {
            $items[] = $this->contentService->loadContent(
                $queryResult->valueObject->contentInfo->id
            );
        }

        return $items;
    }
}
