<?php
/**
 * File containing the eZRoleFunctionCollection class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZRoleFunctionCollection ezrolefunctioncollection.php
  \brief The class eZRoleFunctionCollection does

*/

class eZRoleFunctionCollection
{
    /*!
     Constructor
    */
    function eZRoleFunctionCollection()
    {
    }

    function fetchRole( $roleID )
    {
        $role = eZRole::fetch( $roleID );
        return array( 'result' => $role );
    }

}

?>
