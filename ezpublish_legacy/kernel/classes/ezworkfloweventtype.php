<?php
/**
 * File containing the eZWorkflowEventType class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

//!! eZKernel
//! The class eZWorkflowEventType does
/*!

*/

class eZWorkflowEventType extends eZWorkflowType
{
    function eZWorkflowEventType( $typeString, $name )
    {
        $this->eZWorkflowType( "event", $typeString, ezpI18n::tr( 'kernel/workflow/event', "Event" ), $name );
    }

    static function registerEventType( $typeString, $class_name )
    {
        eZWorkflowType::registerType( "event", $typeString, $class_name );
    }
}

?>
