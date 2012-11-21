<?php
/**
 * File containing the ezpContentPublishingQueueReaderInterface interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This interface describes an asynchronous publishing queue reader
 * Queue readers are meant to provide the asynchronous publishing system with the next item to be published
 * @since 4.5
 * @package kernel
 */
    interface ezpContentPublishingQueueReaderInterface
{
    /**
     * Searches for and returns the next queue item to be processed
     *
     * @return ezpContentPublishingProcess|false the next process, or false if nothing is to be processed
     */
    public static function next();

    /**
     * Initialization method. Called once before the reader class is used.
     */
    public static function init();
}
?>
