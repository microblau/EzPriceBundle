<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$module = $Params['Module'];


$ini = eZINI::instance();
$tpl = eZTemplate::factory();

$Result = array();
$Result['content'] = $tpl->fetch( "design:setup/rad.tpl" );
$Result['path'] = array( array( 'url' => false,
                                'text' => ezpI18n::tr( 'kernel/setup', 'Rapid Application Development' ) ) );


?>
