<?php

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\ContentService;

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

    public function __construct( ContentService $contentService, LocationService $locationService )
    {
        $this->contentService = $contentService;
        $this->locationService = $locationService;
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
}
