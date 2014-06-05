<?php
// Created on: <13-Jul-2009 18:40 bm>
//
// SOFTWARE NAME: DB Attribute Converter
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 2009 DB Team, http://db-team.eu
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.

class ezdatetime2ezdate extends convertHandler
{
	var $from_datatype	= 'ezdatetime';
	var $to_datatype	= 'ezdate';

	function ezdatetime2ezdate()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// remove default value "Adjusted current datetime" as it doesn't exists in ezdate
		if ( $contentClassAttribute->attribute( 'data_int1' ) == 2 )
		{
			// change to no default value, or maybe change to current date ? 
			$contentClassAttribute->setAttribute( 'data_int1', 0 ); // ( 'data_int1', 1 )
			// remove obsolete xml data
			$contentClassAttribute->setAttribute( 'data_text5', '' );
		}
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute );
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// round timestamp to 00h00 of current date
		$day   = date( "d" ,$content );
		$month = date( "m" ,$content );
		$year  = date( "Y" ,$content );
		$new_timestamp = mktime( 0, 0, 0, $month, $day, $year );
		$contentObjectAttribute->fromString( $new_timestamp );
		
		$contentObjectAttribute->store();
	}
	
}

?>