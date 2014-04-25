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

if ( !$isQuiet )
{
    $cli->output( "Processing pending subtree re-index actions" );
}

// check that solr is enabled and used
$eZSolr = eZSearch::getEngine();
if ( !$eZSolr instanceof eZSolr )
{
    $script->shutdown( 1, 'The current search engine plugin is not eZSolr' );
}

$limit = 50;
$entries = eZPendingActions::fetchByAction( eZSolr::PENDING_ACTION_INDEX_SUBTREE );

if ( !empty( $entries ) )
{
    $parentNodeIDList = array();
    foreach ( $entries as $entry )
    {
        $parentNodeID = $entry->attribute( 'param' );
        $parentNodeIDList[] = (int)$parentNodeID;

        $offset = 0;
        while ( true )
        {
            $nodes = eZContentObjectTreeNode::subTreeByNodeID(
                array(
                    'IgnoreVisibility' => true,
                    'Offset' => $offset,
                    'Limit' => $limit,
                    'Limitation' => array(),
                ),
                $parentNodeID
            );

            if ( !empty( $nodes ) && is_array( $nodes ) )
            {
                foreach ( $nodes as $node )
                {
                    ++$offset;
                    $cli->output( "\tIndexing object ID #{$node->attribute( 'contentobject_id' )}" );
                    // delay commits with passing false for $commit parameter
                    $eZSolr->addObject( $node->attribute( 'object' ), false );
                }

                // finish up with commit
                $eZSolr->commit();
                // clear object cache to conserver memory
                eZContentObject::clearCache();
            }
            else
            {
                break; // No valid nodes
            }
        }
    }

    eZPendingActions::removeByAction(
        eZSolr::PENDING_ACTION_INDEX_SUBTREE,
        array(
            'param' => array( $parentNodeIDList )
        )
    );
}

if ( !$isQuiet )
{
    $cli->output( "Done" );
}

?>
