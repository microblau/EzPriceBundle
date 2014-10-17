<?php

namespace Efl\WebBundle\Controller;

use eZ\Publish\Core\MVC\Symfony\Controller\Controller;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use Symfony\Component\HttpFoundation\Response;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

class FooterController extends Controller
{
    /**
     * Bloque de información Genérica en pie
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function genericInfoAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $blocks = $this->getGenericInfo();

        return $this->render(
            'EflWebBundle:footer:generic_info.html.twig',
            array( 'blocks' => $blocks ),
            $response
        );
    }

    private function getGenericInfo()
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( 142 );
        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 2 ),
                new Criterion\Subtree( $location->pathString ),
                new Criterion\ContentTypeIdentifier( array( 'info_modules' ) )
            )
        );

        $queryResults = $this->getRepository()->getSearchService()
                             ->findLocations( $query )->searchHits;
        $contents = array();

        foreach ( $queryResults as $result )
        {
            $contents[] = $this->getRepository()->getContentService()->loadContent(
                               $result->valueObject->contentInfo->id
            );
        }

        return $contents;
    }

    /**
     * Controlador para el menú de enlaces externos
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function quickLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.quicklinks' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:quick_links.html.twig',
            $parameters,
            $response
        );
    }

    /**
     * Controlador para el menú de enlaces externos
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function customerServiceLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.customerservice' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:customer_service.html.twig',
            $parameters,
            $response
        );
    }

    /**
     * Controlador para el menú de enlaces grupo
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function grupoLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.grupo' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:grupo.html.twig',
            $parameters,
            $response
        );
    }

    /**
     * Controlador para el menú de productos en el pie
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function productLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.products' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:products.html.twig',
            $parameters,
            $response
        );
    }

    /**
     * Controlador para el menú de enlaces en la parte inferior
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function auxLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.aux' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:auxiliar.html.twig',
            $parameters,
            $response
        );
    }

    /**
     * Controlador para el menú de redes sociales
     *
     * @param int $locationId
     *
     * @return Response
     */
    public function rrssLinksAction( $locationId )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $menu = $this->getMenu( 'footer.rrss' );

        $parameters = array(
            'menu' => $menu
        );

        return $this->render(
            'EflWebBundle:footer:rrss.html.twig',
            $parameters,
            $response
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
