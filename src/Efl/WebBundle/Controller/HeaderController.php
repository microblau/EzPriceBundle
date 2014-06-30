<?php

namespace Efl\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function mainMenuAction()
    {
        $catalog_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.location_id' )
        );

        $mementos_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.mementos.location_id' )
        );

        $bases_datos_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.bases_datos.location_id' )
        );

        $qmemento_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.qmemento.location_id' )
        );

        $imemento_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.imemento.location_id' )
        );

        $qmementix_location = $this->get( 'eflweb.location_helper' )->loadLocationById(
            $this->container->getParameter( 'eflweb.catalog.qmementix.location_id' )
        );

        return $this->render(
            'EflWebBundle:header:mainmenu.html.twig',
            array(
                'data' => array(
                    'catalog_location' => $catalog_location,
                    'mementos_location' => $mementos_location,
                    'bases_datos_location' => $bases_datos_location,
                    'qmemento_location' => $qmemento_location,
                    'imemento_location' => $imemento_location,
                    'qmementix_location' => $qmementix_location,
                )
            )
        );
    }
}
