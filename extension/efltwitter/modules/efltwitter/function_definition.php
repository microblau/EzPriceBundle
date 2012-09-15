<?php
$FunctionList = array();

$FunctionList['getUserTimeline'] = array( 'name' => 'getUserTimeline',
                                  'operation_types' => array( 'read' ),
                                  'call_method' => array( 'include_file' => 'extension/efltwitter/classes/efltwitter.php',
                                                          'class' => 'eflTwitter',
                                                          'method' => 'getUserTimeline' ),
                                  'parameter_type' => 'standard',
                                  'parameters' => array(
                                      array( 'name' => 'limit',
                                             'type' => 'integer',
                                             'required' => false ),
                                      array( 'name' => 'user',
                                             'type' => 'string',
                                             'required' => true ),

                                      array( 'name' => 'pass',
                                             'type' => 'string',
                                             'required' => false ),

                                      array( 'name' => 'include_retweets',
                                             'type' => 'bool',
                                             'required' => false,
                                             'default' => false )

                                      ) );

$FunctionList['getFriendsTimeline'] = array( 'name' => 'getFriendsTimeline',
                                  'operation_types' => array( 'read' ),
                                  'call_method' => array( 'include_file' => 'extension/efltwitter/classes/efltwitter.php',
                                                          'class' => 'eflTwitter',
                                                          'method' => 'getFriendsTimeline' ),
                                  'parameter_type' => 'standard',
                                  'parameters' => array(
                                      array( 'name' => 'limit',
                                             'type' => 'integer',
                                             'required' => false ),
                                     array( 'name' => 'user',
                                             'type' => 'string',
                                             'required' => true ),

                                  array( 'name' => 'pass',
                                             'type' => 'string',
                                             'required' => false )
                                        
                                  ) );
                                  
$FunctionList['getTweetCount'] = array( 'name' => 'getTweetCount',
                                  'operation_types' => array( 'read' ),
                                  'call_method' => array( 'include_file' => 'extension/efltwitter/classes/efltwitter.php',
                                                          'class' => 'eflTwitter',
                                                          'method' => 'getTweetCount' ),
                                  'parameter_type' => 'standard',
                                  'parameters' => array(
                                      array( 'name' => 'url',
                                             'type' => 'string',
                                             'required' => false ),
                                  ) );

$FunctionList['getSearch'] = array( 'name' => 'getSearch',
                                  'operation_types' => array( 'read' ),
                                  'call_method' => array( 'include_file' => 'extension/efltwitter/classes/efltwitter.php',
                                                          'class' => 'eflTwitter',
                                                          'method' => 'getSearch' ),
                                  'parameter_type' => 'standard',
                                  'parameters' => array(
                                      array( 'name' => 'q',
                                             'type' => 'string',
                                             'required' => false ),
                                  ) );

$FunctionList['get_tweets'] = array( 'name'            => 'get_tweets',
                              'operation_types' => array( 'read' ),
                              'call_method'     => array( 'class'  => 'tweetsFunctionCollection',
                                                          'method' => 'getTweets' ),
                              'parameter_type'  => 'standard',
                              'parameters'      => array( array( 'name'     => 'limit',
                                                                             'type'     => 'integer',
                                                                             'required' => false ) ) );
?>
