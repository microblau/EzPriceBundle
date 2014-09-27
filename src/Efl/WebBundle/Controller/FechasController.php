<?php

namespace Efl\WebBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

class FechasController extends Controller
{
    public function fullAction( $locationId, $viewType, $layout = false, array $params = array() )
    {
        $calendars = $this->get( 'eflweb.fechas_helper' )->generateCalendars();

        /** @var Response $response */
        $response = $this->get( 'ez_content' )->viewLocation(
            $locationId,
            $viewType,
            $layout,
            array(
                'calendars' => $calendars
            )
        );

        $response->setPublic();
        $response->setSharedMaxAge( 86400 );
        return $response;
    }
}