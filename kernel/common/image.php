<?php
/**
 * File containing the imageInit() function.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Image manager instance
 *
 * @package kernel
 * @deprecated Deprecated as of 4.3, use {@link eZImageManager::factory()} instead.
 */

function imageInit()
{
    eZDebug::writeStrict( 'Function imageInit() has been deprecated in 4.3 in favor of eZImageManager::factory()', 'Deprecation' );
    return eZImageManager::factory();
}

?>
