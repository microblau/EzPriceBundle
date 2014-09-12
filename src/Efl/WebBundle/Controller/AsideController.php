<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class AsideController extends Controller
{
    public function contactAction()
    {
        $response = new Response;

        return $this->render(
            'EflWebBundle:aside:contact.html.twig',
            array(),
            $response
        );
    }
}
