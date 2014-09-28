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

        $request = $this->get( 'request_stack' )->getCurrentRequest();
        if ( $request->isMethod( 'post' ) )
        {
            $form->handleRequest($request);
        }

        $testimonios = $this->get( 'eflweb.qmementix_helper' )->getTestimonies();

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

    public function redirectToIndexAction()
    {
        return $this->redirect(
            $this->generateUrl( 'qmementix' )
        );
    }
}
