<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$FunctionList = array();

$FunctionList['workflow_statuses'] = array( 'name' => 'workflow_statuses',
                                            'operation_types' => array( 'read' ),
                                            'call_method' => array( 'class' => 'eZWorkflowFunctionCollection',
                                                                    'method' => 'fetchWorkflowStatuses' ),
                                            'parameter_type' => 'standard',
                                            'parameters' => array( ) );

$FunctionList['workflow_type_statuses'] = array( 'name' => 'workflow_type_statuses',
                                                 'operation_types' => array( 'read' ),
                                                 'call_method' => array( 'class' => 'eZWorkflowFunctionCollection',
                                                                         'method' => 'fetchWorkflowTypeStatuses' ),
                                                 'parameter_type' => 'standard',
                                                 'parameters' => array( ) );

?>
