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

$FunctionList['best_sell_list'] = array( 'name' => 'best_sell_list',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                 'method' => 'fetchBestSellList' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'top_parent_node_id',
                                                                       'type' => 'integer',
                                                                       'required' => true ),
                                                                array( 'name' => 'limit',
                                                                       'type' => 'integer',
                                                                       'required' => false ),
                                                                array( 'name' => 'offset',
                                                                       'type' => 'integer',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'start_time',
                                                                       'type' => 'integer',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'end_time',
                                                                       'type' => 'integer',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'duration',
                                                                       'type' => 'integer',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'ascending',
                                                                       'type' => 'boolean',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'extended',
                                                                       'type' => 'boolean',
                                                                       'required' => false,
                                                                       'default' => false ),
                                                                array( 'name' => 'attribute_filter',
                                                             		   'type' => 'mixed',
                                                             		   'required' => false,
                                                             		   'default' => false ),
                                                                array( 'name' => 'extended_attribute_filter',
                                                             		   'type' => 'mixed',
                                                                       'required' => false,
                                                                       'default' => false ) ) );

$FunctionList['get_tipos_via'] = array( 'name' => 'get_tipos_via',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getTiposVia' ),
										'parameter_type' => 'standard',
										'parameters' => array()
);

$FunctionList['get_profesiones'] = array( 'name' => 'get_profesiones',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getProfesiones' ),
										'parameter_type' => 'standard',
										'parameters' => array()
);

$FunctionList['get_cargos'] = array( 'name' => 'get_cargos',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getCargos' ),
										'parameter_type' => 'standard',
										'parameters' => array()
);

$FunctionList['get_actividades'] = array( 'name' => 'get_actividades',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getActividades' ),
										'parameter_type' => 'standard',
										'parameters' => array()
);

$FunctionList['get_areas'] = array( 'name' => 'get_areas',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getAreas' ),
										'parameter_type' => 'standard',
										'parameters' => array()
);

$FunctionList['get_departamentos'] = array( 'name' => 'get_departamentos',
                                        'operation_types' => array( 'read'),
                                        'call_method' => array( 'class' => 'ezEflUtils',
                                                                'method' => 'getDepartamentos' ),
                                        'parameter_type' => 'standard',
                                        'parameters' => array()
);

$FunctionList['get_materias'] = array( 'name' => 'get_materias',
                                        'operation_types' => array( 'read'),
                                        'call_method' => array( 'class' => 'ezEflUtils',
                                                                'method' => 'getMaterias' ),
                                        'parameter_type' => 'standard',
                                        'parameters' => array()
);

$FunctionList['get_order_info'] = array( 'name' => 'get_order_info',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getOrderInfo' ),
										'parameter_type' => 'standard',
										'parameters' => array( array( 'name' => 'productcollection_id',
                                                                       'type' => 'integer',
                                                                       'required' => true ) )
);

$FunctionList['related_purchase'] = array( 'name' => 'related_purchase',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                 'method' => 'fetchRelatedPurchaseList' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'contentobject_ids',
                                                                       'type' => 'array',
                                                                       'required' => true ),
                                                                array( 'name' => 'limit',
                                                                       'type' => 'integer',
                                                                       'required' => true ) ) );

$FunctionList['get_products_in_basket'] = array( 'name' => 'get_products_in_basket',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                 'method' => 'getProductsInBasket' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'productcollection_id',
                                                                       'type' => 'integer',
                                                                       'required' => true ) ) );

$FunctionList['get_training_in_basket'] = array( 'name' => 'get_training_in_basket',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                 'method' => 'getTrainingInBasket' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'productcollection_id',
                                                                       'type' => 'integer',
                                                                       'required' => true ) ) );        

$FunctionList['get_usuario_areas_interes'] = array( 'name' => 'get_usuarios_areas_interes',
                                                     'operation_types' => array( 'read' ),
                                                     'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                             'method' => 'getUsuarioAreasInteres' ),
                                                     'parameter_type' => 'standard',
                                                     'parameters' => array( array( 'name' => 'user_id',
                                                                                   'type' => 'integer',
                                                                                   'required' => true ) ) );      

$FunctionList['get_usuario_datos_paso3'] = array( 'name' => 'get_usuario_datos_paso3',
                                                     'operation_types' => array( 'read' ),
                                                     'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                             'method' => 'getUsuarioDatosPaso3' ),
                                                     'parameter_type' => 'standard',
                                                     'parameters' => array( array( 'name' => 'user_id',
                                                                                   'type' => 'integer',
                                                                                   'required' => true ) ) );         

$FunctionList['discount_by_ticket'] = array( 'name' => 'discount_by_ticket',
                                                     'operation_types' => array( 'read' ),
                                                     'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                             'method' => 'discountByTicket' ),
                                                     'parameter_type' => 'standard',
                                                     'parameters' => array( array( 'name' => 'product_id',
                                                                                   'type' => 'integer',
                                                                                   'required' => true ) ) );          
$FunctionList['nautis4_price'] = array( 'name' => 'nautis4_price',
                                                     'operation_types' => array( 'read' ),
                                                     'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                             'method' => 'nautis4Price' ),
                                                     'parameter_type' => 'standard',
                                                     'parameters' => array( array( 'name' => 'product_id',
                                                                                   'type' => 'integer',
                                                                                   'required' => true ),
                                                                            array( 'name' => 'mementos',
                                                                                   'type' => 'integer',
                                                                                   'required' => true )
 ) );     

 $FunctionList['get_discount_type'] = array( 'name' => 'get_discount_type',
                                                     'operation_types' => array( 'read' ),
                                                     'call_method' => array( 'class' => 'tantaBasketFunctionCollection',
                                                                             'method' => 'getDiscountType' ),
                                                     'parameter_type' => 'standard',
                                                     'parameters' => array( array( 'name' => 'user',
                                                                                   'type' => 'object',
                                                                                   'required' => true ),
                                                                            array( 'name' => 'params',
                                                                                   'type' => 'array',
                                                                                   'required' => true )
 ) );  
 
 $FunctionList['get_datos_usuario'] = array( 'name' => 'get_datos_usuario',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getDatosUsuario' ),
										'parameter_type' => 'standard',
										'parameters' => array( array( 'name' => 'email',
                                                                       'type' => 'string',
                                                                       'required' => true ) )
);
 
$FunctionList['gastos_envio'] = array( 'name' => 'gastos_envio',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflUtils',
																'method' => 'getGastosEnvio' ),
										'parameter_type' => 'standard',
										'parameters' => array( )
);
?>
