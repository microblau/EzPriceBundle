<?php
/**
 * File containing ezpRestAuthProvider class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */
class ezpRestAuthProvider implements ezpRestProviderInterface
{
    /**
     * @see ezpRestProviderInterface::getRoutes()
     */
    public function getRoutes()
    {
        $routes = array(
            'basicAuth'    => new ezpMvcRailsRoute( '/http-basic-auth', 'ezpRestAuthController', 'basicAuth' ),
            'oauthLogin'   => new ezpMvcRailsRoute( '/oauth/login', 'ezpRestAuthController', 'oauthRequired' ),
            'oauthToken'   => new ezpMvcRailsRoute( '/oauth/token', 'ezpRestOauthTokenController', array( 'http-post' => 'handleRequest' ))
        );
        return $routes;
    }

        /**
     * Returns associated with provider view controller
     *
     * @return ezpRestViewController
     */
    public function getViewController()
    {
        return new ezpRestApiViewController();
    }
}
?>
