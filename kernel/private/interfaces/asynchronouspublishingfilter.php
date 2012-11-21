<?php
/**
 * File containing the ezpAsynchronousPublishingFilterInterface interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 * @since 4.5
 */

/**
 * Base interface for eZ Asynchronous Publishing filter classes
 * @package kernel
 */
interface ezpAsynchronousPublishingFilterInterface
{
    /**
     * Hook called by the kernel to check for async acceptance of an object
     *
     * @return bool true if the object can be published asynchronously, false if it shouldn't
     */
    public function accept();
}
?>
