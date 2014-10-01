<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 9:55
 */

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\Imemento\ImementoType;
use eZ\Bundle\EzPublishCoreBundle\Controller;

class ImementoController extends Controller
{
    /**
     * Página qmementix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $content = $this->getRepository()->getContentService()->loadContent( 18383 );
        $img = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'big_image' )->destinationContentId
        );

        $currentUserData = $this->get( 'eflweb.utils_helper' )->getCurrentUserFriendlyData();
        $form = $this->createForm(
            new ImementoType(
                $this->get( 'translator' ),
                $this->get( 'ezpublish.api.service.location' ),
                $this->get( 'router' ),
                $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
            ),
            $currentUserData
        );

        $testimonios = $this->get( 'eflweb.testimonies_helper' )->getTestimoniesForLocation( 14129 );
        $faqs = $this->get( 'eflweb.product_helper' )->getFaqsForContent( $content, 'faqs_producto' );

        return $this->render(
            'EflWebBundle:imemento:index.html.twig',
            array(
                'content' => $content,
                'img' => $img,
                'testimonios' => $testimonios,
                'form' => $form->createView(),
                'faqs' => $faqs
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
            new ImementoType(
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
                $this->get( 'eflweb.leads_helper' )->sendImementoLead( $form->getData() );
            }
        }

        return $this->render(
            'EflWebBundle:imemento:form_response.html.twig'
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
            $this->generateUrl( 'imemento' )
        );
    }

    /**
     * Pantalla configuración qmementix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function configAction()
    {
        $content = $this->getRepository()->getContentService()->loadContent( 18383 );

        $img = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'big_image' )->destinationContentId
        );

        return $this->render(
            'EflWebBundle:imemento:config.html.twig',
            array(
                'content' => $content,
                'img' => $img,
            )
        );
    }
}
