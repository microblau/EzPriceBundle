<?php
/**
 * File index.php
 *
 * @copyright Copyright (C) 2007-2010 CJW Network - Coolscreen.de, JAC Systeme GmbH, Webmanufaktur. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU GPL v2
 * @version 1.0.0beta2 | $Id: index.php 12403 2010-07-08 15:32:31Z felix $
 * @package cjw_newsletter
 * @todo pruefen ob kommentare entfernt werden können
 * @subpackage modules
 * @filesource
 */

include_once( 'kernel/common/template.php' );

$module = $Params[ 'Module' ];
$http = eZHTTPTool::instance();

$viewParameters = array( 'offset' => 0,
                         'namefilter' => '' );

// variablen mit () in der url in viewparameter übernehmen
// z.B.  ../list/(offset)/4  setzt die viewparametervariable $offset = 3
$userParameters = $Params['UserParameters'];
$viewParameters = array_merge( $viewParameters, $userParameters );


$tpl = templateInit();
$tpl->setVariable( 'view_parameters', $viewParameters );

$tpl->setVariable( 'current_siteaccess', $viewParameters );
$Result = array();
$Result['content'] = $tpl->fetch( "design:newsletter/index.tpl" );
$Result['path'] = array( array( 'url'  => false,
                                'text' => ezi18n( 'cjw_newsletter', 'Newsletter' ) ),
                         array( 'url'  => false,
                                'text' => ezi18n( 'cjw_newsletter/index', 'Dashboard' ) ) );

?>