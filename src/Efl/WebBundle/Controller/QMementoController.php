<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 28/09/14
 * Time: 9:55
 */

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\QMemento\QMementoType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class QMementoController extends Controller
{
    /**
     * Página qmementix
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $locationId = $this->get( 'eflweb.qmemento_helper' )->findQMementoLocationId();

        $content = $this->getRepository()->getContentService()->loadContent(
            $this->getRepository()->getLocationService()->loadLocation( $locationId )->contentId
        );

        $currentUserData = $this->get( 'eflweb.utils_helper' )->getCurrentUserFriendlyData();

        $img = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video' )->destinationContentId
        );

        $preview = $this->getRepository()->getContentService()->loadContent(
            $content->getFieldValue( 'img_preview_video_2' )->destinationContentId
        );

        $form = $this->createForm(
            new QMementoType(
                $this->get( 'translator' ),
                $this->get( 'ezpublish.api.service.location' ),
                $this->get( 'router' ),
                $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
            ),
            $currentUserData
        );

        $testimonios = $this->get( 'eflweb.testimonies_helper' )->getTestimoniesForLocation( $locationId );

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'full',
            false,
            array(
                'form' => $form->createView(),
                'testimonios' => $testimonios,
                'img' => $img,
                'preview_img' => $preview
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 86400 );
        return $response;

    }

    /**
     * Redirigimos a qmementix para hacer cambio desde legacy
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToIndexAction()
    {
        return $this->redirect(
            $this->generateUrl( 'qmemento' )
        );
    }

    /**
     * Post formulario qmemento. Llama al webservice de aterrizajes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postFormAction()
    {
        $form = $this->createForm(
            new QmementoType(
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
                $this->get( 'eflweb.leads_helper' )->sendQMementoLead( $form->getData() );
            }
        }

        return $this->render(
            'EflWebBundle:qmementix:form_response.html.twig'
        );
    }

    public function detailAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $parentLocationId = $this->get( 'eflweb.qmemento_helper' )->findQMementoLocationId();

        $parentContent = $this->getRepository()->getContentService()->loadContent(
            $this->getRepository()->getLocationService()->loadLocation( $parentLocationId )->contentId
        );

        $img = $this->getRepository()->getContentService()->loadContent(
            $parentContent->getFieldValue( 'img_preview_video' )->destinationContentId
        );

        $preview = $this->getRepository()->getContentService()->loadContent(
            $parentContent->getFieldValue( 'img_preview_video_2' )->destinationContentId
        );

        $menu = $this->getMenu( 'qmemento' );
        $menu['item_' .I$sio$slocationId]


        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            'full',
            false,
            array(
                'parentContent' => $parentContent,
                'img' => $img,
                'preview_img' => $preview,
                'menu' => $menu
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 86400 );
        return $response;
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
