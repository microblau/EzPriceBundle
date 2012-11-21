<?php
/**
 * Cluster files purge cronjob
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

if ( !eZScriptClusterPurge::isRequired() )
{
    $cli->error( "Your current cluster handler does not require file purge" );
    $script->shutdown( 1 );
}

$purgeHandler = new eZScriptClusterPurge();
$purgeHandler->optScopes = array( 'classattridentifiers',
                                  'classidentifiers',
                                  'content',
                                  'expirycache',
                                  'statelimitations',
                                  'template-block',
                                  'user-info-cache',
                                  'viewcache',
                                  'wildcard-cache-index',
                                  'image',
                                  'media',
                                  'binaryfile' );
$purgeHandler->optExpiry = 30;
$purgeHandler->run();

?>
