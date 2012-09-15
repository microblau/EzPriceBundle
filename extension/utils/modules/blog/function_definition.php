<?php
$FunctionList = array();

$FunctionList['get_related_posts'] = array( 'name' => 'get_related_posts',
										'operation_types' => array( 'read'),
										'call_method' => array( 'class' => 'eflBlog',
																'method' => 'getRelatedPosts' ),
										'parameter_type' => 'standard',
										'parameters' => array(
                                                                array( 'name' => 'query',
                                                                       'type' => 'string',
                                                                       'required' => true )
                                                                
                                                            )
);

?>
