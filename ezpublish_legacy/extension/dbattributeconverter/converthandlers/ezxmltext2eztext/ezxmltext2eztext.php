<?php

class ezxmltext2eztext extends convertHandler
{
	var $from_datatype	= 'ezxmltext';
	var $to_datatype	= 'eztext';

	function ezstring2eztext()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentClassAttribute->store();
	}

	function convertObjectAttribute( $contentObjectAttribute, $wizard )
	{
		// get content from exmltext output handler
		$content = $contentObjectAttribute->content()->attribute('output')->attribute('output_text');
		// strip html tags if selected
		if ( $wizard->VariableList['settings']['Output'] == 'plain_text' )
		{
			$content = strip_tags( $content );
			$content = str_replace( "\n\n", "\n", trim( $content ) );
		}
		// store as new datatype
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		$contentObjectAttribute->store();
	}

	function getSettings()
	{
		$settings = array();
		$settings[] = array( 'type'  => 'select',
							 'name'  => 'Output',
							 'label' => ezpI18n::tr( 'attributeconverter/common', 'Output' ),
							 'options' => array( 'plain_text' => 'Plain text', 
												 'xhtml' 	  => 'XHTML' ) );
		return $settings;
	}
	
}

?>