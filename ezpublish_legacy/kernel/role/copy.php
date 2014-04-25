<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$roleID = $Params['RoleID'];

$role = eZRole::fetch( $roleID );
if ( $role )
{
    $newRole = $role->copy();
    return $Module->redirectToView( 'edit', array( $newRole->attribute( 'id' ) ) );
}
else
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

?>
