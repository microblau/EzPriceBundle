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

/**
 * Definición de la función para pintar calendario
 * 
 * @author carlos.revillo@tantacom.com
 */

$FunctionList = array();

$FunctionList['show_month'] = array( 'name' => 'custom_valid_nodes',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'calendarFunctions',
                                                                 'method' => 'showMonth' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'year',
                                                                       'type' => 'integer',
                                                                       'required' => true 
                                                                	 ), 
																array( 'name' => 'month',
                                                                       'type' => 'integer',
                                                                       'required' => true 
																	 ),
																array( 'name' => 'days',
                                                                       'type' => 'array',
                                                                       'required' => true 
																     ),
																array( 'name' => 'day_name_length',
                                                                       'type' => 'int',
                                                                       'required' => true 
																     ),
																array( 'name' => 'month_href',
                                                                       'type' => 'mixed',
                                                                       'required' => true 
																     ),
																array( 'name' => 'first_day',
                                                                       'type' => 'integer',
                                                                       'required' => true 
																     ),
															 	array( 'name' => 'pn',
                                                                       'type' => 'array',
                                                                       'required' => true 
																     ),
																array( 'name' => 'pn',
                                                                       'type' => 'integer',
                                                                       'required' => true  )	    
                                                                	  
                                                                	 ) );
                     
$FunctionList['days'] = array( 'name' => 'custom_valid_nodes',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'calendarFunctions',
                                                                 'method' => 'getDays' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'fechas',
                                                                       'type' => 'array',
                                                                       'required' => true 
                                                                	 ) 
																    
                                                                	  
                                                                	 ) );                                                             	 
?>