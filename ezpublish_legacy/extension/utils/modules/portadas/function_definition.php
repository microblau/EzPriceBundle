<?php
//
// Created on: <25-Feb-2010 18:47:49 carlos.revillo@tantacom.com>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//

/*! \file
*/


$FunctionList = array();

$FunctionList['custom_valid_nodes'] = array( 'name' => 'custom_valid_nodes',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'customEZFlowFunctionCollection',
                                                                 'method' => 'customValidNodes' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'block_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
                                                                	 ) );

$FunctionList['custom_waiting_nodes'] = array( 'name' => 'custom_waiting_nodes',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'customEZFlowFunctionCollection',
                                                                 'method' => 'customWaitingNodes' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'block_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
                                                                	 ) );

$FunctionList['get_pos_for_node_in_block'] = array( 'name' => 'get_pos_for_node_in_block',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'customEZFlowFunctionCollection',
                                                                 'method' => 'getPosForNodeInBlock' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'block_id',
                                                                       'type' => 'string',
                                                                       'required' => true ),
																array( 'name' => 'node_id',
																	   'type' => 'integer',
																	   'required' => true
                                                                	 ) ) );

$FunctionList['get_elements_for_block'] = array( 'name' => 'get_elements_for_block',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'customEZFlowFunctionCollection',
                                                                 'method' => 'getElementsForBlock' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'block_id',
                                                                       'type' => 'string',
                                                                       'required' => true ),
																array( 'name' => 'pos',
																	   'type' => 'integer',
																	   'required' => false
                                                                	 ),
                                                                array( 'name' => 'offset',
																	   'type' => 'integer',
																	   'required' => true
                                                                	 ),
																array( 'name' => 'limit',
																	   'type' => 'integer',
																	   'required' => true
                                                                	 )
                                                                	 ) );

$FunctionList['get_total_elements_for_block'] = array( 'name' => 'get_total_elements_for_block',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'customEZFlowFunctionCollection',
                                                                 'method' => 'getTotalElementsForBlock' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'block_id',
                                                                       'type' => 'string',
                                                                       'required' => true ),
																array( 'name' => 'pos',
																	   'type' => 'integer',
																	   'required' => false
                                                                	 ),
                                                               array( 'name' => 'items_per_block',
                                                                       'type' => 'integer',
                                                                       'required' => false
                                                                     )
																
                                                                	 ) );

                                                                	 
?>