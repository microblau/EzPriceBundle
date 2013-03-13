<?php
//
// Created on: <27-Nov-2008 15:28:15 pb>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Find
// SOFTWARE RELEASE: 2.7.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2012 eZ Systems AS
// SOFTWARE LICENSE: eZ Business Use License Agreement eZ BUL Version 2.1
// NOTICE: >
//  This source file is part of the eZ Publish CMS and is
//  licensed under the terms and conditions of the eZ Business Use
//  License v2.1 (eZ BUL).
//
//  A copy of the eZ BUL was included with the software. If the
//  license is missing, request a copy of the license via email
//  at license@ez.no or via postal mail at
// 	Attn: Licensing Dept. eZ Systems AS, Klostergata 30, N-3732 Skien, Norway
//
//  IMPORTANT: THE SOFTWARE IS LICENSED, NOT SOLD. ADDITIONALLY, THE
//  SOFTWARE IS LICENSED "AS IS," WITHOUT ANY WARRANTIES WHATSOEVER.
//  READ THE eZ BUL BEFORE USING, INSTALLING OR MODIFYING THE SOFTWARE.

// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*! \file ezfindexcontent.php
*/

eZDebug::writeStrict( "This cronjob is deprecated in favor of the standard cronjobs/indexcontent.php provided by eZ Publish" );

if ( !$isQuiet )
{
    $cli->output( "Starting processing pending search engine modifications" );
}

// check that solr is enabled and used
$eZSolr = eZSearch::getEngine();
if ( !( $eZSolr instanceof eZSolr ) )
{
	$script->shutdown( 1, 'The current search engine plugin is not eZSolr' );
}

$contentObjects = array();
$db = eZDB::instance();

$offset = 0;
$limit = 50;

while( true )
{
    $entries = $db->arrayQuery( "SELECT param FROM ezpending_actions WHERE action = 'index_object'",
                                array( 'limit' => $limit,
                                       'offset' => $offset ) );

    if ( is_array( $entries ) && count( $entries ) != 0 )
    {
        $objectIDList = array();
        $db->begin();
        foreach ( $entries as $entry )
        {
            $objectID = $entry['param'];
            $objectIDList[] = (int)$objectID;

            $cli->output( "\tIndexing object ID #$objectID" );
            $object = eZContentObject::fetch( $objectID );
            if ( $object )
            {
                // delay commits with passing false for $commit parameter
                $eZSolr->addObject( $object, false );
            }
        }

        $paramInSQL = $db->generateSQLInStatement( $objectIDList, 'param' );

        $db->query( "DELETE FROM ezpending_actions WHERE action = 'index_object' AND $paramInSQL" );
        $db->commit();

        // finish up with commit
        $eZSolr->commit();
        // clear object cache to conserver memory
        eZContentObject::clearCache();
    }
    else
    {
        break; // No valid result from ezpending_actions
    }
}

if ( !$isQuiet )
{
    $cli->output( "Done" );
}

?>
