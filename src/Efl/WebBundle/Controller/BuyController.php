<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class BuyController extends Controller
{
    public function menuAction()
    {
        $response = new Response;

        $modules = $this->get( 'eflweb.buy_helper' )->getMenuModules();

        return $this->render(
            'EflWebBundle:buy:menu.html.twig',
            array(
                'modules' => $modules
            ),
            $response
        );
    }
}