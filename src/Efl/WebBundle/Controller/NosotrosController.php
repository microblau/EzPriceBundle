<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class NosotrosController extends Controller
{
    public function menuAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'nosotros' );
        $menu["item_" . $locationId]->setCurrent( true );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:nosotros:menu.html.twig',
            $parameters,
            $response
        );
    }

    public function pageAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $response = new Response();
        $response->setSharedMaxAge( 300 );

        $testiminiosLocations = $this->get( 'eflweb.nosotros_helper' )->getRandomTestimonies();
        $testimonios = array();
        foreach ( $testiminiosLocations as $testiminiosLocation )
        {
            $content = $this->getRepository()->getContentService()->loadContent(
                $testiminiosLocation->contentInfo->id
            );
            $img = $content->getFieldValue( 'foto_testimonio' );
            $destinationImgObj = $this->getRepository()->getContentService()->loadContent( $img->destinationContentIds[0] );
            $parentLocation = $this->getRepository()->getLocationService()->loadLocation( $testiminiosLocation->parentLocationId );
            $parentObject = $this->getRepository()->getContentService()->loadContent( $parentLocation->contentId );



            $testimonios[] = array(
                'content' => $content,
                'imgObject' => $destinationImgObj,
                'parentObject' => $parentObject,
            );
        }

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array( 'testimonios' => $testimonios )
        );
    }

    /**
     * @param string $identifier
     *
     * @return \Knp\Menu\MenuItem
     */
    private function getMenu( $identifier )
    {
        return $this->container->get( "efl.menu.$identifier" );
    }
}