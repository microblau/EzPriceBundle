<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\Repository;

class LocationHelper
{
    /**
     * @var \eZ\Publish\API\Repository\Repository
     */
    private $repository;

    public function __construct( Repository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * Devuelve el location $locationId
     *
     * @param $locationId
     * @return \eZ\Publish\API\Repository\Values\Content\Location
     */
    public function loadLocationById( $locationId )
    {
        $locationService = $this->repository->getLocationService();
        $location = $locationService->loadLocation( $locationId );
        return $location;
    }
}
