<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

function stateEditPostFetch( $module, $class, $object, $version, $contentObjectAttributes, $editVersion, $editLanguage, $fromLanguage, &$validation )
{
}

function stateEditPreCommit( $module, $class, $object, $version, $contentObjectAttributes, $editVersion, $editLanguage )
{
}

function stateEditActionCheck( $module, $class, $object, $version, $contentObjectAttributes, $editVersion, $editLanguage, $fromLanguage )
{
    if ( $module->isCurrentAction( 'StateEdit' ) )
    {
        $http = eZHTTPTool::instance();
        if ( $http->hasPostVariable( 'SelectedStateIDList' ) )
        {
            $selectedStateIDList = $http->postVariable( 'SelectedStateIDList' );
            $objectID = $object->attribute( 'id' );

            if ( eZOperationHandler::operationIsAvailable( 'content_updateobjectstate' ) )
            {
                $operationResult = eZOperationHandler::execute( 'content', 'updateobjectstate',
                                                                array( 'object_id'     => $objectID,
                                                                       'state_id_list' => $selectedStateIDList ) );
            }
            else
            {
                eZContentOperationCollection::updateObjectState( $objectID, $selectedStateIDList );
            }
            $module->redirectToView( 'edit', array( $object->attribute( 'id' ), $editVersion, $editLanguage, $fromLanguage ) );
        }
    }
}

function stateEditPreTemplate( $module, $class, $object, $version, $contentObjectAttributes, $editVersion, $editLanguage, $tpl )
{
}

function initializeStateEdit( $module )
{
    $module->addHook( 'post_fetch', 'stateEditPostFetch' );
    $module->addHook( 'pre_commit', 'stateEditPreCommit' );
    $module->addHook( 'action_check', 'stateEditActionCheck' );
    $module->addHook( 'pre_template', 'stateEditPreTemplate' );
}

?>
