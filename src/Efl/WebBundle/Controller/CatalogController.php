<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class CatalogController extends Controller
{
    public function productAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId( $locationId ),
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation( $location->parentLocationId )->contentId
                ),
                'fecha_aparicion' => $this->get( 'eflweb.product_helper' )->getFechaAparicionByProductLocationId( $locationId )
            )
        );
    }
}
