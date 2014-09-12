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
use eZ\Publish\API\Repository\ContentService;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class FaqsHelper
{
    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    private $searchService;

    /**
     * @var \eZ\Publish\Core\SignalSlot\ContentService
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
     * tipos de faqs, agrupadas si tienen hijos.
     *
     * @return SimpleChoiceList
     */
    public function getFaqGroups()
    {
        $location = $this->locationService->loadLocation( 80 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeId( array( 65 ) )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;

        $locations = array();

        foreach ( $results as $location )
        {
            $subQuery = new LocationQuery();
            $subCats = array();
            $subQuery->query = new Criterion\LogicalAnd(
                array(
                    new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                    new Criterion\Location\Depth( Criterion\Operator::EQ, $location->valueObject->depth + 1 ),
                    new Criterion\Subtree( $location->valueObject->pathString ),
                    new Criterion\ContentTypeId( array( 65 ) )
                )
            );

            $subQuery->sortClauses = array( new Query\SortClause\Location\Priority() );

            $subResults = $this->searchService->findLocations( $subQuery )->searchHits;

            if ( count( $subResults ))
            {
                foreach ( $subResults as $subResult )
                {
                    $subCats[$subResult->valueObject->id] = $subResult->valueObject->contentInfo->name;
                }

                $locations[$location->valueObject->contentInfo->name] = $subCats;
            }
            else
            {
                $locations[$location->valueObject->id] = $location->valueObject->contentInfo->name;
            }
        }

        return new SimpleChoiceList( array( '80' => '' ) + $locations );
    }

    public function getQuestions( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeId( array( 50 ) )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->searchService->findLocations( $query )->searchHits;
        $questionsContents = array();

        foreach ( $results as $result )
        {
            $questionsContents[] = $this->contentService->loadContent( $result->valueObject->contentInfo->id );
        }

        return $questionsContents;
    }
}
