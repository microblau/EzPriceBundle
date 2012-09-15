<?php

class eztext2ezxmltext extends convertHandler
{
	var $from_datatype	= 'eztext';
	var $to_datatype	= 'ezxmltext';

	function ezstring2eztext()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentClassAttribute->store();
	}

	function convertObjectAttribute( $contentObjectAttribute, $wizard = null )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		// call XMLInputParser
		$parser = new eZSimplifiedXMLInputParser( $contentObjectAttribute->ContentObjectID );
		$parser->setParseLineBreaks( true );
		$document = $parser->process( $content );
		// Create XML structure
		$xmlString = eZXMLTextType::domString( $document );
		// store as new datatype
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $xmlString );
		$contentObjectAttribute->store();
	}

/*	function getSettings()
	{
		$settings = array();
		$settings[] = array( 'type'  => 'select',
							 'name'  => 'Output',
							 'label' => ezi18n( 'attributeconverter/common', 'Output' ),
							 'options' => array( 'plain_text' => 'Plain text', 
												 'xhtml' 	  => 'XHTML' ) );
		return $settings;
	}*/
	
}

?>