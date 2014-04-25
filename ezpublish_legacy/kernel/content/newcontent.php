<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$tpl = eZTemplate::factory();
$user = eZUser::currentUser();

$tpl->setVariable( "view_parameters", $Params['UserParameters'] );
$tpl->setVariable( 'last_visit_timestamp', $user->lastVisit() );

$Result['content'] = $tpl->fetch( 'design:content/newcontent.tpl' );
$Result['path'] = array( array( 'text' => ezpI18n::tr( 'kernel/content', 'New content' ),
                                'url' => false ) );


?>
