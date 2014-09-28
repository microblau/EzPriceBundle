<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 9:55
 */

namespace Efl\WebBundle\Controller;

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

        $testimonios = $this->get( 'eflweb.qmementix_helper' )->getTestimonies();

        return $this->render(
            'EflWebBundle:qmementix:index.html.twig',
            array(
                'content' => $content,
                'img' => $img,
                'preview_img' => $preview,
                'testimonios' => $testimonios
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
