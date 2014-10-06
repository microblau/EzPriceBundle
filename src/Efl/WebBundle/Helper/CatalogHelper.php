<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 6/10/14
 * Time: 10:22
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\Core\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;

class CatalogHelper
{
    private $contentService;

    private $locationService;

    private $searchService;

    public function __construct(
        ContentService $contentService,
        LocationService $locationService,
        SearchService $searchService
    )
    {
        $this->contentService = $contentService;
        $this->locationService = $locationService;
        $this->searchService = $searchService;
    }

    /**
     * Devuelve una lista con las áreas de interés
     *
     * @return array
     * @throws \eZ\Publish\Core\Base\Exceptions\UnauthorizedException
     */
    public function getRamasDelDerecho()
    {
        $location = $this->locationService->loadLocation( 143 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;

        $values = array();

        foreach ( $results as $result )
        {
            $values[$result->valueObject->contentInfo->id] = $result->valueObject->contentInfo->name;
        }

        return $values;
    }

    /**
     * Folders colgando de mementos excepto algunos
     *
     * Devolvemos los locations pues nos interesa más para el tema de la búsqueda...
     */
    public function getProductTypes()
    {
        $location = $this->locationService->loadLocation( 61 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( 'folder' )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;

        $values = array();

        foreach ( $results as $result )
        {
            $values[$result->valueObject->id] = $result->valueObject->contentInfo->name;
        }

        return $values;
    }

    public function buildSearchParamsFormRequest()
    {

    }
}
