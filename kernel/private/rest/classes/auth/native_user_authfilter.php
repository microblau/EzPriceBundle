<?php
/**
 * File containing ezpNativeUserAuthFilter class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */
class ezpNativeUserAuthFilter extends ezcAuthenticationFilter
{
    const STATUS_INVALID_USER = 1;

    /**
     * Will check if UserID provided in credentials is valid
     * @see ezcAuthenticationFilter::run()
     */
    public function run( $credentials )
    {
        $status = self::STATUS_INVALID_USER;
        $count = eZPersistentObject::count( eZUser::definition(), array( 'contentobject_id' => (int)$credentials->id ) );
        if ( $count > 0 )
        {
            $status = self::STATUS_OK;
        }

        return $status;
    }
}
?>
