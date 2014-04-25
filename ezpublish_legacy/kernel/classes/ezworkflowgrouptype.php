<?php
/**
 * File containing the eZWorkflowGroupType class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

//!! eZKernel
//! The class eZWorkflowGroupType does
/*!

*/

class eZWorkflowGroupType extends eZWorkflowType
{
    function eZWorkflowGroupType( $typeString, $name )
    {
        $this->eZWorkflowType( "group", $typeString, ezpI18n::tr( 'kernel/workflow/group', "Group" ), $name );
    }

    static function registerGroupType( $typeString, $class_name )
    {
        eZWorkflowType::registerType( "group", $typeString, $class_name );
    }
}

?>
