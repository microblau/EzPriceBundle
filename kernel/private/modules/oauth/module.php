<?php
/**
 * File containing the oauthadmin module definition.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

include_once 'kernel/private/rest/classes/lazy.php';

$Module = array( 'name' => 'Rest client authorization',
                 'variable_params' => true );

$ViewList = array();

$ViewList['authorize'] = array(
    'script' => 'authorize.php',
);

$FunctionList = array( );
?>
