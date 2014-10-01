<?php

namespace Efl\WebBundle\Controller;

use Efl\BasketBundle\Form\Type\AddToBasketType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
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
                'tabs' => $this->get( 'eflweb.product_helper' )->getTabs( $locationId )
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
            'hasResume' => $this->get( 'eflweb.product_helper' )->contentHasResume( $content )
        );

        $formats = $this->get( 'eflweb.product_helper' )->getFormatosForLocation( $location );

        if ( count( $formats ) )
        {
            $form = $this->createForm(
                new AddToBasketType(
                    $formats,
                    $this->get( 'translator' )
                )
            );

            $request = $this->container->get( 'request_stack' )->getCurrentRequest();

            if ( $request->isMethod( 'post' ) )
            {
                $form->handleRequest( $request );
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

    public function relatedByOrdersAction(
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
                'formats' => $formats
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 60 );
        $response->headers->set( 'X-Location-Id', $locationId );

        return $response;
    }

    /**
     * Previsualización producto
     *
     * @param $locationId
     *
     * @return mixed
     */
    public function previewAction( $locationId )
    {
        return $this->fullAction(
            $locationId,
            'preview'
        );
    }

    /**
     * Sumario producto
     *
     * @param $locationId
     *
     * @return mixed
     */
    public function summaryAction( $locationId )
    {
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
                'products' => $products,
                'formats' => $formats
            ),
            $response
        );
    }
}
