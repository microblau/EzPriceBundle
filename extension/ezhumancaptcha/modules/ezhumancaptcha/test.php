<?php

/**
 * eZ Human CAPTCHA extension for eZ Publish 4.0
 * Written by Piotrek Karas, Copyright (C) SELF s.c.
 * http://www.mediaself.pl, http://ryba.eu
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */


require_once( "kernel/common/template.php" );

$tpl = templateInit();
$Result = array();
$Module = $Params['Module'];


$contentObjectID = 158;
$fileAttributeIdentifier  = 'file';

$fileContentObject = eZContentObject::fetch( $contentObjectID );
$fileContentObject->fetchDataMap();
$fileAttributeObject = $fileContentObject->DataMap[$fileContentObject->CurrentVersion][$fileContentObject->CurrentLanguage][$fileAttributeIdentifier];
$fileAttributeObject->content();
$fileObject = $fileAttributeObject->Content;
$filePath = $fileObject->filePath();




/*

switch( $Module->NamedParameters['Action'] )
{
	case 'receive':
		$Result['content'] = $tpl->fetch( 'design:test/receive.tpl' );
		break;
	case 'send':
	default:
		$Result['content'] = $tpl->fetch( 'design:test/send.tpl' );
		break;
}
*/
?>