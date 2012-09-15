<?php
// Created on: <28-Jun-2009 21:00 bartek modzelewski>
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

class convertHandler
{
	// set initial version, in future handlers may need higher version
	const VERSION_FRAMEWORK = '1.0';

	function convertHandler()
	{
	}

	function preAction()
	{
		return true;		
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		return true;		
	}

	function postConvertClassAttributeAction()
	{
		return true;		
	}
	
	function preConvertObjectAttributesAction()
	{
		return true;		
	}
	
	function convertObjectAttribute( $contentObjectAttribute, $wizard = null )
	{
		return true;
	}

	function postAction()
	{
		return true;		
	}	
	
	function getAttributeContent( $contentObjectAttribute )
	{
		 return $contentObjectAttribute->toString();
	}

	function getWarnings()
	{
		$warnings = array( ezi18n( 'dbattributeconverter/common', 'No warnings' ) );
		
		return $warnings;		
	}	
	
	function getSettings()
	{
		/*
		$settings = array();
		$settings[] = array( 'type'  => 'checkbox',
							 'name'  => 'ClearData', 
							 'label' => ezi18n( 'attributeconverter/common', 'Clear all data' ) );
		$settings[] = array( 'type'  => 'select',
							 'name'  => 'TestListbox',
							 'label' => ezi18n( 'attributeconverter/common', 'Listbox test' ),
							 'options' => array( 'yes' => 'Yes', 
												 'no' => 'No' ) );
		$settings[] = array( 'type'  => 'text',
							 'name'  => 'Text',
							 'label' => ezi18n( 'attributeconverter/common', 'Type some text here' ) );
		return $settings;
		*/
		return false;
	}

}

?>