<?php

class ezfloat2ezinteger extends convertHandler
{
	var $from_datatype	= 'ezfloat';
	var $to_datatype	= 'ezinteger';

	function ezfloat2ezinteger()
	{
		
	}

	function convertClassAttribute( $contentClassAttribute, $wizard )
	{
		// get round method
		$settings = $wizard->VariableList['settings'];
		$round_method = $settings['RoundMethod']; 
		// get class settings like min/max val, default val, state
		$data_float1 = $round_method( $contentClassAttribute->attribute( 'data_float1' ) );
		$data_float2 = $round_method( $contentClassAttribute->attribute( 'data_float2' ) );
		$data_float3 = $round_method( $contentClassAttribute->attribute( 'data_float3' ) );
		$data_float4 = $round_method( $contentClassAttribute->attribute( 'data_float4' ) );
		// set new data as integer
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentClassAttribute->setAttribute( 'data_int1', $data_float1 );
		$contentClassAttribute->setAttribute( 'data_int2', $data_float2 );
		$contentClassAttribute->setAttribute( 'data_int3', $data_float3 );
		$contentClassAttribute->setAttribute( 'data_int4', $data_float4 );
		// clear float values
		$contentClassAttribute->setAttribute( 'data_float1', 0 );
		$contentClassAttribute->setAttribute( 'data_float2', 0 );
		$contentClassAttribute->setAttribute( 'data_float3', 0 );
		$contentClassAttribute->setAttribute( 'data_float4', 0 );
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute, $wizard )
	{
		// get round method
		$settings = $wizard->VariableList['settings'];
		$round_method = $settings['RoundMethod']; 
		// get object content
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		// do modifs
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $round_method( $content ) );
		$contentObjectAttribute->setAttribute( 'data_float', null );
		$contentObjectAttribute->store();
	}
	
	function getSettings()
	{
		$settings = array();
		$settings[] = array( 'type'  => 'select',
							 'name'  => 'RoundMethod',
							 'label' => ezi18n( 'attributeconverter/common', 'Round method' ),
							 'options' => array( 'floor' => 'Floor', 
												 'round' => 'Round', 
												 'ceil' => 'Ceil' ) );
		return $settings;
	}
}

?>