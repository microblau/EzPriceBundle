<?php

class ezinteger2ezfloat extends convertHandler
{
	var $from_datatype	= 'ezinteger';
	var $to_datatype	= 'ezfloat';

	function ezinteger2ezfloat()
	{
		
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		// get class settings like min/max val, default val
		$data_int1 = $contentClassAttribute->attribute( 'data_int1' );
		$data_int2 = $contentClassAttribute->attribute( 'data_int2' );
		$data_int3 = $contentClassAttribute->attribute( 'data_int3' );
		$data_int4 = $contentClassAttribute->attribute( 'data_int4' );
		// set new data as float
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentClassAttribute->setAttribute( 'data_float1', $data_int1 ); 
		$contentClassAttribute->setAttribute( 'data_float2', $data_int2 ); 
		$contentClassAttribute->setAttribute( 'data_float3', $data_int3 ); 
		$contentClassAttribute->setAttribute( 'data_float4', $data_int4 ); 
		// clear integer values
		$contentClassAttribute->setAttribute( 'data_int1', 0 ); 
		$contentClassAttribute->setAttribute( 'data_int2', 0 ); 
		$contentClassAttribute->setAttribute( 'data_int3', 0 ); 
		$contentClassAttribute->setAttribute( 'data_int4', 0 ); 
		$contentClassAttribute->store();
		
		//print_r($contentClassAttribute);
	}
	
	function convertObjectAttribute( $contentObjectAttribute )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		$contentObjectAttribute->setAttribute( 'data_int', null );
		$contentObjectAttribute->store();
	}
	
}

?>