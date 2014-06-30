<?php

namespace Efl\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FooterController extends Controller
{
    public function showAction()
    {
        $linkedin_link = $this->container->getParameter( 'eflweb.social_links.linkedin' );
        $twitter_link = $this->container->getParameter( 'eflweb.social_links.twitter' );
        $facebook_link = $this->container->getParameter( 'eflweb.social_links.facebook' );
        $youtube_link = $this->container->getParameter( 'eflweb.social_links.youtube' );

        $catalog_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.location_id' )
        );

        $aviso_legal_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.aviso_legal.location_id' )
        );

        $politica_privacidad_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.politica_privacidad.location_id' )
        );

        $politica_cookies_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.politica_cookies.location_id' )
        );

        return $this->render(
            'EflWebBundle::page_footer.html.twig',
            array(
                'data' => array(
                    'linkedin_link' => $linkedin_link,
                    'twitter_link' => $twitter_link,
                    'facebook_link' => $facebook_link,
                    'youtube_link' => $youtube_link,
                    'catalog_location' => $catalog_location,
                    'aviso_legal_location' => $aviso_legal_location,
                    'politica_privacidad_location' => $politica_privacidad_location,
                    'politica_cookies_location' => $politica_cookies_location
                )
            )
        );
    }
}
