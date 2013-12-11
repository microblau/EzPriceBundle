<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$FunctionList = array();
$FunctionList['role'] = array( 'name' => 'role',
                               'operation_types' => array( 'read' ),
                               'call_method' => array( 'class' => 'eZRoleFunctionCollection',
                                                       'method' => 'fetchRole' ),
                               'parameter_type' => 'standard',
                               'parameters' => array( array( 'name' => 'role_id',
                                                             'type' => 'integer',
                                                             'required' => true ) ) );

?>
