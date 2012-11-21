<?php
/**
 * File containing the ezpMobileDeviceDetectFilterInterface interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

interface ezpMobileDeviceDetectFilterInterface
{
    /**
     * Processes the User Agent string and determines whether it is a mobile device or not
     * Needs to set boolean value for @see ezpMobileDeviceDetectFilterInterface::isMobileDevice()
     * and optionally user agent alias @see ezpMobileDeviceDetectFilterInterface::getUserAgentAlias()
     *
     * @abstract
     */
    public function process();

    /**
     * Handles redirection to the mobile optimized interface
     *
     * @abstract
     */
    public function redirect();

    /**
     * Returns true if current device is mobile
     *
     * @abstract
     * @return bool
     */
    public function isMobileDevice();

    /**
     * Returns mobile User Agent alias defined in the site.ini.[SiteAccessSettings].MobileUserAgentRegexps
     *
     * @abstract
     * @return string
     */
    public function getUserAgentAlias();
}
