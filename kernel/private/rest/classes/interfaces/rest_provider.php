<?php
/**
 * File containing the ezpRestProviderInterface interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

interface ezpRestProviderInterface
{
    /**
     * Returns registered versioned routes for provider
     *
     * @abstract
     * @return array
     */
    public function getRoutes();

    /**
     * Returns associated with provider view controller
     *
     * @abstract
     * @return ezpRestViewController
     */
    public function getViewController();
}
