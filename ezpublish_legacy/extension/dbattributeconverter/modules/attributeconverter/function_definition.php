<?php
//
// Created on: <19-Apr-2008 Bartek Modzelewski>


/*! \file function_definition.php
*/

$FunctionList = array();

$FunctionList['view_message'] = array( 'name' => 'view_message',
                                 'call_method' => array( 'class' => 'eZPm',
                                                         'method' => 'fetchMessage' ),
                                 'parameter_type' => 'standard',
                                 'parameters' => array ( array ( 'name' => 'id',
                                                                 'type' => 'integer',
                                                                 'required' => true ) ) );


?>
