<?php
/**
 * File containing the ezpMobileDeviceDetectFilter class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class ezpMobileDeviceDetectFilter
{
    /**
     * Returns an instance of the ezpMobileDeviceDetectFilterInterface class
     *
     * @static
     * @return ezpMobileDeviceDetectFilterInterface|null
     */
    public static function getFilter()
    {
        $mobileDeviceFilterClass = eZINI::instance()->variable( 'SiteAccessSettings', 'MobileDeviceFilterClass' );

        $mobileDeviceDetectFilter = class_exists( $mobileDeviceFilterClass) ? new $mobileDeviceFilterClass : null;

        if ( $mobileDeviceDetectFilter instanceof ezpMobileDeviceDetectFilterInterface )
            return $mobileDeviceDetectFilter;

        return null;
    }
}
