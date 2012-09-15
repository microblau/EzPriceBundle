<?php
//
// Created on: <19-Feb-2010 12:47:49 carlos.revillo@tantacom.com>
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

$FunctionList['view_top_list'] = array( 'name' => 'view_top_list',
                                        'operation_types' => array( 'read' ),
                                        'call_method' => array( 'class' => 'tantaStatsFunctionCollection',
                                                                'method' => 'fetchMostViewedTopList' ),
                                        'parameter_type' => 'standard',
                                        'parameters' => array( array( 'name' => 'class_id',
                                                                      'type' => 'integer',
                                                                      'required' => false,
                                                                      'default' => false ),
                                                               array( 'name' => 'section_id',
                                                                      'type' => 'integer',
                                                                      'required' => false,
                                                                      'default' => false ),
                                                               array( 'name' => 'attribute_filter',
                                                                      'type' => 'mixed',
                                                                      'required' => false,
                                                                      'default' => false ),
                                                                array( 'name' => 'extended_attribute_filter',
                                                                      'type' => 'integer',
                                                                      'required' => false,
                                                                      'default' => false ),
                                                               array( 'name' => 'offset',
                                                                      'type' => 'integer',
                                                                      'required' => false,
                                                                      'default' => false ),
                                                               array( 'name' => 'limit',
                                                                      'type' => 'integer',
                                                                      'required' => false,
                                                                      'default' => false ) ) );
?>