<?php
// Created on: <28-Jun-2009 22:00 bm>
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

class DBAttributeConverter
{
	static function getConvertHandlers()
	{
		$converIni = eZINI::instance( 'attributeconverter.ini' );
		$handlerArray = $converIni->variable( 'ConverterHandlers', 'Handler' );
		foreach ( $handlerArray as $handler )
		{
			$parts = explode( '2', $handler );
			$handlers[][$parts[0]] = $parts[1];
			
		}
		return $handlers;
		
	}

	static function getConvertFromArray()
	{
		$converIni = eZINI::instance( 'attributeconverter.ini' );
		$handlerArray = $converIni->variable( 'ConverterHandlers', 'Handler' );
		
		foreach ( $handlerArray as $handler )
		{
			$parts = explode( '2', $handler );
			$handlers[] = $parts[0];
			
		}
		return $handlers;
	}

	static function getTargetDatatypeBySource( $source_datatype )
	{
		// if passed variable is an integer, it means that attribute_id has been passed - need to get datatype_string
		if ( is_int( $source_datatype ) )
		{
			$attribute = eZContentClassAttribute::fetch( $source_datatype );
			if ( !is_object( $attribute ) )
			{
				return false;
			}
			$source_datatype = $attribute->attribute( 'data_type_string' );
			
			
		}
		$converIni = eZINI::instance( 'attributeconverter.ini' );
		$handlerArray = $converIni->variable( 'ConverterHandlers', 'Handler' );
		
		foreach ( $handlerArray as $handler )
		{
			// this part should be improved in future to handle datatypes that contain "2" in name, like ezmultioption2
			$parts = explode( '2', $handler );
			if ( $parts[0] == $source_datatype )
				$handlers[] = $parts[1];
			
		}
		return $handlers;
	}

	static function getContentObjectAttributeCount( $attribute_id )
	{
		return eZContentObjectAttribute::fetchListByClassID( $attribute_id, $version = false, $limit = null, $asObject = true, $asCount = true );
	}

	static function createDataForCLI( $object )
	{
		// make a new object copy
		$ser = serialize( $object );
		$simplified_object = unserialize( $ser );
		// remove some unnecessary data
		unset( $simplified_object->TPL );
		unset( $simplified_object->Module );
		// serialize again and store in file
		$serialized_object = serialize( $simplified_object );
		$filename_part = substr( md5( $serialized_object ), 0, 4 );
		$fp = fopen( 'var/cache/' . $filename_part . '.txt', 'w' );
		$res = fwrite( $fp, $serialized_object );
		fclose( $fp );	
		if ( $res > 0 )
			return $filename_part;
		else
			return false;	
	}

}

?>