<?php

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\Core\Helper\FieldHelper;
use eZ\Publish\API\Repository\Values\Content\Location;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use Efl\ReviewsBundle\eZ\Publish\Core\Repository\ReviewsService;

class ProductHelper
{
    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    private $contentService;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    /**
     * @var FieldHelper
     */
    private $fieldHelper;

    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * @var ReviewsService
     */
    private $reviewsService;

    public function __construct(
        ContentService $contentService,
        LocationService $locationService,
        FieldHelper $fieldHelper,
        SearchService $searchService,
        ReviewsService $reviewsService
    )
    {
        $this->contentService = $contentService;
        $this->locationService = $locationService;
        $this->fieldHelper = $fieldHelper;
        $this->searchService = $searchService;
        $this->reviewsService = $reviewsService;
    }

    /**
     * @param $locationId
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content
     */
    private function getContentByLocationId( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );
        return $this->contentService->loadContent( $location->contentInfo->id );
    }

    /**
     * Obtiene la imagen asociada al producto
     *
     * @param $locationId
     *
     * @return \eZ\Publish\API\Repository\Values\Content\Content
     */
    public function getImageByProductLocationId( $locationId )
    {
        $images = $this->getContentByLocationId( $locationId )->getFieldValue( 'imagen' );
        return $this->contentService->loadContent( $images->destinationContentIds[0] );
    }

    /**
     * @param $locationId
     *
     * @return mixed
     */
    public function getFechaAparicionByProductLocationId( $locationId )
    {
        return $this->getContentByLocationId( $locationId )->getFieldValue( 'fecha_aparicion' );
    }

    /**
     * Determina que tab mostraremos activa por defecto en función del contenido
     *
     * @param $locationId
     * @return array
     */
    public function getActiveTab( $locationId )
    {
        $location = $this->locationService->loadLocation( $locationId );
        $content = $this->contentService->loadContent( $location->contentId );
        $activeTab = 0;
        $hasTab1 = $this->contentHasNovedades( $content );
        $sistemaMemento = $this->contentHasSistemaMemento( $location );
        $reviews = $this->contentHasReviews( $location );

        if ( $hasTab1 )
        {
            $activeTab = 1;
        }
        else if ( $sistemaMemento )
        {
            $activeTab = 2;
        }
        else if ( $reviews )
        {
            $activeTab = 3;
        }

        return array(
            'hasTab1' => $hasTab1,
            'sistemaMemento' => $sistemaMemento,
            'reviews' => $reviews,
            'activeTab' => $activeTab
        );
    }

    /**
     * @param $content
     * @return bool
     */
    private function contentHasNovedades( Content $content )
    {
        return !$this->fieldHelper->isFieldEmpty( $content, 'novedades' );
    }


    /**
     * Mira si la localización tiene hijos de tipo sistema memento
     *
     * @param Location $location
     * @return array|bool
     */
    private function contentHasSistemaMemento( Location $location )
    {
        $sistemaMemento = false;

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( 'sistema_memento' )
            )
        );

        if ( $this->searchService->findLocations( $query )->totalCount > 0 )
        {
            $content = $this->contentService->loadContent(
                $this->searchService->findLocations( $query )->searchHits[0]->valueObject->contentInfo->id
            );
            $img = $content->getFieldValue( 'image' );
            $image = $this->contentService->loadContent( $img->destinationContentId );
            $sistemaMemento = array(
                'content' => $content,
                'image' => $image
            );
        }

        return $sistemaMemento;
    }

    /**
     * Devuelve las reviews que tiene el producto y falso en caso contrario
     *
     * @param Location $location
     * @return bool|mixed
     */
    private function contentHasReviews( Location $location )
    {
        return $this->reviewsService->getReviewsCountForLocation( $location ) > 0
            ? $this->reviewsService->getReviewsForLocation( $location, 3 )
            : false;
    }
}
