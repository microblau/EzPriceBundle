<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class CatalogController extends Controller
{
    public function productAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 );
        $response->headers->set( 'X-Location-Id', $locationId );

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
                'fecha_aparicion' => $this->get( 'eflweb.product_helper' )->getFechaAparicionByProductLocationId( $locationId ),
                'nValoraciones' => $this->get( 'eflweb.valorations' )->getReviewsNumberForLocationId( $locationId )
            ),
            $response
        );
    }

    public function getRelatedProductsByOrdersAction( $contentId )
    {
        $contentIds = array( $contentId );
        $products = $this->get( 'eflweb.basket' )->relatedPurchasedListForContentIds( $contentIds, 4 );

        return $this->render(
            'EflWebBundle:product:relatedbyorders.html.twig',
            array()
        );
    }
}
