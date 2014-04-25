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
 *
 *
 *
 * This class provides a collection of universal tools for CAPTCHA purposes.
 */


if ( !$isQuiet )
{
	$cli->output( 'Test CRON...' );
}

file_put_contents( 'crontext.log', date("Y-m-d H:i:s") . ' test cron', FILE_APPEND );

if ( !$isQuiet )
{
	$cli->output( $cleanupResult[0].'/'.$cleanupResult[1].' done!' );
}

?>
