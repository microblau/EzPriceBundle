<?php
$FunctionList = array();

$FunctionList['get_filter'] = array( 'name' => 'get_filter',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflCatalogo',
																'method' => 'getFilter' ),
										'parameter_type' => 'standard',
										'parameters' => array(
                                                                array( 'name' => 'param1',
                                                                       'type' => 'string',
                                                                       'required' => true ),
                                                                array( 'name' => 'param2',
                                                                       'type' => 'string',
                                                                       'required' => true )
                                                            )
);

$FunctionList['get_extended_filter'] = array( 'name' => 'get_extended_filter',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflCatalogo',
																'method' => 'getExtendedFilter' ),
										'parameter_type' => 'standard',
										'parameters' => array(
                                                                array( 'name' => 'param1',
                                                                       'type' => 'string',
                                                                       'required' => true ),
                                                                array( 'name' => 'param2',
                                                                       'type' => 'string',
                                                                       'required' => true )
                                                            )
);

$FunctionList['custom_reverse_related_objects'] = array( 'name' => 'custom_reverse_related_objects',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'ezEflCatalogo',
																'method' => 'customReverseRelatedObjects' ),
										'parameter_type' => 'standard',
										'parameters' => array(
                                                                array( 'name' => 'from_object_version',
                                                                       'type' => 'mixed',
                                                                       'required' => true ),
                                                                array( 'name' => 'object_id',
                                                                       'type' => 'int',
                                                                       'required' => true ),
                                                                array( 'name' => 'attribute_id',
                                                                       'type' => 'mixed',
                                                                       'required' => true ),
                                                                array( 'name' => 'group_by_attribute',
                                                                       'type' => 'boolean',
                                                                       'required' => true ),
                                                                array( 'name' => 'params',
                                                                       'type' => 'mixed',
                                                                       'required' => true ),
                                                                array( 'name' => 'reverse_related_objects',
                                                                       'type' => 'boolean',
                                                                       'required' => true )
                                                            )
);

?>
