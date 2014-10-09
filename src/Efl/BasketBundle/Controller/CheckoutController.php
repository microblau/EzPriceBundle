<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 7/10/14
 * Time: 17:08
 */

namespace Efl\BasketBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    /**
     * Redirección de la url antigua a la nueva
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function basketAction()
    {
        return $this->redirect(
            $this->generateUrl( 'cart' )
        );
    }

    /**
     * Muestra la cesta de la compra. Distingue si está vacía o no
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function cartAction()
    {
        $currentBasket = $this->get( 'eflweb.basket_service' )->getCurrentBasket();
        $currentItems = $currentBasket->getItems();
        $template = count( $currentItems ) ? 'cart' : 'empty-cart';

        $params = array();
        if ( count( $currentItems ) )
        {
            $params['items'] = array();
            foreach( $currentItems as $item )
            {
                $params['items'][] = array(
                    'product_info' => $this->viewItemAction(
                        $item->locationId,
                        'basket'
                    )->getContent(),
                    'product_item_count' => $item->itemCount,
                    'product_unit_price' => $item->totalPriceExVat / $item->itemCount,
                    'product_total_price' => $item->totalPriceExVat,
                    'product_data' => $this->get( 'eflweb.cart_helper' )->getDataForBasketItem(
                        $item->getContent()
                    )
                );
            }
        }

        $params['totalExVat'] = $currentBasket->getTotalExVat();
        $params['totalIncVat'] = $currentBasket->getTotalIncVat();
        $params['totalTaxAmount'] = $currentBasket->getTotalTaxAmount();

        return $this->render(
            'EflBasketBundle::' . $template .  '.html.twig',
            $params
        );
    }

    /**
     * Visualización de la información relativa
     * al producto
     *
     * @param $locationId
     * @param $viewType
     * @param bool $layout
     * @param array $params
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewItemAction(
        $locationId,
        $viewType,
        $layout = false,
        array $params = array()
    )
    {
        $parentLocation = $this->getRepository()->getLocationService()->loadLocation(
            $this->getRepository()->getLocationService()->loadLocation( $locationId )->parentLocationId
        );

        $content = $this->getRepository()->getContentService()->loadContent(
            $parentLocation->contentId
        );

        $data = $this->get( 'eflweb.product_helper' )->buildElementForLineView( $content );

        $formats = $this->get( 'eflweb.product_helper' )->getFormatosForLocation( $parentLocation );

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'productParent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation(
                        $parentLocation->parentLocationId
                    )->contentId
                ),
                'product' => $this->getRepository()->getContentService()->loadContent(
                    $parentLocation->contentId
                ),
                'formats' => $formats,
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId(
                    $parentLocation->id
                ),
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        return $response;
    }
}
