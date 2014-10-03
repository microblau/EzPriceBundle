<?php

namespace Efl\WebBundle\Controller;

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

        // Initialize pagination.
        $pager = new Pagerfanta(
            new CatalogSearchAdapter(
                $this->getLegacyKernel(),
                $searchText,
                $this->getRepository()->getContentService()
            )
        );
        $pager->setMaxPerPage( 10 );
        $pager->setCurrentPage( $request->get( 'page', 1 ) );

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
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
