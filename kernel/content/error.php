<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$NodeID = $Params['NodeID'];
$Module = $Params['Module'];


$tpl = eZTemplate::factory();

$Module->setTitle( "Error 404 object " . $NodeID . " not found" );

$tpl->setVariable( "object", $NodeID );

$Result = array();
$Result['content'] = $tpl->fetch( "design:content/error.tpl" );


?>
