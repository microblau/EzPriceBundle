<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class AsideController extends Controller
{
    public function contactAction()
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 );

        return $this->render(
            'EflWebBundle:aside:contact.html.twig',
            array(),
            $response
        );
    }

    public function metodosPagoAction()
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 );

        return $this->render(
            "EflWebBundle:aside:metodospago.html.twig",
            array(),
            $response
        );
    }

    public function envioDevolucionesAction()
    {
        $response = new Response;
        $response->setPublic();
        $response->setSharedMaxAge( 86400 );

        return $this->render(
            "EflWebBundle:aside:enviodevoluciones.html.twig",
            array(),
            $response
        );
    }
}
