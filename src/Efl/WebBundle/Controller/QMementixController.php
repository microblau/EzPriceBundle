<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 9:55
 */

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\QMementix\QMementixType;
use eZ\Bundle\EzPublishCoreBundle\Controller;

class QMementixController extends Controller
{
    /**
     * Página qmementix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $content = $this->getRepository()->getContentService()->loadContent( 20025 );
        $img = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video' )->destinationContentId
        );

        $preview = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video_2' )->destinationContentId
        );

        $currentUserData = $this->get( 'eflweb.utils_helper' )->getCurrentUserFriendlyData();
        $form = $this->createForm(
            new QMementixType(
                $this->get( 'translator' ),
                $this->get( 'ezpublish.api.service.location' ),
                $this->get( 'router' ),
                $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
            ),
            $currentUserData
        );

        $testimonios = $this->get( 'eflweb.testimonies_helper' )->getTestimoniesForLocation( 14851 );

        return $this->render(
            'EflWebBundle:qmementix:index.html.twig',
            array(
                'content' => $content,
                'img' => $img,
                'preview_img' => $preview,
                'testimonios' => $testimonios,
                'form' => $form->createView()
            )
        );
    }

    /**
     * Post formulario qmementix. Llama al webservice de aterrizajes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postFormAction()
    {
        $form = $this->createForm(
            new QMementixType(
                $this->get( 'translator' ),
                $this->get( 'ezpublish.api.service.location' ),
                $this->get( 'router' ),
                $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
            )
        );

        $request = $this->get( 'request_stack' )->getCurrentRequest();

        if ( $request->isMethod( 'POST' ) )
        {

            $form->handleRequest( $request );
            if ( $form->isValid() )
            {
                $this->get( 'eflweb.leads_helper' )->sendQMementixLead( $form->getData() );
            }
        }

        return $this->render(
            'EflWebBundle:qmementix:form_response.html.twig'
        );
    }

    /**
     * Redirigimos a qmementix para hacer cambio desde legacy
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToIndexAction()
    {
        return $this->redirect(
            $this->generateUrl( 'qmementix' )
        );
    }

    /**
     * Pantalla configuración qmementix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function configAction()
    {
        $content = $this->getRepository()->getContentService()->loadContent( 20025 );

        $img = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video' )->destinationContentId
        );

        $preview = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video_2' )->destinationContentId
        );

        $products = $this->get( 'eflweb.catalog_helper' )->getInternetProducts();

        return $this->render(
            'EflWebBundle:qmementix:config.html.twig',
            array(
                'content' => $content,
                'img' => $img,
                'preview_img' => $preview,
                'products' => $products
            )
        );
    }

    /**
     * Vista de los elementos configurables
     *
     * @param $locationId
     * @param $viewType
     * @param bool $layout
     * @param array $params
     *
     * @return mixed
     */
    public function viewElementAction(
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
                'hasDiscount' => $this->get( 'eflweb.product_helper' )->contentHasOffer( $content ),
                'alreadyInBasket' => $this->get( 'eflweb.basket_service' )->isProductInBasket( $formats['formato_internet']['content']->id )
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 7200 );
        $response->headers->set( 'X-Location-Id', $locationId );

        return $response;
    }
}
