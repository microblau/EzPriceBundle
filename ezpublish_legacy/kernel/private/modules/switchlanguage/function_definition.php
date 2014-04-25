<?php
/**
 * File containing function definition for LanguageSwitcher module
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$FunctionList = array();
$FunctionList['url_alias'] = array( 'name' => 'url_alias',
                                    'call_method' => array( 'class' => 'ezpLanguageSwitcherFunctionCollection',
                                                            'method' => 'fetchUrlAlias' ),
                                    'parameters' => array(
                                                           array( 'name' => 'node_id',
                                                                  'type' => 'integer',
                                                                  'default' => false,
                                                                  'required' => false ),

                                                           array( 'name' => 'path',
                                                                  'type' => 'string',
                                                                  'default' => false,
                                                                  'required' => false ),

                                                           array( 'name' => 'locale',
                                                                  'type' => 'string',
                                                                  'default' => false,
                                                                  'required' => true ), ) );

?>
