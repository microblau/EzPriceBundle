<?php

namespace Efl\WebBundle\Controller;

use Efl\WebBundle\Form\Type\Faqs\GroupsType;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Publish\SPI\Persistence\Content\Type\Group;
use Symfony\Component\HttpFoundation\Response;

class FaqsController extends Controller
{
    public function pageAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $response = new Response();
        $response->setSharedMaxAge( 86400 );

        $form = $this->createForm(
            new GroupsType(
                $this->get( 'eflweb.faqs_helper' )
            )
        );

        return $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array( 'form' => $form->createView() )
        );
    }
}