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

class QMementoController extends Controller
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

        return $this->render(
            'EflWebBundle:qmementix:config.html.twig',
            array(
                'content' => $content,
                'img' => $img,
                'preview_img' => $preview
            )
        );
    }
}
