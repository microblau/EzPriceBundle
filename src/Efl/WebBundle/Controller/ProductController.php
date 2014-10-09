<?php

namespace Efl\WebBundle\Controller;

use Efl\BasketBundle\Event\AddItemToBasketEvent;
use Efl\BasketBundle\Form\Type\AddToBasketType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\API\Repository\Values\Content\Content;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Muestra imagen del producto y enlaces a vídeo, previsualización y sumario cuando los hay
     *
     * @param $locationId
     *
     * @return Response
     */
    public function leftPartAction( $locationId, $viewType = 'full' )
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $content = $this->getRepository()->getContentService()->loadContent( $location->contentId );
        $format = $this->get( 'eflweb.product_helper' )->getFormatForContent( $content->id );

        return $this->render(
            'EflWebBundle:product:leftpart.html.twig',
            array(
                'viewType' => $viewType,
                'location' => $location,
                'content' => $content,
                'format' => $format,
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId(
                    $locationId
                ),
                'path' => $this->getRepository()->getURLAliasService()->reverseLookup( $location )->path
            ),
            $response
        );
    }

    /**
     * Parte central de la ficha
     *
     * @param $locationId
     * @param string $viewType
     *
     * @return Response
     */
    public function centerPartAction( $locationId, $viewType = 'full' )
    {
        $currentUserId = $this->get( 'eflweb.utils_helper' )->getCurrentRepositoryUserId();
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $content = $this->getRepository()->getContentService()->loadContent( $location->contentId );

        return $this->render(
            'EflWebBundle:product:centerpart.html.twig',
            array(
                'viewType' => $viewType,
                'location' => $location,
                'content' => $content,
                'image' => $this->get( 'eflweb.product_helper' )->getImageByProductLocationId(
                    $locationId
                ),
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation(
                        $location->parentLocationId
                    )->contentId
                ),
                'fecha_aparicion' => $this->get(
                    'eflweb.product_helper'
                )->getFechaAparicionByProductLocationId( $locationId ),
                'nValoraciones' => $this->get(
                    'eflweb.reviews_service'
                )->getReviewsCountForLocation( $location ),
                'haVotado' => ( $currentUserId != 10 )
                              && $this->get(
                        'eflweb.reviews_service'
                    )->userHasReviewedLocation( $currentUserId, $locationId ),
            ),
            $response
        );
    }

    /**
     * Parte inferior de la ficha
     *
     * @param $locationId
     *
     * @return Response
     */
    public function downPartAction( $locationId )
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $content = $this->getRepository()->getContentService()->loadContent( $location->contentId );

        return $this->render(
            'EflWebBundle:product:downpart.html.twig',
            array(
                'location' => $location,
                'content' => $content,
                'tabs' => $this->get( 'eflweb.product_helper' )->getTabs( $locationId ),
            ),
            $response
        );
    }

    /**
     * Full view para producto
     *
     * @param $locationId
     * @param $viewType
     * @param bool $layout
     * @param array $params
     *
     * @return mixed
     */
    public function fullAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $content = $this->getRepository()->getContentService()->loadContent(
            $this->getRepository()->getLocationService()->loadLocation( $locationId )->contentId
        );

        $params = array(
            'viewType' => $viewType,
            'hasDiscount' => $this->get( 'eflweb.product_helper' )->contentHasOffer( $content )
        );

        $formats = $this->get( 'eflweb.product_helper' )->getFormatosForLocation( $location );

        // formamos un array de format ids para luego hacer borrado
        $formatsIds = array();
        foreach ( $formats as $format )
        {
            $formatsIds[] = $format['content']->id;
        }

        if ( count( $formats ) )
        {

            $form = $this->createForm(
                new AddToBasketType(
                    $formats,
                    $this->get( 'translator' ),
                    $this->get( 'eflweb.basket_service')
                ),
                array()
            );

            $request = $this->container->get( 'request_stack' )->getCurrentRequest();

            if ( $request->isMethod( 'post' ) )
            {
                $form->handleRequest( $request );
                if ( $form->isValid() )
                {
                    $products = $form->getData( 'formats' );

                    // borramos de la cesta, si estuvieran, aquellos ids q no vienen en el post
                    foreach ( $formatsIds as $formatId )
                    {
                        if (
                            ( !in_array( $formatId, $products['formats'] ) ) &&
                            ( $this->get( 'eflweb.basket_service' )->isProductInBasket( $formatId ) )
                        )
                        {
                            $this->get( 'eflweb.basket_service' )->removeProductFromBasket( $formatId );
                            $this->get( 'session' )->getFlashBag()->add(
                                'basketMsg',
                                $this->get( 'translator' )->trans(
                                    'Acabamos de quitar el <b>%product%</b> de la compra.',
                                    array(
                                        '%product%' => $content->contentInfo->name
                                    )
                                )
                            );
                        }
                    }

                    foreach ( $products['formats'] as $productId )
                    {
                        // sólo añadimos si el producto no estaba ya en cesta
                        if ( !$this->get( 'eflweb.basket_service' )->isProductInBasket( $productId ) )
                        {
                            $basketItem = $this->get( 'eflweb.basket_service' )->addProductToBasket( $productId );
                            /*$this->get( 'session' )->getFlashBag()->add(
                                'basketMsg',
                                $this->get( 'translator' )->trans(
                                    'Acabamos de añadir el <b>%product%</b> a la compra.',
                                    array(
                                        '%product%' => $content->contentInfo->name
                                    )
                                )
                            );*/

                            $event = new AddItemToBasketEvent(
                                $this->get( 'eflweb.basket_service' )->getCurrentBasket(),
                                $basketItem
                            );
                            $dispatcher = $this->get('event_dispatcher');
                            $dispatcher->dispatch('eflweb.event.additemtobasket', $event);
                        }
                    }



                    return $this->redirect(
                        $this->generateUrl( 'cart' )
                    );
                }
            }

            $params['form'] = $form->createView();
            $params['formats'] = $formats;
        }

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            $params
        );

        $response->setPrivate();
        $response->setMaxAge( 0 );
        $response->setSharedMaxAge( 0 );
        $response->headers->addCacheControlDirective( 'must-revalidate', true );
        $response->headers->addCacheControlDirective( 'no-store', true );

        return $response;
    }

    public function lineAction(
        $locationId,
        $viewType,
        $layout = false,
        array $params = array()
    )
    {
        $content = $this->getRepository()->getContentService()->loadContent(
            $this->getRepository()->getLocationService()->loadLocation( $locationId )->contentId
        );
        $data = $this->get( 'eflweb.product_helper' )->buildElementForLineView( $content );

        $location = $this->getRepository()->getLocationService()->loadLocation(
            $locationId
        );
        $formats = $this->get( 'eflweb.product_helper' )->getFormatosForLocation( $location );

        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'product' => $data,
                'formats' => $formats,
                'hasDiscount' => $this->get( 'eflweb.product_helper' )->contentHasOffer( $content )
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 7200 );
        $response->headers->set( 'X-Location-Id', $locationId );

        return $response;
    }

    /**
     * Previsualización producto
     *
     * @param $url
     *
     * @return mixed
     */
    public function previewAction( $url )
    {
        $url = "/$url";

        $locationId = $this->getRepository()->getURLAliasService()->lookup( $url )->destination;

        return $this->fullAction(
            $locationId,
            'preview'
        );
    }

    /**
     * Sumario producto
     *
     * @param $url
     *
     * @return mixed
     */
    public function summaryAction( $url )
    {
        $url = "/$url";

        $locationId = $this->getRepository()->getURLAliasService()->lookup( $url )->destination;

        return $this->fullAction(
            $locationId,
            'summary'
        );
    }

    /**
     * Vídeo producto
     *
     * @param $locationId
     *
     * @return mixed
     */
    public function videoAction( $locationId )
    {
        $location = $this->getRepository()->getLocationService()->loadLocation( $locationId );
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 * 30 );
        $response->headers->set( 'X-Location-Id', $locationId );

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'video',
            false,
            array(
                'parentContent' => $this->getRepository()->getContentService()->loadContent(
                    $this->getRepository()->getLocationService()->loadLocation(
                        $location->parentLocationId
                    )->contentId
                ),
            ),
            $response
        );
    }

    /**
     * Productos comprados en otras compras donde se compró este producto
     *
     * @param $contentId
     *
     * @return Response
     */
    public function getRelatedProductsByOrdersAction( $contentId )
    {
        $response = new Response;
        $contentIds = array( $contentId );
        $result = $this->get( 'eflweb.basket_service' )->getRelatedPurchasedListForContentIds(
            $contentIds,
            4
        );
        $products = array();

        foreach ( $result as $item )
        {
            $products[] = $item->contentInfo->mainLocationId;
        }

        return $this->render(
            'EflWebBundle:product:relatedbyorders.html.twig',
            array(
                'products' => $products
            ),
            $response
        );
    }

    public function renderFaqsProduct( array $faqs )
    {
        return $this->render(
            'EflWebBundle:product:faqs.html.twig',
            array(
                'faqs' => $faqs
            )
        );
    }

    public function renderSistemaMementoProduct( Content $sistema_memento )
    {
        return $this->render(
            'EflWebBundle:product:sistema_memento.html.twig',
            array(
                'sistemaMemento' => $sistema_memento
            )
        );
    }

    public function renderInfoField( Content $content, $field )
    {
        return $this->render(
            'EflWebBundle:product:info_field.html.twig',
            array(
                'content' => $content,
                'field' => $field
            )
        );
    }
}
