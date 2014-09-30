<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 11:42
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\Core\Repository\ContentService;

class TestimoniesHelper
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
     * Obtiene los testimonios para qMementix.
     * Serán locations (nodes) colgados de su node
     *
     * @return array
     * @throws \eZ\Publish\Core\Base\Exceptions\UnauthorizedException
     */
    public function getTestimoniesForLocation( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( array( 'testimonio') )
            )
        );

        $query->offset = 0;
        $query->limit = 2;

        $results = $this->searchService->findLocations( $query )->searchHits;

        $testimonios = array();

        foreach ( $results as $location )
        {
            $content = $this->contentService->loadContent( $location->valueObject->contentInfo->id );
            $destinationImgObj = $this->contentService->loadContent(
                    $content->getFieldValue( 'foto_testimonio' )->destinationContentIds[0]
                );
            $testimonios[] = array(
                'content' => $content,
                'imgObject' => $destinationImgObj
            );
        }

        return $testimonios;
    }
}
