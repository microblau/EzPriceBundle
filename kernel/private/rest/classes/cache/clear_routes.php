<?php
/**
 * File containing ezpRestRoutesCacheClear class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */
/**
 * Clear cache handler.
 * Deletes REST routes from APC
 */
class ezpRestRoutesCacheClear
{
    /**
     * Force Route cache expiration,
     * so that APC cache will be flushed and regenerated next REST call
     */
    public static function clearCache()
    {
        $expiryHandler = eZExpiryHandler::instance();
        if( $expiryHandler->hasTimestamp( ezpRestRouter::ROUTE_CACHE_KEY ) )
        {
            $expiryHandler->setTimestamp( ezpRestRouter::ROUTE_CACHE_KEY, 0 );
            $expiryHandler->store();
        }
    }

    public static function purgeCache()
    {
        self::clearCache();
    }
}
