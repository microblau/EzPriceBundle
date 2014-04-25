<?php

$FunctionList=array();
$FunctionList['muestratodas'] = array( 'name' => 'muestratodas',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'muestratodas' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															, array( 'name' => 'limite',
                                                                       'type' => 'integer',
                                                                       'required' => false ),
															    array( 'name' => 'offset',
                                                                       'type' => 'integer',
                                                                       'required' => false ),
																 array( 'name' => 'condicion',
                                                                       'type' => 'string',
                                                                       'required' => false )	   
																) );		

$FunctionList['cuantasvaloraciones'] = array( 'name' => 'cuantasvaloraciones',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'cuantasvaloraciones' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );


$FunctionList['mediacalidad'] = array( 'name' => 'mediacalidad',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'mediacalidad' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );
$FunctionList['mediaactualizaciones'] = array( 'name' => 'mediaactualizaciones',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'mediaactualizaciones' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );
$FunctionList['mediafacilidad'] = array( 'name' => 'mediafacilidad',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'mediafacilidad' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );		
																	 
$FunctionList['muestraultimas'] = array( 'name' => 'muestraultimas',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'muestraultimas' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );																	 															 


$FunctionList['muestraaleatorio'] = array( 'name' => 'muestraaleatorio',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'muestraaleatorio' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 )
																
                                                                	 );	
																	 
$FunctionList['calculaestrellas'] = array( 'name' => 'calculaestrellas',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'calculaestrellas' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 , array( 'name' => 'categoria',
                                                                       'type' => 'integer',
                                                                       'required' => false ),
															    array( 'name' => 'n_estrellas',
                                                                       'type' => 'integer',
                                                                       'required' => false )
																) );																				 
																	 				
$FunctionList['damevaloraciones'] = array( 'name' => 'damevaloraciones',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'damevaloraciones' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'orden',
                                                                       'type' => 'string',
                                                                       'required' => true ) , 
															    array( 'name' => 'limite',
                                                                       'type' => 'integer',
                                                                       'required' => false ),
															    array( 'name' => 'offset',
                                                                       'type' => 'integer',
                                                                       'required' => false )
																) );		
$FunctionList['havotado'] = array( 'name' => 'havotado',
                                         'operation_types' => array( 'read' ),
                                         'call_method' => array('include_file' => 'extension/utils/modules/producto/classes/Valoraciones.php',	 
										 						'class' => 'Valoraciones',
                                                                 'method' => 'havotado' ),
                                         'parameter_type' => 'standard',
                                         'parameters' => array( array( 'name' => 'node_id',
                                                                       'type' => 'string',
                                                                       'required' => true )
															 , array( 'name' => 'usuario',
                                                                       'type' => 'string',
                                                                       'required' => false )
																) );																	 
																 
?>