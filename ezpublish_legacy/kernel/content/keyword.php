<?php
/**
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

$Module = $Params['Module'];
$Alphabet = rawurldecode( $Params['Alphabet'] );

$Offset = $Params['Offset'];
$ClassID = $Params['ClassID'];
$viewParameters = array( 'offset' => $Offset, 'classid' => $ClassID );

$tpl = eZTemplate::factory();

$tpl->setVariable( 'view_parameters', $viewParameters );
$tpl->setVariable( 'alphabet', $Alphabet );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:content/keyword.tpl' );
$Result['path'] = array( array( 'text' => ezpI18n::tr( 'kernel/content', 'Keywords' ),
                                'url' => false ) );

?>
