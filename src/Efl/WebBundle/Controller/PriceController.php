<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/09/14
 * Time: 9:42
 */

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controlador para precios
 *
 * Class PrecioController
 * @package Efl\WebBundle\Controller
 */

class PriceController extends Controller
{
    /**
     * Muestra el precio con oferta si lo hubiera según la twigTemplate dada
     *
     * @param $contentId
     * @param $twigTemplate
     * @return Response
     */
    public function showPriceAction( $contentId, $twigTemplate )
    {
        $response = new Response;

        $response->setSharedMaxAge(0);

        $prices = $this->get( 'eflweb.price_helper' )->getPrices( $contentId );

        return $this->render(
            "EflWebBundle:prices:{$twigTemplate}.html.twig",
            array(
                'prices' => $prices
            ),
            $response
        );
    }
}
