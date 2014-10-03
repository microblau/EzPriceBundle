<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Efl\WebBundle\Entity\SimpleSearch;
use eZ\Publish\Core\MVC\Symfony\Security\UserWrapped;

class HeaderController extends Controller
{
    /**
     * Construye el menú principal
     *
     * @param string $route
     *
     * @return Response
     */
    public function mainMenuAction( $route = '', $locationId = null )
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 );

        $menu = $this->getMenu( 'main' );
        $selectedItem = $this->get( 'eflweb.menus_helper' )->getSelectedMainMenuItem( $route, $locationId );

        if ( isset( $menu[$selectedItem] ) )
        {
            $menu[$selectedItem]->setCurrent( true );
        }

        $parameters = array(
            'menu' => $menu
        );
        return $this->render( 'EflWebBundle:header:mainmenu.html.twig', $parameters, $response );
    }

    /**
     * Pinta links en la zona superior derecha.
     * Mensaje de bienvenida y acceso a cuenta
     *
     * @return Response
     */
    public function userLinksAction()
    {
        $response = new Response();
        $response->setSharedMaxAge( 3600 );
        $response->setVary( 'Cookie' );

        $cart_is_empty = $this->get( 'eflweb.cart_helper' )->isCurrentCartEmpty();
        $cart_total = $this->get( 'eflweb.cart_helper' )->getCurrentCartTotal();
        $cart_nItems = $this->get( 'eflweb.cart_helper' )->getCurrentCartNItems();

        return $this->render(
            "EflWebBundle:header:user_links.html.twig",
            array(
                'cart_is_empty' => $cart_is_empty,
                'cart_total' => $cart_total,
                'cart_n_items' => $cart_nItems
            ),
            $response
        );

    }

    public function searchBoxAction()
    {
        $response = new Response();

        $simpleSearch = new SimpleSearch();
        $form = $this->createForm( $this->get( 'efl.form.type.simple_search' ), $simpleSearch );

        return $this->render(
            'EflWebBundle:header:searchbox.html.twig',
            array(
                'form' => $form->createView()
            ),
            $response
        );
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
