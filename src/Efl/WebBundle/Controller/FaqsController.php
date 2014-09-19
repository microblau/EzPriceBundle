<?php

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\Faqs\GroupsType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\SPI\Persistence\Content\Type\Group;
use Symfony\Component\HttpFoundation\Response;

class FaqsController extends Controller
{
    public function categoryAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $request = $this->getRequest();
        $response = new Response();
        $response->setSharedMaxAge( 86400 );
        $helper = $this->get( 'eflweb.faqs_helper' );

        $form = $this->createForm(
            new GroupsType(
                $helper,
                (int)$locationId
            )
        );

        if ( $request->isMethod('POST') )
        {
            $form->submit($request);

            if ($form->isValid()) {
                $groupLocationId = $form->get( 'group' )->getData();
                $destLocation = $this->getRepository()->getLocationService()->loadLocation( $groupLocationId );
                return $this->redirect( $this->generateUrl( $destLocation ) );
            }
        }

        $questions = $this->get( 'eflweb.faqs_helper' )->getQuestions( $locationId );

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'form' => $form->createView(),
                'questions' => $questions
            )
        );
    }
}
