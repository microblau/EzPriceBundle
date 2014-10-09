<?php

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\Catalog\FiltersType;
use Efl\WebBundle\Pagination\PagerFanta\CatalogSearchAdapter;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Pagerfanta\Pagerfanta;

class CatalogController extends Controller
{
    public function listAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $searchText = '';
        $request = $this->get( 'request_stack' )->getCurrentRequest();

        $form = $this->get( 'efl.form.catalog_filters' );

        // Initialize pagination.
        $pager = new Pagerfanta(
            new CatalogSearchAdapter(
                $this->getLegacyKernel(),
                array(),
                $this->getRepository()->getContentService()
            )
        );
        $pager->setMaxPerPage( 10 );
        $page = $request->get( 'page', 1 );
        $pager->setCurrentPage( $page );

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'pager' => $pager,
                'form' => $form->createView(),
                'page' => $page
            )
        );

        $response->setPrivate();
        $response->setMaxAge( 0 );
        $response->setSharedMaxAge( 0 );

        return $response;
    }

    public function searchAction()
    {
        $request = $this->get( 'request_stack' )->getCurrentRequest();
        $form = $this->get( 'efl.form.catalog_filters' );

        $form->handleRequest( $request );

        $params = array();

        $areas = $form->get( 'areas' )->getData();
        if ( !empty ( $areas ) )
        {
            $params['areas'] = $areas;
        }

        $types = $form->get( 'types' )->getData();
        if ( !empty ( $types ) )
        {
            $params['types'] = $types;
        }

        $state = $form->get( 'states' )->getData();
        if ( !empty ( $state ) )
        {
            $params['state'] = $state;
        }

        $pager = new Pagerfanta(
            new CatalogSearchAdapter(
                $this->getLegacyKernel(),
                $params,
                $this->getRepository()->getContentService()
            )
        );
        $pager->setMaxPerPage( 10 );
        $pager->setCurrentPage( $request->get( 'page', 1 ) );

        $response = $this->render(
            'EflWebBundle:catalog:search.html.twig',
            array(
                'pager' => $pager
            )
        );

        $response->setPrivate();
        $response->setMaxAge( 0 );
        $response->setSharedMaxAge( 0 );

        return $response;

    }

    /**
     * @param string $identifier
     * @return \Knp\Menu\MenuItem
     */
    private function getMenu( $identifier )
    {
        return $this->container->get( "efl.menu.$identifier" );
    }
}
