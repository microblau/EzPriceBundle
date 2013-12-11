<?php
/**
 * File containing the ezpRestFeedDecorator class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This class decorates the feed provided in the REST interface
 * for content sync mechanisms.
 *
 * The interface is  based on the in-progress ezcMvcFeedDecorator interface.
 *
 * The decorator objects should be able describe the various syncing streams,
 * the decorator needs to be able to extract relevant information for defined
 * streams via an interface suited for this purpose.
 *
 * @package rest
 */
class ezpRestFeedDecorator
{
    public function decorateFeed( ezcFeed $feed )
    {
    }

    /**
     * Returns the name of the variable in the result object to decorate
     *
     * @return string
     */
    public function getItemVariable()
    {
    }

    /**
     * Adds feed metadata pertaining to the item's data specified in $data
     *
     * @todo Add list of required metadata to add
     *
     * @param string $ezcFeedEntryElement
     * @param string $data
     * @return void
     */
    public function decorateFeedItem( ezcFeedEntryElement $item, $data )
    {
    }
}
?>
