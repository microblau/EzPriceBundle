<?php
// Created on: <19-Jul-2009 17:00 bm>
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

class ezobjectrelationlist2ezobjectrelation extends convertHandler
{
	var $from_datatype	= 'ezobjectrelationlist';
	var $to_datatype	= 'ezobjectrelation';

	function __constructor()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentClassAttribute->setAttribute( 'data_text5', '' );
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute, $wizard )
	{
		// get object selection
		$settings = $wizard->VariableList['settings'];
		$object_selection = $settings['ObjectSelection']; 
		$content = $this->getAttributeContent( $contentObjectAttribute, $object_selection ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		$contentObjectAttribute->setAttribute( 'data_text', null );
		$contentObjectAttribute->store();
	}

	function getAttributeContent( $contentObjectAttribute, $object_selection = null )
	{
		$string = $contentObjectAttribute->toString();
		if ( empty( $string ) )
		{
			return null;
		}
		$array  = explode( '-', $string );
		if ( $object_selection == 'last' )
		{
			// return last object
			$return = $array[(count($array)-1)];
		}
		else
		{
			// return first object
			$return = $array[0];
		}
		return $return;
	}
	
	function getSettings()
	{
		$settings = array();
		$settings[] = array( 'type'  => 'select',
							 'name'  => 'ObjectSelection',
							 'label' => ezi18n( 'attributeconverter/common', 'Object selection if many' ),
							 'options' => array( 'first' => 'First related object', 
												 'last' => 'Last related object' ) );
		return $settings;
	}

}

?>