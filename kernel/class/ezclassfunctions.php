<?php
/**
 * File containing the eZClassFunctions class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class eZClassFunctions
{
    static function addGroup( $classID, $classVersion, $selectedGroup )
    {
        list ( $groupID, $groupName ) = explode( '/', $selectedGroup );
        $ingroup = eZContentClassClassGroup::create( $classID, $classVersion, $groupID, $groupName );
        $ingroup->store();
        return true;
    }

    static function removeGroup( $classID, $classVersion, $selectedGroup )
    {
        $class = eZContentClass::fetch( $classID, true, eZContentClass::VERSION_STATUS_DEFINED );
        if ( !$class )
            return false;
        $groups = $class->attribute( 'ingroup_list' );
        foreach ( array_keys( $groups ) as $key )
        {
            if ( in_array( $groups[$key]->attribute( 'group_id' ), $selectedGroup ) )
            {
                unset( $groups[$key] );
            }
        }

        if ( count( $groups ) == 0 )
        {
            return false;
        }
        else
        {
            foreach(  $selectedGroup as $group_id )
            {
                eZContentClassClassGroup::removeGroup( $classID, $classVersion, $group_id );
            }
        }
        return true;
    }
}

?>
